<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Panel de Administración')</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('/../assets/css/bootstrap.min.css', array('media'=>'screen')) }}

    <!-- Custom styles for this template -->
    {{ HTML::style('/../assets/css/adminpanel.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/adminpanel-responsive.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/table-responsive.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/bootstrap-reset.css', array('media'=>'screen')) }}
    {{ HTML::style('/../assets/css/font-awesome.css', array('media'=>'screen')) }}

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

    <div class="container">
        {{ Form::open(array('url' => '/registrarse','class' => 'form-signin', 'id' => 'singup')) }}
        <h2 class="form-signin-heading">Registrarse</h2>
        <div class="login-wrap">
            @if(Session::has('notice'))
            <div class="alert alert-success">{{ Session::get('notice') }}</div>
            <br>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
            <br>
            @endif
            <p>Ingresa tus Datos a Continuación</p>
            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Nombre Completo" required />
            <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electronico" required />
            <br />
            <div class="form-group">
                <div class="alert alert-info">Debe guardar aqui la direccion a la cual recibe los pedidos, no olvide seleccionar La Ciudad y el Estado</div>
                <input type="text" name="user_address" id="user_address" class="form-control" placeholder="Dirección" required />
                <label for="estado">Estado</label>
                <select name="estado" id="estados" class="form-control">
                </select>
                <br />
                <label for="municipio">Ciudad</label>
                <select name="municipio" id="municipios" class="form-control">
                    <option>Selecciona el Estado</option>
                </select>
            </div>
            <div class="form-group">
                <div class="alert alert-info">Ingrese su Numero de telefono o movil para efectos de comunicación</div>
                <input type="text" name="user_mobile" id="user_mobile" class="form-control" placeholder="Telefono" required />
            </div>
            <p> Ingresa los detalles para tu Cuenta</p>
            <input type="text" name="username" id="username" class="form-control" placeholder="Usuario" required />
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required />
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required />
            <button class="btn btn-lg btn-success btn-block" type="submit">Registrarse</button>
            <div class="registration">
                Estas Registrado.
                <a class="" href="/login">
                    Ingresa Aqui
                </a>
            </div>

        </div>

        {{ Form::close() }}

    </div>
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
    {{ HTML::script('/../assets/js/bootstrap.min.js') }}
    {{ HTML::script('/../assets/js/jquery.validate.js') }}
    {{ HTML::script('/../assets/js/common.js') }}
    <script type="text/javascript">
        /* GEO */
        $(document).on("ready", function(){

            var $estados = $("#estados");
            var $municipios = $("#municipios");

            $.post('/geo/estados', function(data, textStatus, xhr) {                
                $.each(data, function(index, val) {
                    var option = '<option value="' + val.id +'">' + val.estado +'</option>';
                    $estados.append(option);
                }); 
            },'json');

            $estados.on("change", function(){
                var id = $(this).val();
                resetMunicipios();
                $.post('/geo/estado/' + id, function(data, textStatus, xhr) {                
                    $.each(data, function(index, val) {
                        var option = '<option value="' + val.id +'">' + val.ciudad +'</option>';
                        $municipios.append(option);
                    }); 
                },'json');
            });

            function resetMunicipios(){
                $municipios.empty();
                var option = '<option> -- Seleccione --</option>';
                $municipios.append(option);
            }
        });
        $(function(){
            $('#singup').validate({
                rules :{
                    full_name : {
                        required : true,
                    },
                    email : {
                        required : true,
                        email : true
                    },
                    user_address : {
                        required : true,
                    },
                    estado : {
                        required : true,
                    },
                    municipio : {
                        required : true,
                    },
                    user_mobile : {
                        required : true,
                        number : true,
                    },
                    username : {
                        required : true,
                    },
                    password : {
                        required : true,
                    },
                    password_confirmation : {
                        required : true,
                        equalTo : "#password",
                    },
                },
                messages : {
                    full_name : {
                        required : "No puede dejar en blanco este campo, ingrese su nombre completo",
                    },
                    email : {
                        required : "El correo electronico es requerido",
                        email    : "Escriba una direccion de correo electronica valida",
                    },
                    user_address : {
                        required : "Escriba una direccion ya que es requerida para efectos de envios de los pedidos a su persona",
                    },
                    estado : {
                        required : "Seleccione el Estado de residencia",
                    },
                    municipio : {
                        required : "Seleccione el municipio de referencia",
                    },
                    user_mobile : {
                        required : "Este campo es obligatorio, el telefono es para efectos de comunicacion",
                    },
                    username : {
                        required : "El nombre de usuario es obligatorio, se usa para efectos de acceder a su cuenta",
                    },
                    password : {
                        required : "Este campo es obligatorio, debe ingresar el password que usara para su cuenta de usuario",
                    },
                    password_confirmation : {
                        required : "La confirmacion del password no la puede dejar vacia",
                        equalTo : "La confirmacion del password debe coincidir con el password",
                    },
                }
            });    
        });
    </script>

</body>
</html>