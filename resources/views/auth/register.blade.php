@extends('layouts.app')

@section('content')
<script type="text/javascript">
    $(document).ready(function() {
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function(e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function() {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>
<section class="container-fluid breakcump register">
    <div class="row" id="selector">
        <a href="#" class="col-4 kb-link kb-link-active" style="text-align: center;">
            REGISTRO
        </a>
        <a href="#" class="col-4 kb-link" style="text-align: center;">
            PLANES
        </a>
        <a href="#" class="col-4 kb-link" style="text-align: center;">
            PAGO
        </a>
    </div>
</section>
<section class="container-fluid breakcump-grey">
    <div class="container">
        <?php if (session()->has('webpay-message')) : ?>
            <div class="alert-warning" style="margin: 10px 0;">
                <p><?= session()->get('webpay-message') ?></p>
            </div>
        <?php endif ?>
        <div class="icon-breakcump">
            <img src="assets/img/icon-k.png">
            <h4>REGISTRO</h4>
        </div>
    </div>
</section>
<section class="container mt-2 pb-2 mb-4">
    <div class="col-md-12">
        <form method="POST" action="{{ route('preregister') }}" class="form-register form-registro-step card">
            @csrf
            <fieldset>
                <label class="color-green">Ingrese los datos</label>
                <div class="form-group">
                    <input type="text" name="users[name]" value="{{ old('users.name') }}" required class="form-control">
                    <small class="form-text text-muted">Nombre de Usuario</small>
                    <small class="form-text text-danger">@error('name') {{ $message }} @enderror</small>
                </div>
                <div class="form-group">
                    <input type="email" name="users[email]" value="{{ old('users.email') }}" required class="form-control">
                    <small class="form-text text-muted">Correo Electrónico</small>
                    <small class="form-text text-danger">@error('email') {{ $message }} @enderror</small>
                </div>
                <div class="form-group">
                    <select class="custom-select js-basic-multiple" id="comuna" name="users[comuna_id]">
                        <option value>Seleccionar comuna</option>
                        @foreach(App\Comuna::all() as $comuna)
                        <option value="{{ $comuna->id }}">{{ $comuna->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Comuna</small>
                    <small class="form-text text-danger">@error('comuna_id') {{ $message }} @enderror</small>
                </div>
                <div class="form-group">
                    <input type="password" name="users[password]" value="{{ old('users.password') }}" required class="form-control">
                    <small class="form-text text-muted">Contraseña</small>
                    <small class="form-text text-danger">@error('password') {{ $message }} @enderror</small>
                </div>
                <div class="form-group">
                    <input type="password" name="users[password_confirmation]" value="{{ old('users.password_confirmation') }}" required class="form-control">
                    <small class="form-text text-muted">Confirmar Contraseña</small>
                    <small class="form-text text-danger">@error('password_confirmation'){{ $message }} @enderror</small>
                </div>
                <button type="button" name="next" style="width:100%;" class="btn btn-lg btn-success btn-block next action-button">CONTINUAR</button>
            </fieldset>
            <fieldset>
                <div class="col-md-12 text-center">
					@foreach(App\Subscription::all() as $sub)
					<input style="display:none; "type="radio" data-name="{{ $sub->name }}" data-description="{{$sub->description}}"
							data-price="{{ number_format($sub->price) }}" data-quote="{{ $sub->quote }}" data-months="{{ $sub->months }}"
							class="custom-control-input" id="subscription-{{ $sub->id }}" name="users[subscription_id]" value="{{ $sub->id }}" />
					<label style="width: 100%;" for="subscription-{{ $sub->id }}">
						<div class="card mb-4 shadow-sm">
							<div class="card-header" style="background-color: transparent; color: #000;">
								<h3>{{ $sub->name }}</h3>
								<p>{{ $sub->description }}</p>
							</div>
							<div class="card-body success-color">
								<h1 class="card-title pricing-card-titler" style="color: #fff;">$ {{ $sub->price }}</h1>
							</div>
							<div class="card-footer">
								<p class="card-title">Hasta  {{ $sub->quote }} Productos</p>
								<hr>
								<p class="card-text">{{ $sub->months }} meses</p>
								<button style="width:auto;margin:auto;" onclick="$('#subscription-{{ $sub->id }}').trigger('click')" type="button" name="next" class="col-12 btn btn-success btn-block next action-button">PAGAR</button>
							</div>
						</div>
					</label>
					@endforeach
                    <small class="form-text text-danger">@error('subscription_id'){{ $message }} @enderror</small>
                </div>
                <button type="button" name="previous" class="col-12 btn btn-lg btn-defaul btn-block previous action-button-previous">REGRESAR</button>
                <!--<button type="button" name="next" class="col-12 btn btn-lg btn-success btn-block next action-button">PAGAR</button>-->
            </fieldset>
            <fieldset>
				<div class="card mb-4 shadow-sm text-center">
					<div class="card-header" style="background-color: transparent; color: #000;">
						<h3 id="sub-name"></h3>
						<p id="sub-description"></p>
					</div>
					<div class="card-body success-color">
						<h1 class="card-title pricing-card-titler" style="color: #fff;">$ <span id="sub-price"></span></h1>
					</div>
					<div class="card-footer">
						<p class="card-title">Hasta <span id="sub-quote"></span> Productos</p>
						<hr>
						<p class="card-text"><span id="sub-months"></span> meses</p>
					</div>
				</div>
                <button type="button" name="previous" class="col-12 btn btn-lg btn-defaul btn-block previous action-button-previous">REGRESAR</button>
                <button type="submit" class="col-12 btn btn-lg btn-info btn-block submit">CONFIRMAR</button>
            </fieldset>
        </form>
    </div>
</section>
<style>
.select2-container, .select2-selection{
	width: 100%!important;
}
</style>
@endsection
