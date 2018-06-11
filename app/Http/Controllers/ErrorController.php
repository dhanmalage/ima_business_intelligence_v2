<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function pageNotFound()
    {
        return view('errors.403');
    }
	
	public function loginError()
    {
        return view('errors.403-login');
    }
	
}
