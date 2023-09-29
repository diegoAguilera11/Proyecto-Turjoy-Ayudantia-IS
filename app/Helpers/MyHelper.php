<?php


function makeMessages()
{
    $messages = [
        'document.required' => 'el campo archivo es requerido.',
        'document.mimes' => 'el archivo seleccionado no es Excel con extensión .xlsx.',
        'document.max' => 'el tamaño máximo del archivo a cargar no puede superar los 5 megabytes'
    ];

    return $messages;
}
