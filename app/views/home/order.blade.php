@extends('layouts.home')

@section('title') Ordenes - ActiveWear @stop

@section('content')
<div class="main">
	<div class="container">
		<div class="row">
			@if(Session::has('notice'))
				<br />
				<div class="alert alert-success" style="font-size: 19px;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ Session::get('notice') }}
				</div>
			@endif
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">
                    <button class="btn btn-info btn-md" onclick="history.go(-1)">
                        <i class="fa fa-chevron-left"></i> Volver
                    </button>
				</div>
				<div class="panel-body">
					<section id="no-more-tables">
						@if(count($order) > 0)

						<table class="table table-rounded table-striped table-condensed cf">
							<thead class="cf">
								<tr>
									<th>No</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Precio Unidad</th>
									<th>Sub-Total</th>
								</tr>
							</thead>

							<tbody>
								<?php
									$no=0; 
									$discount = 0;
								?>
								@foreach($order->items as $item)
								<?php $no++;  ?>
								<tr>
									<td data-title="No.">{{ $no; }}. </td>
									<td data-title="Producto">
										<a href="/assets/images/stamps/{{ Stamp::getName($item->product->stamp_id) }}">
											<img src="/assets/images/stamps/{{ Stamp::getName($item->product->stamp_id) }}" class="cart-img img-thumbnail" alt="" width="120">
										</a>
										<br />
										{{ Stamp::getStampName($item->product->stamp_id) }}
										<br />
										({{ ucwords(strtolower(Modelo::getName($item->product->model_id))) }})
										</td>
										<td data-title="Cantidad"> 										
											<span class="badge cart-qty"> {{ $item->cantidad }} </span>
										</td>
										<td data-title="Precio Unidad">{{ Configuration::getMoneySymbol() }} {{ number_format($item->precio, 2, ',', '.') }}</td>
										<td data-title="Sub-Total">{{ Configuration::getMoneySymbol() }} {{ number_format($item->cantidad*$item->precio, 2, ',', '.') }}</td>
									</tr>
									<?php $discount += $item->cantidad; ?>
									@endforeach
									@if (($item->factura->with_tax == 'yes') && (Configuration::getIva() > 0) )
										@if (($discount >= Configuration::getQuantitiesDiscount()) && (Configuration::getDiscount() > 0) )
											<tr>
												<td colspan="2" class="cart-bottom visible-lg" style="text-align:right"><strong>Total Cantidad:</strong></td>
												<td data-title="Cantidad"><strong>{{ $discount }}</strong></td>
												<td colspan="1" class="cart-bottom visible-lg" style="text-align:right"><strong>Sub-Total:</strong></td>
												<td data-title="Total :">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total(), 2, ',', '.') }}</td>
											</tr>
											<tr>
												<td colspan="4" class="cart-bottom visible-lg" style="text-align:right">
													<strong>{{ Configuration::getWholesaleDiscountReference() }} :</strong>
												</td>
												<td data-title="{{ Configuration::getWholesaleDiscountReference() }} :" style="color:red;">
													{{ Configuration::getMoneySymbol() }} {{ number_format($order->total()*Configuration::getDiscount(), 2,',','.') }}
												</td>
											</tr>
											<tr>
												<td colspan="1"></td>
												<td><strong>Descuento a partir de 12 Piezas</strong></td>
												<td colspan="2" class="cart-bottom visible-lg" style="text-align:right"><strong>Sub-Total - {{ Configuration::getWholesaleDiscountReference() }} :</strong></td>
												<td data-title="Sub-Total - {{ Configuration::getWholesaleDiscountReference() }} :">
													{{ Configuration::getMoneySymbol() }} {{ number_format($order->total()-($order->total()*Configuration::getDiscount()), 2, ',', '.') }}
												</td>						
											</tr>
											<tr>
												<td colspan="4" class="cart-bottom visible-lg" style="text-align:right"><strong>{{ Configuration::getTaxReference() }} :</strong></td>
												<td data-title="{{ Configuration::getTaxReference() }} :">
													{{ Configuration::getMoneySymbol() }} {{ number_format(($order->total()-($order->total()*Configuration::getDiscount()))*Configuration::getIva(), 2,',','.') }}
												</td>
											</tr>
											<tr>
												<td colspan="4" class="cart-bottom visible-lg" style="text-align:right"><strong>Total :</strong></td>
												<td data-title="Total :">
													{{ Configuration::getMoneySymbol() }} {{ number_format(($order->total()-($order->total()*Configuration::getDiscount()))+(($order->total()-($order->total()*Configuration::getDiscount()))*Configuration::getIva()), 2,',','.') }}
												</td>
											</tr>

										@else

											<tr>
												<td colspan="2" class="cart-bottom visible-lg" style="text-align:right"><strong>Total Cantidad :</strong></td>
												<td data-title="Cantidad:"><strong>{{ $discount }}</strong></td>
												<td colspan="1" class="cart-bottom visible-lg" style="text-align:right"><strong>Sub-Total :</strong></td>
												<td data-title="Sub-total :">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total(), 2, ',', '.') }}</td>
											</tr>
											<tr>
												<td colspan="4" class="cart-bottom visible-lg" style="text-align:right"><strong>{{ Configuration::getTaxReference() }} :</strong></td>
												<td data-title="{{ Configuration::getTaxReference() }} :" style="color:red;">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total()*Configuration::getIva(), 2,',','.') }}</td>
											</tr>
											<tr>
												<td colspan="4" class="cart-bottom visible-lg" style="text-align:right"><strong>Total :</strong></td>
												<td data-title="Total :">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total()+($order->total()*Configuration::getIva()), 2, ',', '.') }}</td>
											</tr>
										@endif	
									@else
										@if (($discount >= Configuration::getQuantitiesDiscount()) && (Configuration::getDiscount() > 0) )
											<tr>
												<td colspan="2" class="cart-bottom visible-lg" style="text-align:right"><strong>Total Cantidad :</strong></td>
												<td data-title="Cantidad"><strong>{{ $discount }}</strong></td>
												<td colspan="1" class="cart-bottom visible-lg" style="text-align:right"><strong>Sub-Total:</strong></td>
												<td data-title="Total :">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total(), 2, ',', '.') }}</td>
											</tr>
											<tr>
												<td colspan="4" class="cart-bottom visible-lg" style="text-align:right"><strong>{{ Configuration::getWholesaleDiscountReference() }} :</strong></td>
												<td data-title="{{ Configuration::getWholesaleDiscountReference() }} :" style="color:red;">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total()*Configuration::getDiscount(), 2,',','.') }}</td>
											</tr>
											<tr>
												<td colspan="1"></td>
												<td><strong>Descuento a partir de 12 Piezas</strong></td>
												<td colspan="2" class="cart-bottom visible-lg" style="text-align:right"><strong>Total :</strong></td>
												<td data-title="Total :">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total()-($order->total()*Configuration::getDiscount()), 2, ',', '.') }}</td>						
											</tr>
										@else
											<tr>
												<td colspan="2" class="cart-bottom visible-lg" style="text-align:right"><strong>Total Cantidad :</strong></td>
												<td data-title="Cantidad"><strong>{{ $discount }}</strong></td>
												<td colspan="1" class="cart-bottom visible-lg" style="text-align:right"><strong>Total:</strong></td>
												<td data-title="Total :">{{ Configuration::getMoneySymbol() }} {{ number_format($order->total(), 2, ',', '.') }}</td>						
											</tr>
										@endif	
										
									@endif
									<tr>
										<td colspan="4" class="text-right bg1">
										</td>
										<td></td>
									</tr>							  
								</tbody>
							</table>
							<?php $user = Auth::user(); ?>
								{{-- true expr --}}
							<!-- Start cart action -->
							<div class="row">
								<div class="col-lg-12 bg2">

									@if(!$order->pago)
										@if ($user->id == $order->user_id)
										<h3>Confirmar pago:</h3>
										<form action="/pay" id="order" autocomplete="off" method="post" enctype="multipart/form-data">
											<div class="col-lg-6">
												<div class="form-group">
													{{ Form::label('banco','Nombre del Banco Desde donde Realizo el Deposito o Transferencia') }} 
													{{ $errors->first('banco', '<div class="alert alert-danger">:message</div>') }}
													<input name="banco" type="text" value="{{ Input::old('banco') }}" placeholder="Nombre del Banco" class="form-control" rquired />
												</div>
												<div class="form-group">
													{{ Form::label('recibo','No. de transferencia o deposito') }} 
													{{ $errors->first('recibo', '<div class="alert alert-danger">:message</div>') }}
													<input name="recibo" type="number" value="{{ Input::old('recibo') }}" placeholder="No. de Recibo" class="form-control" rquired />
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													{{ Form::label('monto','Monto de la transferencia o deposito') }}
													{{ $errors->first('monto', '<div class="alert alert-danger">:message</div>') }}
													<div class="input-group">
														<span class="input-group-addon">{{ Configuration::getMoneySymbol() }}</span>
														<input name="monto" value="{{ Input::old('monto') }}" placeholder="Monto en {{ Configuration::getMoneySymbol() }}" type="number" class="form-control" required />
													</div>
												</div>
												<div class="form-group">
													{{ Form::label('fecha','Seleccione la Fecha de la transaccion') }}
													{{ $errors->first('fecha', '<div class="alert alert-danger">:message</div>') }}
													<input name="fecha" value="{{ Input::old('fecha') }}" type="text" id="datepicker" class="form-control datepicker" required />
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													{{ Form::label('adjunto','Seleccione el Adjunto') }}
													{{ $errors->first('adjunto', '<div class="alert alert-danger">:message</div>') }}
													<input type="file" name="adjunto" placeholder="Imagen" class="form-control" required />
												</div>
											</div>
											<div class="col-lg-12">
											<?php $user = Auth::user(); ?>
											@if (strtolower(Ciudad::getName($user->municipio)) == 'maracaibo')
												<div class="alert alert-success" style="font-size: 19px;">
													<p class="text-justify">
														{{ Configuration::getUserLocalAddress() }}
													</p>
												</div>
											@else
												<p style="font-size: 19px;">
													{{ Configuration::getAddressConfirmMessage() }}
												</p>
												<div class="alert alert-success" style="font-size: 19px;">
													<p class="text-justify">
														<strong>Direccion de Entrega del Pedido:</strong><br />
														{{ User::getAddress(Auth::user()->id).' '.ucwords(strtolower(Ciudad::getName($user->municipio))).', Edo.'.ucwords(strtolower(Estado::getName($user->estado))); }}
													</p>
												</div>
												{{ Form::label('options', 'Seleccione Si o No') }}
												{{ $errors->first('options', '<div class="alert alert-danger">:message</div>') }}
												<br />
												{{ Form::label('options', 'Si') }}
												<input type="radio" name="options" id="si" class="option" value="si" />
												{{ Form::label('options', 'No') }}
												<input type="radio" name="options" id="no" class="option" value="no" />
												<br />
												<div class="collapse">
													{{ Form::label('user_address', 'Nueva Dirección') }}
													<input type="text" name="user_address" value="" class="form-control col-lg-12" placeholder="Agregue su nueva Dirección" />
										            <div class="form-group">
										                <label for="estados">Estado</label>
										                {{ $errors->first('estados', '<div class="alert alert-danger">:message</div>') }}
										                <select name="estados" id="estados" class="form-control">
										                        <option>Seleccione...</option>
										                </select>
										                <br />
										                <label for="municipios">Ciudad</label>
										                {{ $errors->first('municipios', '<div class="alert alert-danger">:message</div>') }}
										                <select name="municipios" id="municipios" class="form-control">
										                        <option>Selecciona el Estado</option>
										                </select>
										            </div>
												</div>
												<br />
											@endif
												{{ Form::hidden('id', $order->id) }}
												<button type="submit" class="btn btn-lg btn-primary btn-block"> <i class="fa fa-check"></i> Confirmar</button>
											</div>
											<br />
											<br />
										</form>
										@else
											{{-- false expr --}}
										@endif
									@else

									<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label('recibo','No. de transferencia o deposito:') }} 
												{{ $order->pago->recibo }}
											</div>
											<div class="form-group">
												{{ Form::label('monto','Monto de la transferencia o deposito:') }}
												&nbsp;&nbsp;{{ Configuration::getMoneySymbol() }}&nbsp;{{ number_format($order->pago->monto, 2, ',', '.') }}
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label('fecha','Fecha de la transaccion: ') }}
												{{ $order->pago->fecha }}
											</div>
											<div class="form-group">
												{{ Form::label('adjunto','Adjunto') }}
												<a href="/{{ $order->pago->adjunto }}" target="_popup">ADJUNTO</a>
											</div>
										</div>

									@endif
								</div>		
							</div>
							<!-- End cart action -->
							@else
							<br/>
							<h2 align="center">No hay productos en esta orden :(</h2>
							@endif
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop