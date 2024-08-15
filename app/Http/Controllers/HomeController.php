<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    // public function index()
    // {
    //     return view('auth.login');
    // }
    public function admin()
    {
        $user = User::all();
        return view('users.dashboard', compact(
            'user',

        ));
    }
    public function operator()
    {
        return view('operator.dashboard');
    }
}
