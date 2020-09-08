@extends('layouts.admin')
@section('contenido')
<div class="main-content">

      
    @include('navbar')

    

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">

      

          <!-- Header -->
          <div class="header mt-md-5">
            <div class="header-body">
              <div class="row align-items-center">
                <div class="col">

                  <!-- Pretitle -->
                  <h6 class="header-pretitle">
                    Formulario
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Registrar usuario 
                  </h1>
                 
                </div>
               
              </div> <!-- / .row -->
            </div>
          </div>

          <!-- Form -->

          <form class="mb-4" action="{{route('update.usuario',$user->id)}}" method="POST">
            @method('PATCH')
            @csrf
           
            <div class="form-group">
              @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{Session::get('success')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>

                </div>
              @endif
            </div>
            <div class="form-group">
              @if(Session::has('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{Session::get('danger')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>

                </div>
              @endif
            </div>


            <div class="form-group">
             
                <div class="card mb-4">
                    <div class="card-body">
    
                      <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="exampleInputEmail1">Nombres completos</label>
                            <input type="text" class="form-control form-control-prepended" placeholder="Nombres completos" name="name" value="{{$user->name}}">
                            @if ($errors->has('enlace'))
                            <div class="invalid-feedback">
                                {{ $errors->first('enlace') }}
                            </div>
                            @endif                
                        </div>
                        <div class="col-lg-6">
                          <label for="exampleInputEmail1">Correo de acceso</label>
                          <input type="email" class="form-control"  placeholder="Correo electrónico" name="email" value="{{$user->email}}">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6 form-group">
                          <label for="exampleInputEmail1">Nueva contraseña</label>
                          <div class="input-group input-group-merge" id="show_hide_password">
                            <input type="password" class="form-control form-control-prepended" placeholder="Icono"  name="password" >
                            <div class="input-group-prepend">
                              <div class="input-group-text" style="padding-right: 0px;padding:0px !important">
                                <button type="button" id="btn-pass" class="btn btn-primary" style="border-bottom-width: 0px;"><span class="fe fe-lock"></span></button>
                              </div>
                            </div>
                            @if ($errors->has('icono'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('icono') }}
                                </div>
                                @endif
                          </div>

                        </div>

                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Confirmar contraseña</label>
                            <div class="input-group input-group-merge" id="show_hide_password">
                              <input type="password" class="form-control form-control-prepended" placeholder="Icono"  name="password_confirmation" >
                              <div class="input-group-prepend">
                                <div class="input-group-text" style="padding-right: 0px;padding:0px !important">
                                  <button type="button" id="btn-pass" class="btn btn-primary" style="border-bottom-width: 0px;"><span class="fe fe-lock"></span></button>
                                </div>
                              </div>
                              
                            </div>
  
                          </div>

                        <div class="col-lg-6">
                            <label for="exampleInputEmail1">Rol de usuario</label>
                            <select name="role" class="form-control">
                                @if ($user->role == 'ADMIN')
                                    <option value="ADMIN" selected>ADMIN</option>
                                    <option value="USER">USER</option>
                                @else
                                    <option value="ADMIN" >ADMIN</option>
                                    <option value="USER" selected>USER</option>
                                @endif
                            </select>
                              @if ($errors->has('role'))
                                  <div class="invalid-feedback">
                                      {{ $errors->first('role') }}
                                  </div>
                              @endif
                          </div>

 

                      </div>

                    </div>
                </div>
            </div>


            <!-- Divider -->
            <hr class="mt-4 mb-5">

  
           

     
            <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
            <a href="{{route('index.usuario')}}" class="btn btn-block btn-link text-muted">
              Cancelar
            </a>

          </form>

        </div>
      </div> <!-- / .row -->
    </div>

  </div> 

  @push('scripts')
    <script>
        
        $(document).ready(function() {
            $("#btn-pass").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });





    </script>
@endpush
@endsection