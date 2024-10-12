<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Conversation;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function welcome(Request $request) {

        if($request->user()) {
            return Redirect::route('dashboard');
        }

        return view('welcome');
    }
    
    public function load() {
        return view('load');
    }


    public function dashboard() {
        return view('dashboard');
    }


    public function conversation() {
        return view('conversation');
    }

    public function category() {
        return view('category');
    }

}
