@extends('layouts.home')

@section('title') Carrito de Compras - ActiveWear @stop

@section('content')
<div class="main">
	<div class="container">
		<div class="row">
			<br />
			<div class="panel panel-default">
				<div class="panel-heading"></div>
				<div class="panel-body">
					<section id="no-more-tables">
						@if(count($cart) > 0)

						<table class="table table-rounded table-striped table-condensed cf">
							<thead class="cf">
								<tr>
									<th>No</th>
									<th>Productos</th>
									<th>Cantidades</th>
									<th>Precio Unidad</th>
									<th>Sub-total</th>
									<th>Eliminar</th>
								</tr>
							</thead>

							<tbody>

								<?php $discount=0; ?>
								<?php $no=0; ?>
								@foreach($cart as $item)
								<?php $no++; ?>
								<tr>
									<td data-title="No.">
										{{ $no; }}. 
									</td>
									<td data-title="Producto">
										<a href="#"><img src="/assets/images/stamps/{{ $item->options->image }}" class="cart-img" alt="" width="80"></a>
										<a href="#" class="item-name">{{ $item->name }}</a>
									</td>
									<td data-title="Cantidad"> 
										<a href="/cart/minus/{{ $item->rowid }}" class="cart-change minus carioca_color4 label label-minus"> 
											<i class="fa fa-minus fa-lg"></i> 
										</a> 
										<span class="label label-number label-default cart-qty"> {{ $item->qty }} </span>
										<a href="/cart/plus/{{ $item->rowid }}" class="cart-change plus carioca_color3 label label-plus">
											<i class="fa fa-plus fa-lg"></i> 
										</a> 
									</td>
									<td data-title="Precio Unidad">
										{{ Configuration::getMoneySymbol() }} {{ number_format($item->price, 2, ',', '.') }}
									</td>
									<td data-title="Sub-total">
										{{ Configuration::getMoneySymbol() }} {{ number_format($item->qty*$item->price, 2, ',', '.') }}
									</td>
									<td data-title="Eliminar">
										<a href="/cart/remove/{{ $item->rowid }}" class="cart-remove carioca_color1 label">
											<i class="fa fa-trash-o fa-lg"></i> 
										</a>
									</td>
								</tr>
								<?php $discount += $item->qty; ?> 
								@endforeach

								@if(($discount >= Configuration::getQuantitiesDiscount()) && (Configuration::getDiscount() > 0))
									<tr>
										<td colspan="5" class="cart-bottom visible-lg" style="text-align:right">
											<strong>Sub-Total :</strong>
										</td>
										<td data-title="Sub-Total :">
											{{ Configuration::getMoneySymbol() }} {{ number_format(Cart::total(), 2, ',', '.') }}
										</td>
									</tr>
									<tr>
										<td colspan="5" class="cart-bottom visible-lg" style="text-align:right">
											<strong>{{ Configuration::getWholesaleDiscountReference() }} :</strong>
										</td>
										<td data-title="{{ Configuration::getWholesaleDiscountReference() }} :" style="color:red;">
											{{ Configuration::getMoneySymbol() }} {{ number_format(Cart::total()*Configuration::getDiscount(), 2,',','.') }}
										</td>
									</tr>
									<tr>	
										<td colspan="1" class="cart-bottom visible-lg"></td>
										<td><strong>Descuento a partir de 12 Piezas</strong></td>
										<td colspan="3" class="cart-bottom visible-lg" style="text-align:right"><strong>Total :</strong></td>
										<td data-title="Total :">
											{{ Configuration::getMoneySymbol() }} {{ number_format(Cart::total() - (Cart::total()*Configuration::getDiscount()), 2, ',', '.'); }}
										</td>													
									</tr>
								@else
									<tr>	
										<td colspan="5" class="cart-bottom visible-lg" style="text-align:right"><strong>Total :</strong></td>
										<td data-title="Sub-Total :">
											{{ Configuration::getMoneySymbol() }} {{ number_format(Cart::total(), 2, ',', '.') }}
										</td>													
									</tr>
								@endif


								<tr>
									<td colspan="5" class="text-right bg1">
									</td>
									<td></td>
								</tr>							  
							</tbody>
						</table>
						<form action="/procesar" method="get" accept-charset="utf-8">
							<!-- Start cart action -->
							<div class="row">
								<div class="col-lg-12 bg2 cart-action">
									<div class="alert alert-success" style="font-size: 1.2em;">
										<input type="checkbox" name="tax" id="tax" value="yes" />&nbsp;&nbsp; Marque esta casilla si desea usted la factura fiscal.
									</div>
									<button type="submit" class="btn btn-lg btn-primary pull-right">&nbsp;&nbsp;<i class="fa fa-check"></i>&nbsp;&nbsp;Procesar Compra</button>
								</div>		
							</div>
							<!-- End cart action -->
						</form>
						@else
						<br/>
						<h2 class="text-center">No hay productos en tu carrito de compras</h2>
						<br />
						<div class="text-center">
							<button class="btn btn-success btn-lg" onclick="location.href='/productos/carioca'">Visita Nuestros Productos</button>
						</div>

						@endif
					</section>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
</div>
@stop