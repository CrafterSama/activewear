@extends('layouts.admin')

@section('content')

	<h2>Lista de Pedidos</h2>
	<div class="alert alert-info">
		A continuación encontrara una lista de los pedidos aprobados y entregados o enviados en el sistema. 
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
	    	<span class="visible-lg text-right">Pedidos Aprobados</span>
	    </header>
	    <div class="panel-body">
	        <section id="no-more-tables">
	            <table class="table table-striped table-condensed cf">
	            	<thead class="cf">
						<tr>
							<th class="col-xs-1 text-center">Nº de Orden</th>
							<th class="text-center">Usuario</th>
							<th class="text-center">Producto</th>
							<th class="text-center">Cantidad</th>
							<th class="col-xs-2 text-center">Fecha de la Orden</th>
							<th class="col-xs-3 text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($items as $item)
							<tr class="text-center">
								<td data-title="Nº de Recibo">{{ $item->factura_id }}</td>
								<td data-title="Usuario">
									<a href="/admin/usuarios/{{ $item->factura->user_id }}/perfil" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Ver Datos del Usuario">{{ User::getName($item->factura->user_id) }}</a>
									<br />
									<strong>Direccion: </strong>{{ User::getAddress($item->factura->user_id).', '.Ciudad::getName(User::getCiudad($item->factura->user_id)).', Edo. '.Estado::getName(User::getEstado($item->factura->user_id)) }}
									<br />
									<strong>Telefono: </strong>{{ User::getPhone($item->factura->user_id) }}
								</td>
								<td data-title="Producto"><img class="img-thumbnail" src="/assets/images/stamps/{{ Stamp::getName($item->product->stamp_id) }}" class="cart-img" alt="" width="120"></a><br /> {{ Stamp::getStampName($item->product->stamp_id) }} <br /> ({{ Modelo::getName($item->product->model_id) }})</td>
								<td data-title="Cantidad">{{ $item->cantidad }}</td>
								<td data-title="Fecha de la Orden">{{ Helper::getDate(strtotime($item->created_at,0)) }}</td>
								<td data-title="Acciones" class="text-center">
									Pedido Aprobado
									<br />
									<a href="/order/{{ $item->factura_id }}" class="btn btn-info btn-xs white"  data-toggle="tooltip" data-placement="top" title="Ver el Pedido"><i class="fa fa-eye fa-lg"></i>&nbsp;&nbsp;Ver el Pedido</a>
									<a href="/admin/pedidos/enviado/{{ $item->factura_id }}" class="btn btn-info btn-xs white"  data-toggle="tooltip" data-placement="top" title="Haga click para quitar el pedido de la Lista y pasarlo a Enviados"><i class="fa fa-aprove fa-lg"></i>&nbsp;&nbsp;Pedido Enviado</a>
								</td>
							</tr>
						@endforeach
					</tbody>
	            </table>
	            {{ $items->links() }}
	        </section>
	    </div>
	</section>
@stop