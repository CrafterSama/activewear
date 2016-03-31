@extends('layouts.admin')

@section('title', 'Busqueda de Productos') @stop

@section('content')

	<h1>Modulo de Busqueda</h1>
	<div class="alert alert-info">
		Seleccione los modelos para una busqueda mas exacta.
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
			<span class="text-center">
				{{ Form::open(array('url' => '/admin/productos/buscar','class' => 'form row', 'id' => 'singin')) }}
					<div class="col-sm-12 col-md-3">
						<select name="model" class="selectpicker" data-width="100%" id="model">
								<option value="">Selecciona el Modelo</option>
							@foreach($models as $model)
								<option value="{{ $model->id }}">{{ $model->model_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-12 col-md-3">
						<select name="branch" class="selectpicker" data-width="100%" id="brand">
							<option value="">Selecciona la Marca</option>
							<option value="2">Pioggia</option>
							<option value="1">Carioca</option>
						</select>
					</div>
					<div class="col-sm-12 col-md-3">
						<input name="search" value="{{ Input::old('search') }}" placeholder="Buscar" type="text" id="search" class="form-control" />
					</div>
					<div class="col-sm-12 col-md-3">
						<input type="submit" class="btn btn-success btn-block" value="Buscar" />
					</div>
				{{ Form::close() }}
			</span>
		</header>
		<div class="panel-body bg2">
				        <section id="no-more-tables">
	            <table class="table table-rounded table-striped table-condensed cf">
	            	<thead class="cf">
						<tr class="text-center">
							<th class="col-xs-2 text-center">Estampado</th>
							<th class="text-center">Modelo</th>							
							<th class="text-center">Marca</th>							
							<th class="col-xs-1 text-center">Cantidad</th>
							<th class="col-xs-1 text-center visible-lg">Valor Unitario</th>
							<th class="col-xs-1 text-center visible-lg">Total Bs.</th>
							<th class="col-xs-2 text-center visible-lg">Fecha de Registro</th>
							<th class="col-xs-2 text-center">Acciones</th>
						</tr>
					</thead>
					<tbody class="text-center">
						@if (empty($products))
							<h4>Aun no hay Datos</h4>
						@else
							@foreach ($products as $product)
								<?php

									$image = '/assets/images/stamps/'.Stamp::getName($product->stamp_id);
									
									if($product->brand == '0') {
										$brand = 'Pioggia';
									} else {
										$brand = 'Carioca';
									}
								?>
								<tr>
									<td class="col-xs-2" data-title="Estampado">
										<a href="/assets/images/stamps/{{ Stamp::getName($product->stamp_id) }}" class="img-thumbnail">
											<img src="{{ Image::path($image, 'resizeCrop', 150, 145)->responsive('max-width=150', 'resize', 100) }}" alt="Estampado" />
										</a>
										<br /> 
									</td>
									<td data-title="Modelo">
										{{ Stamp::getStampCode($product->stamp_id).'<br />'.Modelo::getName($product->model_id).'<br />'.Stamp::getStampName($product->stamp_id).'<br />'.Stamp::getStampDesc($product->stamp_id) }}
									</td>
									<td data-title="Marca">
										{{ $brand }}
									</td>
									<td data-title="Cantidad">
										{{ $product->amounts }}
									</td>
									<td class="visible-lg" data-title="Valor Unitario">
										Bs. {{  number_format(Modelo::getPrice($product->model_id), 2, ',', '.') }}
									</td>
									<td class="visible-lg" data-title="Total Bs.">
										Bs. {{  number_format($product->amounts*Modelo::getPrice($product->model_id), 2, ',', '.') }}
									</td>
									<td class="visible-lg" data-title="Fecha de Registro">
										{{ $product->created_at }}
									</td>
									<td data-title="Acciones" class="text-center">
										<a href="/admin/productos/{{ $product->id }}/editar" class="btn btn-warning btn-xs white"  data-toggle="tooltip" data-placement="top" title="Editar Registro"><i class="fa fa-pencil fa-2x"></i></a>
										<a href="{{ url('/admin/productos/borrar',$product->id) }}" class="btn btn-danger btn-xs white"  data-toggle="tooltip" data-placement="top" title="Borrar Registro" onclick="return confirm('¿Esta seguro que desea borrar este Registro?');"><i class="fa fa-trash-o fa-2x"></i></a>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
	            </table>
	        </section>
		</div>
		<div class="panel-footer">
		</div>
	</section>
	<script type="text/javascript">
	    $(function(){
	    $.getJSON("/api/stadistics/data", function (result) {

	    var labels = [],data=[];
	    for (var i = 0; i < result.length; i++) {
	        labels.push(result[i].month);
	        data.push(result[i].projects);
	    }



	    var buyerData = {
	      labels : labels,
	      datasets : [
	        {
	          fillColor : "rgba(240, 127, 110, 0.3)",
	          strokeColor : "#f56954",
	          pointColor : "#A62121",
	          pointStrokeColor : "#741F1F",
	          data : data
	        }
	      ]
	    };
	    var buyers = document.getElementById('projects-graph').getContext('2d');
	    new Chart(buyers).Line(buyerData, {
	      bezierCurve : true
	    });

	  });

	});
	</script>
    


@stop
