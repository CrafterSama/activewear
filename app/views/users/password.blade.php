@extends ('layouts.admin')

<?php

    if ($user->exists):
        $form_data = array('url' => 'admin/usuarios/'.$user->id.'/password', 'method' => 'POST');
    endif;

?>

@section ('title') Cambio de Contraseña @stop

@section ('content')

	<h1>Cambio de Contraseña</h1>
	<div class="alert alert-info">
		A continuacion encontrara un formulario para Cambiar su Contraseña.
	</div>
	<br>
	<section class="panel">
		<header class="panel-heading">
			<a href="{{ URL::previous() }}" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Volver</a>	
			<span class="pull-right">
				Cambio de Contraseña
			</span>
		</header>
		<div class="panel-body">
			<section id="user_password">
				{{ Form::model($user, $form_data, array('role' => 'form')) }}
					@include ('common/errors', array('errors' => $errors))
					<div class="row">
						<div class="form-group col-md-4">
							{{ Form::label('password', 'Contraseña') }}
							{{ Form::password('password', array('class' => 'form-control')) }}
						</div>
						<div class="form-group col-md-4">
							{{ Form::label('password_confirmation', 'Confirmar contraseña') }}
							{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
						</div>
					</div>
					{{ Form::button('Cambiar Contraseña', array('type' => 'submit', 'class' => 'btn btn-primary pull-right')) }}    
			  
				{{ Form::close() }}
			</section>
		</div>
	</section>
@stop