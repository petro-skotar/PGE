@extends('admin.template')

@section('content')
<form action="{{ (request()->routeIs('managers.edit')) ? route('managers.update', $manager->id): ''}}{{ request()->routeIs('managers.create') ? route('managers.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('managers.edit'))
	@method('PUT')
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
            <h1 class="m-0 text-dark">Администраторы <span>{{ request()->routeIs('managers.edit') ? '(Editing)': ''}} {{ request()->routeIs('managers.create') ? '(Creation)' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Save</button>
			<a href="{{route('managers.index')}}" class="btn btn-primary float-right">Back</a>
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

        @if (!empty(Session::get('messages_save')))
		<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <span><i class="icon fas fa-check-circle"></i>{!!Session::get('messages_save')!!}</span>
			@if (!empty(Session::get('user_create_new_password_send_result')))
				<br>
				<span><i class="icon fas fa-check-circle"></i>{!!Session::get('user_create_new_password_send_result')!!}</span>
			@endisset
			@if (!empty(Session::get('user_registrations_on_site_confirm_send')))
				<br>
				<span><i class="icon fas fa-check-circle"></i>{!!Session::get('user_registrations_on_site_confirm_send')!!}</span>
			@endisset
			@if (!empty(Session::get('user_registrations_on_event_confirm_send')))
				<br>
				<span><i class="icon fas fa-check-circle"></i>{!!Session::get('user_registrations_on_event_confirm_send')!!}</span>
			@endisset
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
					<label>Имя *</label>
					<input name="name" required value="{{($manager->name ? $manager->name : old('name') )}}"  @if($manager->id == 1)readonly @endif type="text" class="form-control" placeholder="Имя администратора">
				  </div>
				  <div class="form-group">
					<label>Email *</label>
					<input name="email" required value="{{($manager->email ? $manager->email : old('email') )}}" @if($manager->id == 1)readonly @endif type="text" class="form-control" placeholder="Email (для входа)">
				  </div>
				  <div class="form-group">
					<label>Пароль</label>
					@if(!request()->routeIs('managers.create'))
						<br>
					<a href="" class="create_new_pass">Create a new password</a></p>
					@endif
					<div class="input-group new_pass @if(!request()->routeIs('managers.create')) hide @endif">
						<input name="password" @if(request()->routeIs('users-aml.create'))required @endif value="" type="text" class="form-control" placeholder="Пароль">
						<div class="input-group-append">
							<a href="" class="input-group-text create_password_key no_submit" title="Сгенерировать пароль"><i class="fas fa-key"></i></a>
						</div>
					</div>
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
                <h3 class="card-title">Доступ</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">

                    <div class="col-sm-12">
					  @if($manager->id != 1)
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="active" name="active" value="1" @if ($manager->active) checked @endif>
                          <label for="active" class="custom-control-label font-weight-normal">Активный</label>
                        </div>
                      </div>
					 @endif
					  <div class="form-group">
						<label>Роль</label>
						<select class="form-control select2" @if($manager->id == 1)disabled="disabled" @endif name="role_id">
						@foreach ($roles as $r)
							@if($r->id != 1 || $manager->id == 1)
							<option value="{{$r->id}}" @if ($manager->role_id == $r->id) selected @endif>{{$r->name}}</option>
							@endif
						@endforeach
						</select>
                     </div>
                    </div>

                </div>
            </div>
           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info trigger_btn">Save</button>
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
