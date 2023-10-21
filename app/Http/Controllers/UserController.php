<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class UserController extends Controller
{
    //
    public function store (Request $request){

        $input = $request->collect();

        $user = new User();
        $customer = new Customer();

        $user->username = $input['username'];
        $user->password = $input['password'];
        $user->Role = $input['roleType'];
        $user->save();

        $customer->FirstName = $input['firstName'];
        $customer->LastName = $input['lastName'];
        $customer->ContactNo = $input['contactNo'];
        $customer->Email = $input['email'];
        $customer->Address = $input['address'];
        $customer->User_ID = $user->id;
        $customer->save();

        return response()->json([
            'status' => 'success',
            'data' => [$user,$customer]
        ]);
    }

    public function update(){

    }
}
