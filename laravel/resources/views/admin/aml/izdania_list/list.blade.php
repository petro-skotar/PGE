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
            <h1 class="m-0 text-dark">Участники МСИ <span>/ {{ Config::get('cms.modules.uchastniki-aml.sub.izdania_list.name') }}</span></h1>
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
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
				@php $k=0 @endphp
                <table class="table table-hover text-nowrap-off listing ui-sortable">
				  @foreach($Article_details as $details)
	                @foreach($details->izdania_list as $item)
						@php $k=$k+1 @endphp
						<tr class="">
                          <td class="align-middle pl-3 pr-4 full-width">
                            <b></b>
							<a @if($item->filepath)href="{{route('download_izdania_files',$item->code())}}" target="_blank" @endif>[{{$details->lang}}] {{$item->name}}</a><br>
						  </td>
	                      <td class="align-middle pr-2">
	                      	  <div class="btn-group">
		                        <form action="{{ route('izdania_list.destroy', $item->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
		                        </form>
		                      </div>
	                      </td>
	                    </tr>
					@endforeach
				  @endforeach
                </table>
			  @if($k==0)
				<div class="card-body table-responsive">
					<p>Нет публикаций</p>
				</div>
              @endif
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>

			<div class="col-12 col-md-4">
				<form action="{{ route('izdania_list.store') }}" method="post"  enctype="multipart/form-data" id="form">@csrf
					<div class="card card-primary card-outline card-outline-tabs">
					  <div class="card-header">
						<h3 class="card-title">Добавление новой публикации</h3>
					  </div>
					  <div class="card-body">
						<div class="tab-content" id="custom-tabs-four-tabContent">

						  <div class="form-group">
							<label>Название *</label>
							<input name="name" value="{{old('name')}}" required type="text" class="form-control">
						  </div>
						  <div class="form-group">
							<label>Файл *</label>
								<div class="custom-file">
								  <input type="file" required class="custom-file-input" name="filepath" id="filepath">
								  <label class="custom-file-label" for="filepath">Выберите файл</label>
								</div>
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
						  <button type="submit" class="btn btn-info trigger_btn">Добавить публикацию</button>
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
