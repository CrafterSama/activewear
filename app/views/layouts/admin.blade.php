@if (Auth::user()->role_id != 1)
    No tienes Acceso a esta Seccion! <a href="/">Volver al Inicio</a>
@else
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
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="/admin" class="logo">
                <img src="/../assets/images/logo.png" alt="logo" width="90px" />
                {{-- <strong><em style="font-size: 0.5em; margin-top: 30px;">Carioca ActiveWear</em></strong> --}}
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars fa-2x"></div>
            </div>
        </div>
        <!--logo end-->
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <!-- user login dropdown start-->
                <li><a href="/" style="padding: 6px; background: rgb(199,71,81); border-radius: 5px; color: white;" class="btn"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Volver a la Web</a></li>
                <li class="dropdown">
                    
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="/assets/images/avatar1_small.jpg">
                        <span class="username">{{ Auth::user()->full_name; }}</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="/admin/usuarios/{{ Auth::user()->id }}/perfil"><i class=" fa fa-suitcase"></i>Perfil</a></li>
                        <li><a href="/admin/usuarios/{{ Auth::user()->id }}/password"><i class=" fa fa-pencil"></i>Contraseña</a></li>
                        <li><a href="/admin/configuracion"><i class="fa fa-cog"></i>Configuracion</a></li>
                        <li><a href="/logout"><i class="fa fa-key"></i>Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="/admin">
                        <i class="fa fa-home fa-lg"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/productos">
                        <i class="fa fa-list fa-lg"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a data-toggle="collapse" data-target="#toggleOrders" class="collapse">
                        <i class="fa fa-list-alt fa-lg"></i>
                        <span>Pedidos</span>
                    </a>
                    <div class="collapse" id="toggleOrders">
                        <ul class="sub">
                            <li><a href="/admin/pedidos">Pendientes</a></li>
                            <li><a href="/admin/pedidos/aprobados">Aprobados</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="/admin/modelos">
                        <i class="fa fa-th-large fa-lg"></i>
                        <span>Modelos</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a data-toggle="collapse" data-target="#toggleReports" class="collapse">
                        <i class="fa fa-list-alt fa-lg"></i>
                        <span>Reportes</span>
                    </a>
                    <div class="collapse" id="toggleReports">
                        <ul class="sub">
                            <li><a href="/admin/reportes/porfecha">Por Fechas</a></li>
                            <li><a href="/admin/pedidos/porcentaje">Por Porcentaje</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="/admin/usuarios">
                        <i class="fa fa-users"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            @yield('content')
   
        </section>
    </section>
    <!--main content end-->
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--common script init for all pages-->
{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.10.4/jquery-ui.min.js') }}
{{ HTML::script('/../assets/js/bootstrap.min.js') }}
{{ HTML::script('/../assets/js/jquery.nicescroll.js') }}
{{ HTML::script('/../assets/js/toggle-init.js') }}
{{ HTML::script('/../assets/js/jquery.dcjqaccordion.2.7.js') }}
{{ HTML::script('http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js') }}
{{ HTML::script('/../assets/js/common.js') }}
{{ HTML::script('/../assets/js/scripts.js') }}
<!--script for this page-->
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
                $('#form').validate({
                    rules :{
                        recibo : {
                            required : true,
                            number : true

                        },
                        monto : {
                            required : true,
                            number : true

                        },
                        fecha : {
                            required : true,
                            date : true

                        },
                        adjunto : {
                            required : true
                        },
                        options : {
                            required : true
                        },
                        /*if ($('#no').is(':checked')) {*/
                            user_address : {
                                required : true,
                                maxlenght : 140
                            },
                            estado : {
                                required : true
                            },
                            municipio : {
                                required : true
                            },
                        /*}*/
                    },
                    messages : {
                        recibo : {
                            required : "Debe ingresar el numero del recibo",
                            number    : "Solo puede ingresar caracteres numericos"
                        },
                        monto : {
                            required : "Debe Ingresar el Monto de la Transferencia o Deposito",
                            number    : "Solo puede ingresar caracteres numericos"
                        },
                        fecha : {
                            required : "Debe Ingresar la fecha en la que realizo la Transferencia o Deposito",
                            date : "El Formato debe Ser de Fecha"
                        },
                        adjunto : {
                            required : "Debe subir una imagen"
                        },
                        options : {
                            required : "Debe Seleccionar Si o No"
                        },
                        /*if ($('#no').is(':checked')) {*/
                            user_address : {
                                required : "Este Campo es Obligatorio, debe ingresar su nueva dirección"
                            },
                            estados : {
                                required : "Seleccione el estado"
                            },
                            municipios : {
                                required : "Seleccione el municipio"
                            },
                        /*}*/
                    }
                });    
            });
    </script>
</body>
</html>
@endif