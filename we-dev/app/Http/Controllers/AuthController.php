<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $plainPassword = $request->input('password');
            $data = [
               'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => app('hash')->make($plainPassword)

            ];
             DB::table('users')->insert($data);

            //return successful response
            return response()->json(['user' => $data, 'message' => 'CREATED'], 200);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::logout();
        $token = $this->jwt->getToken();

        $this->jwt->setToken($token)->invalidate(true);
        $this->jwt->invalidate();
        $this->jwt->invalidate(true);
        $this->jwt->invalidate($this->jwt->getToken());
        $this->jwt->invalidate($this->jwt->parseToken());
        $this->jwt->parseToken()->invalidate();

        return ['message'=>'token removed'] ;
    }
}
