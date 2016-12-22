<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\AuthSigninRequest;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;

class AuthController extends Controller
{
    public function signup(AuthRequest $request)
    {

    	return User::create([
    		'name'		=>	$request->json('name'),
    		'email'		=>	$request->json('email'),
    		'password'	=>	bcrypt($request->json('password'))
    		]);
    }
    public function signin(AuthSigninRequest $request)
    {
    	 // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
