<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);

        if ($menu->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->menu_id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => $request->quantity,
                'image' => $menu->image,
                'max_stock' => $menu->stock,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Menu ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->quantity > $cart[$id]['max_stock']) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }

            $cart[$id]['quantity'] = $request->quantity;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return back()->with('success', 'Keranjang diperbarui!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Item dihapus dari keranjang!');
    }
}