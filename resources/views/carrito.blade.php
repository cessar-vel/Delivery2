@extends('layouts.user')
@section('user')
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
            <p class="h3 text-white">Mi carrito de compras</p>
            <ul class="breadcrumbs-custom offset-top-10">
                <li><a href="{{route('inicio')}}">Inicio</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="section-50 section-sm-100">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <h4 class="text-left font-default">{{count($carrito)}} items en el carrito</h4>
            <div class="table-responsive offset-top-10">
              <table class="table table-shopping-cart">
                <tbody>
                    @if (count($carrito) <= '0')
                    <tr>
                        <td>No hay nigun producto en el carrito.</td>
                    </tr>
                    @else
                    @foreach ($carrito as $item)
                  <tr>
                   
                    <td style="width: 1px">
                      <div class="inset-left-20">
                        <div class="product-image"><img src="{{asset('admin/'.$item->portada)}}" width="130" height="130" alt=""></div>
                      </div>
                    </td>
                    <td style="min-width: 340px;">
                      <div class="inset-left-30 text-left"><span class="product-brand text-italic">{{substr($item->createAt,0,10)}}</span>
                        <div class="h5 text-sbold offset-top-0"><a class="link-default" href="shop-single.html">{{$item->alimento}}</a></div>
                      </div>
                    </td>
                    <td>
                      <div class="inset-left-20"><span class="h5 text-sbold">${{$item->precio}}</span></div>
                    </td>
                    <td>
                      <div class="inset-left-20"> 
                          
                          
                            <form action="{{route('destroy_carrito',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="icon icon-sm mdi mdi-window-close link-gray-lightest" type="submit"></button>
                            </form>
                       

                        </div>
                    </td>
                  </tr>
                  @endforeach
                    @endif
                  
                 
                </tbody>
              </table>
            </div>
           @if (count($carrito) > '0')
           <div class="row">
                <div class="col-lg-6 offset-top-35 text-left" id="telef">
                    <label><b>Telefono</b></label>
                    <input type="number" id="direccion" name="direccion" class="form-control col-lg-8" placeholder="Telefono de contacto">
                </div>
                <div class="col-lg-6 offset-top-35 text-right">
                    <div class="h4 font-default text-bold">
                        <small class="inset-right-5 text-gray-light">Total: </small> ${{$total->total}}
                        </div>
                        <button disabled class="btn btn-icon btn-icon-left btn-burnt-sienna btn-shape-circle offset-top-35" id="buyButton">
                            <span class="thin-icon-card" style="font-size: 25px;"></span>
                            <span>Procesar con tarjeta</span>
                        </button>
                    </div>
                </div>
           @endif
          </div>
        </div>
      </div>
    </section>
  </main>
@push('scripts')
    <script>

      $(document).ready(function(){
        $('#telef div').removeClass("stepper");
        $('.stepper-arrow').css("display","none");
      });

        $('#direccion').keyup(function(){
            var car_direccion = $('#direccion').val();
            if(car_direccion >= '2'){
                $('#buyButton').attr("disabled", false);
            }else{
                $('#buyButton').attr("disabled", true);
            }
        });

        Culqi.publicKey = '<?php echo $config->culqi_public?>';

  
        Culqi.settings({
            title: '<?php echo $config->nombre_empresa?>',
            currency: 'USD',
            amount: Math.round('<?php echo $total->total?>')+ '00',
        });
        // Usa la funcion Culqi.open() en el evento que desees
        $('#buyButton').on('click', function(e) {
            // Abre el formulario con las opciones de Culqi.settings
            Culqi.open();
            e.preventDefault();
        });

        function culqi() {
            if (Culqi.token) { 
                let token = Culqi.token.id;
                let productos = '<?php echo $data_productos?>';
                let transanccion  = token;
                let iduser  = "<?php echo auth()->user()->id?>";
                let precio = '<?php echo round($total->total)?>';
                let direccion = document.getElementById('direccion').value;
                return window.location="../../../../../../cuenta/pedido/"+productos+"/"+iduser+"/"+direccion+"/"+precio+"/"+token+'/culqi';
            } 
            else { 
                console.log(Culqi.error);
                alert(Culqi.error.user_message);
            }
        };
    </script>
@endpush
@endsection