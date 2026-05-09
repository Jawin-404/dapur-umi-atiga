@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">📦 Riwayat Pesanan Saya</div>
        <div class="card-body">
            @if($orders->count() > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td><strong>{{ $order->order_number }}</strong></td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>{{ strtoupper($order->payment_method) }}</td>
                            <td>
                                <span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 1rem;">
                {{ $orders->links() }}
            </div>
            @else
                <div style="text-align: center; padding: 3rem; color: var(--text-light);">
                    <p style="font-size: 3rem;">📦</p>
                    <p>Belum ada pesanan</p>
                    <a href="{{ route('menus.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Mulai Belanja</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection