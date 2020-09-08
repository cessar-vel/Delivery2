<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Carrito;
use App\Alimento;
use App\Pedido;
use App\PedidoDetalle;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;
use Culqi;

class ClienteController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->only('ordenar_online','add_cart','open_carrito','destroy_carrito','generar_pedido','ordenes','hoy');
    }
    
    public function index(Request $request){

        $config = DB::table('config_general')
        ->first();

        $slider = DB::table('slider')
        ->get();

        $seccion_uno = DB::table('seccion_uno')
        ->get();

        $menu_comida = DB::table('menu_comida')
        ->get();

        $alimento = DB::table('alimento')
        ->get();

        $num_menu = count($menu_comida);

        $inicio = DB::table('inicio')
        ->first();

        $seccion_tres = DB::table('seccion_tres')
        ->get();

        $galeria = DB::table('galeria')
        ->take('4')
        ->get();

        /* ---------------------------------------------- */

        

        /* ---------------------------------------------- */
        return view('inicio', compact('config','slider','seccion_uno','menu_comida','num_menu','alimento','inicio','seccion_tres','galeria'));
    }

    function faq(){
        $faq = DB::table('faq')->get();
        return view('faq',compact('faq'));
    }

    function menu_single($menu){

        $menu_comida = DB::table('menu_comida')
        ->where('titulo','=',$menu)
        ->first();

        $alimento = DB::table('alimento')
        ->where('categoria','=',$menu)
        ->get();

        return view('menu_single.index',compact('menu_comida','alimento'));
    }

    function ordenar_online(){

        $menu_comida = DB::table('menu_comida')
        ->get();

        $alimento = DB::table('alimento')
        ->get();

        return view('orden_online',compact('menu_comida','alimento'));
    }

    function add_cart($idalimento){
        $alimento = DB::table('alimento')
        ->where('id','=',$idalimento)
        ->first();

        $carrito = new Carrito;
        $carrito->producto = $alimento->titulo;
        $carrito->iduser = auth()->user()->id;
        $carrito->idalimento = $idalimento;
        $carrito->estado = 'En el carrito';
        $carrito->precio = substr($alimento->precio,1,8);
        $mytime = Carbon::now('America/Lima');
        $carrito->createAt = $mytime->format('Y-m-d');
        $carrito->cantidad = '1';
        $carrito->save();

        Session::flash('success', 'Se agregó al carrito exitosamente');
        return redirect()->back();

    }

    function open_carrito(){

        $config = DB::table('config_general')
        ->first();

        $carrito = DB::table('carrito as c')
        ->join('alimento as a','a.id','=','c.idalimento')
        ->select('c.id','a.portada','a.titulo as alimento','c.cantidad','c.estado','c.createAt','c.precio','c.idalimento')
        ->where('iduser','=',auth()->user()->id)
        ->orderby('c.id','desc')
        ->get();

        $total = DB::table('carrito as c')
        ->select(DB::raw("sum(c.precio) as total"))
        ->where('iduser','=',auth()->user()->id)
        ->first();

        $productos = [];

        foreach($carrito as $item){
            array_push($productos,$item->idalimento);
        }

        $data_productos = implode('-',$productos);

        return view('carrito',compact('carrito','total','config','data_productos'));
    }

    public function destroy_carrito($id){
        $carrito = Carrito::findOrFail($id);
        $carrito->destroy($id);

        return redirect()->back();
    }

    public function generar_pedido($productos,$iduser,$direccion,$total,$token,$metodo){


        $config = DB::table('config_general')
        ->first();
        //trim(trim(round($total),0), '.')

        if($metodo == 'culqi'){
            try {
                $SECRET_KEY = $config->{'culqi_private'};
                $culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));
                
                $charge = $culqi->Charges->create(
                    array(
                    "amount" => round($total).'00',
                    "capture" => true,
                    "currency_code" => 'USD',
                    "description" => $config->{'nombre_empresa'},
                    "email" => "test@culqi.com",
                    "source_id" => $token
                    )
                );
            }catch(\Exception $e){
                dd($e);
                Session::flash('danger', 'Se rechazó la tarjera de crédito, intente con otra.');
                return Redirect::back();
            }
        }
        $productos = explode("-",$productos);
    

        $today = getdate();
        $data_month = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $current_month = $today['mon'];
        $current_year = $today['year'];

        $pedido = new Pedido;
        $pedido->iduser = $iduser;
        $mytime = Carbon::now('America/Lima');
        $pedido->fecha = $today['year'].'-'.$today['mday'].'-'.$today['mon'];
        $pedido->direccion = trim($direccion);
        $pedido->total_pagado = $total;
        $pedido->estado = 'En espera';
        $pedido->mes = $current_month;
        $pedido->year = $current_year;
        $pedido->tiempo_estimado = 'Calculando';
        $pedido->save();

        $cont = 0;

        $carrito = DB::table('carrito')
        ->where('iduser','=',auth()->user()->id)
        ->get();



        while($cont<count($productos)){

            $alimento = Alimento::findOrFail($productos[$cont]);

            $detalle = new PedidoDetalle;
            $detalle->idpedido = $pedido->id;
            $detalle->producto = $alimento->titulo;
            $detalle->precio = substr($alimento->precio,1,8);;
            $detalle->save();

            $carrito_del = Carrito::findOrFail($carrito[$cont]->id);
            $carrito_del->delete();

            $cont = $cont+1; 
        }

        return redirect()->route('hoy');


    }

    public function ordenes(){

        $pedidos = DB::table('pedido_detalle as d')
        ->join('pedidos as p','d.idpedido','=','p.id')
        ->select('p.fecha','p.total_pagado','p.estado','d.producto','d.precio','p.direccion')
        ->where('iduser','=',auth()->user()->id)
        ->orderby('d.id','desc')
        ->paginate(20);

        return view('ordenes',compact('pedidos'));
    }

    public function hoy(){

        $today = getdate();


        $pedidos = DB::table('pedido_detalle as d')
        ->join('pedidos as p','d.idpedido','=','p.id')
        ->select('p.fecha','p.total_pagado','p.estado','d.producto','d.precio','p.direccion')
        ->where([
            ['p.iduser','=',auth()->user()->id],
            ['p.fecha','=',$today['year'].'-'.$today['mday'].'-'.$today['mon']]
        ])
        ->orderby('d.id','desc')
        ->get();

        return view('hoy',compact('pedidos'));
    }

    public function ofertas(){

        $oferta = DB::table('alimento')
        ->where('oferta','=','1')
        ->orderby('id','desc')
        ->get();

        $seccion_uno = DB::table('seccion_uno')
        ->get();

        return view('ofertas',compact('oferta','seccion_uno'));
    }
}
