<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Session\Store;

class AuthSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): Response
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
            
            Auth::login(Auth::user(), $request->statusLogin);            
            $user = Auth::user();

            $success = array();
            $success['uid'] = $user->id;
            $success['tokey'] = $user->createToken($user->remember_token)->plainTextToken;
            $success['name'] = $user->name;
    
            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User Login successfully'
            ];
            return response($response);
            // return response()->json($response, 200);
        }else{
            
            $response = [
                'success' => false,
                'message' => 'User not Login'
            ];
            return response($response);
            // return response()->json($response, 200);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $response = [
            'success' => true,
            'message' => 'User logout'
        ];

        return response($response);
    }
}
