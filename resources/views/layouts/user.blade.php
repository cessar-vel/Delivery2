<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <?php
    
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

        $nav = DB::table('navegacion')
        ->get();

        if (auth::check()) {
          $carrito = DB::table('carrito')
          ->get();

          $num_carrito = count($carrito);
        }

    ?>
    <!-- Site Title-->
    <title><?php echo $config->nombre_empresa?></title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
 
    <!-- Stylesheets-->
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
    <style>
      .rd-navbar-nav .navbar-icon:before{
        font-size: 41px !important;
      }
      .thumbnail-menu-modern .price:before {
          content: "";
          display: inline-block;
      }
      .rd-navbar-nav .navbar-icon:before {

        color: <?php echo $config->color_texto_menu?> !important;
      }
    </style>
  </head>
  <body>
    <div class="ie-panel"><a href="https://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
      </div>
    </div>
    <!-- Page-->
    <div class="page text-center">
      <!-- Page Header-->
      <header class="page-head">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap rd-navbar-minimal" style="background: {{$config->color_fondo_menu}} !important">
          <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="100px" data-lg-stick-up-offset="100px" style="background: {{$config->color_fondo_menu}} !important">
            <div class="container container-fluid">
              <div class="rd-navbar-inner">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand--><a class="rd-navbar-brand brand" href="{{route('inicio')}}">
                    <div class="brand-logo">
                      <svg x="0px" y="0px" width="230px" height="41px" viewbox="0 0 230 41">
                        <text transform="matrix(1 0 0 1 1.144409e-004 32)" fill="<?php echo $config->color_texto_menu?>" font-family="'Grand Hotel'" font-size="45.22">{{$config->nombre_empresa}}</text>
                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#EB5453" d="M43.743,2.954c2.606,0,4.719,2.091,4.719,4.672  c0,2.58-2.113,4.672-4.719,4.672c-2.606,0-4.719-2.091-4.719-4.672C39.024,5.045,41.137,2.954,43.743,2.954z"></path>
                      </svg>
                    </div></a>
                </div>
                <!-- RD Navbar Nav-->
                <div class="rd-navbar-nav-wrap">
                  <!-- RD Navbar Nav-->
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li><a class="navbar-icon restaurant-icon-19" href="#" style="color: {{$config->color_texto_menu}} !important">Menu</a>
                      <!-- RD Navbar Dropdown-->
                      <ul class="rd-navbar-dropdown menu-img-wrap">
                        @foreach ($menu_comida as $item)
                          @if (strlen($item->titulo) >= '9')
                            <li class="menu-img">
                              <a href="{{route('menu_single',strtolower($item->titulo))}}"  style="font-size:11px !important">
                                <img src="{{asset('admin/'.$item->preview)}}" alt="" width="88" height="60">
                                <span style="">{{$item->titulo}}</span>
                              </a>
                            </li>
                          @else
                            <li class="menu-img">
                              <a href="{{route('menu_single',strtolower($item->titulo))}}" style="font-size:11px !important">
                                <img src="{{asset('admin/'.$item->preview)}}" alt="" width="88" height="60">
                                <span>{{$item->titulo}}</span>
                              </a>
                            </li>
                          @endif
                          
                        @endforeach
                      </ul>
                    </li>
                   @foreach ($nav as $item)

                      <li class="{{ (request()->is('contacto')) ? 'active' : '' }}">
                        <a class="navbar-icon {{$item->icono}}" href="{{$item->enlace}}" style="color: {{$config->color_texto_menu}} !important">{{$item->titulo}}</a>
                      </li> 
                    
                   @endforeach

                   @if (auth::check())
                   <li class="rd-navbar--has-dropdown rd-navbar-submenu"><a class="navbar-icon thin-icon-user" style="color: {{$config->color_texto_menu}} !important" href="#">Mi cuenta</a>
                   
                    <ul class="rd-navbar-dropdown rd-navbar-open-right">
                      
                      <li><a href="{{route('hoy')}}">Pedidos hoy</a></li>
                      <li><a href="{{route('ordenes')}}">Historial</a></li>
                      <li><a href="{{route('ofertas')}}">Ofertas</a></li>
                      <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <li style="padding:0px !important"><button style="    width: 100%;
                          font-size: 15px !important;
                          border: 2px solid #ff0000;
                          color: #ff0000;
                          text-align: left;
                          padding-left: 28px;
                          ">CERRAR SESIÓN</button></li>
                      </form>
                    </ul>
                  </li>
                   @endif

                  </ul>

                  <!-- RD Navbar Shop-->
                  <ul class="rd-navbar-shop list-inline">
                   
                    @if (auth::check())
                      <li><a class="unit unit-horizontal unit-middle unit-spacing-xxs link-gray-light" href="{{route('open_carrito')}}">
                        <div class="unit-left"><span class="icon icon-md icon-primary thin-icon-cart"></span></div>
                        <div class="unit-body"><span class="label-inline big" style="color: {{$config->color_texto_menu}} !important">{{$num_carrito}}</span></div></a>
                      </li>
                    @else
                      <li><a class="unit unit-horizontal unit-middle unit-spacing-xxs link-gray-light" href="{{route('login')}}">
                        <div class="unit-left"><span class="icon icon-md icon-primary thin-icon-cart"></span></div>
                        <div class="unit-body"><span class="label-inline big">Iniciar sesión</span></div></a>
                      </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- Page Content-->
      @yield('user')
      <!-- Page Footer -->
      <footer class="page-foot text-sm-left">
        <section class="bg-gray-darker section-top-55 section-bottom-60">
          <div class="container">
            <div class="row border-left-cell">
              <div class="col-sm-6 col-md-3 col-lg-4"><a class="brand brand-inverse" href="index.html">
                  <svg x="0px" y="0px" width="230px" height="41px" viewbox="0 0 230 41">
                    <text transform="matrix(1 0 0 1 1.144409e-004 32)" fill="#2C2D2F" font-family="'Grand Hotel'" font-size="45.22">{{$config->nombre_empresa}}</text>
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#EB5453" d="M43.743,2.954c2.606,0,4.719,2.091,4.719,4.672  c0,2.58-2.113,4.672-4.719,4.672c-2.606,0-4.719-2.091-4.719-4.672C39.024,5.045,41.137,2.954,43.743,2.954z"></path>
                  </svg></a>
                <ul class="list-unstyled contact-info offset-top-5">
                  <li>
                    <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                      <div class="unit-left"><span class="text-white">Dirección:</span></div>
                      <div class="unit-body text-left text-gray-light">
                        <p>{{$config->ubicacion}}</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="unit unit-horizontal unit-top unit-spacing-xxs">
                      <div class="unit-left"><span class="text-white">Email:</span></div>
                      <div class="unit-body"><a class="link-gray-light" href="mailto:#">{{$config->correo}}</a></div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="col-sm-6 col-md-3 offset-top-50 offset-sm-top-0">
                <h4 class="text-uppercase">Menú</h4>
                <ul class="list-tags offset-top-15">
                  @foreach ($menu_comida as $item)
                  <li class="text-gray-light"><a class="link-gray-light" href="menu-single.html">{{$item->titulo}}</a></li>
                  @endforeach
                  
                  
                </ul>
              </div>
              <div class="col-sm-10 col-lg-5 offset-top-50 offset-md-top-0 col-md-6">
                <h4 class="text-uppercase"><a class="link-gray-light" href="{{route('faq')}}">Preguntas frecuentes</a></h4>
              </div>
            </div>
          </div>
        </section>
        <section class="section-20 bg-white">
          <div class="container">
            <div class="row justify-content-xs-center justify-content-sm-between">
              <div class="col-sm-5 offset-top-26 text-md-left">
                <p class="copyright">
                  {{$config->cr}}
                  <!-- {%FOOTER_LINK}-->
                </p>
              </div>
              <div class="col-sm-4 offset-top-30 offset-sm-top-0 text-md-right">
                <ul class="list-inline list-inline-sizing-1">
                  <li><a class="link-silver-light" target="_blank" href="{{$config->instagram}}"><span class="icon icon-xs fa-instagram"></span></a></li>
                  <li><a class="link-silver-light" target="_blank" href="{{$config->facebook}}"><span class="icon icon-xs fa-facebook"></span></a></li>
                  <li><a class="link-silver-light" target="_blank" href="{{$config->twitter}}"><span class="icon icon-xs fa-twitter"></span></a></li>
                  
                </ul>
              </div>
            </div>
          </div>
        </section>

      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
    <!-- Java script-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{asset('js/core.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://checkout.culqi.com/js/v3"></script>
    @stack('scripts')
	<!--LIVEDEMO_00 -->


	
  </body>
</html>