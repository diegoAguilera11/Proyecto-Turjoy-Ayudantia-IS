<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Travel;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketReportIndex()
    {
        // Obtener todos los ticket
        $tickets = Ticket::all();

        return view('admin.tickets.reports.index', [
            'tickets' => $tickets,
        ]);
    }

    public function ticketReportSearchIndex($tickets)
    {
        $ticketSearch = Ticket::find($tickets);

        // dd($ticketSearch);

        return view('admin.tickets.reports.index', [
            'tickets' => $ticketSearch,
        ]);
    }

    public function searchToDate(Request $request)
    {
        $messages = makeMessages();
        // Validar
        $this->validate($request, [
            'initDate' => ['required', 'date'],
            'finishDate' => ['required', 'date', 'after:initDate'],
        ], $messages);

        // Validar que la fecha inicial sea menor a la final

        $initDate = $request->initDate;
        $finishDate = $request->finishDate;

        // Filtrado
        $tickets = Ticket::whereBetween('date', [$initDate, $finishDate])->get();

        if ($tickets->count() === 0) {
            return back()->with('message', 'no se encontraron reservas dentro del rango seleccionado');
            // dd(' no hay tickets');
        } else {
            // Retornar los tickets segun el rango de fecha.....
            // $ticketIds = $tickets->pluck('id')->toArray();
            $ticketIds = $tickets->pluck('id')->implode(',');

            // dd($ticketIds);

            return redirect()->route('report-ticket-search.index', [
                'tickets' => $ticketIds,
            ]);
        }
    }

    public function store(Request $request)
    {
        // Generar el numero de reserva
        $code = generateReservationNumber();
        // Modificar request
        $request->request->add(['code' => $code]);

        // Validar
        $makeMessages = makeMessages();
        $this->validate($request, [
            'seat' => ['required'],
            'total' => ['required'],
            'date' => ['date', 'required'],
        ], $makeMessages);

        //  Verificamos si la fecha ingresada es mayor a la fecha actual.
        $invalidDate = validDate($request->date);
        if ($invalidDate) {
            return back()->with('message', 'La fecha debe ser igual o mayor a '.date('d-m-Y'));
        }

        // Obtener viaje
        $travel = Travel::where('origin', $request->origin)->where('destination', $request->destination)->first();

        // Crear la reserva
        $ticket = Ticket::create([
        'code' => $request->code,
        'seat' => $request->seat,
        'date' => $request->date,
        'total' => $request->total * $request->seat,
        'travel_id' => $travel->id,
        ]);

        return redirect()->route('generate.pdf', [
            'id' => $ticket->id,
        ]);
    }
}
