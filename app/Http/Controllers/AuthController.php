<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        // print_r($request);
        // $request->validate([
        //     'emailID' => 'required|string|email',
        //     'pass' => 'required|string',
        // ]);

        // $user = User::where('emailID', $request->emailID)->first();

        // if (! $user || ! Hash::check($request->pass, $user->pass)) {
        //     throw ValidationException::withMessages([
        //         'emailID' => ['The provided credentials are incorrect.'],
        //     ]);
        // }

        // $token = $user->createToken('authToken')->plainTextToken;

        // return response()->json(['access_token' => $token], 200);
    }

}
