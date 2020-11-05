<li class="nav-item {{ \Request::is('home') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ url('/') }}">
		{{ __('Home') }}
	</a>
</li>

<li class="nav-item {{ \Request::is('showcase') ? 'active' : ''  }}">
    <a class="nav-link" href="{{ route('showcase.index') }}">
        {{ __('Vitrinea') }}
    </a>
</li>

<li class="nav-item {{ \Request::is('products') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ route('products.index') }}">
		{{ __('Mis productos') }}
	</a>
</li>

<li class="nav-item {{ \Request::is('favorites') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ route('favorites.index') }}">
		{{ __('Mis favoritos') }}
	</a>
</li>

<li class="nav-item {{ \Request::is('matches') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ route('matches.index') }}">
		{{ __('Mis matches') }}
	</a>
</li>

<li class="nav-item">
	<a class="nav-link" href="{{ route('user.edit') }}">
		{{ __('Mi perfil ') }}{{ Auth::user()->name }}
	</a>
</li>

<li class="nav-item">
	<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
	    document.getElementById('logout-form').submit();">
		{{ __('Cerrar sesión') }}
	</a>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	@csrf
</form>
