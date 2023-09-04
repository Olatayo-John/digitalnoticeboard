<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index(){

    }

    public function create(Request $request){
        
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
    }
}
