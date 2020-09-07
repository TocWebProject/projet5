<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    // Uploading an Avatar for User
    public function uploadAvatar (Request $request)
    {
        // is there a file ?
        if($request->hasFile('image')){
            
            // Condition
            $validated = $request->validate([
                'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            ]);

            // If the file is valid, we can store the image.
            if ($request->file('image')->isValid()) {

                $filename = $request->image->getClientOriginalName();

                // Delete old Image Avatar
                $imageStored = auth()->user()->avatar;
                if($imageStored){
                    Storage::delete('/public/images/' . $imageStored);
                }

                //Store the image
                $request->image->storeAs('images', $filename, 'public');
                auth()->user()->update(['avatar' => $filename]);  

                $request->session()->flash('success', "Bravo, vous avez ajouté votre avatar.");
 
                return redirect()->back();
            }
        } else {
            $request->session()->flash('error', 'Une erreur est survenue lors de la mise à jour de votre avatar, avez-vous selectionné un fichier ?');
            return redirect()->back();
        }
    }
}
