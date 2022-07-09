<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        $validated = $request->safe()->only(['email', 'password']);

        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            return [
                    'user name' => $user['name']
                    ];
        }
        return ([
            'errors' => [
                'Failed auth' => [
                    0 => 'Не верный логин/пароль'
                ]
            ],
        ]);
    }

    public function register(RegisterRequest $request){
        $validated = $request->safe()->only(['name', 'email', 'password']);
        $validated['password'] = Hash::make($validated['password']);
        
        return User::register($validated);
    }
}
