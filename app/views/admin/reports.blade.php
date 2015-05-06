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
							<select name="type" id="type">
								<option value="1">Total</option>
								<option value="2">Al Detal</option>
								<option value="3">Al Mayor</option>
							</select>
							<div class="form-group">
								{{ $errors->first('date-star', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('date-star','Desde') }}
								<input name="date-star" value="{{ Input::old('date-star') }}" type="date" id="datepicker" class="form-control datepicker" required />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								{{ $errors->first('date-end', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('date-end','Hasta') }}
								<input name="date-end" value="{{ Input::old('date-end') }}" type="date" id="datepicker" class="form-control datepicker" required />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								{{ $errors->first('porcentual', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('porcentual','Porcentaje', array('class' => 'awesome')) }}
								<input name="porcentual" value="{{ Input::old('porcentual') }}" type="number" min="0" max="100" id="datepicker" class="form-control datepicker" required />
							</div>
							<br />
							<input type="submit" value="Generar" class="btn btn-primary pull-right" />
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</section>


@stop
