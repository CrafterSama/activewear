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
					<strong><span class="email"></span> Correo Electronico:</strong> <a class="btn-link" href="mailto:#">ventasactivewear@gmail.com</a>
					<br /><br />
					<strong><span class="phone"></span> Telefono de Contacto Venezuela: </strong> +58 414 0659155
					<br /><br />
					<strong><span class="phone"></span> Telefono de Contacto Brasil: </strong> +55 219 82199956
					<br /><br />
					<strong><span class="phone"></span> Telefono de Contacto Miami: </strong> +1 305 7932023
					<br /><br />
				</div>
			</div>
			{{ Form::open(array
				(
				'action' => 'HomeController@postContact',
				'method' => 'POST',
				'role' 	=> 'form',
				'class' => 'form'
				)) 
			}}
			{{-- <form id="contact" method="post" class="form" role="form"> --}}
	    		@if(Session::has('status'))
					<div class="alert alert-success">{{ Session::get('status') }}</div>
					<br>
				@endif
				@if(Session::has('error'))
					<div class="alert alert-danger">{{ Session::get('error') }}</div>
					<br>
				@endif
				<div class="row">
					<div class="col-xs-12 col-md-12 form-group input-group">
						{{ Form::text('name','', array('placeholder'=>'Nombre...','class'=>'form-control form-control','id'=>'name','required'=>'')) }}
						<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
					</div>
					<div class="col-xs-12 col-md-12 form-group input-group">
						{{ Form::email('email','', array('placeholder'=>'Email...','class'=>'form-control form-control','id'=>'email','required'=>'')) }}
						<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
					</div>
				    <div class="col-xs-12 col-md-12 form-group input-group">
						{{ Form::textarea('msg', '', array('placeholder'=>'Mensaje...','rows'=>'6','class'=>'form-control form-control','id'=>'msg')) }}
						<span class="input-group-addon"></span>
				    </div>
					{{ Form::input('hidden', 'contacto') }}
					<div class="col-xs-12 col-md-12 form-group pull-right">
						{{ Form::submit('Enviar',array('class'=>'btn btn-primary pull-right, bgviolet')) }}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
	<br /><br />
@stop
