<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Factura</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body style="font-family: sans-serif; font-size: 18px; font-style: italic; background: #fff url('http://carioca.craftersama.me/assets/images/bg.png') repeat top center fixed; margin: 0; color: #333;"> 
	<div style="width: 100%; margin-right: 50px; text-align: right; border-bottom: 3px solid #81bcb4; ">
		<img style="max-width: 450px;" src="http://carioca.craftersama.me/assets/images/logo_carioca.png" alt="" />
		<h1 style="margin-right: 25px;">Factura</h1>
	</div>
	<div style="padding: 0 1em; background-color: #fff;">
		<h1>Recibo de Pago No. {{ $factura['id'] }}</h1>
		<hr>
		<h4 style="background-color: #81bcb4; color:#fff; padding: 10px; width: 450px;">Detalles del Recibo: </h4>
		<p><strong>Recibo:</strong> {{ $pago['recibo'] }} </p>
		<p><strong>Monto:</strong> {{ $pago['monto'] }} </p>
		<p><strong>Fecha:</strong> {{ $pago['fecha'] }}</p>
		<h1>Recibo No. {{ $factura['id'] }} </h1>
		<hr>
		<h4 style="background-color: #81bcb4; color:#fff; padding: 10px; width: 450px;">Detalles del Comprador: </h4>
		<p><strong>Nombre:</strong> {{ $user['full_name'] }} </p>
		<p><strong>Direccion de Envio:</strong> {{ $user['user_address'].', '.Ciudad::getName($user['municipio']).', Edo. '.Estado::getName($user['estado']) }} </p>
		<p><strong>Telefono de Contacto:</strong> {{ $user['user_mobile'] }} </p>
		<p><strong>Correo:</strong> {{ $user['email'] }} </p>
		<p><strong>Nota:</strong> Si su direccion esta localizada en el municipio Maracaibo, su pedido debe retirarlo por el local de <a href="http://cariocaactivewear.com/contacto">Pioggia Di Mare</a> siga el link para conocerla, de lo contrario si su direccion de envio esta fuera de Maracaibo el Envio se realizara por MRW a la dirección que usted ingreso en el sistema a traves del formulario de registro y es con cobro a destino</p>
		<hr/>
		<table border="0" width="100%" style="border: 1px solid #fff; text-align: center;">
			<tr>
				<th style="background-color: #81bcb4; color:#fff;">Producto</th>
				<th style="background-color: #81bcb4; color:#fff;">Cantidad</th>
				<th style="background-color: #81bcb4; color:#fff;">Precio</th>
				<th style="background-color: #81bcb4; color:#fff;">Subtotal</th>
			</tr>
			<?php 
				$total = 0; 
				$discount = 0;
			?>
			@foreach ($items as $item)
			<tr>
				<td style="background-color: #ccc; height: 220px;">{{ substr($item['keep'], 0, strpos($item['keep'], '|')) }}</td>
				<td style="background-color: #ccc; height: 220px;">{{ $item['cantidad'] }}</td>
				<td style="background-color: #ccc; height: 220px;">Bs. {{ number_format($item['precio'], 2, ',', '.') }}</td>
				<td style="background-color: #ccc; height: 220px;">{{ number_format($item['cantidad']*$item['precio'], 2, ',', '.') }} Bs.</td>
			</tr>
			<?php 
				$total += $item['cantidad'] * $item['precio']; 
				$discount += $item['cantidad'];
			?>
			@endforeach
		</table>
		@if($discount >= Configuration::getQuantitiesDiscount() && Configuration::getDiscount() > 0)
			<h4 align="right">Total: Bs. {{ number_format($total, 2, ',', '.') }} </h4>
			<h4 align="right">{{ Configuration::getWholesaleDiscountReference() }}: Bs. {{ number_format($total*Configuration::getDiscount(), 2, ',', '.') }} </h4>
			{{ Configuration::getWholesaleDiscountReference() }} a partir de {{ Configuration::getQuantitiesDiscount() }} piezas <h4 align="right">Total: Bs. {{ number_format($total-($total*Configuration::getDiscount()), 2, ',', '.') }} </h4>
		@else
			<h4 align="right">Total: Bs. {{ number_format($total, 2, ',', '.') }} </h4>
		@endif
		<p>Cualquier duda que tenga puede comunicarse con nosotros a través de nuestro correo electrónico ventasactivewear@gmail.com o a través de nuestros teléfonos 0414-0659155, donde con gusto le atenderemos </p>	
		<div align="center">
			<a href="http://cariocaactivewear.com/order/{{ $factura['id'] }}" style="font-size: 28px;  background-color: #81bcb4; color: #ecf0f1; text-decoration: none; padding: .2em; margin: 0 auto; border-radius: 5px;"> Ver en linea </a>
		</div>
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