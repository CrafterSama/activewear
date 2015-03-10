@extends('layouts.admin')

@section('content')

<div class="row">
	<div class="col-md-4">	
		<section class="panel">
			<header class="panel-heading">
				Cantidades 
				<span class="tools pull-right">
					<a href="/admin/productos/agregar" class="btn btn-success pull-right white"><i class="fa fa-plus fa-lg"></i>&nbsp;&nbsp;Agregar Producto</a>	
				</span>
			</header>
			<div class="panel-body">
				<section id="no-more-tables">
				  	<table class="table table-striped table-condensed cf">
						<thead class="cf">
							<tr>
								<th class="text-center">Nombre del modelo</th>
								<th class="text-center">Cantidades</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach ($modelos as $modelo)
								<tr>
									<td data-title="Nombre">{{ strtoupper(Modelo::getName($modelo->id)) }}</td>	
									<td data-title="Cantidades">{{ Product::getAmounts($modelo->id) }}</td>
								</tr>
				    		@endforeach
				    			<tr>
			    					<td class="visible-lg"><strong>Total</strong></td>
			    					<td data-title="Total">{{ Product::totalPzs() }}</td>
				    			</tr>
						</tbody>
					</table>
				</section>
			</div>
		</section>
	</div>
	<div class="col-md-4">	
		<section class="panel">
			<header class="panel-heading">
				Total General
				<span class="tools pull-right">
						
				</span>
			</header>
			<div class="panel-body">
				<section id="no-more-tables">
				  	<table class="table table-striped table-condensed cf">
						<thead class="cf">
							<tr>
								<th class="text-center">Nombre del modelo</th>	
								<th class="text-center">Totales en Bs.</th>	
							</tr>
						</thead>
						<tbody class="text-center">
							<?php $totalQty = 0; ?>
							@foreach ($modelos as $modelo)
								<tr>
									<td data-title="Nombre">{{ strtoupper(Modelo::getName($modelo->id)) }}</td>
									<td data-title="Totales en Bs.">Bs. {{ number_format(Product::getAmounts($modelo->id)*$modelo->price_out_tax_float, 2, ',', '.') }}</td>
								</tr>
								<?php
									$totalQty += Product::getAmounts($modelo->id)*$modelo->price_out_tax_float;
								?>
				    		@endforeach
				    			<tr>
				    				<td class="visible-lg"><strong>Total</strong></td>
				    				<td datta-title="Total">Bs. {{ number_format($totalQty, 2, ',', '.') }}</td>
				    			</tr>
						</tbody>
					</table>
				</section>
			</div>
		</section>
	</div>
	<div class="col-md-4">	
		<section class="panel">
			<header class="panel-heading">
				Total General con Descuento
				<span class="tools pull-right">
						
				</span>
			</header>
			<div class="panel-body">
				<section id="no-more-tables">
				  	<table class="table table-striped table-condensed cf">
						<thead class="cf">
							<tr>
								<th class="text-center">Nombre del modelo</th>	
								<th class="text-center">Totales en Bs.</th>	
							</tr>
						</thead>
						<tbody class="text-center">
							<?php $totalQty = 0; ?>
							@foreach ($modelos as $modelo)
								<tr>
									<td data-title="Nombre">{{ strtoupper(Modelo::getName($modelo->id)) }}</td>
									<td data-title="Totales en Bs.">Bs. {{ number_format((Product::getAmounts($modelo->id)*$modelo->price_out_tax_float)-(Product::getAmounts($modelo->id)*$modelo->price_out_tax_float*0.30), 2, ',', '.') }}</td>
								</tr>
								<?php
									$totalQty += (Product::getAmounts($modelo->id)*$modelo->price_out_tax_float)-(Product::getAmounts($modelo->id)*$modelo->price_out_tax_float*0.30);
								?>
				    		@endforeach
				    			<tr>
				    				<td class="visible-lg"><strong>Total</strong></td>
				    				<td datta-title="Total">Bs. {{ number_format($totalQty, 2, ',', '.') }}</td>
				    			</tr>
						</tbody>
					</table>
				</section>
			</div>
		</section>
	</div>
	<div class="col-md-4">	
		<section class="panel">
			<header class="panel-heading">
				Modelos
				<span class="tools pull-right">
					<a href="/admin/modelos/agregar" class="btn btn-success pull-right white"><i class="fa fa-plus fa-lg"></i>&nbsp;&nbsp;Agregar Modelo</a>	
				</span>
			</header>
			<div class="panel-body">
				<section id="no-more-tables">
				  	<table class="table table-striped table-condensed cf">
						<thead class="cf">
							<tr>
								<th class="text-center">Modelos En el Sistema</th>	
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach ($modelos as $modelo)
								<tr>
									<td data-title="Modelo">{{ strtoupper(Modelo::getName($modelo->id)) }}</td>
								</tr>
				    		@endforeach
						</tbody>
					</table>
				</section>
			</div>
		</section>
	</div>

</div>

@stop