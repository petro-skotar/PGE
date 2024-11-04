@extends('admin.template')

@section('content')
<form action="{{ (request()->routeIs('documents-aml.edit')) ? route('documents-aml.update', $document->id): ''}}{{ request()->routeIs('documents-aml.create') ? route('documents-aml.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('documents-aml.edit'))
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
            <h1 class="m-0 text-dark">Участники МСИ <span>/ {{ Config::get('cms.modules.uchastniki-aml.sub.documents-aml.name') }}</span> <span>- {{ request()->routeIs('documents-aml.edit') ? 'Editing': ''}} {{ request()->routeIs('documents-aml.create') ? 'Creation' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Save</button>
			<a href="{{route('documents-aml.index')}}" class="btn btn-primary float-right">Back</a>
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

        @isset($messages['save'])
		<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <span><i class="icon fas fa-check-circle"></i>{!!$messages['save']!!}</span>
        </div>
		@endisset

        <div class="row">
          <div class="col-12 col-sm-8">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
				<h3 class="card-title">Данные</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

				  <div class="form-group">
					<label>Название файла *</label>
					<input name="filename" value="{{($document->filename ? $document->filename : old('filename') )}}" required type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Файл</label>
					<div class="custom-file">
					  <input type="file" class="custom-file-input" @if (request()->routeIs('documents-aml.create')) required @endif name="filepath" id="filepath">
					  <label class="custom-file-label" for="filepath">Выбрать файл</label>
					</div>
					@if($document->filepath)
					<div class="filepath_img">
						<div class="custom-control custom-checkbox">
						  <input class="custom-control-input" type="checkbox" id="filepath_remove" name="filepath_remove" value="1" >
						  <label for="filepath_remove" class="custom-control-label font-weight-normal">Удалить файл после сохранения</label>
						</div>
						<div class="file_rezult">
							<a href="{{route('download_aml_files',$document->code())}}" target="_blank">Скачать загруженый файл</a>
						</div>
					</div>
					@endif
				  </div>
						<hr>
					 <div class="form-group">
						<label>Открыть доступ:</label>

						<div class="custom-control custom-radio mb-2">
						  <input class="custom-control-input" type="radio" id="open_for_all_users_1" name="open_for_all_users" @if($document->open_for_all_users == 1) checked @endif value="1" >
						  <label for="open_for_all_users_1" class="custom-control-label font-weight-normal"><b>Всем</b></label>
						</div>
						<div class="custom-control custom-radio mb-2">
						  <input class="custom-control-input" type="radio" id="open_for_all_users_0" name="open_for_all_users" @if($document->open_for_all_users == 0) checked @endif value="0" >
						  <label for="open_for_all_users_0" class="custom-control-label font-weight-normal"><b>Конкретным пользователям</b></label> <a href="" class="check_all_other_users_aml @if($document->open_for_all_users == 0) open @endif">выбрать всех</a>
						</div>

						<div class="other_users_aml active">
							@if(!empty($users_aml))
								<table class="table table-sm">
								@foreach ($users_aml as $user)
								<tr>
									<td class="align-middle">
										<div class="custom-control custom-checkbox mb-2">
										  <input class="custom-control-input" type="checkbox" id="users_id_{{$user->id}}" name="users_id[{{$user->id}}]" @if($document->users->pluck('user_id')->contains($user->id)) checked @endif value="1" >
										  <label for="users_id_{{$user->id}}" class="custom-control-label font-weight-normal"><b>{{$user->surname}} {{$user->name}} {{$user->patronymic}}</b>
										  @if($user->aml_artile_id)({{$user->organization_aml($user->aml_artile_id)->details_one->name}})@endif</label>
										</div>
									</td>
									<td class="align-middle text-right pl-3 pr-2" style="width: 160px;" title="Документ просмотрен">
										@if($document->document_view_user($user->id)->count() > 0)
											<span class="viewed active"><i class="fa fa-eye"></i></span>
											{{ Date::parse($document->document_view_user($user->id)->first()['created_at'])->format('Y-m-d H:i') }}
										@endif
									</td>
								@endforeach
								</table>
							@else
								<p>Нет пользователей</p>
							@endif
						</div>

                      </div>
					  <style>
						.viewed{
							font-size: 14px;
							color: #dfdfdf;
							margin-right: 4px;
						}
						.viewed.active{
							color: #343a40;
						}
					  </style>
                </div>
              </div>
              <!-- /.card -->

           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
            </div>
          </div>

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
                          <input class="custom-control-input" type="checkbox" id="active" name="active" value="1" @if ($document->active || request()->routeIs('documents-aml.create')) checked @endif>
                          <label for="active" class="custom-control-label font-weight-normal">Активный</label>
                        </div>
                      </div>

					  <div class="form-group">
						<label>Язык</label>
						@foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $lang => $lang_details)
						<div class="custom-control custom-radio">
						  <input class="custom-control-input" type="radio" id="lang_{{$lang}}" name="lang" @if ($document->lang == $lang) checked @endif value="{{$lang}}">
						  <label for="lang_{{$lang}}" class="custom-control-label font-weight-normal">{{$lang}}</label>
						</div>
						@endforeach
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
