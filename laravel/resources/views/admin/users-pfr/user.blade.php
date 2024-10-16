@extends('admin.template')

@section('content')
<form action="{{ (request()->routeIs('users-pfr.edit')) ? route('users-pfr.update', $manager->id): ''}}{{ request()->routeIs('users-pfr.create') ? route('users-pfr.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('users-pfr.edit'))
	@method('PUT')
@endif
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper form_zone">
	<div class="fz_loagind">
		<div class="fz_loagind_wrapper">
			<div class="">
				<img src="{{ asset('adm/dist/img/loading.gif') }}" />
				<p class="">Ожидайте, идет сохранение</p>
			</div>
		</div>
	</div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Государства ПФР <span>/ {{ Config::get('cms.modules.uchastniki-pfr.sub.users-pfr.name') }}</span> <span>- {{ request()->routeIs('users-pfr.edit') ? 'Редактирование': ''}} {{ request()->routeIs('users-pfr.create') ? 'Создание' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Сохранить</button>            
			<a href="{{route('users-pfr.index')}}" class="btn btn-primary float-right">Назад</a>
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
          <h5><i class="icon fas fa-ban"></i> Ошибка</h5>
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
					<label>Фамилия *</label>
					<input name="surname" value="{{($manager->surname ? $manager->surname : old('surname') )}}" required type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Имя *</label>
					<input name="name" value="{{($manager->name ? $manager->name : old('name') )}}" required @if($manager->id == 1)disabled @endif type="text" class="form-control">
				  </div>
				  <div class="form-group">
					<label>Отчество</label>
					<input name="patronymic" value="{{($manager->patronymic ? $manager->patronymic : old('patronymic') )}}" type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Телефон</label>
					<input name="phone" value="{{($manager->phone ? $manager->phone : old('phone') )}}" type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Email *</label>
					<input name="email" required value="{{($manager->email ? $manager->email : old('email') )}}" @if($manager->id == 1)disabled @endif type="text" class="form-control" placeholder="Email (для входа)">
				  </div>
				  <div class="form-group">
					<label>Должность *</label>
					<input name="post" value="{{($manager->post ? $manager->post : old('post') )}}" required type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Пароль *</label>
					@if(!request()->routeIs('users-pfr.create'))
					<p>Невозможно увидеть пароль или восстановить его. Возможно только создать новый.<br>
					<a href="" class="create_new_pass">Создать новый пароль</a></p>
					@endif
					<div class="input-group new_pass @if(!request()->routeIs('users-pfr.create')) hide @endif">
						<input name="password" @if(request()->routeIs('users-pfr.create'))required @endif value="" type="text" class="form-control" placeholder="Пароль">
						<div class="input-group-append">
							<a href="" class="input-group-text create_password_key no_submit" title="Сгенерировать пароль"><i class="fas fa-key"></i></a>
						</div>
					</div>
				  </div>
				  
						
                </div>
              </div>
              <!-- /.card -->

           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info">Сохранить</button>
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
                          <input class="custom-control-input" type="checkbox" id="active" name="active" value="1" @if ($manager->active || request()->routeIs('users-pfr.create')) checked @endif>
                          <label for="active" class="custom-control-label font-weight-normal">Активный</label>
                        </div>
                      </div>
					  <hr>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="pfr_as_admin" name="pfr_as_admin" value="1" @if ($manager->pfr_as_admin) checked @endif>
                          <label for="pfr_as_admin" class="custom-control-label font-weight-normal">Открыть доступ к мероприятиям</label>
                        </div>
                      </div>
					  <hr>
					 @endif
					  <div class="form-group">
						<label>Росударство ПФР *</label>
						<select class="form-control select2" required name="pfr_artile_id">
						<option value="0">-- Не указано --</option>
						@foreach ($organizations as $r)							
							<option value="{{$r->id}}" @if(!empty($r->uchastniki_pfr_connect_user->id) && $manager->pfr_artile_id != $r->id) disabled title="К этой организации уже привязан другой пользователь: {{$r->uchastniki_pfr_connect_user->surname}} {{$r->uchastniki_pfr_connect_user->name}} {{$r->uchastniki_pfr_connect_user->patronymic}}" @endif @if($manager->pfr_artile_id == $r->id) selected @endif>{{$r->details_one->name}}</option>							
						@endforeach
						</select>
                     </div>
                    </div>

                </div>
            </div>
           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info trigger_btn">Сохранить</button>
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
