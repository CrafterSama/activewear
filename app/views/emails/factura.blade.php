<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Pedido</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body style="font-family: sans-serif; font-size: 18px; font-style: italic; background: #fff url('http://carioca.craftersama.me/assets/images/bg.png') repeat top center fixed; margin: 0; color: #333;"> 
	<div style="width: 100%; margin-right: 50px; text-align: right; border-bottom: 3px solid #8D2C33; ">
		<img style="max-width: 450px;" src="http://carioca.craftersama.me/assets/images/logo_carioca.png" alt="" />
		<h1 style="margin-right: 25px;">Orden de Compra</h1>
	</div>
	<div style="padding: 0 1em; background-color: #fff;">
		<h1>Recibo No. {{ $factura['id'] }} </h1>
		<hr>
		<h4 style="background-color: #8c2d83; color:#fff; padding: 10px; width: 450px;">Datos de facturación: </h4>
		<p><strong>Nombre:</strong> {{ $user['full_name'] }} </p>
		<p><strong>Correo:</strong> {{ $user['email'] }} </p>
		<hr/>
		<table border="0" width="100%" style="border: 1px solid #ccc ; text-align: center;">
			<tr>
				<th style="background-color: #8c2d83; padding: 0.2em; border-bottom: 1px solid #8c2d83; color:#fff">Producto</th>
				<th style="background-color: #8c2d83; padding: 0.2em; border-bottom: 1px solid #8c2d83; color:#fff">Cantidad</th>
				<th style="background-color: #8c2d83; padding: 0.2em; border-bottom: 1px solid #8c2d83; color:#fff">Precio</th>
				<th style="background-color: #8c2d83; padding: 0.2em; border-bottom: 1px solid #8c2d83; color:#fff">Subtotal</th>
			</tr>
			<?php 
				$total = 0; 
				$discount = 0;
			?>
			@foreach ($cart as $item)
			<tr>
				<td style="background-color: #ccc; height: 220px;">{{ $item['name'] }}</td>
				<td style="background-color: #ccc; height: 220px;">{{ $item['qty'] }}</td>
				<td style="background-color: #ccc; height: 220px;">{{ number_format($item['price'], 2, ',', '.') }} Bs.</td>
				<td style="background-color: #ccc; height: 220px;">{{ number_format($item['subtotal'], 2, ',', '.') }} Bs.</td>
			</tr>
			<?php 
				$total += $item['qty'] * $item['price']; 
				$discount += $item['qty'];
			?>
			@endforeach
		</table>
		<div style="font-weight: bold;">
			@if (($factura['with_tax'] == 'yes') && (Configuration::getIva() > 0))
				@if(($discount >= 12) && (Configuration::getDiscount() > 0))
					<h4 align="right">Sub-Total: {{ Configuration::getMoneySymbol() }} {{ number_format($total, 2, ',', '.') }} </h4>
					<h4 align="right">{{ Configuration::getWholesaleDiscountReference() }}: {{ Configuration::getMoneySymbol() }} {{ number_format($total*Configuration::getDiscount(), 2, ',', '.') }} </h4>
					Descuento a partir de 12 piezas <h4 align="right">Sub-Total : {{ Configuration::getMoneySymbol() }} {{ number_format($total-($total*Configuration::getDiscount()), 2, ',', '.') }}</h4>
					<h4 align="right">{{ Configuration::getTaxReference() }}: {{ Configuration::getMoneySymbol() }} {{ number_format(($total-($total*Configuration::getDiscount()))*Configuration::getIva(), 2, ',', '.') }} </h4>
					<h4 align="right">Total {{ Configuration::getMoneySymbol() }} {{ number_format(($total-($total*Configuration::getDiscount()))+(($total-($total*Configuration::getDiscount()))*Configuration::getIva()), 2, ',', '.') }} </h4>
				@else
					<h4 align="right">Sub-Total: {{ Configuration::getMoneySymbol() }} {{ number_format($total, 2, ',', '.') }} </h4>
					<h4 align="right">{{ Configuration::getTaxReference() }}: {{ Configuration::getMoneySymbol() }} {{ number_format($total*Configuration::getIva(), 2, ',', '.') }} </h4>
					<h4 align="right">Total: {{ Configuration::getMoneySymbol() }} {{ number_format($total+($total*Configuration::getIva()), 2, ',', '.') }} </h4>
				@endif
			@else
				@if(($discount >= 12) && (Configuration::getDiscount() > 0))
					<h4 align="right">Sub-Total: {{ Configuration::getMoneySymbol() }} {{ number_format($total, 2, ',', '.') }} </h4>
					<h4 align="right">{{ Configuration::getWholesaleDiscountReference() }}: {{ Configuration::getMoneySymbol() }} {{ number_format($total*Configuration::getDiscount(), 2, ',', '.') }} </h4>
					Descuento a partir de 12 piezas <h4 align="right">Sub-Total: {{ Configuration::getMoneySymbol() }} {{ number_format($total-($total*Configuration::getDiscount()), 2, ',', '.') }}</h4>
					<h4 align="right">Total {{ Configuration::getMoneySymbol() }} {{ number_format($total-($total*Configuration::getDiscount()), 2, ',', '.') }} </h4>
				@else
					<h4 align="right">Total: {{ Configuration::getMoneySymbol() }} {{ number_format($total, 2, ',', '.') }} </h4>
				@endif
			@endif
		</div>
		<h4 style="background-color: #8c2d83; color:#fff; padding: 10px; width: 450px;">Instrucciones: </h4>
		<div style="width: 70%; float: left;">
	        <span style="font-weight:bold;">Deposita o has una transferencia a las siguientes Cuentas.</span>
	        <br><br>
	        <span><strong style="color:#060;">Banesco Banco Universal Banesco</strong><br>
	        <strong>Cuenta Corriente No.</strong> 0134-0073-31-0731061723<br>
	        <strong>A Nombre de:</strong> Vivian Medina<br>
	        <strong>C.I. No.</strong> 14738935</span>
	    </div>
		<div style="width: 30%; float: right;">
        	<p><strong>Reporta tu pago haciendo click en el botón <a style="background-color: #8c2d83; text-decoration: none; color: #fff; font-weight: bold; border-radius: 0.3em; padding: 0.1em;" href="http://cariocaactivewear.com/order/{{ $factura['id'] }}">Completar Pago</a>, y llena el formulario</strong></p>
        </div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
        <div style="text-align: center">
        	<p><strong>Advertencia: Si en un lapso de 24 horas no has realizado ningún pago el pedido será cancelado y la mercancía volverá a stock de tienda.</strong></p>
        </div>
        <br />
        <br />
        <div style="text-align: center">
			<a href="http://cariocaactivewear.com/order/{{ $factura['id'] }}" style="font-size: 28px; background-color: #8c2d83; color: #ecf0f1; text-decoration: none; padding: .2em; border-bottom: 3px solid #8D2C33; margin: 0 auto; border-radius: 5px"> Completar Pago </a>
		</div>
		<br />
		<br />
		<p style="text-align: center">Esta es una cuenta no monitoreada. Favor no responder o reenviar correos.</p>
		<br />
		<br />
		<hr />
		<table align="center">
			<tr>
				<td style="text-align: center;padding: 40px 0px 0px 0px;font-family: sans-serif; font-size: 12px; line-height: 18px;color: #888888;">
					© {{ Configuration::getCompanyName() }}<br>
					<p></p>
					<a href="mailto:{{ Configuration::getContactEmail() }}" style="font-weight:bold; color: #8a929f;">{{ Configuration::getContactEmail() }}</a><br><br>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;padding: 10px 0px 40px 0px;font-family: sans-serif; font-size: 12px; line-height: 18px;color: #888888;">
					<a style="opacity: 0.5;" href="{{ Configuration::getTwitter() }}"><img src="https://raw.githubusercontent.com/danleech/simple-icons/master/icons/twitter/twitter-64-black.png" alt="Twitter"><i style="color: #ccc" class="fa fa-twitter-square fa-x2"></i></a>&nbsp; &nbsp;
					<a style="opacity: 0.5;" href="{{ Configuration::getInstagram() }}"><img src="https://raw.githubusercontent.com/danleech/simple-icons/master/icons/instagram/instagram-64-black.png" alt="Instagram"><i style="color: #ccc" class="fa fa-facebook-square fa-x2"></i></a>&nbsp; &nbsp;
					<a style="opacity: 0.5;" href="{{ Configuration::getFacebook() }}"><img src="https://raw.githubusercontent.com/danleech/simple-icons/master/icons/facebook/facebook-64-black.png" alt="Facebook"><i style="color: #ccc" class="fa fa-instagram fa-x2"></i></a>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;padding: 10px 0px 40px 0px;font-family: sans-serif; font-size: 12px; line-height: 18px;color: #888888;">
					Made by &nbsp; <a style="font-size: 1.2em; font-weight: bold; text-decoration: none; color: #333; background-color: #ccc; border-radius: .2em; padding: .3em;" href="http://craftersama.me"><img style="margin-bottom: -3px;" src="http://craftersama.me/images/craftersama_gw_logo.png" alt="" width="16px">&nbsp; CrafterSama Studio</a> 
				</td>
			</tr>
		</table>
	</div>	
</body>
</html>