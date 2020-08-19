<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $id = Auth::id();
        $numberOfTasks = Tasks::where('user_id', $id)->count();

        return view('home')->with('numberOfTasks', $numberOfTasks);   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $id = Auth::id();
        $numberOfTasks = Tasks::where('user_id', $id)->count();

        return view('admin.adminHome')->with('numberOfTasks', $numberOfTasks);
    }
}
