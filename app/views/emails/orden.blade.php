<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Orden De Compra</title>
</head>
<body style="font-family: sans-serif; background: #fff url('http://carioca.craftersama.me/assets/images/bg.png') repeat top center fixed; margin: 0; color: #333;"> 
	<div style="width: 100%; margin-right: 50px; text-align: right; border-bottom: 3px solid #8D2C33; ">
		<img style="max-width: 450px;" src="http://carioca.craftersama.me/assets/images/logo_carioca.png" alt="" />
		<h1 style="margin-right: 25px;">Orden de Pago</h1>
	</div>
	<div style="padding: 0 1em;"> 
		<h1>Pedido No. {{ $factura['id'] }} a la Compra</h1>
		<hr>
		<p><strong>Recibo:</strong> {{ $pago['recibo'] }} </p>
		<p><strong>Monto:</strong> {{ number_format($pago['monto'], 2, ',','.') }} </p>
		<p><strong>Fecha:</strong> {{ $pago['fecha'] }}</p>
		<h1>Pedido No. {{ $factura['id'] }} </h1>
		<hr>
		<h4>Detalles del Pedido: </h4>
		<p><strong>Nombre:</strong> {{ $user['full_name'] }} </p>
		<p><strong>Direccion de Envio:</strong> {{ $user['user_address'].', '.Ciudad::getName($user['municipio']).', Edo. '.Estado::getName($user['estado']) }} </p>
		<p><strong>Telefono de Contacto:</strong> {{ $user['user_mobile'] }} </p>
		<p><strong>Correo:</strong> {{ $user['email'] }} </p>
		<hr/>
		<h4>Compra: </h4>
		<table border="0" width="100%" style="border: 1px solid #fff; text-align: center;">
			<tr>
				<th style="background-color: #C74751; color:#fff;">Producto</th>
				<th style="background-color: #C74751; color:#fff;">Cantidad</th>
			</tr>
			<?php 
				$total = 0; 
				$discount = 0;
			?>
			@foreach ($items as $item)
			<tr>
				<td style="border: 1px solid #fff ;">{{ substr($item['keep'], 0, strpos($item['keep'], '|')) }}</td>
				<td style="border: 1px solid #fff ;">{{ $item['cantidad'] }}</td>
			</tr>
			<?php 
				$total += $item['cantidad'] * $item['precio']; 
				$discount += $item['cantidad'];
			?>
			@endforeach
		</table>
		<br />
		<br />
		<br />
		<div align="center">
			<a href="http://cariocaactivewear.com/order/{{ $factura['id'] }}" style="font-size: 28px;  background-color: #C74751; color: #ecf0f1; text-decoration: none; padding: .2em; border-bottom: 3px solid #8D2C33; margin: 0 auto; border-radius: 5px;"> Ver en linea </a>
		</div>
	</div>
</body>
</html>