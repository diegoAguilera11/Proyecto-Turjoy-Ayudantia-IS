<?php

namespace App\Http\Controllers;

use App\Imports\TravelsImport;
use App\Models\Ticket;
use App\Models\Travel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TravelController extends Controller
{
    public function indexAddTravels()
    {
        if (session('validRows') || session('invalidRows') || session('duplicatedRows')) {
            session()->put('validRows', []);
            session()->put('invalidRows', []);
            session()->put('duplicatedRows', []);
        } else {
            session(['validRows' => []]);
            session(['invalidRows' => []]);
            session(['duplicatedRows' => []]);
        }

        return view('admin.travel.index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows'),
        ]);
    }

    public function indexTravels()
    {
        return view('admin.travel.index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows'),
        ]);
    }

    public function travelCheck(Request $request)
    {
        // Validar el archivo general
        $messages = makeMessages();
        $this->validate($request, [
            'document' => ['required', 'max:5120', 'mimes:xlsx'],
        ], $messages);

        // Validar el archivo excel en detalle
        if ($request->hasFile('document')) {
            $file = request()->file('document');

            $import = new TravelsImport();
            Excel::import($import, $file);

            // Obtener filas válidas e inválidas
            $validRows = $import->getValidRows();
            $invalidRows = $import->getInvalidRows();
            $duplicatedRows = $import->getDuplicatedRows();

            // dd($validRows, $invalidRows, $duplicatedRows);

            // Agregar o actualizar las filas en la base de datos
            foreach ($validRows as $row) {
                $origin = $row['origen'];
                $destination = $row['destino'];

                // Verifica si la fila ya existe en la base de datos
                $travel = Travel::where('origin', $origin)
                    ->where('destination', $destination)
                    ->first();

                if ($travel) {
                    // Si existe, realiza una actualización
                    $travel->update([
                        'seat_quantity' => $row['cantidad_de_asientos'],
                        'base_rate' => $row['tarifa_base'],
                    ]);
                } else {
                    // Si no existe, inserta un nuevo viaje a la base de datos
                    Travel::create([
                        'origin' => $origin,
                        'destination' => $destination,
                        'seat_quantity' => $row['cantidad_de_asientos'],
                        'base_rate' => $row['tarifa_base'],
                    ]);
                }
            }

            // Eliminar registros (filas) vacios del  documento excel
            $invalidRows = array_filter($invalidRows, function ($invalidrow) {
                return $invalidrow['origen'] !== null || $invalidrow['destino'] !== null || $invalidrow['cantidad_de_asientos'] !== null || $invalidrow['tarifa_base'] !== null;
            });

            // dd(session('invalidRows'));

            session()->put('validRows', $validRows);
            session()->put('invalidRows', $invalidRows);
            session()->put('duplicatedRows', $duplicatedRows);

            // dd(count(session('validRows')), count(session('invalidRows')));

            return redirect()->route('travelsAdd.index');
        }
    }

    public function obtainOrigins()
    {
        $origins = Travel::distinct()->orderBy('origin', 'asc')->pluck('origin');

        return response()->json([
            'origins' => $origins,
        ]);
    }

    public function obtainDestinations()
    {
        $destinations = Travel::distinct()->orderBy('destination', 'asc')->pluck('destination');

        return response()->json([
            'destinations' => $destinations,
        ]);
    }

    public function searchDestinations($origin)
    {
        $destinations = Travel::where('origin', $origin)->orderBy('destination', 'asc')->pluck('destination');

        return response()->json([
            'destination' => $destinations,
        ]);
    }

    public function seatings($origin, $destination, $date)
    {
        // Obtenemos el viaje segun el origen y destino ingresado.
        $travel = Travel::where('origin', $origin)->where('destination', $destination)->first();

        if ($travel) {
            $tickets = Ticket::where('travel_id', $travel->id)->where('date', $date)->sum('seat');

            $seatNow = $travel->seat_quantity - $tickets;

            return response()->json(['seat' => $seatNow, 'travel' => $travel]);
        }
    }

    public function checkTravel(Request $request)
    {
        dd($request);
    }

    public function homeIndex()
    {
        $travels = Travel::get()->count();

        // dd($travels);

        return view('home', [
            'countTravels' => $travels,
        ]);
    }
}
