@extends('layouts.admin')

@section('content')

	<h2>Lista de Pedidos</h2>
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
	    	<span class="visible-lg text-right">Pedidos Pendientes</span>
	    </header>
	    <div class="panel-body">
	        <section id="no-more-tables">
	            <table class="table table-striped table-condensed cf">
	            	<thead class="cf">
						<tr>
							<th class="col-xs-1 text-center">Nº de Factura</th>
							<th class="col-xs-1 text-center">Nombre Completo</th>
							<th class="col-xs-2 text-center">Banco</th>
							<th class="col-xs-1 text-center">No. de Recibo</th>
							<th class="text-center">Con Descuento</th>
							<th class="col-xs-2 text-center">Monto</th>
							<th class="text-center">Con IVA</th>
							<th class="col-xs-2 text-center">Imagen Adjunta</th>
							<th class="col-xs-2 text-center">Fecha de la Orden</th>
							<th class="col-xs-3 text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($items as $item)
							<tr class="text-center">
								<td data-title="Nº de Factura">{{ $item->factura_id }}</td>
								<td data-title="Nombre Completo">
								@if(User::getName($item->factura->user_id)=='false')
									El Usuario fue Borrado
								@else
									<a href="/admin/usuarios/{{ $item->factura->user_id }}/perfil" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Ver Datos del Usuario">{{ User::getName($item->factura->user_id) }}</a>
								@endif								
								
								</td>
								<td data-title="Banco">{{ Pago::getBank($item->factura_id) }}</td>
								<td data-title="No. de Recibo">{{ Pago::getBill($item->factura_id) }}</td>
								<td data-title="Con Descuento">
									@if (Item::totalItems($item->factura_id) >= 12)
										Si
									@else
										No
									@endif
								</td>
								<td data-title="Monto">
								@if (($item->factura->with_tax == 'yes') && (Configuration::getIva() > 0))
									@if (Item::totalItems($item->factura_id) >= 12)
										{{ number_format((Item::totalFactura($item->factura_id)-(Item::totalFactura($item->factura_id)*Configuration::getDiscount()))+((Item::totalFactura($item->factura_id)-(Item::totalFactura($item->factura_id)*Configuration::getDiscount()))*Configuration::getIva()), 2, ',', '.') }}
									@else
										{{ number_format(Item::totalFactura($item->factura_id)+(Item::totalFactura($item->factura_id)*Configuration::getIva()), 2, ',', '.') }}
									@endif
								@else
									@if (Item::totalItems($item->factura_id) >= 12)
										{{ number_format(Item::totalFactura($item->factura_id)-(Item::totalFactura($item->factura_id)*Configuration::getDiscount()), 2, ',', '.') }}
									@else
										{{ number_format(Item::totalFactura($item->factura_id), 2, ',', '.') }}
									@endif
								@endif
								</td>
								<td>
									@if ($item->factura->with_tax == 'yes')
										Si
									@else
										No
									@endif
								</td>
								<td data-title="Adjunto">
									@if (Pago::getAdj($item->factura_id) == 'Sin Pagar')
										Mercancia Sin Pagar
									@else
										<a href="/{{ Pago::getAdj($item->factura_id) }}"><img src="/{{ Pago::getAdj($item->factura_id) }}" alt="" class="img-thumbnail" width="120px" /></a>
									@endif
								</td>
								<td data-title="Fecha de la Orden">{{ Helper::getDate(strtotime($item->created_at,0)) }}</td>
								{{-- <td data-title="Pago">{{ Pago::getAmount($item->factura_id) }}</td> --}}
								<td data-title="Acciones" class="text-center">
									<a href="/admin/pedidos/aprobar/{{ $item->factura->id }}" class="btn btn-success btn-xs white"  data-toggle="tooltip" data-placement="top" title="Aprobar y Entregar"><i class="fa fa-check fa-lg" onclick="return confirm('¿Esta seguro que ya realizo la entrega o envio para aprobar este Pedido?');"></i></a>
									<a href="/admin/pedidos/cancelar/{{ $item->id }}" class="btn btn-danger btn-xs white"  data-toggle="tooltip" data-placement="top" title="Cancelar Pedido" onclick="return confirm('¿Esta seguro que desea cancelar este pedido?');"><i class="fa fa-trash-o fa-lg"></i></a>
									<a href="/order/{{ $item->factura_id }}" class="btn btn-info btn-xs white"  data-toggle="tooltip" data-placement="top" title="Ver el Pedido"><i class="fa fa-eye fa-lg"></i></a>
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