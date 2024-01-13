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
    
    public function load(Request $request) {
        return view('load');
    }


    public function dashboard(Request $request) {
        return view('dashboard');
    }


    public function conversation(Request $request) {
        return view('conversation');
    }

    public function category(Request $request) {
        return view('category');
    }

}
