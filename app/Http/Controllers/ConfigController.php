<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ConfigGeneral;
use Illuminate\Support\Facades\Validator;
use Session;

class ConfigController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function index(){
        $general = DB::table('config_general')
        ->first();
        return view('configuraciones.general.index',compact('general'));
    }

    public function guardar(Request $request){
        
        try {
            $validator = $request->validate([
                'nombre_empresa'=>'required|max:150',
                'logo'=>'max:5000',
                'cr'=>'required|max:150',
                'ubicacion'=>'required',
                'correo'=>'max:150|email|required',
                'telefono1'=>'required|max:30',
                'telefono2'=>'required|max:30',
                'facebook'=>'required|max:300',
                'twitter'=>'required|max:300',
                'instagram'=>'required|max:300',
                'horarios'=>'required|max:300',
                'color_texto_menu'=>'required',
                'color_fondo_menu'=>'required',
                'facebook_iframe'=>'required',
                'culqi_public'=>'required|max:35',
                'culqi_private'=>'required|max:35',
            ]);
            $general = ConfigGeneral::findOrFail(1);
            $general->nombre_empresa = $request->get('nombre_empresa');
            $general->cr = $request->get('cr');
            $general->ubicacion = $request->get('ubicacion');
            $general->correo = $request->get('correo');
            $general->telefono1 = $request->get('telefono1');
            $general->telefono2 = $request->get('telefono2');
            $general->facebook = $request->get('facebook');
            $general->twitter = $request->get('twitter');
            $general->iframe = $request->get('iframe');
            $general->instagram = $request->get('instagram');
            $general->horarios = $request->get('horarios');
            $general->horarios = $request->get('horarios');
            $general->color_texto_menu = $request->get('color_texto_menu');
            $general->color_fondo_menu = $request->get('color_fondo_menu');
            $general->facebook_iframe = $request->get('facebook_iframe');
            $general->culqi_public = $request->get('culqi_public');
            $general->culqi_private = $request->get('culqi_private');
            if($request->logo){
                $extension1 = $request->logo[0]->extension();
                try{
                    unlink(public_path('admin/'.$general->logo));
                }
                catch(\Exception $e){    
                }
                if($extension1 == 'png' || $extension1 == 'jpeg' || $extension1 == 'jpg' || $extension1 == 'webp' || $extension1 == 'svg'){
                    $imgname1 = uniqid();
                    
                    $imageName1 = $imgname1.'.'.$request->logo[0]->extension();  
                    $request->logo[0]->move(public_path('admin'), $imageName1);
                    $general->logo = $imageName1;
                }else{
                    Session::flash('danger', 'El formato de la imagen no se acepta');
                    return redirect()->back();
                }
            }
            $general->save();
            Session::flash('success', 'Se actualizó los cambios con exito');
            return redirect()->back();

        } catch (\Exception $e) {
            dd($e);
            Session::flash('danger', $e);
            return redirect()->back();
        }
    }
}
