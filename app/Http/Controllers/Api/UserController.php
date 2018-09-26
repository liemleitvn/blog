<?php

namespace App\Http\Controllers\Api;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use JWTAuthException;
use Hash;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function register(Request $request){
        $checkExistUser = $this->user->where('email','=',$request->get('email'))->get()->toArray();
        if(count($checkExistUser)==0) {
            $user = $this->user->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);

            return response()->json([
                'status'=> 200,
                'message'=> 'User created successfully',
                'data'=>$user
            ]);
        }
        else {
            return response()->json([
                'status'=>401,
                'message'=>'User is adready'
            ], 401);
        }

    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }


    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        if($user) {
            return response()->json(['result' => $user],200);
        }
        else {
            return response()->json(['User not found'], 200);
        }

    }
}
