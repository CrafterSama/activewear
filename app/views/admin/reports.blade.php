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
			<div class="row">
				<div class="col-lg-12 bg2">
					<h3>Reporte de Ventas:</h3>
					<form action="/pay" id="order" autocomplete="off" method="post" enctype="multipart/form-data">
						<div class="col-lg-4">
							<div class="form-group">
								{{ $errors->first('fecha-star', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('fecha-star','Desde') }}
								<input name="fecha-star" value="{{ Input::old('fecha-star') }}" type="date" id="datepicker" class="form-control datepicker" required />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								{{ $errors->first('fecha-end', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('fecha-end','Hasta') }}
								<input name="fecha-end" value="{{ Input::old('fecha-end') }}" type="date" id="datepicker" class="form-control datepicker" required />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								{{ Form::label('porcentual','Porcentaje', array('class' => 'awesome')) }}
								{{ $errors->first('porcentual', '<div class="alert alert-danger">:message</div>') }}
								<input name="porcentual" value="{{ Input::old('porcentual') }}" type="number" id="datepicker" class="form-control datepicker" required />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</section>


@stop
