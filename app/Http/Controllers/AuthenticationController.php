<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function authentication(Request $req)
    {
       

        $conn = new mysqli($req->servername,$req->username,$req->password);

        // Check connection
        if ($conn->connect_error) {
            $req->session()->flash('message',"Test  Connection Fail");
            return redirect()->back();
        
        }
        Session::put('servername', $req->servername);
        Session::put('username', $req->username);
        Session::put('password', $req->passwrd);

        return redirect()->route('second_page');
    }

  

    
       
}
