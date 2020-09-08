<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
      
      $config = DB::table('config_general')
      ->first();

      ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather/feather.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/libs/flatpickr/dist/flatpickr.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/libs/quill/dist/quill.core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/libs/highlightjs/styles/vs2015.css')}}" />

    <!-- Theme CSS -->
      
    <link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}" id="stylesheetLight">
    <link rel="stylesheet" href="{{asset('assets/css/theme-dark.min.css')}}" id="stylesheetDark">
    <link rel="stylesheet" href="{{asset('assets/css/spectrum.min.css')}}" id="stylesheetLight">
    <link rel="stylesheet" href="{{asset('fonts/font-fileuploader.css')}}" id="stylesheetLight">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.fileuploader.min.css')}}" id="stylesheetLight">
    <link rel="stylesheet" href="{{asset('css/thin.css')}}" id="stylesheetLight">
    <link rel="icon" href="{{asset('admin/'.$config->logo)}}" type="image/x-icon">
    <style>
      body {
        display: none;
      }
      .invalid-feedback{
        display: block;
      }

    </style>
    
    <!-- Title -->
    <title>Panel Administrador</title>

    
  </head>
  <body>

    <!-- MODALS
    ================================================== -->
    
    <!-- Modal: Demo -->
    <div class="modal fade fixed-right" id="modalDemo" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-vertical" role="document">
        <form class="modal-content" id="demoForm">
          <div class="modal-body">

            <!-- Close -->
            <a class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>

            <!-- Image -->
            <div class="text-center">
              <img src="{{asset('admin/'.$config->logo)}}" alt="..." class="img-fluid mb-3" style="width: 50px">
            </div>

            <!-- Heading -->
            <h2 class="text-center mb-2">
              Personaliza tu entorno
            </h2>

            <!-- Text -->
            <p class="text-center mb-4">
              Configura tu panel de administración a tu estilo.
            </p>

            <!-- Divider -->
            <hr class="mb-4">

            <!-- Heading -->
            <h4 class="mb-1">
              Color de esquema
            </h4>

            <!-- Text -->
            <p class="small text-muted mb-3">
              Configura el color de fondo del esquema.
            </p>

            <!-- Button group -->
            <div class="btn-group-toggle d-flex mb-4" data-toggle="buttons">
              <label class="btn btn-white col">
                <input type="radio" name="colorScheme" id="colorSchemeLight" value="light"> <i class="fe fe-sun mr-2"></i>  Claro
              </label>
              <label class="btn btn-white col ml-2">
                <input type="radio" name="colorScheme" id="colorSchemeDark" value="dark"> <i class="fe fe-moon mr-2"></i>  Oscuro
              </label>
            </div>

            <!-- Heading -->
            <h4 class="mb-1">
              Posición de la navegación
            </h4>

            <!-- Text -->
            <p class="small text-muted mb-3">
              Selecciona la posicion del menu lateral.
            </p>

            <!-- Button group -->
            <div class="btn-group-toggle d-flex mb-4" data-toggle="buttons">
              <label class="btn btn-white col">
                <input type="radio" name="navPosition" id="navPositionSidenav" value="sidenav"> Lateral
              </label>
              <label class="btn btn-white col ml-2">
                <input type="radio" name="navPosition" id="navPositionTopnav" value="topnav"> Superior
              </label>
              <label class="btn btn-white col ml-2">
                <input type="radio" name="navPosition" id="navPositionCombo" value="combo"> Mix
              </label>
            </div>

            <!-- Collapse -->
            <div class="collapse show" id="sidebarSizeContainer">

              <!-- Heading -->
              <h4 class="mb-1">
                Tipo de menú
              </h4>

              <!-- Text -->
              <p class="small text-muted mb-3">
                Selecciona el tipo de menú.
              </p>

              <!-- Button group -->
              <div class="btn-group-toggle d-flex mb-4" data-toggle="buttons">
                <label class="btn btn-white col">
                  <input type="radio" name="sidebarSize" id="sidebarSizeBase" value="base"> Completo
                </label>
                <label class="btn btn-white col ml-2">
                  <input type="radio" name="sidebarSize" id="sidebarSizeSmall" value="small"> Iconos
                </label>
              </div>

            </div>

            <!-- Heading -->
            <h4 class="mb-1">
              Color de la navegación
            </h4>

            <!-- Text -->
            <p class="small text-muted mb-3">
              Cambia el color del menú lateral.
            </p>

            <!-- Button group -->
            <div class="btn-group-toggle d-flex" data-toggle="buttons">
              <label class="btn btn-white col">
                <input type="radio" name="navColor" id="navColorDefault" value="default"> Defecto
              </label>
              <label class="btn btn-white col ml-2">
                <input type="radio" name="navColor" id="navColorInverted" value="inverted"> Navy
              </label>
              <label class="btn btn-white col ml-2">
                <input type="radio" name="navColor" id="navColorVibrant" value="vibrant"> Degradado
              </label>
            </div>

          </div>
          <div class="modal-footer border-0">

            <!-- Button -->
            <button type="submit" class="btn btn-block btn-primary mt-auto">
              Guardar
            </button>

          </div>
        </form>
      </div>
    </div>


    <!-- NAVIGATION
    ================================================== -->

    <nav class="navbar navbar-vertical fixed-left navbar-expand-md " id="sidebar">
      <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="./index.html">
          <img src="{{asset('admin/'.$config->logo)}}" class="navbar-brand-img 
          mx-auto" alt="...">
        </a>

        <!-- User (xs) -->
        <div class="navbar-user d-md-none">

          <!-- Dropdown -->
          <div class="dropdown">

            <!-- Toggle -->
            <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-sm avatar-online">
                <img src="{{asset('img/'.auth()->user()->perfil)}}" class="avatar-img rounded-circle" alt="...">
              </div>
            </a>

            <!-- Menu -->
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarIcon">
              <a href="./profile-posts.html" class="dropdown-item">Profile</a>
              <a href="./account-general.html" class="dropdown-item">Settings</a>
              <hr class="dropdown-divider">
              <form method="POST" action="{{route('logout')}}">
                  {{csrf_field()}}
                  <button class="dropdown-item">
                    Cerrar sesión
                  </button>
                
                </form>
            </div>

          </div>

        </div>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">

          <!-- Form -->
          <form class="mt-4 mb-3 d-md-none">
            <div class="input-group input-group-rounded input-group-merge">
              <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fe fe-search"></span>
                </div>
              </div>
            </div>
          </form>

          <!-- Navigation -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{route('dashboard')}}">
                <i class="fe fe-airplay"></i>Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#sidebarDashboards" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarDashboards">
                <i class="fe fe-home"></i> Páginas
              </a>
              <div class="collapse show" id="sidebarDashboards">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{route('admin.inicio')}}" class="nav-link {{ (request()->is('panel/paginas/inicio*')) ? 'active' : '' }}">
                      Inicio
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.producto')}}" class="nav-link {{ (request()->is('panel/data/productos*')) ? 'active' : '' }}">
                      Productos
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('index_oferta.producto')}}" class="nav-link {{ (request()->is('panel/data/productos/ofertas')) ? 'active' : '' }}">
                      Ofertas
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/configuraciones/*')) ? 'active' : '' }}" href="#sidebarConfig" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarConfig">
                <i class="fe fe-settings"></i> Configuraciones
              </a>
              <div class="collapse {{ (request()->is('panel/configuraciones/*')) ? 'show' : '' }}" id="sidebarConfig">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{route('admin.general')}}" class="nav-link {{ (request()->is('panel/configuraciones/general*')) ? 'active' : '' }}">
                      General
                    </a>
                    <a href="{{route('index.seccion_uno')}}" class="nav-link {{ (request()->is('panel/configuraciones/seccion_uno*')) ? 'active' : '' }}">
                      Sección uno
                    </a>
                    <a href="{{route('index.seccion_tres')}}" class="nav-link {{ (request()->is('panel/configuraciones/seccion_tres*')) ? 'active' : '' }}">
                      Sección tres
                    </a>
                    <a href="{{route('index.menu')}}" class="nav-link {{ (request()->is('panel/configuraciones/menu*')) ? 'active' : '' }}">
                      Menú
                    </a>
                    <a href="{{route('index.faq')}}" class="nav-link {{ (request()->is('panel/configuraciones/faq*')) ? 'active' : '' }}">
                      FAQ
                    </a>
                    <a href="{{route('index.galeria')}}" class="nav-link {{ (request()->is('panel/configuraciones/galeria*')) ? 'active' : '' }}">
                      Galería
                    </a>
                    <a href="{{route('index.slider')}}" class="nav-link {{ (request()->is('panel/configuraciones/slider*')) ? 'active' : '' }}">
                      Slider
                    </a>
                  </li>
                  
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/ventas*')) ? 'active' : '' }}" href="#sidebarVenta" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarVenta">
                <i class="fe fe-shopping-cart"></i> Ventas
              </a>
              <div class="collapse {{ (request()->is('panel/ventas*')) ? 'show' : '' }}" id="sidebarVenta">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{route('index.ventas')}}" class="nav-link {{ (request()->is('panel/ventas/pedidos*')) ? 'active' : '' }}">
                      Pedidos
                    </a>
                   
                  </li>
                  
                </ul>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/navegacion*')) ? 'active' : '' }}" href="{{route('index.nav')}}">
                <i class="fe fe-grid"></i> Navegación
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/mensajes*')) ? 'active' : '' }}" href="{{route('index.mensaje')}}">
                <i class="fe fe-mail"></i> Mensajes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/usuario*')) ? 'active' : '' }}" href="{{route('index.usuario')}}">
                <i class="fe fe-user"></i> Usuarios
              </a>
            </li>
          </ul>

          <!-- Divider -->
          <hr class="navbar-divider my-3">

         

          <!-- Push content down -->
          <div class="mt-auto"></div>

          
          <!-- Personalizar -->
          <div id="popoverDemo" data-toggle="popover" data-trigger="manual" title="Make Dashkit Your Own!" data-content="Switch the demo to Dark Mode or adjust the navigation layout, icons, and colors!">
            <a href="#modalDemo" class="btn btn-block btn-primary mb-4" data-toggle="modal">
              <i class="fe fe-sliders mr-2"></i> Personalizar
            </a>
          </div>
          

          
          <!-- User (md) -->
          <div class="navbar-user d-none d-md-flex sa" id="sidebarUser" style="display: block !important">

         

            <!-- Dropup -->
            <div class="dropup">

              <!-- Toggle -->
              <a href="#" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-sm avatar-online">
                  <img src="{{asset('img/'.auth()->user()->perfil)}}" class="avatar-img rounded-circle" alt="...">
                </div>
              </a>

              <!-- Menu -->
              <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
                
                <form method="POST" action="{{route('logout')}}">
                  {{csrf_field()}}
                  <button class="dropdown-item">
                    Cerrar sesión
                  </button>
                
                </form>
              </div>

            </div>

     

          </div>
          

        </div> <!-- / .navbar-collapse -->

      </div>
    </nav>

    
    
    <nav class="navbar navbar-vertical navbar-vertical-sm fixed-left navbar-expand-md " id="sidebarSmall">
      <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarSmallCollapse" aria-controls="sidebarSmallCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="./index.html">
          <img src="{{asset('admin/'.$config->logo)}}" class="navbar-brand-img 
          mx-auto" alt="...">
        </a>

        <!-- User (xs) -->
        <div class="navbar-user d-md-none">

          <!-- Dropdown -->
          <div class="dropdown">

            <!-- Toggle -->
            <a href="#" id="sidebarSmallIcon" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-sm avatar-online">
                <img src="{{asset('img/'.auth()->user()->perfil)}}" class="avatar-img rounded-circle" alt="...">
              </div>
            </a>

            <!-- Menu -->
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sidebarSmallIcon">
              <a href="./profile-posts.html" class="dropdown-item">Profile</a>
              <a href="./account-general.html" class="dropdown-item">Settings</a>
              <hr class="dropdown-divider">
              <form method="POST" action="{{route('logout')}}">
                  {{csrf_field()}}
                  <button class="dropdown-item">
                    Cerrar sesión
                  </button>
                
                </form>
            </div>

          </div>

        </div>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarSmallCollapse">

          <!-- Form -->
          <form class="mt-4 mb-3 d-md-none">
            <div class="input-group input-group-rounded input-group-merge">
              <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fe fe-search"></span>
                </div>
              </div>
            </div>
          </form>

          <!-- Divider -->
          <hr class="navbar-divider d-none d-md-block mt-0 mb-3">

          <!-- Navigation -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{route('dashboard')}}">
                <i class="fe fe-airplay"></i>Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#sidebarDashboards" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarDashboards">
                <i class="fe fe-home"></i> Páginas
              </a>
              <div class="collapse show" id="sidebarDashboards">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{route('admin.inicio')}}" class="nav-link {{ (request()->is('panel/paginas/inicio*')) ? 'active' : '' }}">
                      Inicio
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('admin.producto')}}" class="nav-link {{ (request()->is('panel/data/productos*')) ? 'active' : '' }}">
                      Productos
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('index_oferta.producto')}}" class="nav-link {{ (request()->is('panel/data/productos/ofertas')) ? 'active' : '' }}">
                      Ofertas
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/configuraciones/*')) ? 'active' : '' }}" href="#sidebarConfig" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarConfig">
                <i class="fe fe-settings"></i> Configuraciones
              </a>
              <div class="collapse {{ (request()->is('panel/configuraciones/*')) ? 'show' : '' }}" id="sidebarConfig">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{route('admin.general')}}" class="nav-link {{ (request()->is('panel/configuraciones/general*')) ? 'active' : '' }}">
                      General
                    </a>
                    <a href="{{route('index.seccion_uno')}}" class="nav-link {{ (request()->is('panel/configuraciones/seccion_uno*')) ? 'active' : '' }}">
                      Sección uno
                    </a>
                    <a href="{{route('index.seccion_tres')}}" class="nav-link {{ (request()->is('panel/configuraciones/seccion_tres*')) ? 'active' : '' }}">
                      Sección tres
                    </a>
                    <a href="{{route('index.menu')}}" class="nav-link {{ (request()->is('panel/configuraciones/menu*')) ? 'active' : '' }}">
                      Menú
                    </a>
                    <a href="{{route('index.faq')}}" class="nav-link {{ (request()->is('panel/configuraciones/faq*')) ? 'active' : '' }}">
                      FAQ
                    </a>
                    <a href="{{route('index.galeria')}}" class="nav-link {{ (request()->is('panel/configuraciones/galeria*')) ? 'active' : '' }}">
                      Galería
                    </a>
                    <a href="{{route('index.slider')}}" class="nav-link {{ (request()->is('panel/configuraciones/slider*')) ? 'active' : '' }}">
                      Slider
                    </a>
                  </li>
                  
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/ventas*')) ? 'active' : '' }}" href="#sidebarVenta" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="sidebarVenta">
                <i class="fe fe-shopping-cart"></i> Ventas
              </a>
              <div class="collapse {{ (request()->is('panel/ventas*')) ? 'show' : '' }}" id="sidebarVenta">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{route('index.ventas')}}" class="nav-link {{ (request()->is('panel/ventas/pedidos*')) ? 'active' : '' }}">
                      Pedidos
                    </a>
                   
                  </li>
                  
                </ul>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/navegacion*')) ? 'active' : '' }}" href="{{route('index.nav')}}">
                <i class="fe fe-grid"></i> Navegación
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/mensajes*')) ? 'active' : '' }}" href="{{route('index.mensaje')}}">
                <i class="fe fe-mail"></i> Mensajes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ (request()->is('panel/usuario*')) ? 'active' : '' }}" href="{{route('index.usuario')}}">
                <i class="fe fe-user"></i> Usuarios
              </a>
            </li>
          </ul>

          <!-- Divider -->
          <hr class="navbar-divider my-3">

          <!-- Navigation -->
          <ul class="navbar-nav mb-md-4">
            <li class="nav-item dropright">
              <a class="nav-link dropdown-toggle " id="sidebarSmallBasics" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Basics">
                <i class="fe fe-clipboard"></i> <span class="d-md-none">Basics</span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="sidebarSmallBasics">
                <li class="dropdown-header d-none d-md-block">
                  <h6 class="text-uppercase mb-0">Basics</h6>
                </li>
                <li>
                  <a href="./docs/getting-started.html" class="dropdown-item ">
                    Getting Started
                  </a>
                </li>
                <li>
                  <a href="./docs/design-file.html" class="dropdown-item ">
                    Design File
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./docs/components.html" data-toggle="tooltip" data-placement="right" data-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' title="Components">
                <i class="fe fe-book-open"></i> <span class="d-md-none">Components</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./docs/changelog.html" data-toggle="tooltip" data-placement="right" data-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' title="Changelog">
                <i class="fe fe-git-branch"></i> <span class="d-md-none">Changelog</span> <span class="badge badge-primary ml-auto d-md-none">v1.6.0</span>
              </a>
            </li>
          </ul>

          <!-- Push content down -->
          <div class="mt-auto"></div>

          
          <!-- Personalizar -->
          <div class="mb-4" data-toggle="tooltip" data-placement="right" data-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' title="Personalizar">
            <a href="#modalDemo" class="btn btn-block btn-primary" data-toggle="modal">
              <i class="fe fe-sliders"></i> <span class="d-md-none ml-2">Personalizar</span>
            </a>
          </div>
          

          
          <!-- User (md) -->
          <div class="navbar-user d-none d-md-flex flex-column" id="sidebarSmallUser" style="display: block !important">

            <!-- Icon -->
            <a href="#sidebarModalSearch" class="navbar-user-link mb-3" data-toggle="modal">
              <span class="icon">
                <i class="fe fe-search"></i>
              </span>
            </a>

            <!-- Icon -->
            <a href="#sidebarModalActivity" class="navbar-user-link mb-3" data-toggle="modal">
              <span class="icon">
                <i class="fe fe-bell"></i>
              </span>
            </a>

            <!-- Dropup -->
            <div class="dropright">

              <!-- Toggle -->
              <a href="#" id="sidebarSmallIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-sm avatar-online">
                  <img src="{{asset('img/'.auth()->user()->perfil)}}" class="avatar-img rounded-circle" alt="...">
                </div>
              </a>

              <!-- Menu -->
              <div class="dropdown-menu" aria-labelledby="sidebarSmallIconCopy">
                
                <form method="POST" action="{{route('logout')}}">
                  {{csrf_field()}}
                  <button class="dropdown-item">
                    Cerrar sesión
                  </button>
                
                </form>
              </div>

            </div>

          </div>
          

        </div> <!-- / .navbar-collapse -->

      </div>
    </nav>

    
    
    
    <nav class="navbar navbar-expand-lg " id="topnav">
      <div class="container">

        <!-- Toggler -->
        <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand mr-auto" href="./index.html">
          <img src="{{asset('admin/'.$config->logo)}}" alt="..." class="navbar-brand-img">
        </a>

        <!-- Form -->
        <form class="form-inline mr-4 d-none d-lg-flex">
          <div class="input-group input-group-rounded input-group-merge" data-list='{"valueNames": ["name"]}'>

            <!-- Input -->
            <input type="search" class="form-control form-control-prepended  dropdown-toggle list-search" data-toggle="dropdown" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fe fe-search"></i>
              </div>
            </div>

            <!-- Menu -->
            <div class="dropdown-menu dropdown-menu-card">
              <div class="card-body">

                <!-- List group -->
                <div class="list-group list-group-flush list-group-focus list my-n3">
                  <a class="list-group-item" href="./team-overview.html">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar">
                          <img src="./assets/img/avatars/teams/team-logo-1.jpg" alt="..." class="avatar-img rounded">
                        </div>

                      </div>
                      <div class="col ml-n2">

                        <!-- Title -->
                        <h4 class="text-body text-focus mb-1 name">
                          Airbnb
                        </h4>

                        <!-- Time -->
                        <p class="small text-muted mb-0">
                          <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 2hr ago</time>
                        </p>

                      </div>
                    </div> <!-- / .row -->
                  </a>
                  <a class="list-group-item" href="./team-overview.html">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar">
                          <img src="./assets/img/avatars/teams/team-logo-2.jpg" alt="..." class="avatar-img rounded">
                        </div>

                      </div>
                      <div class="col ml-n2">

                        <!-- Title -->
                        <h4 class="text-body text-focus mb-1 name">
                          Medium Corporation
                        </h4>

                        <!-- Time -->
                        <p class="small text-muted mb-0">
                          <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 2hr ago</time>
                        </p>

                      </div>
                    </div> <!-- / .row -->
                  </a>
                  <a class="list-group-item" href="./project-overview.html">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar avatar-4by3">
                          <img src="./assets/img/avatars/projects/project-1.jpg" alt="..." class="avatar-img rounded">
                        </div>

                      </div>
                      <div class="col ml-n2">

                        <!-- Title -->
                        <h4 class="text-body text-focus mb-1 name">
                          Homepage Redesign
                        </h4>

                        <!-- Time -->
                        <p class="small text-muted mb-0">
                          <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                        </p>

                      </div>
                    </div> <!-- / .row -->
                  </a>
                  <a class="list-group-item" href="./project-overview.html">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar avatar-4by3">
                          <img src="./assets/img/avatars/projects/project-2.jpg" alt="..." class="avatar-img rounded">
                        </div>

                      </div>
                      <div class="col ml-n2">

                        <!-- Title -->
                        <h4 class="text-body text-focus mb-1 name">
                          Travels & Time
                        </h4>

                        <!-- Time -->
                        <p class="small text-muted mb-0">
                          <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                        </p>

                      </div>
                    </div> <!-- / .row -->
                  </a>
                  <a class="list-group-item" href="./project-overview.html">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar avatar-4by3">
                          <img src="./assets/img/avatars/projects/project-3.jpg" alt="..." class="avatar-img rounded">
                        </div>

                      </div>
                      <div class="col ml-n2">

                        <!-- Title -->
                        <h4 class="text-body text-focus mb-1 name">
                          Safari Exploration
                        </h4>

                        <!-- Time -->
                        <p class="small text-muted mb-0">
                          <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                        </p>

                      </div>
                    </div> <!-- / .row -->
                  </a>
                  <a class="list-group-item" href="./profile-posts.html">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar">
                          <img src="{{asset('img/'.auth()->user()->perfil)}}" alt="..." class="avatar-img rounded-circle">
                        </div>

                      </div>
                      <div class="col ml-n2">

                        <!-- Title -->
                        <h4 class="text-body text-focus mb-1 name">
                          Dianna Smiley
                        </h4>

                        <!-- Status -->
                        <p class="text-body small mb-0">
                          <span class="text-success">●</span> Online
                        </p>

                      </div>
                    </div> <!-- / .row -->
                  </a>
                  <a class="list-group-item" href="./profile-posts.html">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar">
                          <img src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>

                      </div>
                      <div class="col ml-n2">

                        <!-- Title -->
                        <h4 class="text-body text-focus mb-1 name">
                          Ab Hadley
                        </h4>

                        <!-- Status -->
                        <p class="text-body small mb-0">
                          <span class="text-danger">●</span> Offline
                        </p>

                      </div>
                    </div> <!-- / .row -->
                  </a>
                </div>

              </div>
            </div> <!-- / .dropdown-menu -->

          </div>
        </form>

    

        <!-- Collapse -->
        <div class="collapse navbar-collapse mr-lg-auto order-lg-first" id="navbar">

          <!-- Form -->
          <form class="mt-4 mb-3 d-md-none">
            <input type="search" class="form-control form-control-rounded" placeholder="Search" aria-label="Search">
          </form>

          <!-- Navigation -->
          <ul class="navbar-nav mr-lg-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" id="topnavDashboards" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dashboards
              </a>
              <ul class="dropdown-menu" aria-labelledby="topnavDashboards">
                <li>
                  <a class="dropdown-item active" href="./index.html">
                    Default
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="./dashboard-project-management.html">
                    Project Management
                  </a>
                </li>
                <li>
                  <a class="dropdown-item " href="./dashboard-ecommerce.html">
                    E-Commerce
                  </a>
                </li>
              </ul>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="#modalDemo" data-toggle="modal">
                Personalizar
              </a>
            </li>
          </ul>

        </div>

      </div> <!-- / .container -->
    </nav>

    

    <!-- MAIN CONTENT
    ================================================== -->
   @yield('contenido')

    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Libs JS -->
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/@shopify/draggable/lib/es5/draggable.bundle.legacy.js')}}"></script>
    <script src="{{asset('assets/libs/autosize/dist/autosize.min.js')}}"></script>
    <script src="{{asset('assets/libs/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/libs/flatpickr/dist/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js')}}"></script>
    <script src="{{asset('assets/libs/list.js/dist/list.min.js')}}"></script>
    <script src="{{asset('assets/libs/quill/dist/quill.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/libs/chart.js/Chart.extension.js')}}"></script>

    <!-- Theme JS -->
    <script src="{{asset('assets/js/theme.min.js')}}"></script>
    <script src="{{asset('assets/js/dashkit.min.js')}}"></script>
    <script src="{{asset('assets/js/spectrum.min.js')}}"></script>
    <script src="https://innostudio.de/fileuploader/js/jquery.slick.min.js"></script>
    <script src="{{asset('assets/js/jquery.fileuploader.min.js')}}"></script>

    @stack('scripts')
      <script>
        $('#sidebarUser').removeAttr('style');
      </script>

  </body>
</html>
