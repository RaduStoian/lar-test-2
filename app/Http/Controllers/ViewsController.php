<?php

namespace App\Http\Controllers;

class ViewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function view() {
        return view('app');
    }
}
