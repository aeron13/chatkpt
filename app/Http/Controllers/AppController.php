<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{

    public function dashboard(Request $request) {

        return view('dashboard');
        
    }
}
