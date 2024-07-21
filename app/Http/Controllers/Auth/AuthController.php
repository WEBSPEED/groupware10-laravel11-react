<?php

namespace App\Http\Controllers\Auth;

use APP\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * 사용자 등록 API
     */
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required:email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if( $validator->faile() ){
            $response = [
                'success' => false,
                'message' => $validator->error()
            ];
            return response()->json($response,400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::creare($input);

        $success['tokey'] = $user->createToken('MyApp')->plainTextToken();
        $success['name'] = $user->name;

        $response = [
            'success' =>true,
            'data' => $success,
            'message' => 'User register successfully'
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request){
        // $credentials = $request->safe()->only([
        //     'email' => ['required', 'email'],
        //     'password' => ['required']
        // ]);

       // if( Auth::attempty(['email'=>$request->email,'password'=>$request->password]) ){
            $user = $request->user();
            
            dd($user);
            // dd($request);

            $success['tokey'] = $user->createToken('MyApp')->plainTextToken();
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User register successfully'
            ];

            return response()->json($response, 200);
            
       // }
    }

    /**
     * 로그아웃 처리
     */
    public function logout()
    {
        // $user = User::user();

        $response = [
            'success' => true,
            'message' => 'User logout'
        ];

        return response()->json($response, 200);
    }
}
