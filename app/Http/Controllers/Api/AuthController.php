<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\User;
use Carbon\Carbon;
use Auth;
class AuthController extends Controller
{
	public $successStatus = 200;

    public function login(LoginRequest $request)
    {
    	if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
           return $this->authResponse('success', $user);
        } 
        else{ 
            return $this->authResponse('fail', ['Unauthorised']);
        } 
    }

    public function register(RegisterRequest $request)
    {
    	$input = $request->only('email', 'name', 'password'); 
    	try {
    		$user  = User::create($input);
    		return $this->authResponse('success', $user);

    	} catch (Exception $e) {
    		return $this->authResponse('fail', null, [$e]);
    	}

    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json([
        	'status'  => 'success',
            'message' => 'Successfully logged out'
        ]);
    }

    private function authResponse($status, $user = null, $errors = [])
    {
    	if($status == 'success'){

    		$tokenResult =  $user->createToken('auth');
            $token 	     = $tokenResult->token;

            return response()->json(
            	[
            		'status' => 'success', 
            		'token_type' => 'Bearer',
            		'expires_at' => Carbon::parse(
		                $tokenResult->token->expires_at
		            )->toDateTimeString(),
            		'token' => $tokenResult->accessToken,
            	]

            	, $this->successStatus); 

    	}else{
    		return response()->json(
            	[
            		'status' => $status,
            	 	'errors'=> $errors
            	]
            	, 401); 
    	}
    }
}
