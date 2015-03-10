@extends('layouts.admin')

@section('title') Lista de Productos - Carioca ActiveWear @stop

@section('content')

	<h2>Lista de Productos</h2>
	<div class="alert alert-info">
		A continuación encontrara una Lista de los Productos Ingresados al Sistema. 
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
			Productos
	        <span class="tools pull-right">
	            <a href="/admin/productos/agregar" class="btn btn-success pull-right white"><i class="fa fa-plus fa-lg"></i>	Agregar Producto</a>	
	        </span>
	    </header>
	    <div class="panel-body">
	        <section id="no-more-tables">
	            <table class="table table-rounded table-striped table-condensed cf">
	            	<thead class="cf">
						<tr class="text-center">
							<th class="col-xs-2 text-center">Estampado</th>
							<th class="text-center">Nombre</th>							
							<th class="col-xs-2 text-center">Fecha de Registro</th>
							<th class="col-xs-2 text-center">Acciones</th>
						</tr>
					</thead>
					<tbody class="text-center">
						@if (empty($stamps))
							<h4>Aun no hay Datos</h4>
						@else
							@foreach ($stamps as $stamp)
								<tr>
									<td class="col-xs-2" data-title="Estampado">
										<a href="/assets/images/stamps/{{ Stamp::getName($stamp->id) }}" class="img-thumbnail"><img src="/assets/images/stamps/{{ Stamp::getName($stamp->id) }}" alt="Estampado" width="150px" /></a>
									</td>
									<td data-title="Nombre">{{ Stamp::getStampName($stamp->id) }}</td>
									<td class="visible-lg" data-title="Fecha de Registro">{{ $stamp->created_at }}</td>
									<td data-title="Acciones" class="text-center">
										<a href="/admin/estampados/{{ $stamp->id }}/editar" class="btn btn-warning btn-xs white"  data-toggle="tooltip" data-placement="top" title="Editar Registro"><i class="fa fa-pencil fa-lg"></i></a>
										<!-- <a href="{{ url('/admin/productos/borrar',$stamp->id) }}" class="btn btn-danger btn-xs white"  data-toggle="tooltip" data-placement="top" title="Borrar Registro" onclick="return confirm('¿Esta seguro que desea borrar este Registro?');"><i class="fa fa-trash-o fa-lg"></i></a> -->
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
	            </table>
	            {{ $stamps->links() }}
	        </section>
	    </div>
	</section>

@stop