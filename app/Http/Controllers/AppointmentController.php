<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    // Stocker un RDV
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'date' => 'required|date',
            'hour' => 'required'
        ]);

        // Création du RDV
        Appointment::create([
            'email' => $request->email,
            'date' => $request->date,
            'hour' => $request->hour,
            'status' => 'reserved'
        ]);

        return response()->json(['message' => 'RDV réservé !']);
    }

    // Récupérer les heures indisponibles pour une date
    public function unavailableHours(Request $request)
    {
        $date = $request->date;
        $hours = Appointment::where('date', $date)
                    ->pluck('hour')
                    ->toArray();

        return response()->json($hours);
    }
}

