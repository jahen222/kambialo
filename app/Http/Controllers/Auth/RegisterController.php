<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Auth;
use App\WebpayOrder;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function preregister(Request $request)
    {
        if ($data = $request->input('users')) {

            Validator::make(
                $data,
                [
                    'name' => 'required',
                    'email' => 'unique:users',
                    'subscription_id' => 'required',
                    'comuna_id' => 'required'
                ],
                [
                    'name.required' => 'Usuario es requerido',
                    'subscription_id.required' => 'Debe seleccionar un plan de subscripcion',
                    'email.unique' => 'El correo electronico se encuentra en uso',
                    'comuna_id.required' => 'Comuna es requerido',
                ]
            )->validate();

            
            // Obtenemos los certificados y llaves para utilizar el ambiente de integración de Webpay Normal.  
            $bag = CertificationBagFactory::integrationWebpayNormal();

            $plus = TransbankServiceFactory::normal($bag);
            $sub = \App\Subscription::where('id', $data['subscription_id'])->first();
            $idOrder = date('YmdHis') . $sub->id;

            // Para transacciones normales, solo puedes añadir una linea de detalle de transacción.  
            $plus->addTransactionDetail($sub->price, $idOrder); // Monto e identificador de la orden  

            // Debes además, registrar las URLs a las cuales volverá el cliente durante y después del flujo de Webpay  
            $response = $plus->initTransaction(route('confirmation'), route('endregister'));

            /**
             * @TODO Guardar en DB preregistro
             */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'comuna' => $data['comuna'],
                'subscription_id' => $data['subscription_id'],
                'comuna_id' => $data['comuna_id'],
                'password' => Hash::make($data['password']),
                'token_webpay' => $response->token
            ]);

            return RedirectorHelper::redirectHTML($response->url, $response->token);
        }
    }

    public function confirmation(Request $request)
    {
        $bag = CertificationBagFactory::integrationWebpayNormal();
        $plus = TransbankServiceFactory::normal($bag);
        $response = $plus->getTransactionResult();

        /* Comprueba que la orden no haya sido pagada */
        if ($response->detailOutput->responseCode == 0) {
            $user = User::where('token_webpay', $request->input('token_ws'))->first();
            WebpayOrder::create([
                'user_id' => $user->id,
                'accounting_date' => $response->accountingDate,
                'buy_order' => $response->buyOrder,
                'card_number' => $response->cardDetail->cardNumber,
                'authorization_code' => $response->detailOutput->authorizationCode,
                'payment_code' => $response->detailOutput->paymentTypeCode,
                'response_code' => $response->detailOutput->responseCode,
                'shares_number' => $response->detailOutput->sharesNumber,
                'amount' => $response->detailOutput->amount,
                'commerce_code' => $response->detailOutput->commerceCode,
                'transaction_date' => $response->transactionDate,
            ]);
            $plus->acknowledgeTransaction();
        }
        return RedirectorHelper::redirectBackNormal($response->urlRedirection);
    }

    public function endregister(Request $request)
    {
        if ($user = User::where('token_webpay', $request->input('token_ws'))->first()) {
            if ($order = WebpayOrder::where('user_id', $user->id)->first()) {
                Auth::loginUsingId($user->id);
                return view('auth.register.endregistration', ['user' => $user, 'order' => $order]);
            }
            $user->delete();
        }
        \Session::flash('webpay-message', 'Ha ocurrido un problema con su pago, puede volver a intentarlo');
        return redirect('register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subscription_id' => $data['subscription'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('User');

        return $user;
    }
}
