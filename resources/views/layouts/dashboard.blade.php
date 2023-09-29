@extends('layouts.app')

@section('title')
    Turjoy - Dashboard
@endsection

@section('content')
    @if ($user->role === 'Administrator')
        <h3 class="text-3xl text-white text-center font-semibold uppercase my-8">
            Bienvenido administrador {{ auth()->user()->name }}
        </h3>
        <div class="grid grid-cols-1 justify-center items-center gap-6">
            <a class=" w-1/2 mx-auto bg-green-400 hover:bg-green-700 transition-all p-4 rounded-lg text-white font-semibold text-lg" href="{{ route('travels.index') }}">Cargar rutas de viaje</a>
        </div>
    @endif
@endsection
