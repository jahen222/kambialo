@extends('layouts.app')

@section('content')
<div class="container">
	<h2>Usuario registrado satisfactoriamente. Bienvenido {{ $user->name }}</h2>

	<div class="row justify-content-center">
		<div class="col-sm-6" style="border: 1px dashed blue">
			<div class="text-center">
				<div><h2>Pedido procesado satisfactoriamente</p></div>
				<div class="row">
					<div class="col-sm-3">
						<b>Pedido:</b><br>
						<?= $order->buy_order ?>
					</div>
					<div class="col-sm-3">
						<b>Fecha:</b><br>
						<?= $order->created_at ?>
					</div>
					<div class="col-sm-3">
						<b>Total:</b><br>
						<?= $order->amount ?>
					</div>
					<div class="col-sm-3">
						<b>Metodo de pago:</b><br>
						Transbank Webpay
					</div>
				</div>
			</div>
			<div class="text-center" style="border: 1px dashed green;">
				<p style="margin:0;"><?= $order->response_code == 0 ? 'Transaccion aprobada' : ''?></p>
			</div>
			<div class="col-12" style="border: 1px solid blue; margin: 5px 0;">
				<h3 class="text-center">Detalles de pago</h3>
				<table widht="100%">
					<tbody>
						<tr>
							<td width="70%"><b>Respuesta de Transaccion</b></td>
							<td><?= $order->response_code == 0 ? 'Transaccion aprobada' : ''?></td>
						</tr>

						<tr>
							<td><b>Codigo de la Transaccion</b></td>
							<td><?= $order->payment_code ?></td>
						</tr>

						<tr>
							<td><b>Orden de Compra</b></td>
							<td><?= $order->buy_order ?></td>
						</tr>

						<tr>
							<td><b>Codigo de autorizacion</b></td>
							<td><?= $order->authorization_code ?></td>
						</tr>

						<tr>
							<td><b>Fecha de Transaccion</b></td>
							<td><?= (new \Datetime($order->transaction_date))->format('d-m-Y') ?></td>
						</tr>

						<tr>
							<td><b>Hora de Transaccion</b></td>
							<td><?=(new \Datetime($order->transaction_date))->format('H:i:s') ?></td>
						</tr>

						<tr>
							<td><b>Tarjeta de credito</b></td>
							<td><?= str_repeat('**** ', 3) . $order->card_number ?></td>
						</tr>

						<tr>
							<td><b>Tipo de pago</b></td>
							<td></td>
						</tr>

						<tr>
							<td><b>Tipo de cuota</b></td>
							<td><?= $order->shares_number == 0 ? 'Sin cuotas' : '' ?> </td>
						</tr>

						<tr>
							<td><b>Monto Compra</b></td>
							<td><?= $order->amount ?></td>
						</tr>

						<tr>
							<td><b>Numero de Cuotas</b></td>
							<td><?= $order->shares_number ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-12" style="border: 1px solid blue; margin: 5px 0;">
				<h3 class="text-center">Detalles del Plan</h3>
				<table width="100%">
					<tbody>
						<tr>
							<td width="70%">Plan</td>
							<td><?= $user->subscription->name . ' - ' . $user->subscription->description ?></td>
						</tr>
						<tr>
							<td>Total</td>
							<td><?= $user->subscription->price ?> </td>
						</tr>

						<tr>
							<td><b>Subtotal:</b></td>
							<td><?= $user->subscription->price ?> </td>
						</tr>

						<tr>
							<td><b>Metodo de pago:</b></td>
							<td>Transbank Webpay</td>
						</tr>

						<tr>
							<td><b>Total:</b></td>
							<td><?= $user->subscription->price ?></td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection