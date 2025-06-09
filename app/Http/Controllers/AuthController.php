<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

    public function me()
    {
        return response()->json([
            'status' => true,
            'mensagem' => 'Usuário autenticado.',
            'usuario' => Auth::user()
        ], 200);
    }


    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => true,
            'mensagem' => 'Usuário registrado com sucesso.',
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json([
            'status' => false,
            'mensagem' => 'Credenciais inválidas.'
        ], 401);
    }

    return response()->json([
        'status' => true,
        'mensagem' => 'Login realizado com sucesso.',
        'token' => $token,
        'usuario' => Auth::user()
    ]);
}




public function logout()
{
    try {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'status' => true,
            'mensagem' => 'Logout realizado com sucesso.'
        ]);
    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json([
            'status' => false,
            'mensagem' => 'Falha ao realizar logout, token inválido.'
        ], 400);
    }
}

}
