@extends('layouts.app')

@section('content')
<div class="hero">
    <h1>🍽️ Dapur Umi Atiga</h1>
    <p>Lauk rumahan dengan cita rasa istimewa. Pesan online, kami antar sampai rumah!</p>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('menus.index') }}" class="btn" style="background: #FFD700; color: #6B3410;">
            🍲 Lihat Menu
        </a>
        @guest
        <a href="{{ route('register') }}" class="btn" style="background: white; color: var(--primary);">
            📝 Daftar Sekarang
        </a>
        @endguest
    </div>
</div>

<div class="container">
    <div class="stats-grid">
        <div class="stat-card">
            <h3>🍳</h3>
            <p>Masakan Rumahan</p>
        </div>
        <div class="stat-card">
            <h3>🚗</h3>
            <p>Antar ke Rumah</p>
        </div>
        <div class="stat-card">
            <h3>💳</h3>
            <p>Bayar QRIS / COD</p>
        </div>
        <div class="stat-card">
            <h3>⭐</h3>
            <p>Bahan Segar</p>
        </div>
    </div>

    <div style="text-align: center; padding: 2rem;">
        <h2 style="color: var(--primary); margin-bottom: 1rem;">Kenapa Pilih Dapur Umi Atiga?</h2>
        <div class="menu-grid" style="max-width: 900px; margin: 0 auto;">
            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">👩‍🍳</div>
                    <h3 style="color: var(--primary);">Masakan Rumahan</h3>
                    <p style="color: var(--text-light);">Dimasak dengan cinta menggunakan resep keluarga turun-temurun</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📱</div>
                    <h3 style="color: var(--primary);">Pesan Online</h3>
                    <p style="color: var(--text-light);">Mudah pesan dari rumah, tinggal klik dan pilih menu favorit</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🚚</div>
                    <h3 style="color: var(--primary);">Diantar Gratis</h3>
                    <p style="color: var(--text-light);">Pesanan diantar langsung ke depan pintu rumah Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection