@extends('layouts.home')

@section('title') Ordenes por Usuario - ActiveWear @stop

@section('content')
<div class="main">
    <div class="container">
        <div class="row">
			<br />
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
			        <section id="no-more-tables">
		            	<table class="table table-rounded table-striped table-condensed cf">
		            		<thead class="cf">
								<tr>
									<th class="col-md-3">ID</th>
									<th class="col-md-3 text-center">Productos</th>
									<th class="col-md-3 text-center">Fecha</th>
									<th class="col-md-3 text-center">Ver</th>
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
										{{ Helper::getDate(strtotime($order->created_at,0)) }}
									</td>
									<td data-title="Ver" class="col-md-3 text-center">
										<a href="/order/{{ $order->id }}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ver</a>
                        			</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</section>
                </div>
            </div>
	    </div>
    </div>
</div>
@stop