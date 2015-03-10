@extends('layouts.home')

@section('title') Contactenos - ActiveWear @stop

@yield('title')

	Formulario de Contactos

@stop

@section('content')
	<div class="row clearfix">
        <div class="col-md-4 column">
                <img src="/../assets/images/banner_contactos.jpg" alt="Contactos" class="banner_top">
        </div>
        <div class="col-md-4 column visible-lg visible-md">

        </div>
        <div class="col-md-4 column visible-lg visible-md">
               <div class="quote"><strong>No olvides seguirnos en nuestras redes sociales <br / /> #CariocaActiveWear</strong></div>
        </div>
	</div>
    <div class="contact_form">
		<div class="col-md-4 visible-lg visible-md">
		    <img src="/../assets/images/modelo_activewear.jpg" alt="acerca de" class="banner_top">
		</div>
		<br /><br />
		<div class="col-md-8 col-xs-12 contact-form">
			<div class="row">
				<div class="col-md-12">
					<strong><span class="email"></span> Correo Electronico:</strong> <a class="btn-link" href="mailto:#">ventas@cariocaactivewear.com</a>
					<br /><br />
					<strong><span class="phone"></span> Telefono de Contacto Venezuela: </strong> +58 414 0659155
					<br /><br />
					<strong><span class="phone"></span> Telefono de Contacto Brasil: </strong> +55 219 82199956
					<br /><br />
					<strong><span class="phone"></span> Telefono de Contacto Miami: </strong> +1 305 7932023
					<br /><br />
				</div>
			</div>
			<form id="contact" method="post" class="form" role="form">
				<div class="row">
					<div class="col-xs-12 col-md-12 form-group input-group">
						{{ Form::text('name','', array('placeholder'=>'Nombre...','class'=>'form-control bggray','id'=>'name','required'=>'')) }}
						<span class="input-group-addon bggray"><i class="fa fa-user fa-fw"></i></span>
					</div>
					<div class="col-xs-12 col-md-12 form-group input-group">
						{{ Form::email('email','', array('placeholder'=>'Email...','class'=>'form-control bggray','id'=>'email','required'=>'')) }}
						<span class="input-group-addon bggray"><i class="fa fa-envelope-o fa-fw"></i></span>
					</div>
				    <div class="col-xs-12 col-md-12 form-group input-group">
						{{ Form::textarea('message', '', array('placeholder'=>'Mensaje...','rows'=>'6','class'=>'form-control bggray','id'=>'message')) }}
						<span class="input-group-addon bggray"></span>
				    </div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-12 form-group pull-right">
						{{ Form::submit('Enviar',array('class'=>'btn btn-primary pull-right, bgviolet')) }}
					</div>
				</div>
			</form>
		</div>
	</div>
	<br /><br />
@stop
