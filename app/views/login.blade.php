<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title','Panel de Administración')</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', array('media'=>'screen')) }}
    <!-- Font Awesome -->
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', array('media'=>'screen')) }}
    <!-- Custom styles for this template -->
    {{ HTML::style('assets/css/adminpanel.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/adminpanel-responsive.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/bootstrap-reset.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/bootstrap-switch.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/bootstrap-datepicker3.min.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/bootstrap-select.min.css', array('media'=>'screen')) }}
    {{ HTML::style('assets/css/table-responsive.css', array('media'=>'screen')) }}
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    {{ HTML::style('assets/css/jquery-img-upload/jquery.fileupload.css', array('media'=>'screen')) }}
    
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
          @if(Session::has('status'))
              <div class="alert alert-success">{{ Session::get('status') }}</div>
              <br>
          @endif
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
          </label>
          <span class="pull-right">
            <a href="/reset-password"> Olvide mi Contraseña?</a>
          </span>
          @if(isset($_GET['redirect']))
            {{ Form::hidden('redirect', $_GET['redirect'] ); }}
          @endif
          {{ Form::submit('Entrar',array('class'=>'btn btn-lg btn-success btn-block')) }}
          <div class="text-center" style="font-size: 18px;">
            No Tienes Cuenta?<br />
            <a  class="btn btn-lg btn-info btn-block" href="/registrarse">Create una</a> ¡Es Gratis!
          </div>
        </div>
      </form>
<!-- Placed js at the end of the document so the pages load faster -->
<!--common script init for all pages-->
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
{{ HTML::script('http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js') }}
{{ HTML::script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js') }}
{{ HTML::script('assets/js/jquery.nicescroll.js') }}
{{ HTML::script('assets/js/jquery.dcjqaccordion.2.7.js') }}
{{ HTML::script('assets/js/jquery.scrollTo.min.js') }}
{{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/bootstrap-switch.js') }}
{{ HTML::script('assets/js/bootstrap-select.min.js') }}
{{ HTML::script('assets/js/bootstrap-filestyle.min.js') }}
{{ HTML::script('assets/js/bootstrap-datepicker.min.js') }}
{{ HTML::script('assets/js/locales/bootstrap-datepicker.es.min.js') }}
{{ HTML::script('assets/js/toggle-init.js') }}
{{ HTML::script('assets/js/vendor/Chart.min.js') }}
{{ HTML::script('assets/js/common.js') }}
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