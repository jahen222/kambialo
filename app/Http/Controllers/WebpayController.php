<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;

class WebpayController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index(Request $request)
	{
		// Obtenemos los certificados y llaves para utilizar el ambiente de integración de Webpay Normal.  
		$bag = CertificationBagFactory::integrationWebpayNormal();

		$plus = TransbankServiceFactory::normal($bag);
		$sub = \App\Subscription::where('id', $request->input('subscription'))->first();
		$idOrder = date('YmdHis') . $sub->id;

		// Para transacciones normales, solo puedes añadir una linea de detalle de transacción.  
		$plus->addTransactionDetail($sub->price, $idOrder); // Monto e identificador de la orden  

		// Debes además, registrar las URLs a las cuales volverá el cliente durante y después del flujo de Webpay  
		$response = $plus->initTransaction(url('webpay/confirmation'), url('webpay/final'));

		return json_encode([
			'url' => $response->url,
			'token' => $response->token,
			'sub' => $sub
		]);
	}

	public function final(Request $request)
	{
		/** TODO verificacion de transaccion */
		return view('webpay.final');
	}

	public function confirmation(Request $request)
	{
		$bag = CertificationBagFactory::integrationWebpayNormal();
		$plus = TransbankServiceFactory::normal($bag);
		$response = $plus->getTransactionResult($request->input('TBK_TOKEN'));

		/* Comprueba que la orden no haya sido pagada */
		if ($response->detailOutput->responseCode == 0) {
			$plus->acknowledgeTransaction();
		}
		return view('webpay.confirmation', ['response' => $response]);
	}
}
