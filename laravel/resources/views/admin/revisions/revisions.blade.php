@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		  <div class="col-sm-8">
			<h1 class="text-dark">{{ Config::get('cms.modules.statistics.name') }}</h1>				
		  </div><!-- /.col -->
		  <div class="col-sm-4">
			<a href="{{ route('revisions_export') }}?date_start={{$filter['date_start']}}&date_end={{$filter['date_end']}}" class="btn btn-success float-right mr-2"><i class="fas fa-file-export"></i> &nbsp;Экспорт текущей выборки</a>	  </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список документов</h3>
                <div class="card-tools">
                  <form class="form-group" action="" id="revisions_filter_form" method="get">
					<input type="hidden" id="date_start" name="date_start" value="{{ $filter['date_start'] }}">
					<input type="hidden" id="date_end" name="date_end" value="{{ $filter['date_end'] }}">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="far fa-clock"></i></span>
						</div>
						<input type="text" class="form-control float-right" id="reservationtime">
					</div>
				  </form>
                </div>
              </div>
              <!-- /.card-header -->
          @if (count($revisions)>0)
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover text-nowrap listing ui-sortable">
                  @foreach($revisions as $revision)
				   @if($revision->document())
					<tr data-id="{{$revision->id}}" >
						<td class="align-middle  pl-3">
							<span class="handle">
								<i class="far fa-file-alt"></i>
							</span>
						</td>
					  <td class="align-middle full-width pl-2 pr-4"><a href="javascript:viod(0">{{ $revision->document()->filename }}</a></td>
					  <td class="align-middle full-width pl-2 pr-4"><a class="" title="Категория" href="{{route('mediateka.index')}}?type=documents&parent_id={{$revision->document()->category_id}}" target="_blank">{{ $revision->document()->category()->name_ru }}</a></td>
					  <td class="align-middle pl-2 pr-4"><span class="none_lang">{{ $revision->document()->filetype }}</span></td>
					  <td class="align-middle pl-2"><a href="javascript:viod(0)" title="Просмотрено страницу документа" class="btn btn-sm btn-flat"><i class="far fa-eye"></i> {{ count($revision->views($filter)) }}</a></td>
					  <td class="align-middle pr-4"><a href="javascript:viod(0)" title="Количество скачиваний/чтений документа (файла)" class="btn btn-sm btn-flat"><i class="{{ ( $revision->document()->category_type == 'video' ? 'far fa-play-circle' : 'far fa-arrow-alt-circle-down' ) }}"></i> {{ count($revision->downloads($filter)) }}</a></td>
					  <td class="align-middle text-right"><a href="{{route('viewDocument',$revision->parent_id)}}" class="btn btn-sm btn-flat" title="Открыть на сайте" target="_blank"><i class="fas fa-desktop"></i></a></td>
					</tr>
					@endif
				  @endforeach
                </table>
				
				<div class="">
				{{ $revisions->appends(request()->query())->links('vendor.pagination.tailwind') }}             
			    </div>
			  
              </div>
            @else
				<div class="card-body table-responsive">
					<p>Нет данных</p>
				</div>
            @endif
              <!-- /.card-body -->
              
             </div> 
            <!-- /.card -->
          </div>
        </div>
        
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection