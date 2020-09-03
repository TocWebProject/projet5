<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\User;
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
     * Show the application homepage for normal User.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if (auth()->user()->is_admin === 1) {

            return $this->adminHome();

        } else {
            
            // Number of Tasks for the User.
            $id = Auth::id();
            $numberOfTasks = Tasks::where('user_id', $id)->count();
            
            if ($numberOfTasks === 0) {
                $sentenceToTransmit = "vous n'avez aucune tâche à effectuer ! Vraiment ? Ajouter vos prochaines tâches...";
            } elseif ($numberOfTasks === 1) {
                $sentenceToTransmit = "vous avez une seule tâche à effectuer ! Penser à vos prochaines tâches...";
            } elseif ($numberOfTasks > 1) {
                $sentenceToTransmit = "vous avez $numberOfTasks tâches à effectuer ! Courage !";
            }
            
            return view('home')->with('sentenceToTransmit', $sentenceToTransmit);   
        }
    }

    /**
     * Show the application homepage for the Admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $id = Auth::id();

        // Number of Tasks for admin
        $numberOfTasks = Tasks::where('user_id', $id)->count();

        if ($numberOfTasks === 0) {
            $sentenceToTransmit = "vous n'avez aucune tâche à effectuer ! Vraiment ? Ajouter vos prochaines tâches...";
        } elseif ($numberOfTasks === 1) {
            $sentenceToTransmit = "vous avez une seule tâche à effectuer ! Penser à vos prochaines tâches...";
        } elseif ($numberOfTasks > 1) {
            $sentenceToTransmit = "vous avez $numberOfTasks tâches à effectuer ! Courage !";
        }

        // Number of Users in this app. 
        $numberOfUsers = User::count();
        
        return view('admin.adminHome')->with('sentenceToTransmit', $sentenceToTransmit)->with('numberOfUsers', $numberOfUsers);
        
    }
}
