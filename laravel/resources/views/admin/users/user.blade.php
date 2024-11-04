@extends('admin.template')

@section('content')
<form action="{{ (request()->routeIs('users.edit')) ? route('users.update', $manager->id): ''}}{{ request()->routeIs('users.create') ? route('users.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('users.edit'))
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
            <h1 class="m-0 text-dark">Пользователи <span>{{ request()->routeIs('users.edit') ? '(Editing)': ''}} {{ request()->routeIs('users.create') ? '(Creation)' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
			<button type="submit" class="btn btn-info float-right"><i class="icon fas fa-save"></i>&nbsp; Сохранить</button>
			<a href="{{route('users.index')}}" class="btn btn-success float-right mr-2">Back</a>
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
          <div class="col-12 col-sm-8">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
				<h3 class="card-title">Data</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

				  <div class="form-group">
					<label>Фамилия</label>
					<input name="surname" value="{{($manager->surname ? $manager->surname : old('surname') )}}" type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Name *</label>
					<input name="name" value="{{($manager->name ? $manager->name : old('name') )}}" required @if($manager->id == 1)disabled @endif type="text" class="form-control" placeholder="Имя администратора">
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
					<input name="email" value="{{($manager->email ? $manager->email : old('email') )}}" required @if($manager->id == 1)disabled @endif type="text" class="form-control" placeholder="Email (для входа)">
				  </div>
				  <div class="form-group">
					<label>Место работы *</label>
					<input name="place_of_work" value="{{($manager->place_of_work ? $manager->place_of_work : old('place_of_work') )}}" required type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Job title *</label>
					<input name="post" value="{{($manager->post ? $manager->post : old('post') )}}" required type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Город</label>
					<input name="city" value="{{($manager->city ? $manager->city : old('city') )}}" type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Дата рождения <span>(формат: 31-12-2021)</span></label>
					<input id="birthday" name="birthday" value="{{($manager->birthday ? Date::parse($manager->birthday)->format('d-m-Y') : old('birthday') )}}" type="text" class="form-control" placeholder="dd-mm-YYYY">
				  </div>
				  <div class="form-group">
					<label>Комментарий</label>
					<textarea class="form-control" id="comments" rows="3" name="comments">{{($manager->comments ? $manager->comments : old('comments') )}}</textarea>
				  </div>




					 <div class="form-group">

						<div class="input-group-append" style="display: none;">
							<input name="password" value="" type="text" class="form-control @if(request()->routeIs('users.create')) auto_create_password @endif" placeholder="Новый пароль">
							<a style="display: none1;" href="" class="input-group-text create_password" title="Сгенерировать пароль" target="_blank"><i class="fas fa-key"></i></a>
						</div>
					@if(request()->routeIs('users.create'))
						<div class="alert callout callout-info">
						  <h5 class="h_only"><i class="icon fas fa-info"></i> Пароль будет создан автоматически и отправлен на почту пользователю</h5>
						</div>
						<div class="form-group" style="display: none;">
							<div class="custom-control custom-checkbox">
							  <input class="custom-control-input" type="checkbox" id="send_to_email" checked name="send_to_email" value="1" >
							  <label for="send_to_email" class="custom-control-label font-weight-normal">Отправить данные для входа на указанный выше Email</label>
							</div>
						</div>
					@endif

					</div>



                </div>
              </div>
              <!-- /.card -->

           	    <div class="card-footer">
				@if(request()->routeIs('users.create'))
                  <button type="submit" class="btn btn-info">Создать пользователя</button>
				@endif
				@if(request()->routeIs('users.edit'))
				<div class="btn-group-">
                    <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>&nbsp; Просто сохранить</button>
					<button type="submit" class="btn btn-primary create_password create_password_and_send_to_user" name="create_password_and_send_to_user" title="Создать новый пароль и отправить его пользователю на почту" value="1" target="_blank"><i class="fas fa-key"></i>&nbsp; Создать новый пароль и отправить его пользователю на почту &nbsp;<i class="fa fa-envelope"></i></button>
				</div>
				@endif
                </div>
            </div>
          </div>

		@if(!request()->routeIs('users.create'))
          <div class="col-12 col-sm-4">

            <!-- general form elements disabled -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Access</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">

                    <div class="col-sm-12">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="active" name="active" value="1" @if ($manager->active) checked @endif>
                          <label for="active" class="custom-control-label font-weight-normal">Активен</label>
                        </div>
                      </div>
					  @if(!request()->routeIs('users.create') && $manager->send_verify_registration == 0)
                      <div class="form-group">
                         <input type="submit" class="btn btn-success" name="send_verify_registration" value="Подтвердить" />
                         <br><br>
						 <input type="submit" class="btn btn-danger" name="send_verify_registration_off" value="Отклонить" />
                      </div>
					  @endif
					  <hr>
                    </div>

                </div>
            </div>
           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
		   </div>

		  </div>
		@endif

        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</form>

@endsection
