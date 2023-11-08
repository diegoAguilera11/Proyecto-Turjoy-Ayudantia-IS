<?php

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Support\Str;

function makeMessages()
{
    $messages = [
        'document.required' => 'el campo archivo es requerido.',
        'document.mimes' => 'el archivo seleccionado no es Excel con extensión .xlsx.',
        'document.max' => 'el tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
    ];

    return $messages;
}

function validDate($date)
{
    $fechaActual = date("d-m-Y");
    $fechaVerificar = Carbon::parse($date);

    if ($fechaVerificar->lessThan($fechaActual)) {
        return true;
    }

    return false;
}

function generateReservationNumber()
{
    do {
        $letters = Str::random(4); // Genera 4 letras aleatorias
        $numbers = mt_rand(10, 99); // Genera 2 números aleatorios

        $code = $letters.$numbers;

        $response = Ticket::where('code', $code)->first();
    } while ($response);

    return $code;
}
