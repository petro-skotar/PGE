<!DOCTYPE html>@php $v='1.65'; @endphp
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <base href="https://<?php echo $_SERVER['HTTP_HOST']; ?>" />
  <title>{!! env('APP_NAME') !!} | Система управления контентом. Version {{$v}}</title>
  <link rel="icon" type="image/png" href="adm/favicon.png">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adm/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adm/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adm/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('adm/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('adm/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('adm/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('adm/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('adm/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('adm/plugins/daterangepicker/daterangepicker.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adm/dist/css/adminlte.min.css') }}">
  <!-- admin customize -->
  <link rel="stylesheet" href="{{ asset('adm/admin.css') }}?{{$v}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed page_{{Auth::user()->role.'_'.Auth::user()->role_id}}">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="justify-content: space-between;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../" target="_blank" class="nav-link">На сайт</a>
      </li>
	  {{--
	  @if(Auth::user()->id == 1)
      <li class="nav-item d-none d-sm-inline-block">
        &nbsp;
      </li>
		  @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
			  <li class="nav-item d-none d-sm-inline-block" style="text-transform: uppercase">
				<a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="nav-link {!!($localeCode == $LANG ? 'active"><b><u>'.$localeCode.'</u></b></a>' : '">'.$localeCode.'</a>')!!}
			  </li>
		  @endforeach
	  @endif
	  --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav float-sm-right">

      <li class="nav-item d-none d-sm-inline-block">
      	<a class="nav-link"><i class="fas fa-user"></i> {{Auth::user()->surname}} {{Auth::user()->name}}</a>
      </li>
      <li class="nav-item">
		<!-- Authentication -->
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
				<i class="fas fa-sign-out-alt"></i> Выйти
			</a>
		</form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin/articles" class="brand-link navs-logo">
      <img src="adm/favicon.png" alt="PGE Construction" class="brand-image"
           style="opacity: .8">
      <span class="brand-text">PGE <span class="ano_logo font-weight-light">Construction</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item" style="font-size: 5px">
           &nbsp;
          </li>
			@foreach (Config::get('cms.modules') as $mod=>$m)
				@if($m['display']==1)
					<?php $mods_open=''; ?>
					@if(!empty($m['sub']))
					@foreach ($m['sub'] as $sub_mod=>$sub_m)
							<?php
								$pos = strpos(request()->path(), 'admin/'.$mod.'/'.$sub_mod);
								if ($pos !== false || !empty($m['always_open'])) {
									$mods_open = 'menu-open';
								}
							?>
						@endforeach
					@endif
					@if(Auth::user()->roles_open_modules(Auth::user()->role_id, $mod))
					@if(Auth::user()->role_id != 6 || (Auth::user()->role_id == 6 && $mod=='uchastniki-pfr') || (Auth::user()->role_id == 6 && Auth::user()->pfr_as_admin))
					<li class="nav-item {{!empty($m['sub']) ? 'has-treeview' : ''}} {{$mods_open}} {{empty($m['active']) ? 'disabled' : ''}}">
						<a href="admin/{{$mod}}" class="nav-link {{ (request()->is('admin/'.$mod.'*')) ? 'active' : '' }}">
						  <i class="nav-icon {{$m['class-icon']}}"></i>
						  <p>
						  {{$m['name']}}
						  {!! !empty($m['sub']) ? '<i class="fas fa-angle-left right"></i>' : '' !!}
						  </p>
						</a>
						@if(!empty($m['sub']))
							<ul class="nav nav-treeview">
								@foreach ($m['sub'] as $sub_mod=>$sub_m)
									@if($sub_m['display']==1)
										@if( (in_array($sub_mod,['managers','roles']) && Auth::user()->id == 1) || !in_array($sub_mod,['managers','roles']) )
											@if(empty($sub_m['role_id'][Auth::user()->role_id]['locked']))
												<li class="nav-item  {{empty($sub_m['active']) ? 'disabled' : ''}}">
													<a href="
														@if(!empty($sub_m['role_id'][Auth::user()->role_id]['only_edit']))
															{{ route('uchastniki-aml.edit', Auth::user()->aml_artile_id) }}
														@else
															admin/{{$mod}}/{{$sub_mod}}
														@endif
														" class="nav-link {{ $mods_open && request()->is('admin/'.$mod.'/'.$sub_mod.'*') ? 'active' : '' }}">
													  <i class="nav-icon {{$sub_m['class-icon']}}"></i>
													  <p>
														@if(!empty($sub_m['role_id'][Auth::user()->role_id]['name']))
															{{ $sub_m['role_id'][Auth::user()->role_id]['name'] }}
														@else
															{{$sub_m['name']}}
														@endif
														@if(!empty($INFO_DOCUMENTS_AML[$sub_mod]))
															<span class="badge badge-success right">{{ $INFO_DOCUMENTS_AML['documents-aml'] }}</span>
														@endif
													  </p>
													</a>
												</li>
											@endif
										@endif
									@endif
								@endforeach
							</ul>
						@endif
					</li>
					@endif
					@endif
				@endif
			@endforeach
			 <li class="nav-item" style="font-size: 5px">
           &nbsp;
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <a href="petro.skotar.dev@gmail.com">petro.skotar.dev@gmail.com</a>
    </div>
    <!-- Default to the left -->
    <span>Copyright &copy; <?php echo date("Y") ?> - <a target="_blank">PGE Construction</a></span>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adm/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adm/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Редактор -->
<script src="{{ asset('adm/plugins/ckeditor/ckeditor.js') }}"></script>
<!-- файлы -->
<script src="{{ asset('adm/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('adm/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adm/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('adm/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('adm/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adm/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('adm/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('adm/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adm/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('adm/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('adm/plugins/ckfinder/ckfinder.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adm/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('adm/admin.js') }}?{{$v}}"></script>

</body>
</html>
