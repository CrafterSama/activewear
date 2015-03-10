<!DOCTYPE html>
<?php

$url = Request::path();
//print_r($url);

?>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<title>@yield('title')</title>

		<!-- Bootstrap core CSS -->
		{{ HTML::style('/../assets/css/bootstrap.min.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/font-awesome.min.css', array('media'=>'screen')) }}
		<!-- Custom styles for this template -->
		{{ HTML::style('/../assets/css/bootstrap-reset.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/table-responsive.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/style.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/jquery-ui.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/jMyCarousel.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/fotorama.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/datepicker.css', array('media'=>'screen')) }}
		{{ HTML::style('/../assets/css/tabs.css', array('media'=>'screen')) }}

		<link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css' />
		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	  	<![endif]-->
	</head>
		<body>

			<header class="">
				@if (Auth::check())
					<div class="login-menu dropdown blog-nav-item pull-right">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="username">{{ Auth::user()->full_name; }}</span>
							<b class="caret"></b>
						</a>
						&nbsp;&nbsp;&nbsp;
						<ul class="dropdown-menu extended logout">
						@if (Auth::user()->role_id == 1)
							<li><a href="/admin"><i class="fa fa-dashboard"></i>  Panel de Administracion</a></li>
						@endif
							<li><a href="/orders"><i class="fa fa-shopping-cart"></i>  Mis Pedidos</a></li>
							<li><a href="/logout"><i class="fa fa-sign-out"></i>  Salir</a></li>
						</ul>
					</div>
				@else
					<div class="login-menu pull-right">
						<a class="" href="/registrarse">Registrarte <i class="fa fa-edit"></i></a>
						&nbsp;&nbsp;&nbsp;
						<a class="" href="/login">Identificarse <i class="fa fa-sign-in"></i></a>
						&nbsp;&nbsp;&nbsp;
					</div>
				@endif
				<br />
				<div class="carioca_line">
					@if ($url == '/')
						<div class="carioca_block1"></div>
					@else
						<img class="image-logo-header" src="/../assets/images/logo_carioca.png" alt="logo" width="100%">
					@endif
					<div class="carioca_block2"></div>
					<div class="carioca_block3"></div>
					<div class="carioca_block4"></div>
					<div class="carioca_block1"></div>
					<div class="carioca_block2"></div>
					<div class="carioca_block3"></div>
					<div class="carioca_block4"></div>
					<div class="carioca_block1"></div>
					<div class="carioca_block2"></div>
				</div>
				<div class="bar-menu navbar navbar-default" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="fa fa-bars fa-lg"></span><span class="menu-word">&nbsp;&nbsp;MENU</span>
							</button>
							@if ($url == '/')
							@else
							<span class="social-nav-btns visible-xs pull-right">
								<a class="cart" href="/carrito"><span class="label label-warning cart-text">{{ Cart::count(); }}</span>&nbsp;&nbsp;<span class="fa fa-shopping-cart fa-lg"></span></a>
								<a class="instagram" href="http://www.instagram.com/carioca_activewear"><span class="fa fa-instagram fa-lg"></span></a>
								<a class="facebook" href="https://www.facebook.com/pages/Carioca-Activewear/332150280300248"><span class="fa fa-facebook fa-lg"></span></a>
								<a class="twitter" href="http://www.twitter.com/cariocaactive"><span class="fa fa-twitter fa-lg"></a></span>
							</span>
							@endif
						</div>  
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav">
								<li><a class="" href="/">Inicio</a></li>
								<!-- <li><a class="" href="/productos">Productos</a></li> -->
								<li>
									<a data-toggle="dropdown" class="dropdown-toggle" href="#">
										<span class="">Productos</span>
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="/productos/carioca">Carioca</a></li>
										<li><a href="/productos/pioggia">Pioggia</a></li>
									</ul>
								</li>
								<li><a class="" href="/galerias">Galerias</a></li>
								<li><a class="" href="/acerca-de">Acerca de</a></li>
								<li><a class="" href="/contactos">Contactos</a></li>
							</ul>
							@if ($url == '/')
							@else
							<span class="social-nav-btns big-screen hidden-xs pull-right nav-pills">
								<a class="cart" href="/carrito"><span class="label label-warning cart-text">{{ Cart::count(); }}</span>&nbsp;&nbsp;<span class="fa fa-shopping-cart fa-lg"></span></a>
								<a class="instagram" href="http://www.instagram.com/carioca_activewear"><span class="fa fa-instagram fa-lg"></span></a>
								<a class="facebook" href="https://www.facebook.com/pages/Carioca-Activewear/332150280300248"><span class="fa fa-facebook fa-lg"></span></a>
								<a class="twitter" href="http://www.twitter.com/cariocaactive"><span class="fa fa-twitter fa-lg"></a></span>
							</span>
							@endif
						</div>
					</div>
				</div>
			</header>
			{{-- @if($url == '/')
				<section class="body-bg">
					<div class="main">
						<div class="container">
							@yield('content')
						</div>
					</div>
				</section>
			@else --}}
				<div class="main">
					<div class="container">
						@yield('content')
					</div>
				</div>
			{{-- @endif --}}
			<footer class="footer">
				<div class="container">
					<p>Creado por <a href="http://craftersama.me">CrafterSama Studio</a></p>
					<p><span id="back-to-top">Subir</span></p>
				</div>
			</footer>
		{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		{{ HTML::script('/../assets/js/bootstrap.min.js') }}
		{{ HTML::script('/../assets/js/jquery.validate.js') }}
		{{ HTML::script('/../assets/js/jquery-ui.min.js') }}
		{{ HTML::script('/../assets/js/jMyCarousel.js') }}
		{{ HTML::script('/../assets/js/fotorama.js') }}
		{{ HTML::script('/../assets/js/common.js') }}
		{{-- HTML::script('/../assets/js/tabs.js') --}}
		{{ HTML::script('/../assets/js/Imagecow.js') }}
		<script type="text/javascript">
    		Imagecow.init();
		</script>
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
	    	    $('#order').validate({
	        	    rules :{
	        	    	banco : {
	        	    		required : true,
	        	    	},
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
		                banco : {
		                    required : "Debe ingresar el nombre del banco en el cual realizo el deposito o transferencia",
		                },
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
	        $(document).on('ready', function(){
	            $(".add-to-cart").on("click", function(event){
	                event.preventDefault();
	                var id = $(this).data('id');
	                var qty = $("select[name=qty]").val() || 1;
	                $.post('/cart/' + id + '/add/' + qty, function(data, textStatus, xhr) {
	                    $.post('/total', function(data, textStatus, xhr) {
	                        $(".cart-text").html(data);
	                    });
	                });
	                $('#carrito').removeClass('hide');
	                $(this).removeClass('btn-success');
	                $(this).addClass('btn-info');
	                $(this).html('<i class="fa fa-check fa-lg"></i> Agregado');
	            })
	        });
	        $(function() {
    			$( "#datepicker" ).datepicker({
					direction: 'up',
					constrainInput: true,
					showOn: "both",
					showAnim: "fade",
					buttonImage: "/../assets/images/calendar.png",
					buttonImageOnly: true,
					dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
					monthNamesShort: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
					'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					yearRange: '2014:2025',
					/*dateFormat: 'dd/mm/yy',*/
					changeMonth: true,
					changeYear: true
    			});
			});
		</script>
	</body>
</html>
