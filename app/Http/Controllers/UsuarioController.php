<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function index(){
        $user = DB::table('users')
        ->where('role','=','ADMIN')
        ->orderby('id','desc')
        ->get();

        return view('usuarios.index',compact('user'));
    }

    public function create(){
        return view('usuarios.create');
    }

    public function store(Request $request){
   
            $validator = $request->validate([
                'name'=>'required|max:255',
                'password'=>'required|max:50',
                'role'=>'required|max:50',
                'email'=>'required|max:150',
            ]);
    
            $user = new User;
            $user->name = $request->get('name');
      
            $user->password = bcrypt($request->get('password'));
      
            $user->role = $request->get('role');
            $user->email = $request->get('email');
            $user->perfil = 'perfil.png';
            $user->save();
    
            Session::flash('success', 'Se registró con exito el nuevo usuario');
            return redirect()->route('index.usuario');
       
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('usuarios.edit',compact('user'));
    }

    public function update(Request $request,$id){
        $validator = $request->validate([
            'name'=>'required|max:255',
            'password'=>'max:50|confirmed',
            'role'=>'required|max:50',
            'email'=>'required|max:150',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        if($request->get('password')){
            $user->password = bcrypt($request->get('password'));
        }
        $user->role = $request->get('role');
        $user->email = $request->get('email');
        $user->perfil = 'perfil.png';
        $user->update();

        Session::flash('success', 'Se actualizó con exito el nuevo usuario');
        return redirect()->route('index.usuario');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->destroy($id);

        Session::flash('success', 'Se eliminó el usuario correctamente');
        return redirect()->back();
    }
}
