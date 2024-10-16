@extends('admin.template')

@section('content')

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
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Участники МСИ <span>/ {{ Config::get('cms.modules.uchastniki-aml.sub.reestr-aml.name') }}</span></h1>
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
         <div class="col-12 col-sm-8">
          @if ($ReestrAML)		  
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список файлов {!! ($table_search ? '<span class="table_search_title">|<b>Результаты поиска</b>: <u>'.$table_search.'</u></span>':'') !!}</h3>
                <div class="card-tools">
                  <form class="input-group input-group-sm" style="width: 150px;" action="{{ route('reestr-aml.index') }}" method="GET">
                    <input type="text" name="table_search" class="form-control float-right" value="{{ $table_search }}" placeholder="Найти">
					<div class="input-group-append">
                      <button type="submit" class="btn btn-default" name="table_search_submit" value="1"><i class="fas fa-search"></i></button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
			  @if (count($ReestrAML)>0)
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover text-nowrap-off listing ui-sortable">
                  @foreach($ReestrAML as $item)
	                    <tr data-id="{{$item->id}}" data-url="{{route('reestr-aml.update', $item->id)}}" >
	                      <td class="align-middle pl-4 pr-4 text-center full-width">
							<a class="reestr_xls" target="_blank" href="{{route('download_reestr_files',$item->code())}}"><img src="{{ asset('adm/dist/img/docs/xls.svg') }}" />{{$item->name}}</a>
						  </td>
	                      <td class="align-middle pl-4 fs14 text-nowrap">
							{{ Date::parse($item->created_at)->format('j F Y г. H:i') }}
						  </td>
	                      <td class="align-middle">
	                      	  <div class="btn-group">
		                        <form action="{{ route('reestr-aml.destroy' , $item->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
		                        </form>
		                      </div>
	                      </td>
	                    </tr>
					 
				  @endforeach
                </table>
              </div>
			  @else
				<div class="card-body table-responsive">
					@if($table_search)
						<p>По вашему запросу ничего не найдено</p>
						<p><a href="{{ route('reestr-aml.index') }}">Назад к списку</a></p>
					@else
						<p>Еще нет файлов</p>
					@endif
				</div>
            @endif
              <!-- /.card-body -->
               
            </div>
            <!-- /.card -->
            @endif
			
			
          </div>
			
         <div class="col-12 col-sm-4">
		<form action="{{ request()->routeIs('reestr-aml.create') ? route('reestr-aml.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
					<div class="card card-primary card-outline card-outline-tabs">
					  <div class="card-header">                
						<h3 class="card-title">Загрузка нового файла</h3>
					  </div>
					  <div class="card-body">
						<div class="tab-content" id="custom-tabs-four-tabContent">
						  
						  <div class="form-group">
							<label>Имя файла *</label>
							<input name="name" value="{{old('name')}}" required type="text" class="form-control">
						  </div>
								
							<div class="form-group">
								<label>Файл *</label>
								<div class="custom-file">
								  <input type="file" class="custom-file-input" name="filename" id="filename">
								  <label class="custom-file-label" for="filename">Выбрать файл</label>
								</div>
							</div>
					</div>
					</div>
						<div class="card-footer">
						  <button type="submit" class="btn btn-info trigger_btn">Загрузить</button>
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