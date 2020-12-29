<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('user.index')->with('users', User::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if ($data = $request->input('users')) {
			Validator::make(
				$data,
				[
					'email' => ['required|email',Rule::unique('users')],
					'name' => ['required',Rule::unique('users')],
					'comuna_id' => 'required',
					'subscription_id' => 'required',
					'password' => 'required|same:confirm_password',
					'confirm_password' => 'required|same:password',
					'firstname' => 'required',
					'lastname' => 'required',
					'telephone' => 'required|numeric|digits_between:10,12',
				],
				[
					'email.required' => 'El correo electrónico es requerido',
					'email.unique' => 'El correo electrónico se encuentra en uso',
					'name.required' => 'El nombre de usuario es requerido',
					'name.unique' => 'El nombre de usuario se encuentra en uso',
					'comuna_id.required' => 'Comuna es requerido',
					'subscription_id.required' => 'Subscripción es requerido',
					'password.required' => 'Contraseña es requerido',
					'confirm_password.required' => 'Confirmar contraseña es requerido',
					'password.same' => 'Las contraseñas no coinciden',
					'confirm_password.same' => 'Las contraseñas no coinciden',
					'firstname.required' => 'El Nombre es requerido',
					'lastname.required' => 'El Apellido es requerido',
					'telephone.required' => 'Teléfono es requerido',
                    'telephone.numeric' => 'Teléfono debe ser numerico',
                    'telephone.digits_between' => 'Teléfono debe tener entre 10 y 12 dígitos.',
				]
			)->validate();

			User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'comuna_id' => $data['comuna_id'],
				'subscription_id' => $data['subscription_id'],
				'password' => Hash::make($data['password']),
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'telephone' => $data['telephone'],
				'token_webpay' => '',
			]);
			return redirect('/users/')->with('success', 'Perfil creado con éxito.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return view('user.show')->with('user', User::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id = '')
	{
		$user = $id ? User::find($id) : auth()->user();
		return view('user/edit')->with('user', $user)->with('id', $id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id = '')
	{
		if ($data = $request->input('users')) {
			$user = $id ? User::find($id) : auth()->user();
			Validator::make(
				$data,
				[
					'email' => ['required|email',Rule::unique('users')->ignore($user->id)],
					'comuna_id' => 'required',
					'password' => 'required_with:confirm_password|same:confirm_password',
					'confirm_password' => 'required_with:password|same:password',
					'firstname' => 'required',
					'lastname' => 'required',
					'telephone' => 'required|numeric|digits_between:10,12',
					'birthdate' => 'required',
					'gender' => 'required',
				],
				[
					'email.required' => 'El correo electrónico es requerido',
					'email.unique' => 'El correo electrónico se encuentra en uso',
					'comuna_id.required' => 'Comuna es requerido',
					'subscription_id.required' => 'Subscripción es requerido',
					'password.required_with' => 'Contraseña es requerido',
					'confirm_password.required_with' => 'Confirmar contraseña es requerido',
					'password.same' => 'Las contraseñas no coinciden',
					'confirm_password.same' => 'Las contraseñas no coinciden',
					'firstname.required' => 'El Nombre es requerido',
					'lastname.required' => 'El Apellido es requerido',
					'telephone.required' => 'Teléfono es requerido',
                    'telephone.numeric' => 'Teléfono debe ser numerico',
                    'telephone.digits_between' => 'Teléfono debe tener entre 10 y 12 dígitos.',
					'birthdate.required' => 'La fecha de nacimiento es requerido',
					'gender.required' => 'El sexo es requerido',
				]
			)->validate();

			$user->update([
				'email' => $data['email'],
				'comuna_id' => $data['comuna_id'],
				'subscription_id' => $data['subscription_id'] ?? $user->subscription_id,
				'password' => $data['password'] ? Hash::make($data['password']) : $user->password,
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'telephone' => $data['telephone'],
				'birthdate' => date('Y-m-d', strtotime($data['birthdate'])),
				'gender' => $data['gender'],
			]);
			return redirect('/user/edit/'.$id)->with('success', 'Perfil actualizado con éxito.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
        if (count($user->products()->get()))
            return back()->with('error', 'No se puede eliminar, tiene información asociada.');

		$user->delete();
        return redirect('/users')->with('success', 'Usuario eliminado con éxito.');
	}
}
