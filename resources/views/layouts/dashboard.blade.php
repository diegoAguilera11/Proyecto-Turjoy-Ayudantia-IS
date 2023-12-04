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
            <a data-tooltip-target="tooltip-default" data-tooltip-placement="bottom" class=" w-1/2 mx-auto bg-green-400 hover:bg-green-700 transition-all p-4 rounded-lg text-white font-semibold text-lg"
                href="{{ route('travels.index') }}">Cargar rutas de viaje</a>
        </div>

        <div id="tooltip-default" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Permite cargar rutas de viaje al sistema turjoy.
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <div class="grid grid-cols-1 justify-center items-center gap-6">
            <a class=" w-1/2 mx-auto my-6 bg-green-400 hover:bg-green-700 transition-all p-4 rounded-lg text-white font-semibold text-lg"
                href="{{ route('report-ticket.index') }}">Reporte de reservas</a>
        </div>
    @endif
@endsection
