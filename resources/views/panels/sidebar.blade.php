@php
$configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto text-center" style="width: 80%">
        <a class="" href="{{url('/')}}">
          <span class="brand-logo">
            <img src="{{ asset('images/login/camionGO-logo.png')}}" style="max-width:150px">
          </span>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
		
		<li class="nav-item  {{Route::currentRouteName() === 'agenda.index' ? 'active' : ''}}">
			<a href="{{ route('agenda.index') }}" class="d-flex align-items-center" target="_self">
				<i data-feather="calendar"></i>
				<span class="menu-title text-truncate">Agenda</span>
			</a>
		</li>
		<li class="nav-item  ">
       		<a href="{{ route('logout') }}" class="d-flex align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();">
				<i data-feather="power"></i>
				<span class="menu-title text-truncate">Salir</span>
            </a>
          <form method="POST" id="logout-form2" action="{{ route('logout') }}">
            @csrf
          </form>
        </li>
    </ul>
  </div>
</div>
<!-- END: Main Menu-->
