<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->q);

        if (!$query) {
            return response()->json([]);
        }

        $medecins = User::where('role', 'medecin')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                  ->orWhere('speciality', 'like', "%$query%");
            })
            ->get();

        return response()->json($medecins);
    }

    public function show($id)
    {
        $medecin = User::where('role', 'medecin')
            ->where('id', $id)
            ->firstOrFail();

        return view('medecin.calendar', compact('medecin'));
    }
}