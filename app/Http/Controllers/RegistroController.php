<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class RegistroController extends Controller
{
    public function index(){
        return view('registro');
    }

    public function store(Request $request){
      
   
        $validator = $request->validate([
            'name'=>'required|max:150',
            'email'=>'required|max:150|unique:users',
            'password'=>'required|max:50',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->role = 'USER';
        $user->perfil = 'perfil.png';
        $user->save();

        Session::flash('success', 'Felicidades!!, ustéd se registró con exito en la web');
        Auth::login($user);
 
        return redirect()->to('/');
       
    }
}
