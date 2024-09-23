<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password))
        {
            response()->json(["message" => "The credentials are wrong" ], 401);
        }
        // 1|bLYy042HOKdHhPsLecuCwaDMYcrBKbleQHVmTo5wd20e6cc8
        return response()->json(["accessToken" => $user->createToken($request->name)->plainTextToken]);
    }
}
