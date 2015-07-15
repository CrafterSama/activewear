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
        <form action="{{ action('RemindersController@postRemind') }}" method="POST" class="form-signin" id="singin">
          <h2 class="form-signin-heading carioca_color4">Restablecer Contraseña</h2>
          <div class="login-wrap">
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                <br>
            @endif
            @if(Session::has('status'))
                <div class="alert alert-success">{{ Session::get('status') }}</div>
                <br>
            @endif
            <div class="user-login-info">
              <input class="form-control" placeholder="Email" type="email" name="email" />
            </div>
            {{ Form::submit('Restablecer',array('class'=>'btn btn-lg btn-success btn-block')) }}
            <div class="text-center" style="font-size: 18px;">
                No Tienes Cuenta?<br />
                <a  class="btn btn-lg btn-info btn-block" href="/registrarse">Create una</a>¡Es Gratis!
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
</body>
</html>