<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Auth extends Controller
{
  public function generateToken(Request $request) {
    $this->validate($request, User::$rules);
    if( password_verify(decrypt(User::where('email',$request->email)->firstOrFail()->password), $request->hashPassword) )
      return JWT::encode(['sub' => $request->email, 'iat' => time(), 'exp' => time() + 1800], env('JWT_KEY'), 'HS256');
  }
}
