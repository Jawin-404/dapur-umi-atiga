@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Pesan Menu</h2>

<form action="/order" method="POST" enctype="multipart/form-data">
@csrf

<input type="hidden" name="menu_id" value="{{ $menu->id }}">

<label>Jumlah</label>
<input type="number" name="jumlah" class="border p-2 w-full mb-3">

<label>Catatan</label>
<textarea name="catatan" class="border p-2 w-full mb-3"></textarea>

<label>Metode Pembayaran</label>
<select name="metode" class="border p-2 w-full mb-3">
    <option value="cod">COD</option>
    <option value="qris">QRIS</option>
</select>

<label>Upload Bukti (jika QRIS)</label>
<input type="file" name="bukti" class="mb-3">

<button class="bg-orange-500 text-white px-4 py-2 rounded">
    Pesan Sekarang
</button>

</form>

@endsection