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
        <div class="icon-breakcump">
            <img src="assets/img/icon-k.png">
            <h4>REGISTRO</h4>
        </div>
    </div>
</section>
<section class="container mt-2 pb-2 mb-4">
    <div class="col-md-12">
        <form method="POST" action="{{ route('register') }}" class="form-register form-registro-step">
            @csrf
            <fieldset>
                <label class="color-green">Ingrese los datos</label>
                <div class="form-group">
                    <input type="text" name="name" required class="form-control">
                    <small class="form-text text-muted">Nombre de Usuario</small>
                </div>
                <div class="form-group">
                    <input type="email" name="email" required class="form-control">
                    <small class="form-text text-muted">Correo Elecronico</small>
                </div>
                <div class="form-group">
                    <select class="form-control">
                        <option value>Val1</option>
                        <option value="val2">Val2</option>
                    </select>
                    <small class="form-text text-muted">Todvia no se</small>
                </div>
                <div class="form-group">
                    <input type="password" name="password" required class="form-control">
                    <small class="form-text text-muted">Contraseña</small>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" required class="form-control">
                    <small class="form-text text-muted">Confirmar Contraseña</small>
                </div>
                <input type="button" name="next" class="btn btn-lg btn-success btn-block next action-button" value="CONTINUAR" />
            </fieldset>
            <fieldset>
                <div class="col-md-12 pt-5 pb-5">
                    <?php
                    $subcription = App\Subscription::all();
                    ?>
                    @foreach($subcription as $sub)
                    <div class="form-group col-md-12">
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="radio" id="subscription" name="subscription" value="{{ $sub->id }}">
                            <label class="custom-control-label" for="customCheck1">{{ $sub->name }} - {{ $sub->description }} - {{ $sub->price }}</label>
                        </div>
                    </div>
                    @endforeach

                </div>
                <input type="button" name="previous" class="col-12 btn btn-lg btn-defaul btn-block previous action-button-previous" value="REGRESAR" />
                <input type="button" name="next" class="col-12 btn btn-lg btn-success btn-block next action-button" value="PAGAR" />
            </fieldset>
            <fieldset>

                AQUI EL PAGO
                <input type="button" name="previous" class="col-12 btn btn-lg btn-defaul btn-block previous action-button-previous" value="REGRESAR" />
                <button type="submit" class="col-12 btn btn-lg btn-info btn-block">CONFIRMAR</button> 
            </fieldset>


        </form>
    </div>
</section>

{{-- <div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p>Usuario</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Subscripción</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Pago</p>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro') }}</div>
<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="setup-content" id="step-1">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button class="btn btn-success nextBtn btn-lg pull-right" type="button">Siguiente</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="step-2">
            <div class="form-group row">
                <div class="col-md-12 col-form-label">
                    <?php
                    $subcription = App\Subscription::all();
                    ?>
                    @foreach($subcription as $sub)
                    <input type="radio" id="subscription" name="subscription" value="{{ $sub->id }}">
                    <label for="male">{{ $sub->name }} - {{ $sub->description }} - {{ $sub->price }}</label><br>
                    @endforeach
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-4 offset-md-4">
                    <button class="btn btn-success nextBtn btn-lg pull-right" type="button">Siguiente</button>
                </div>
            </div>
        </div>

        <div class="row setup-content" id="step-3">
            <div class="form-group">
                <label for="name" class="col-md-12 col-form-label">{{ __('¿estás seguro?') }}</label>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                        {{ __('Sí!') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div> --}}
@endsection