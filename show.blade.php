@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            📦 Detail Pesanan {{ $order->order_number }}
            <span class="badge badge-{{ $order->status }}" style="float: right;">{{ ucfirst($order->status) }}</span>
        </div>
        <div class="card-body">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div>
                    <h4 style="color: var(--primary); margin-bottom: 1rem;">Info Pesanan</h4>
                    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>
                    <p><strong>Total:</strong> <span style="color: var(--secondary); font-size: 1.2rem;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                    @if($order->notes)
                        <p><strong>Catatan:</strong> {{ $order->notes }}</p>
                    @endif
                    @if($order->rejection_reason)
                        <div style="background: #f8d7da; padding: 1rem; border-radius: 10px; margin-top: 1rem;">
                            <strong style="color: var(--danger);">Alasan Penolakan:</strong> {{ $order->rejection_reason }}
                        </div>
                    @endif
                </div>
                <div>
                    <h4 style="color: var(--primary); margin-bottom: 1rem;">Alamat Pengiriman</h4>
                    <p><strong>{{ $order->user->name }}</strong></p>
                    <p>{{ $order->user->address }}</p>
                    <p>📞 {{ $order->user->phone }}</p>
                </div>
            </div>

            <h4 style="color: var(--primary); margin: 2rem 0 1rem;">Item Pesanan</h4>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>Menu</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->menu->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td><strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($order->payment_proof)
            <div style="margin-top: 2rem;">
                <h4 style="color: var(--primary); margin-bottom: 1rem;">Bukti Pembayaran</h4>
                <img src="{{ asset('storage/' . $order->payment_proof) }}" style="max-width: 300px; border-radius: 10px; border: 2px solid var(--border);">
            </div>
            @endif

            @if($order->status === 'pending' && $order->payment_method === 'qris' && !$order->payment_proof)
            <div style="margin-top: 1.5rem; padding: 1rem; background: #fff3cd; border-radius: 10px; border: 1px solid #ffc107;">
                <p>⚠️ Pesanan Anda masih menunggu. Silakan transfer ke QRIS dan hubungi admin.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection