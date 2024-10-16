@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Страницы</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="button" class="btn btn-primary float-right">Создать страницу</button>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список страниц</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover text-nowrap">
                  <tbody>
                  @foreach($Articles as $article)					 
                    <tr>
                      <td class="align-middle">{{$article->id}}</td>
                      <td class="align-middle full-width">{{$article->name}}</td>                      
                      <td class="align-middle">
                      	<div class="custom-control custom-switch">
	                      <input type="checkbox" @if ($article->active)checked="checked"@endif class="custom-control-input" id="customSwitch{{$article->id}}">
	                      <label class="custom-control-label" for="customSwitch{{$article->id}}"></label>
	                    </div>                      	
                      </td>
                      <td class="align-middle">
                      	<div class="btn-group">
	                        <a href="{{route('viewArticle', ['url'=>$article->url])}}" class="btn btn-sm btn-flat" title="Посмотреть" target="_blank"><i class="fas fa-desktop"></i>
	                        </a>
	                        <a href="{{route('Admin_Articles', ['url'=>$article->url])}}" class="btn btn-sm btn-flat" title="Редактировать"><i class="far fa-edit"></i></a>
	                        <a href="" class="btn btn-sm btn-flat" title="Удалить"><i class="far fa-trash-alt"></i>
	                        </a>
	                      </div>                    	
                      </td>                      
                    </tr>
				  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
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