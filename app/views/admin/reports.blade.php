@extends('layouts.admin')

@section('title', 'Reportes - '.Configuration::getCompanyName()) @stop

@section('content')

	<h1>Modulo de Reportes</h1>
	<div class="alert alert-info">
		Seleccione las Fechas desde y hasta con un lapso no mayor a 30/31 dias e indique el porcentaje de ganancia total entre las fechas indicadas.
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
				Reportes
			</span>
		</header>
		<div class="panel-body">
		</div>
		<div class="panel-footer">
		</div>
	</section>


@stop
