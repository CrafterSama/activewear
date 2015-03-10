<!doctype html>

<html lang="es">

<head>

	<meta charset="UTF-8">

	<title>Factura</title>

</head>

<body style="font-family: sans-serif; background-color: #f2f2f2; margin: 0; color: #333;"> 

	<div style="width: 100%; background-color: #C74751; padding: 0.3em; text-align: center; border-bottom: 3px solid #8D2C33;">

		<img src="http://pioggia.craftersama.me/assets/images/logo.png" alt="">

	</div>



	<div style="padding: 0 1em;"> 

		<h1>Recibo de Pago No. {{ $factura['id'] }} a la Compra</h1>

		<hr>



		<p><strong>Recibo:</strong> {{ $pago['recibo'] }} </p>

		<p><strong>Monto:</strong> {{ $pago['monto'] }} </p>

		<p><strong>Fecha:</strong> {{ $pago['fecha'] }}</p>


		<h1>Recibo No. {{ $factura['id'] }} </h1>

		<hr>



		<h4>Detalles del Recibo: </h4>



		<p><strong>Nombre:</strong> {{ $user['full_name'] }} </p>

		<p><strong>Direccion de Envio:</strong> {{ $user['user_address'].', '.Ciudad::getName($user['municipio']).', Edo. '.Estado::getName($user['estado']) }} </p>

		<p><strong>Telefono de Contacto:</strong> {{ $user['user_mobile'] }} </p>

		<p><strong>Correo:</strong> {{ $user['email'] }} </p>
		
		<p><strong>Nota:</strong> Si su direccion esta localizada en el municipio Maracaibo, su pedido debe retirarlo por el local de <a href="http://cariocaactivewear.com/contacto">Pioggia Di Mare</a> siga el link para conocerla, de lo contrario si su direccion de envio esta fuera de Maracaibo el Envio se realizara por MRW a la dirección que usted ingreso en el sistema a traves del formulario de registro y es con cobro a destino</p>
	

		<hr/>

		<h4>Compra: </h4>



		<table border="0" width="100%" style="border: 1px solid #fff; text-align: center;">

			<tr>

				<th style="background-color: #C74751; color:#fff;">Producto</th>

				<th style="background-color: #C74751; color:#fff;">Cantidad</th>

				<th style="background-color: #C74751; color:#fff;">Precio</th>

				<th style="background-color: #C74751; color:#fff;">Subtotal</th>

			</tr>

			<?php 
				$total = 0; 
				$discount = 0;
			?>

			@foreach ($items as $item)

			<tr>

				<td style="border: 1px solid #fff ;">{{ substr($item['keep'], 0, strpos($item['keep'], '|')) }}</td>

				<td style="border: 1px solid #fff ;">{{ $item['cantidad'] }}</td>

				<td style="border: 1px solid #fff ;">Bs. {{ number_format($item['precio'], 2, ',', '.') }}</td>

				<td style="border: 1px solid #fff ;">{{ number_format($item['cantidad']*$item['precio'], 2, ',', '.') }} Bs.</td>

			</tr>

			<?php 
				$total += $item['cantidad'] * $item['precio']; 
				$discount += $item['cantidad'];
			?>

			@endforeach



		</table>

		@if($discount >= 12 && Configuration::getDiscount() > 0)
			<h4 align="right">Total: Bs. {{ number_format($total, 2, ',', '.') }} </h4>
			<h4 align="right">Descuento 30%: Bs. {{ number_format($total*Configuration::getDiscount(), 2, ',', '.') }} </h4>
			Descuento del 30% a partir de 12 piezas <h4 align="right">Total: Bs. {{ number_format($total-($total*Configuration::getDiscount()), 2, ',', '.') }} </h4>
		@else
			<h4 align="right">Total: Bs. {{ number_format($total, 2, ',', '.') }} </h4>
		@endif

		<p>Cualquier duda que tenga puede comunicarse con nosotros a través de nuestro correo electrónico ventasactivewear@gmail.com o a través de nuestros teléfonos 0414-0659155, donde con gusto le atenderemos </p>	

		<div align="center">

			<a href="http://cariocaactivewear.com/order/{{ $factura['id'] }}" style="font-size: 28px;  background-color: #C74751; color: #ecf0f1; text-decoration: none; padding: .2em; border-bottom: 3px solid #8D2C33; margin: 0 auto; border-radius: 5px;"> Ver en linea </a>

		</div>

	</div>

	

</body>

</html>