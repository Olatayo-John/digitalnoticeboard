<?php

namespace App\Http\Controllers\API;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function index()
    {
        
    }

    public function login(LoginRequest $request){
        $request->validate([
            'email' => ['required','string','email'],
            'password' => ['required'],
            'device_name' => ['required'],
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function register(Request $request){

    }

    public function logout()
    {
        
    }
}
