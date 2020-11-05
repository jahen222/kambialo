@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 card">
			<h1>Perfil </h1>
			<br />

			<form action="{{ route('user.update') }}" id="user-form" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('POST') }}
				<div class="form-group">
					<label for="email">Correo</label>
					<input type="text" class="form-control" name="users[email]" id="email" value="{{ old('users.email') ?? $user->email }}" required>
					<small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
				</div>
				<div class="form-group">
					<label for="comuna">Comuna</label>
					<select class="custom-select js-basic-multiple" id="comuna" name="users[comuna_id]">
						@foreach(App\Comuna::all() as $comuna)
						<option {{ (old('users.comuna_id') ?? $user->comuna_id ==  $comuna->id) ? 'selected' : '' }}  value="{{ $comuna->id }}">{{ $comuna->name }}</option>
						@endforeach
					</select>
					<small class="form-text text-danger">@error('comuna_id') {{ $message }} @enderror</small>
				</div>
				<div class="form-group">
					<label for="firstname">Nombre</label>
					<input type="text" class="form-control" name="users[firstname]" id="firstname" value="{{ old('users.firstname') ?? $user->firstname }}" >
					<small class="form-text text-danger">@error('firstname') {{ $message }} @enderror</small>
				</div>
				<div class="form-group">
					<label for="lastname">Apellido</label>
					<input type="text" class="form-control" name="users[lastname]" id="lastname" value="{{ old('users.lastname') ?? $user->lastname }}" >
					<small class="form-text text-danger">@error('lastname') {{ $message }} @enderror</small>
				</div>
				<div class="form-group">
					<label for="telephone">Telefono</label>
					<input type="text" class="form-control" name="users[telephone]" id="telephone" value="{{ old('users.telephone') ?? $user->telephone }}" >
					<small class="form-text text-danger">@error('telephone') {{ $message }} @enderror</small>
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" name="users[password]" id="password" value="{{ old('users.password') }}">
					<small class="form-text text-danger">@error('password') {{ $message }} @enderror</small>
				</div>
				<div class="form-group">
					<label for="confirm_password">Confirmar Contraseña</label>
					<input type="password" class="form-control" name="users[confirm_password]" id="confirm_password" value="{{ old('users.confirm_password') }}">
					<small class="form-text text-danger">@error('confirm_password') {{ $message }} @enderror</small>
				</div>

				<button type="submit" class="btn btn-primary">Actualizar</button>
			</form>
		</div>
	</div>
	{{-- @include('inc.footer') --}}
</div>
@endsection