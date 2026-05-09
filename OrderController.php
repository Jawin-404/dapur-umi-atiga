<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menus.index')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:qris,cod',
            'notes' => 'nullable|string|max:500',
            'payment_proof' => 'nullable|image|max:2048|required_if:payment_method,qris',
        ]);

        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => auth()->id(),
                'total_price' => $total,
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['notes'],
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Kurangi stok
                Menu::where('id', $item['id'])->decrement('stock', $item['quantity']);
            }

            if ($request->hasFile('payment_proof')) {
                $path = $request->file('payment_proof')->store('payment_proofs', 'public');
                $order->update(['payment_proof' => $path]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with(['items.menu'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $order->load(['items.menu', 'user']);
        return view('orders.show', compact('order'));
    }

    // --- ADMIN ---
    public function adminIndex()
    {
        $orders = Order::with(['user', 'items.menu'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function confirm(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak bisa dikonfirmasi.');
        }

        $order->update(['status' => 'confirmed']);
        return back()->with('success', 'Pesanan berhasil dikonfirmasi!');
    }

    public function reject(Request $request, Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak bisa ditolak.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        // Kembalikan stok
        foreach ($order->items as $item) {
            Menu::where('id', $item->menu_id)->increment('stock', $item->quantity);
        }

        $order->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with('success', 'Pesanan berhasil ditolak.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:preparing,delivering,completed',
        ]);

        $order->update(['status' => $validated['status']]);
        return back()->with('success', 'Status pesanan diperbarui!');
    }
}