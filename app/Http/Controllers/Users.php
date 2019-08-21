<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Users extends Controller
{
    public function signup(Request $request) {
        $request_data = json_decode($request->getContent());
        $query_result = DB::table('users')->insert([
            [
                "name"=>$request_data[0]->fullName, 
                "email"=>$request_data[0]->email,
                "password"=>$request_data[0]->password
            ]
        ]);
        var_dump($query_result);
        if ($query_result == 1) {
            return json_encode("[{'status': 'success'}]");
        }else {
            return json_encode("[{'status': 'error'}]");
        }
    }
}
