@extends('layouts.admin')

@section('title', 'Reportes - '.Configuration::getCompanyName()) @stop

@section('content')

	<h1>Opciones de Configuracion</h1>
	<div class="alert alert-info">
		Formulario para hacer cambios en las opciones de configuracion, tales como cambiar IVA o porcentaje de descuento. 
	</div>
	<br>
	@if(Session::has('notice'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('notice') }}
	</div>
	<br>
	@endif
	<section class="panel">
		<header class="panel-heading">
			<a href="{{ URL::previous() }}" class="btn btn-info"><i class="fa fa-chevron-left"></i> Volver</a>	
			<span class="pull-right">
				Cambiar Opciones
			</span>
		</header>
		<div class="panel-body">

		</div>
		<div class="panel-footer">
		
		</div>
	</section>


@stop
