@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">📋 Checkout</div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h4 style="color: var(--primary); margin-bottom: 1rem;">Ringkasan Pesanan</h4>
                <div class="table-container" style="margin-bottom: 1.5rem;">
                    <table>
                        <thead>
                            <tr><th>Menu</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td><strong>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                                <td><strong style="color: var(--secondary);">Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <h4 style="color: var(--primary); margin-bottom: 1rem;">Alamat Pengiriman</h4>
                <div style="background: #fdf5ee; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 1px solid var(--border);">
                    <p><strong>{{ auth()->user()->name }}</strong></p>
                    <p>{{ auth()->user()->address }}</p>
                    <p>📞 {{ auth()->user()->phone }}</p>
                    <a href="{{ route('profile.edit') }}" style="color: var(--primary); font-size: 0.9rem;">Ubah alamat →</a>
                </div>

                <div class="form-group">
                    <label>Catatan Pesanan (opsional)</label>
                    <textarea name="notes" class="form-control" placeholder="Contoh: Jangan pakai cabe, nasi setengah, dll..."></textarea>
                </div>

                <div class="form-group">
                    <label>Metode Pembayaran *</label>
                    <select name="payment_method" class="form-control" required id="paymentMethod">
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="qris">💳 QRIS (Transfer)</option>
                        <option value="cod">💵 COD (Bayar di Tempat)</option>
                    </select>
                </div>

                <div id="qrisImage" style="display: none; text-align: center; margin-bottom: 1.5rem;">
                    <p style="font-weight: bold; color: var(--primary);">Scan QRIS di bawah ini:</p>
                    <img src="{{ asset('images/qris-store.png') }}" alt="QRIS" style="max-width: 250px; border: 2px solid var(--border); border-radius: 10px;">
                    <p style="font-size: 0.9rem; color: var(--text-light); margin-top: 0.5rem;">Setelah transfer, upload buktinya di bawah.</p>
                </div>
                document.getElementById('paymentMethod').addEventListener('change', function() {
    const section = document.getElementById('paymentProofSection');
    const qrisImg = document.getElementById('qrisImage');
    const input = document.getElementById('paymentProof');
    
    if (this.value === 'qris') {
        section.style.display = 'block';
        qrisImg.style.display = 'block';
        input.required = true;
    } else {
        section.style.display = 'none';
        qrisImg.style.display = 'none';
        input.required = false;
    }
});

                <div class="form-group" id="paymentProofSection" style="display: none;">
                    <label>Bukti Pembayaran (QRIS) *</label>
                    <input type="file" name="payment_proof" class="form-control" accept="image/*" id="paymentProof">
                    <small style="color: var(--text-light);">Upload foto/screenshot bukti pembayaran</small>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
                    ✅ Buat Pesanan
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('paymentMethod').addEventListener('change', function() {
    const section = document.getElementById('paymentProofSection');
    const input = document.getElementById('paymentProof');
    if (this.value === 'qris') {
        section.style.display = 'block';
        input.required = true;
    } else {
        section.style.display = 'none';
        input.required = false;
    }
});
</script>
@endsection