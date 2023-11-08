@extends('layouts.app')



@section('title')
    Página Principal
@endsection


@section('content')
    <h1 class="text-white text-3xl text-center font-bold uppercase my-4">Bienvenido a Turjoy</h1>

    @if ($countTravels > 0)
        <div class="flex flex-col w-1/2 mx-auto justify-center items-center bg-gray-300 rounded-sm">
            <form id="form" action="{{ route('add-reservation') }}" method="POST">
                @csrf
                <div class="relative max-w-sm mt-8">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="date" datepicker datepicker-autohide type="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Seleccione una fecha">
                </div>

                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-xl text-sm text-center p-2">
                        {{ session('message') }}</p>
                @endif

                <div class="flex flex-col items-start">
                    <label for="origins" class="block mt-8 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Origen
                    </label>
                    <select id="origins" name="origin"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Seleccione un origen</option>
                    </select>
                    @error('origin')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-lg text-center p-2">
                            {{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="destinations" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Destino
                    </label>
                    <select id="destinations" name="destination"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="">Seleccione un destino</option>
                    </select>
                </div>
                <div>
                    <label for="seat" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Cantidad de asientos
                    </label>
                    <select id="seat" name="seat"
                        class="w-auto bg-gray-50 border border-gray-300 text-gray-900 mb-8 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Seleccione una cantidad</option>
                    </select>
                </div>
                {{-- Precio reserva --}}
                <input id="base-rate" name="total" value="" hidden>

                <button id="button" type="button"
                    class="bg-blue-500 hover:bg-blue-800 transition-all rounded-sm font-semibold p-2 my-2 text-white">
                    Reservar pasaje
                </button>

            </form>
        </div>
    @else
        <p>por el momento no es posible realizar reservas, intente más tarde</p>
    @endif
@endsection

@section('js')
    <script src="{{ asset('assets/js/index.js') }}"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Aqui va nuestro script de sweetalert
        const button = document.getElementById("button");
        const form = document.getElementById("form");

        button.addEventListener('click', (e) => {
            // Informacion Reserva
            const selectedOrigin = document.getElementById('origins').value;
            const selectedDestination = document.getElementById('destinations').value;

            const datePicker = document.getElementById('date').value;
            const selectedSeat = document.getElementById('seat').value;
            const fecha = new Date(datePicker);
            const dateFormatted = fecha.toLocaleDateString('es-ES', datePicker)

            const baseRate = document.getElementById('base-rate').value;


            e.preventDefault();

            if (selectedOrigin && selectedDestination && datePicker && selectedSeat && baseRate) {
                Swal.fire({
                    title: "¿Desea continuar?",
                    text: "El total de la reserva entre " + selectedOrigin + " y " + selectedDestination +
                        " para el día " + dateFormatted + " es de " + "$" + (baseRate * selectedSeat) +
                        ` (${selectedSeat} Asientos)`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Volver",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endsection
