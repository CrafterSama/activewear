<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title','Panel de Administración')</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.min.css', array('media'=>'screen')) }}

    <!-- Custom styles for this template -->
    {{ HTML::style('assets/css/adminpanel.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/adminpanel-responsive.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/table-responsive.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/bootstrap-reset.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/font-awesome.css', array('media'=>'screen')) }}
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
  <a href="/" class="back-login btn btn-primary btn-xs white"> <i class="fa fa-angle-double-left fa-lg"></i> Volver a la Web</a>
  <body class="login-body">
      {{ Form::open(array('url' => '/login','class' => 'form-signin', 'id' => 'singin')) }}
        <h2 class="form-signin-heading carioca_color4">Conectarse</h2>
       <div class="login-wrap">
            {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}
            @if(Session::has('mensaje_error'))
                <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
                <br>
            @endif
            <div class="user-login-info">
                {{ $errors->first('username', '<div class="alert alert-danger">:message</div>') }}
                {{ Form::text('username', Input::old('username'), array('class' => 'form-control','placeholder' => 'Usuario')); }}
                {{ $errors->first('password', '<div class="alert alert-danger">:message</div>') }}
                {{ Form::password('password', array('class' => 'form-control','placeholder' => 'Contraseña')); }}
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Recuerdame
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Olvide mi Contraseña?</a>

                </span>
            </label>

            @if(isset($_GET['redirect']))
              {{ Form::hidden('redirect', $_GET['redirect'] ); }}
            @endif

            {{ Form::submit('Entrar',array('class'=>'btn btn-lg btn-success btn-block')) }}

            <div class="text-center" style="font-size: 18px;">
                No Tienes Cuenta?<br />
                <a  class="btn btn-lg btn-info btn-block" href="/registrarse">
                    Create una
                </a>
		¡Es Gratis!
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Olvide mi Contraseña?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Ingresa tu Correo Electronico para reiniciar tu contraseña.</p>
                          <input type="text" name="email" placeholder="Correo Electronico" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                          <button class="btn btn-success" type="button">Enviar</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>
<!-- Placed js at the end of the document so the pages load faster -->
<!--common script init for all pages-->
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
{{ HTML::script('/../assets/js/bootstrap.min.js') }}
{{ HTML::script('/../assets/js/jquery.nicescroll.js') }}
{{ HTML::script('/../assets/js/toggle-init.js') }}
{{ HTML::script('/../assets/js/dashboard.js') }}
{{ HTML::script('/../assets/js/jquery.validate.js') }}
{{ HTML::script('/../assets/js/scripts.js') }}
<script>
          $(function(){
            $('#signin').validate({
                rules :{
                  username : {
                    required : true,
                  },
                  password : {
                    required : true,
                  },
                },
                messages : {
                    username : {
                        required : "Debe ingresar el nombre de usuario",
                    },
                    password : {
                        required : "Debe ingresar un password o contraseña",
                    },
                }
            });    
        });
</script>

<!--script for this page-->
</body>
</html>