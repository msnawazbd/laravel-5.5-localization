<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function language($lang)
    {
        // Put the $lang value in the local session and get local value in middleware
        Session::put('locale', $lang);
        // Redirect to same page
        return redirect()->back();
    }
}
