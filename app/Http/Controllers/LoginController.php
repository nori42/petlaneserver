<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    public function authenticate(Request $request){

        $input = $request->collect();

        
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::where('username', $input['username'])->first();

        if ( $user == null || Hash::check($input['password'], $user->Password) != 1) {
            
            return response()->json([
                'status' => 'The provided credentials are incorrect.'
            ]);
        }
        
        return response()->json([
            'status' => 'success',
            '_token' =>  $user->createToken('API_TOKEN')->plainTextToken
        ]);
    }
}
