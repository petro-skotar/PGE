@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Участники МСИ <span>/ {{ Config::get('cms.modules.uchastniki-aml.sub.documents-aml.name') }}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <a href="{{route('documents-aml.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Создать</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
          @if ($documents)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список документов {!! ($table_search ? '<span class="table_search_title">|<b>Результаты поиска</b>: <u>'.$table_search.'</u></span>':'') !!}</h3>
                <div class="card-tools">
                  <form class="input-group input-group-sm" style="width: 150px;" action="{{ route('documents-aml.index') }}" method="GET">
                    <input type="text" name="table_search" class="form-control float-right" value="{{ $table_search }}" placeholder="Найти">
					<div class="input-group-append">
                      <button type="submit" class="btn btn-default" name="table_search_submit" value="1"><i class="fas fa-search"></i></button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
			  @if (count($documents)>0)
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover text-nowrap-off listing ui-sortable">
                  @foreach($documents as $document)
					<tr data-id="{{$document->id}}" data-url="{{route('documents-aml.update', $document->id)}}" >
					  <td class="align-middle pl-3 pr-4 full-width"><a class="reestr_xls" href="{{route('documents-aml.edit', $document->id)}}"><img src="{{ asset('adm/dist/img/docs/'.$document->file_icon().'.svg') }}" />{{$document->filename}}</a></td>
					  <td class="align-middle pr-4 text-nowrap"> {{ Date::parse($document->created_at)->format('j F Y г. H:i') }}  </td>
					  <td class="align-middle pr-4">
						<div class="text-nowrap">@if($document->open_for_all_users) <i title="Доступен всем" class="fa fa-users"></i> @elseif(count($document->users))<i class="far fa-user" title="Доступен"></i> {{count($document->users)}}@endif</div>
					  </td>
					  <td class="align-middle pr-4">
						@if($document->open_for_all_users || count($document->users))
						<div class="text-nowrap"><i title="Количество пользователей, которые просмотрели документ" class="fa fa-eye"></i> {{count($document->document_view_users)}}</div>
						@endif
					  </td>
					  <td class="align-middle">
						<div class="custom-control custom-switch ajax_check">
						  <input type="checkbox" @if ($document->active)checked="checked" @endif class="custom-control-input active" name="active" id="active{{$document->id}}">
						  <label class="custom-control-label" for="active{{$document->id}}"></label>
						</div>
					  </td>
					  <td class="align-middle text-right pr-4"><img class="icon_lang" src="{{ asset('adm/dist/img/flags/4x3/'.$document->lang.'.svg')}}"></td>
					  <td class="align-middle text-right">@if ($document->filepath)<a href="{{route('download_aml_files',$document->code())}}" class="btn btn-sm btn-flat" title="Скачать документ" target="_blank"><i class="fa fa-download"></i></a>@endif</td>
					  <td class="align-middle">
						  <div class="btn-group">
							<a href="{{route('documents-aml.edit', $document->id)}}" class="btn btn-sm btn-flat" title="Edit {{$document->id}}"><i class="far fa-edit"></i></a>
							@if($document->id==1)
							<button type="submit" class="btn btn-sm btn-flat disabled" title="Главного администратора нельзя удалить"><i class="far fa-trash-alt"></i></button>
							@else
							<form action="{{ route('documents-aml.destroy' , $document->id)}}" method="POST">
								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
								<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
							</form>
							@endif
						  </div>
					  </td>
					</tr>
				  @endforeach
                </table>
              </div>
			  @else
				<div class="card-body table-responsive">
					<p>По вашему запросу ничего не найдено</p>
					@if($table_search)
						<p><a href="{{ route('documents-aml.index') }}">Назад к списку</a></p>
					@endif
				</div>
            @endif
              <!-- /.card-body -->



            </div>
            <!-- /.card -->
            @endif
          </div>
        </div>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
