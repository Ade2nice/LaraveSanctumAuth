<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

use Illuminate\Support\Facades\Response;
class RegisterController extends Controller
{
    //
    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',

            'email' => 'required|email|unique:users',

            'password' => 'required',

            'c_password' => 'required|same:password',

        ]);

        if($validator->fails()){

            return response()->json([ 

                'data' => $validator->errors(),
            ]);
                       
            
        }

       $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;

        $success['name'] =  $user->name;

   

        return response()->json([
            'message' => 'User register successfully.',
            'data' =>$success,
        ]);

    }
}
