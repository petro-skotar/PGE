@extends('admin.template')

@section('content')

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
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Участники МСИ <span>/ {{ Config::get('cms.modules.uchastniki-aml.sub.napravlenia_list.name') }}</span></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Main content -->
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
         <div class="col-12 col-md-8">
                @php $k=0 @endphp
                  @foreach($Article_details as $details)
	                @foreach($details->napravlenia_list as $napravlenia)
						@php $k=$k+1 @endphp
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
					<table class="table text-nowrap-off listing ui-sortable">
						<tr class="tr_head">
                          <td class="align-middle pl-3 pr-4 full-width">
                            <b>[{{$details->lang}}] {{$napravlenia->name}}</b>
						  </td>
	                      <td class="align-middle mw-100">
							<b>{{$napravlenia->kod}}</b>
						  </td>
	                      <td class="align-middle pl-4 mw-200">
							<b>{{$napravlenia->qualification}}</b>
						  </td>
	                      <td class="align-middle pr-2">
							  <div class="btn-group">
	                      	  <a href="" class="btn btn-sm btn-flat edit_napravlenia" title="Edit"><i class="far fa-edit"></i></a>
		                        <form action="{{ route('napravlenia_list.destroy', $napravlenia->id)}}" method="POST">
									<input type="hidden" name="type" value="napravlenia" />
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить это направление вместе с ее программами?')" title="Удалить направление"><i class="far fa-trash-alt"></i></button>
		                        </form>
		                      </div>
	                      </td>
	                    </tr>
						<tr class="tr_head napravlenia_form hidden">
                          <td colspan="4">
                            <form action="{{ route('napravlenia_list.update', $napravlenia->id) }}" method="post"  enctype="multipart/form-data" id="form">@csrf
								<input type="hidden" name="_method" value="put">
								<input type="hidden" name="type" value="napravlenia" />
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<input type="text" class="form-control" required name="name" value="{{$napravlenia->name}}" placeholder="Наименование направления / специальности *" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" name="kod" value="{{$napravlenia->kod}}" placeholder="Код" />
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<input type="text" class="form-control" name="qualification" value="{{$napravlenia->qualification}}" placeholder="Квалификация" />
										</div>
									</div>
								</div>
								<div class="row">
								  <div class="col-6">
									<input type="submit" class="btn btn-sm btn-info" value="Сохранить" />
								  </div>
								  <div class="col-6 text-right">
									<button class="btn btn-sm btn-danger hide_napravlenia_form">Отмена</button>
								  </div>
								</div>
							</form>
	                      </td>
	                    </tr>
						<tr>
							<td colspan="4" class="pl-3 pr-3">
								 @foreach($napravlenia->programs as $program)
									<table class="table table-bordered" style="background: #ffffff; margin: 4px 0 0 0;">
									<tr>
									  <td class="pl-3 pr-3 align-middle" style="padding: 5px 0; width: 100%; background: #f9f9f9;">
										<b>{{$program->name}}</b>

										<form class="program_form hidden" action="{{ route('napravlenia_list.update', $program->id) }}" method="post"  enctype="multipart/form-data" id="form">@csrf
											<input type="hidden" name="_method" value="put">
											<input type="hidden" name="type" value="programs" />
											<br>
											<div class="card card-primary card-outline card-outline-tabs">
											  <div class="card-body">
												<div class="tab-content" id="custom-tabs-four-tabContent">
													<div class="row">
													  <div class="col-12">
														<div class="form-group">
														  <input type="text" class="form-control" required name="name" value="{{$program->name}}" placeholder="Название программы">
														</div>
													  </div>
												   </div>
												</div>
											  </div>
											  <div class="card-footer">
												<div class="row">
												  <div class="col-12 col-md-6">
													<input type="submit" class="btn btn-sm btn-info" name="add_files" value="Сохранить" />
												  </div>
												  <div class="col-12 col-md-6 text-right">
													<button type="submit" class="btn btn-sm btn-danger hide_pr_button" name="hide_program">Отмена</button>
												  </div>
												</div>
											  </div>
											 </div>
										</form>

									  </td>
									  <td class="pl-0 pr-0 align-middle text-center" style="padding: 5px 0; background: #f9f9f9;">
										  <div class="btn-group">
										  <a href="" class="btn btn-sm btn-flat edit_programs" title="Edit"><i class="far fa-edit"></i></a>
											<form action="{{ route('napravlenia_list.destroy', $program->id)}}" method="POST">
												<input type="hidden" name="type" value="programs" />
												<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
												<button type="submit" class="btn btn-sm btn-flat" onclick="return confirm('Действительно удалить эту программу?')" title="Удалить программу"><i class="far fa-trash-alt"></i></button>
											</form>
										  </div>
									  </td>
									 </tr>
									 <tr>
									  <td colspan="2" class="pl-3 pr-3 mw-400 list_prog_files">
										@if(count($program->files())>0)
										<table class="table table-sm">
										 <tbody>
										 @foreach($program->files() as $file)
											<tr>
												<td class="pl-3 pr-3"  style="width: 100%;">
													<a @if($file->filepath)href="{{route('download_programs_files',$file->code())}}" target="_blank" @endif title="{{ $file->name }}">{{ $file->name }}</a>
												</td>
												<td class="pl-1 pr-1">
													<form action="{{ route('napravlenia_list.destroy', $file->id)}}" method="POST">
														<input type="hidden" name="type" value="files" />
														<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
														<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить этот файл?')" title="Удалить файл"><i class="far fa-trash-alt"></i></button>
													</form>
												</td>
											</tr>
										 @endforeach
										 </tbody>
										 </table>
										 @endif
										<div class="add_new_aml_file">
											<a href="">+ <span>Добавить файл</span></a>
										</div>
										<div class="row form_new_aml_file">
											<div class="col-12">
												<form action="{{ route('napravlenia_list.store') }}" method="post"  enctype="multipart/form-data" id="form">@csrf
													<input type="hidden" name="type" value="files" />
													<input type="hidden" name="program_id" value="{{$program->id}}" />
													<div class="card card-primary card-outline card-outline-tabs">
													  <div class="card-body">
														<div class="tab-content" id="custom-tabs-four-tabContent">
															<div class="row">
															  <div class="col-12">
																<div class="form-group">
																  <input type="text" class="form-control" required name="name" id="name" placeholder="Название файла">
																  <div class="ano pt4">
																	  Например:<br>
																	  - Образовательная программ<br>
																	  - Учебный план и график<br>
																	  - Рабочие программы дисциплин в сфере ПОД/ФТ
																  </div>
																</div>
																<div class="form-group">
																	<div class="custom-file">
																	  <input type="file" class="custom-file-input" required name="new_file" id="new_file">
																	  <label class="custom-file-label" for="new_file">Выбрать файл</label>
																	</div>
																</div>
															  </div>
														   </div>
														</div>
													  </div>
													  <div class="card-footer">
														<div class="row">
														  <div class="col-12 col-md-6">
															<input type="submit" class="btn btn-sm btn-info" name="add_files" value="Сохранить" />
														  </div>
														  <div class="col-12 col-md-6 text-right">
															<button type="submit" class="btn btn-sm btn-danger hide_file_button" name="hide_program">Отмена</button>
														  </div>
														</div>
													  </div>
													 </div>
												</form>
											</div>
										</div>
									  </td>
									 </tr>
								</table>
								<br>
								 @endforeach
								<div class="text-right add_new_aml_programs">
									<a href="">+ <span>Добавить программу</span></a>
								</div>
								<div class=" form_new_aml_programs">
									<form action="{{ route('napravlenia_list.store') }}" method="post"  enctype="multipart/form-data" id="form">@csrf
										<input type="hidden" name="type" value="programs" />
										<input type="hidden" name="napravlenia_id" value="{{$napravlenia->id}}" />
										<div class="card card-primary card-outline card-outline-tabs">
										  <div class="card-header">
											<h3 class="card-title">Новая программа</h3>
										  </div>
										  <div class="card-body">
											<div class="tab-content" id="custom-tabs-four-tabContent">
												<div class="row">
												  <div class="col-12">
													  <div class="form-group">
														<textarea name="name" required class="form-control" style="height: 127px;" placeholder="Название программы" />{{old('name')}}</textarea>
													  </div>
												  </div>
											   </div>
											</div>
										  </div>
										  <div class="card-footer">
											<div class="row">
											  <div class="col-12 col-md-6">
												<input type="submit" class="btn btn-info trigger_btn" name="add_program" value="Сохранить" />
											  </div>
											  <div class="col-12 col-md-6 text-right">
												<button type="submit" class="btn btn-danger trigger_btn hide_program_button" name="hide_program">Отмена</button>
											  </div>
											</div>
										  </div>
										 </div>
									</form>
								</div>
							</td>
	                    </tr>
					</table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
					@endforeach
				  @endforeach
				  @if($k==0)
					<div class="card-body table-responsive">
						<p>Нет направлений</p>
					</div>
				  @endif


          </div>

			<div class="col-12 col-md-4">
				<form action="{{ route('napravlenia_list.store') }}" method="post"  enctype="multipart/form-data" id="form">@csrf
					<input type="hidden" name="type" value="napravlenia" />
					<div class="card card-primary card-outline card-outline-tabs">
					  <div class="card-header">
						<h3 class="card-title">Creation нового направления</h3>
					  </div>
					  <div class="card-body">
						<div class="tab-content" id="custom-tabs-four-tabContent">

						  <div class="form-group">
							<label>Наименование направления / специальности *</label>
							<input name="name" value="{{old('name')}}" required type="text" class="form-control">
						  </div>

						  <div class="form-group">
							<label>Код</label>
							<input name="kod" value="{{old('kod')}}" type="text" class="form-control">
						  </div>

						  <div class="form-group">
							<label>Квалификация</label>
							<input name="qualification" value="{{old('qualification')}}" type="text" class="form-control">
						  </div>

						  <div class="form-group">
							<label>Язык *</label>
							@foreach($Article_details as $details)
							<div class="custom-control custom-radio">
							  <input class="custom-control-input" type="radio" id="details_id_{{$details->id}}" name="details_id" @if ($details->lang == 'ru') checked @endif value="{{$details->id}}">
							  <label for="details_id_{{$details->id}}" class="custom-control-label font-weight-normal">{{$details->lang}}</label>
							</div>
							@endforeach
						  </div>

					</div>
					</div>
						<div class="card-footer">
						  <button type="submit" class="btn btn-info trigger_btn">Create a direction</button>
						</div>
				   </div>
				</form>
			</div>

        </div>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
