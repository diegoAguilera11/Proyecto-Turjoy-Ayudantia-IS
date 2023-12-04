<?php

use App\Models\Ticket;
use Carbon\Carbon;

function makeMessages()
{
    $messages = [
        'document.required' => 'el campo archivo es requerido.',
        'document.mimes' => 'el archivo seleccionado no es Excel con extensión .xlsx.',
        'document.max' => 'el tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
        'initDate.required' => 'el campo fecha de inicio es requerido',
        'initDate.date' => 'el campo fecha de inicio debe ser una fecha válida',
        'finishDate.required' => 'el campo fecha de término es requerido',
        'finishDate.date' => 'el campo fecha de término debe ser una fecha válida',
        'finishDate' => 'la fecha de inicio a consultar no puede ser mayor que la fecha de término de la consulta',
    ];

    return $messages;
}

function validDate($date)
{
    $fechaActual = date('d-m-Y');
    $fechaVerificar = Carbon::parse($date);

    if ($fechaVerificar->lessThan($fechaActual)) {
        return true;
    }

    return false;
}

function generateReservationNumber()
{
    do {
        $letters = generateRandomLetters(4); // Genera 4 letras aleatorias
        $numbers = mt_rand(10, 99); // Genera 2 números aleatorios

        $code = $letters.$numbers;

        $response = Ticket::where('code', $code)->first();
    } while ($response);

    return $code;
}

function generateRandomLetters($length)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    for ($i = 0; $i < $length; ++$i) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
