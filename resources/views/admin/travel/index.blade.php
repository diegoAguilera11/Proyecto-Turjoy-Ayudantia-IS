@extends('layouts.app')

@section('title')
    Ingresar Viajes
@endsection

@section('content')
    {{--
    {{ count($validRows) }}
    {{ count($invalidRows) }}
    {{ count($duplicatedRows) }} --}}

    @if ($validRows || $invalidRows || $duplicatedRows)
        <div class="flex flex-1 flex-col gap-2">
            <div class="my-8 mx-auto">
                <a class="px-6 py-3 bg-green-500 hover:bg-green-700 transition-all text-white font-semibold rounded-lg"
                    href="{{ route('dashboard') }}">Finalizar</a>
            </div>

            @if (count($validRows) > 0)
                <h3 class="text-2xl text-black font-semibold uppercase text-center">Listado de viajes agregados
                    correctamente
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg mb-2">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-green-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($validRows as $validRow)
                                <tr class="bg-green-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $validRow['origen'] }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['destino'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['cantidad_de_asientos'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (count($invalidRows))
                <h3 class="text-2xl text-black font-semibold uppercase text-center">
                    Listado de viajes que presentaron errores
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <thead class="text-xs text-gray-700 uppercase bg-red-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invalidRows as $invalidRow)
                                <tr class="bg-red-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $invalidRow['origen'] ? $invalidRow['origen'] : '---' }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $invalidRow['destino'] ? $invalidRow['destino'] : '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $invalidRow['cantidad_de_asientos'] ? $invalidRow['cantidad_de_asientos'] : '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $invalidRow['tarifa_base'] ? $invalidRow['tarifa_base'] : '---' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if (count($duplicatedRows))
                <h3 class="text-2xl text-black font-semibold uppercase text-center">
                    Listado de viajes que se encuentran duplicados
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <thead class="text-xs text-gray-700 uppercase bg-amber-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($duplicatedRows as $duplicatedRow)
                                <tr class="bg-yellow-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $duplicatedRow['origen'] }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['destino'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['cantidad_de_asientos'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @else
        <div class="flex flex-col flex-1 justify-center items-center my-6">
            <div class="mb-12 mx-auto">
                <a class="px-6 py-3 bg-red-500 hover:bg-red-700 transition-all text-white font-semibold rounded-lg"
                    href="{{ route('dashboard') }}">Volver</a>
            </div>
            <form class="flex flex-col items-center w-1/2" action="{{ route('travel.check') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <input type="file" name="document">
                    @error('document')
                        <p class="bg-red-400 font-semibold my-4 text-lg text-center text-red-800 px-4 py-3 rounded-lg">
                            {{ $message }}</p>
                    @enderror
                </div>

                <button class="lg:w-1/4 my-4 p-2 bg-green-400 rounded-sm text-white font-semibold" type="submit">
                    Importar Viajes
                </button>
            </form>
        </div>
    @endif

@endsection
