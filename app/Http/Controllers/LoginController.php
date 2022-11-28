<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Response;
class LoginController extends Controller
{
    //
    public function login(Request $request)

    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

            $user = Auth::user(); 

            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 

            $success['name'] =  $user->name;

   
            return response()->json([
                'message' => 'User login successfully.',
                'data' =>$success,
            ]);
           

        } 

        else{ 

            return response()->json([
                'message' => 'Unauthorized.',
                'error'=>'Invalid Password or Email'
            ]);
        } 

    }
}
