@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1 class="m-0 text-dark">Медиатека</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
			  <div style="display: flex; justify-content: flex-end; align-items: center; flex-wrap: wrap;">
				  <form class="input-group input-group mb-2" style="max-width: 280px;" action="{{ route('mediateka.index') }}" method="GET">
					<input type="text" name="table_search" class="form-control float-right" value="{{ $table_search }}" placeholder="Найти">
					<div class="input-group-append">
					  <button type="submit" class="btn btn-default" name="table_search_submit" value="1"><i class="fas fa-search"></i></button>
					</div>
				  </form>
					@if($type == 'categories')
					<a href="{{route('mediateka.create')}}?type=category" class="btn btn-info float-right ml-2 mb-2 text-nowrap"><i class="fas fa-plus"></i> Создать раздел</a>
					@else
					<a href="{{route('mediateka.create')}}?type=document{{(!empty($_GET['parent_id']) ? '&parent_id='.$_GET['parent_id'] : '')}}" class="btn btn-info float-right ml-2 mb-2 text-nowrap"><i class="fas fa-plus"></i> Создать новый документ</a>
					@endif
					<!-- a href="{{route('mediateka.create')}}?type=document{{(!empty($_GET['parent_id']) ? '&parent_id='.$_GET['parent_id'] : '')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Создать документ</a>-->
			  </div>
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
			  @if (!empty($MediatekaCategories))
						 
				<div class="card">
				  <div class="card-header">
					<h3 class="card-title">Список разделов</h3>
										
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body table-responsive p-0">
					<table class="table table-sm table-hover text-nowrap listing ui-sortable">
						@include('admin.mediateka.item_categories', ['MediatekaCategories' => $MediatekaCategories])				
					</table>
				  </div>
				  <!-- /.card-body -->               
				  
					<div class="card-footer">
						<div class="row">	
							<div class="col-sm-12">	
								<a href="{{route('mediateka.create')}}?type=category" class="btn btn-info"><i class="fas fa-plus"></i> Создать раздел</a>
							</div>
						</div>
					</div>			
				</div>
				<!-- /.card -->
				
			  @endif
			  
			  @if (!empty($MediatekaCategories_for_Events))
						 
				<div class="card">
				  <div class="card-header">
					<h3 class="card-title">Список документов мероприятий</h3>
					
					
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body table-responsive p-0">
					<table class="table table-sm table-hover text-nowrap listing ui-sortable">
						@include('admin.mediateka.item_categories', ['MediatekaCategories' => $MediatekaCategories_for_Events])				
					</table>
				  </div>
				  <!-- /.card-body -->               
				  
					<div class="card-footer">
						<div class="row">	
							<div class="col-sm-12">	
								<a href="{{route('mediateka.create')}}?type=category" class="btn btn-info"><i class="fas fa-plus"></i> Создать раздел</a>
							</div>
						</div>
					</div>			
				</div>
				<!-- /.card -->
				
			@endif
			
			@if ($type=='documents')			
			
				<div class="card">
				  <!-- /.card-header -->
					@if($documents->count())
					  @include('admin.mediateka.item_document', ['documents' => $documents])
					@else
					  <div class="card-body table-responsive">
						<div class="row">	
							<div class="col-sm-12">	
								@if(!$table_search)
									<p>В этом разделе еще нет документов.</p>
								@else
									<p>По вашему запросу ничего не найдено.</p>
								@endif							
							</div>
						</div>
					  </div>
					@endif
					
					@if(!$table_search)
					<div class="card-footer">
						<div class="row">	
							<div class="col-sm-12">	
								<a href="{{route('mediateka.create')}}?type=document{{(!empty($_GET['parent_id']) ? '&parent_id='.$_GET['parent_id'] : '')}}" class="btn btn-info"><i class="fas fa-plus"></i> Создать новый документ</a>
							</div>
						</div>
					</div>
					@endif
				  <!-- /.card-body -->               
				   {{ $documents->appends(request()->query())->links('vendor.pagination.tailwind') }}
				</div>
				
            @endif
          </div>
        </div>
        
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
@endsection