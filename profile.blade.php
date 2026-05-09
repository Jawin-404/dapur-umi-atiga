@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Profile</h2>

<form action="/profile" method="POST">
@csrf

<label>Nama</label>
<input type="text" name="name" value="{{ auth()->user()->name }}" class="border p-2 w-full mb-3">

<label>Alamat</label>
<input type="text" name="alamat" value="{{ auth()->user()->alamat }}" class="border p-2 w-full mb-3">

<label>No HP</label>
<input type="text" name="no_hp" value="{{ auth()->user()->no_hp }}" class="border p-2 w-full mb-3">

<button class="bg-orange-500 text-white px-4 py-2 rounded">
    Update
</button>

</form>

@endsection