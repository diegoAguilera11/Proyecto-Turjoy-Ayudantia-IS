@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection

@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="bg-gradient-to-bl from-sky-300 to-red-200 p-6 mx-auto rounded-lg lg:w-1/4">
            <h3 class="font-bold text-2xl text-center text-black uppercase mb-4">Inicia sesión en Turjoy</h3>
            <form class="w-full" action="{{ route('auth.login') }}" method="POST" novalidate>
                @csrf
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Correo electrónico
                    </label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                    @error('email')
                        <p class="bg-red-400 font-semibold text-lg text-red-800 p-2 my-2 rounded-lg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Contraseña
                    </label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                    @error('password')
                        <p class="bg-red-400 font-semibold text-lg text-red-800 p-2 my-2 rounded-lg">{{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Iniciar Sesión"
                    class="text-white bg-emerald-700 hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">
            </form>
        </div>
    </div>
@endsection
