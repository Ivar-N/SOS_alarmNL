<?php

namespace App\Http\Controllers;

use App\Models\TblGebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // User Registration
    public function register(Request $request)
    {
        $request->validate([
            'Naam' => 'required|string|max:255',
            'Achternaam' => 'required|string|max:255',
            'Telefoonnummer' => 'required|string|max:15|unique:tbl_gebruiker,Telefoonnummer',
            'Wachtwoord' => 'required|string|min:8|confirmed',
            'AdresID' => 'nullable|integer|exists:tbl_adres,id',
        ]);

        $user = TblGebruiker::create([
            'Naam' => $request->Naam,
            'Achternaam' => $request->Achternaam,
            'Telefoonnummer' => $request->Telefoonnummer,
            'Wachtwoord' => $request->Wachtwoord, // Password is hashed by the model's mutator
            'AdresID' => $request->AdresID,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    // User Login
    public function login(Request $request)
    {
        $request->validate([
            'Telefoonnummer' => 'required|string',
            'Wachtwoord' => 'required|string',
        ]);

        $user = TblGebruiker::where('Telefoonnummer', $request->Telefoonnummer)->first();

        if (!$user || !Hash::check($request->Wachtwoord, $user->Wachtwoord)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    // User Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
