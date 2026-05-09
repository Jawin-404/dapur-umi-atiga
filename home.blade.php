@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Menu Hari Ini 🍽️</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    @foreach($menus as $menu)
    <div class="bg-white rounded-xl shadow p-4">

        <img src="{{ asset('storage/'.$menu->gambar) }}" class="rounded-lg mb-3">

        <h3 class="font-bold text-lg">{{ $menu->nama }}</h3>

        <p class="text-gray-500">{{ $menu->deskripsi }}</p>

        <p class="text-orange-500 font-bold mt-2">
            Rp {{ number_format($menu->harga) }}
        </p>

        <p class="text-sm">Stok: {{ $menu->stok }}</p>

        <a href="/order/{{ $menu->id }}" 
           class="block mt-3 bg-orange-500 text-white text-center py-2 rounded">
           Pesan
        </a>

    </div>
    @endforeach

</div>

@endsection