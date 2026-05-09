@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header">👤 Edit Profil</div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf @method('PATCH')

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    <small style="color: var(--text-light);">Email tidak dapat diubah</small>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required placeholder="08xxxxxxxxxx">
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="address" class="form-control" required placeholder="Jl. Contoh No. 123, RT/RW, Kelurahan, Kecamatan, Kota">{{ old('address', $user->address) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">💾 Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection