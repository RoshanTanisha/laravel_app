<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class Users extends Controller
{
    // signup function
    public function signup(Request $data){
        $user = new User;
        $user->name = $data[0]['fullName'];
        $user->email = $data[0]['email'];
        $user->password = $data[0]['password'];

        try{
            $returnValue = $user->save();
            if ($returnValue) {
                return json_encode(["success" => true, "message" => "record created"]);
            } else {
                return json_encode(["success" => false, "message" => "no record created"]);
            }
        } catch(\Exception $e) {
            return json_encode(["success" => false, "message" => "user already exists or value entered are not valid"]);
        }
    }

    public function login(Request $data) {
        $user = User::find($data[0]['email']);
        if ($user != null) {
            if ($user['password'] == $data[0]['password']) {
     
                return json_encode(["success" => true, "message" => "login successful"]);
            } else {
                return json_encode(["success" => false, "message" => "password do not match"]);
            }
        } else {
            return json_encode(["success" => false, "message" => "user not registered"]);
        }
    }
}
