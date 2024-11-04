@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Настроки</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <a href="{{route('setting.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Create</a>
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
          @if ($setting)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Найти">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover listing ui-sortable">
                  @foreach($setting as $val)
	                    <tr data-id="{{$val->id}}" data-url="{{route('setting.update', $val->id)}}" >
	                     	<td class="align-middle">
	                      		<span class="handle">
		                      		<i class="fa fa-tasks"></i>
                     			</span>
                     		</td>
	                      <td class="align-middle" style="min-width: 200px;"><a href="{{route('setting.edit', $val->id)}}">{{$val->desc}}</a></td>
	                      <td class="align-middle">{{ ($val->val ? $val->val : ($val->files ? '/storage/'.$val->files[0] : '')) }}</td>
	                      <td class="align-middle">{{$val->code}}</td>
	                      <td class="align-middle">
	                      	<div class="btn-group">
		                        <a href="{{route('setting.edit', $val->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
		                        <form action="{{ route('setting.destroy' , $val->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Are you sure you want to delete it?')" title="Delete"><i class="far fa-trash-alt"></i></button>
		                        </form>
		                      </div>
	                      </td>
	                    </tr>

				  @endforeach
                </table>
              </div>
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
