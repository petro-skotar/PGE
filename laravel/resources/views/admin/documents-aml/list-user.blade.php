@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Участники МСИ <span>/ {{ Config::get('cms.modules.uchastniki-aml.sub.documents-aml.name') }}</span></h1>
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
                
              </div>
              <!-- /.card-header -->
			  @if (count($documents)>0)
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover text-nowrap-off listing ui-sortable">
                  @foreach($documents as $document)
					<tr class=" active_{{$document->document_view_user(Auth::user()->id)->count()}}" data-id="{{$document->id}}" data-url="{{route('documents-aml.update', $document->id)}}" >
					  <td class="align-middle pl-3 pr-4 full-width"><a class="reestr_xls" href="{{route('download_aml_files',$document->code())}}" target="_blank"><img src="{{ asset('adm/dist/img/docs/'.$document->file_icon().'.svg') }}" />{{$document->filename}}</a> </td>
					  <td class="align-middle pl-3 pr-3 text-center">@if($document->document_view_user(Auth::user()->id)->count() == 0) <span class="ano_in_td badge-success">Новый</span> @else  @endif </td>
					  <td class="align-middle pr-4 text-nowrap"> {{ Date::parse($document->created_at)->format('j F Y г. H:i') }}  </td>
					  <td class="align-middle text-right pr-4"><img class="icon_lang" src="{{ asset('adm/dist/img/flags/4x3/'.$document->lang.'.svg')}}"></td>
					  <td class="align-middle text-right">@if ($document->filepath)<a href="{{route('download_aml_files',$document->code())}}" class="btn btn-sm btn-flat" title="Скачать документ" target="_blank"><i class="fa fa-download"></i></a>@endif</td>
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