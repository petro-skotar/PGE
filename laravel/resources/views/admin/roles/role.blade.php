@extends('admin.template')

@section('content')

<form action="{{ (request()->routeIs('roles.edit') || isset($messages['save'])) ? route('roles.update', $role->id): ''}}{{ request()->routeIs('roles.create') ? route('roles.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('roles.edit') || isset($messages['save']))
	<input type="hidden" name="_method" value="put">
@endif
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper form_zone">
	<div class="fz_loagind">
		<div class="fz_loagind_wrapper">
			<div class="">
				<img src="{{ asset('adm/dist/img/loading.gif') }}" />
				<p class="">Please wait, saving in progress</p>
			</div>
		</div>
	</div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Роли пользователей <span>{{ request()->routeIs('roles.edit') ? '(Editing роли)': ''}} {{ request()->routeIs('roles.create') ? '(Creation)' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">


			<div class="btn-group float-right">
				<a href="{{route('roles.index')}}" class="btn btn-success float-right">Back</a>
				<button type="submit" class="btn btn-info float-right">Save</button>
			  </div>


          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        @if(count($errors) > 0)
		<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-ban"></i> Error<</h5>
				<ul>
				@foreach ($errors->all() as $error)
					<li>{!! $error !!}</li>
				@endforeach
				</ul>
        </div>
		@endif

        @isset($messages['save'])
		<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <span><i class="icon fas fa-check-circle"></i>{!!$messages['save']!!}</span>
        </div>
		@endisset

        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
				<h3 class="card-title">Данные</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

				  <div class="form-group">
					<label>Роль *</label>
					<input name="name" required value="{{($role->name ? $role->name : old('name') )}}" type="text" class="form-control" placeholder="Название роли">
				  </div>

                </div>
              </div>
              <!-- /.card -->

           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
            </div>
          </div>

          <div class="col-12 col-sm-6">

            <!-- general form elements disabled -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Access</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">

                    <div class="col-sm-12">

						@foreach (Config::get('cms.modules') as $mod=>$m)
							@if($m['name'])
							<div class="custom-control custom-checkbox mrb-10">
							  <input class="custom-control-input" type="checkbox" id="customCheckbox-{{$mod}}" value="{{$mod}}" name="security[{{$mod}}]" @if(in_array($mod, $roleRolesArray))checked @endif>
							  <label for="customCheckbox-{{$mod}}" class="custom-control-label"><i class="{{$m['class-icon']}}"></i> {{$m['name']}}</label>
							</div>
							@endif
						@endforeach

                    </div>

                </div>
            </div>
           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
		   </div>

		  </div>


        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</form>

@endsection
