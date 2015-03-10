@extends('layouts.admin')

@section('content')

	<h2>Lista de Modelos</h2>
	<div class="alert alert-info">
		A continuación encontrara una lista de los modelos del producto. 
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
			Modelos
	        <span class="tools pull-right">
	            <a href="/admin/modelos/agregar" class="btn btn-success pull-right white"><i class="fa fa-plus fa-lg"></i>	Agregar Modelo</a>	
	        </span>
	    </header>
	    <div class="panel-body">
	        <section id="no-more-tables">
	            <table class="table table-striped table-condensed cf">
	            	<thead class="cf">
						<tr>
							<th>Nombre del Modelo</th>
							<th class="col-xs-1">Precio</th>
							<th class="col-xs-1 visible-lg">Precio al Mayor</th>
							<th class="col-xs-1 visible-lg">Precio Normal con IVA</th>
							<th class="col-xs-1 visible-lg">Precio al Mayor con IVA</th>
							<th class="col-xs-2 visible-lg">Fecha de Registro</th>
							<th class="col-xs-2">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@if (empty($modelos))
							<h4>Aun no hay Datos</h4>
						@else
							@foreach ($modelos as $modelo)
								<tr>
									<td data-title="Modelo">{{ strtoupper($modelo->model_name) }}</td>
									<td data-title="Precio">Bs. {{ number_format($modelo->price_out_tax_float, 2, ',', '.') }}</td>
									<td data-title="al Mayor" class=" visible-lg">Bs. {{ number_format($modelo->price_out_tax_float - ($modelo->price_out_tax_float*0.30), 2, ',', '.') }}</td>
									<td data-title="con IVA" class=" visible-lg">Bs. {{ number_format($modelo->price_out_tax_float + ($modelo->price_out_tax_float*0.12), 2, ',', '.') }}</td>
									<td data-title="al Mayor con IVA" class=" visible-lg">Bs. {{ number_format($modelo->price_out_tax_float-($modelo->price_out_tax_float*0.30)+($modelo->price_out_tax_float*0.12), 2, ',', '.') }}</td>
									<td data-title="Fecha de Registro" class=" visible-lg">{{ $modelo->created_at }}</td>
									<td data-title="Acciones" class="text-center">
										<a href="/admin/modelos/{{ $modelo->id }}/editar" class="btn btn-warning btn-xs white"  data-toggle="tooltip" data-placement="top" title="Editar Registro"><i class="fa fa-pencil fa-lg"></i></a>
										<a href="{{ url('/admin/modelos/borrar', $modelo->id) }}" class="btn btn-danger btn-xs white"  data-toggle="tooltip" data-placement="top" title="Borrar Registro" onclick="return confirm('¿Esta seguro que desea borrar este Registro?');"><i class="fa fa-trash-o fa-lg"></i></a>
									</td>
								</tr>
			    			@endforeach							
						@endif
					</tbody>
	            </table>
	            {{ $modelos->links() }}
	        </section>
	    </div>
	</section>

@stop