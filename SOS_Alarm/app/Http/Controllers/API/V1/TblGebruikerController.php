<?php

namespace App\Http\Controllers\API\V1;

use App\Models\tblGebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoretblGebruikerRequest;
use App\Http\Requests\UpdatetblGebruikerRequest;

class GebruikerController extends Controller
{
    // 1. Show the profile of the authenticated user
    public function show(Request $request)
    {
        $user = $request->user(); // Fetch the authenticated user
        return response()->json(['user' => $user], 200);
    }

    // 2. Update the profile of the authenticated user
    public function update(Request $request)
    {
        $user = $request->user();

        // Validate input
        $request->validate([
            'Naam' => 'nullable|string|max:255',
            'Achternaam' => 'nullable|string|max:255',
            'Telefoonnummer' => 'nullable|string|max:15|unique:tbl_gebruiker,Telefoonnummer,' . $user->id,
            'Wachtwoord' => 'nullable|string|min:8|confirmed',
        ]);

        // Update user fields
        $user->Naam = $request->input('Naam', $user->Naam);
        $user->Achternaam = $request->input('Achternaam', $user->Achternaam);
        $user->Telefoonnummer = $request->input('Telefoonnummer', $user->Telefoonnummer);

        // If password is provided, hash it before saving
        if ($request->filled('Wachtwoord')) {
            $user->Wachtwoord = Hash::make($request->Wachtwoord);
        }

        // Save changes
        $user->save();

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);
    }
}