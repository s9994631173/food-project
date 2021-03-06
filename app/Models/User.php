<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function register($validated){
        $alredyRegister = self::where('email', '=', $validated['email'])->value('email');

        if($alredyRegister){
            return response(['errors' => [
                'user is register' => [
                    0 => 'Пользователь с такой почтой уже зарегистрирован'
                ]
            ]], 422);
        }else{
            $user = self::create($validated);
            Auth::login($user);
            $username = Auth::user()->name;

            return response(['userName' => $username], 200);
        }
    }
}
