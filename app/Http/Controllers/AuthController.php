<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Importer;
use Exporter;
use App\Models\Voters;
use App\Models\Votes;
use App\Models\Candidate;
use App\Models\Imported_files;
use Auth;
use Session;

class AuthController extends Controller {

    public function checkLogin(Request $request) { 
       
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
          );
        
        if(Auth::attempt($userdata)){
            //Session::put('user', $user);
            // /$user = Session::get('user');
            //echo $user->user_last_name;        
            Session::put('user',  Auth::user());
            return response()->json(array('role'=>  Auth::user()->role), 200);
        }else{
            return response()->json(array('msg'=> 'Error credentials'), 401);
        }
        
    }

}