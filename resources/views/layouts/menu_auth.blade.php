<li class="nav-item {{ \Request::is('home') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ url('/') }}">
		{{ __('Home') }}
	</a>
</li>

<li class="nav-item {{ \Request::is('products') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ route('products.index') }}">
		{{ __('Productos') }}
	</a>
</li>

<li class="nav-item {{ \Request::is('favorites') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ route('favorites.index') }}">
		{{ __('Favoritos') }}
	</a>
</li>

<li class="nav-item {{ \Request::is('matches') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ route('matches.index') }}">
		{{ __('Matches') }}
	</a>
</li>

<li class="nav-item {{ \Request::is('showcase') ? 'active' : ''  }}">
	<a class="nav-link" href="{{ route('showcase.index') }}">
		{{ __('Vitrinea') }}
	</a>
</li>

<li class="nav-item">
	<a class="nav-link" href="#">
		{{ __('Perfil ') }}{{ Auth::user()->name }}
	</a>
</li>

<li class="nav-item">
	<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
						 document.getElementById('logout-form').submit();">
		{{ __('Logout') }}
	</a>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	@csrf
</form>