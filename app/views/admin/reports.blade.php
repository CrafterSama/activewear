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
		<div class="panel-body bg2">
			<h3>Reporte de Ventas:</h3>
			<div class="row">
				<form action="/pay" id="order" autocomplete="off" method="post" enctype="multipart/form-data">
					<div class="col-lg-12">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="type">Tipo de Reporte</label>
								<select name="type" id="type" class="selectpicker" data-width="100%">
									<option value="1">Total</option>
									<option value="2">Al Detal</option>
									<option value="3">Al Mayor</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4"></div>
						<div class="col-lg-4"></div>
					</div>
					<br />
					<div class="col-lg-12">
						<div class="col-lg-4">
							<div class="form-group date">
								{{ $errors->first('date-start', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('date-start','Desde') }}
								<input name="date-start" value="{{ Input::old('date-start') }}" type="date" id="date-start" class="form-control" required />
								<span class="input-group-addon">
                    				<span class="fa fa-calendar">
                    				</span>
                				</span>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group date">
								{{ $errors->first('date-end', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('date-end','Hasta') }}
								<input name="date-end" value="{{ Input::old('date-end') }}" type="date" id="date-end" class="form-control" required />
								<span class="input-group-addon">
                    				<span class="fa fa-calendar">
                    				</span>
                				</span>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								{{ $errors->first('porcentual', '<div class="alert alert-danger">:message</div>') }}
								{{ Form::label('porcentual','Porcentaje', array('class' => 'awesome')) }}
								<input name="porcentual" value="{{ Input::old('porcentual') }}" type="number" min="0" max="100" id="" class="form-control" required />
							</div>
							<br />
							<input type="submit" value="Generar" class="btn btn-primary pull-right" />
						</div>
					</div>
				</form>
				{{--  <canvas id="projects-graph" width="1200" height="400"></canvas> --}}
			</div>
		</div>
		<div class="panel-footer">
		</div>
	</section>
    <section class="panel">
        <header class="panel-heading">
            Ventas del Mes
        </header>
        <div class="panel-body">
            <div class="chartJS">
                <canvas id="bar-chart-js" height="250" width="800" ></canvas>
            </div>
        </div>
		<div class="panel-footer">
		</div>
    </section>
@stop
