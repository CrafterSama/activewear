@extends('layouts.admin')

@section('content')

	<h2>Lista de Pedidos de {{ User::getName($id) }}</h2>
	<div class="alert alert-info">
		A continuación encontrara una lista de los pedidos pendientes por aprobar y entregar o enviar en el sistema. 
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
	        <span class="tools pull-left">
	        	<a href="{{ URL::previous() }}" class="btn btn-info"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp; Volver</a>
	            {{-- <a href="/admin/pedidos/agregar" class="btn btn-success pull-right white"><i class="fa fa-plus fa-lg"></i>  Agregar Orden</a>
	            &nbsp;&nbsp;
	            <a href="/admin/usuarios" class="btn btn-success pull-right white"><i class="fa fa-users fa-lg"></i>  Usuarios</a> --}}
	        </span>
	    	<span class="visible-lg text-right">Lista de Pedidos</span>
	    </header>
	    <div class="panel-body">
	        <section id="no-more-tables">
		            	<table class="table table-rounded table-striped table-condensed cf">
		            		<thead class="cf">
								<tr>
									<th class="col-md-3">ID</th>
									<th class="col-md-3 text-center">Productos</th>
									<th class="col-md-3 text-center">Estatus</th>
									<th class="col-md-3 text-center">Fecha</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($orders as $order)
								<tr>
									<td data-title="ID" class="col-md-3">
										{{ $order->id }}
									</td>
									<td data-title="Productos" class="col-md-3 text-center">
										{{ Item::countItems($order->id) }}
									</td>
									<td data-title="Fecha" class="col-md-3 text-center">
										@if ($order->pago)
											Orden Paga
										@else
											Orden Cancelada o Sin Pagar
										@endif
									</td>
									<td data-title="Fecha" class="col-md-3 text-center">
										{{ Helper::getDate(strtotime($order->created_at,0)) }}
									</td>
									<td data-title="Acciones" class="text-center">
										@if (Item::countItems($order->id) != 0)
											<a href="/order/{{ $order->id }}" class="btn btn-primary btn-xs"><i class="fa fa-eye fa-lg"></i>Ver</a>
										@endif
										@if (Auth::user()->role_id == 1)
    										<a href="/order/{{ $order->id }}/borrar" class="btn btn-danger btn-xs" onclick="return confirm('¿Esta seguro que desea borrar este Registro?');"><i class="fa fa-trash-o fa-lg"></i>Borrar</a>
    									@endif
                        			</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{{ $orders->links() }}
	        </section>
	    </div>
	</section>
@stop