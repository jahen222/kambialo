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
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(user $user)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(user $user)
	{
		$user = auth()->user();
		return view('user/edit')->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, user $user)
	{
		//
		if ($data = $request->input('users')) {
			Validator::make(
				$data,
				[
					'email' => [
						'required',
						Rule::unique('users')->ignore(auth()->user()->id),
					],
					'comuna_id' => 'required',
					'password' => 'required_with:confirm_password|same:confirm_password',
					'confirm_password' => 'required_with:password|same:password',
					'firstname' => 'required',
					'lastname' => 'required',
					'telephone' => 'required',
				],
				[
					'email.required' => 'El correo electronico es requerido',
					'email.unique' => 'El correo electronico se encuentra en uso',
					'comuna_id.required' => 'Comuna es requerido',
					'password.required_with' => 'Contraseña es requerido',
					'confirm_password.required_with' => 'Confirmar contraseña es requerido',
					'password.same' => 'Las contraseñas no coinciden',
					'confirm_password.same' => 'Las contraseñas no coinciden',
					'firstname.required' => 'El Nombre es requerido',
					'lastname.required' => 'El Apellido es requerido',
					'telephone.required' => 'El Telefono es requerido',
				]
			)->validate();
			auth()->user()->update([
				'email' => $data['email'],
				'comuna_id' => $data['comuna_id'],
				'password' => $data['password'] ? Hash::make($data['password']) : auth()->user()->password,
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'telephone' => $data['telephone']
			]);
			return redirect('/user/edit')->with('success', 'Perfil actualizado con éxito.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\user  $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(user $user)
	{
		//
	}
}
