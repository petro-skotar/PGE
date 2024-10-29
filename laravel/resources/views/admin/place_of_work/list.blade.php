@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Место работы / учебы</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <a href="{{route('place_of_work.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Создать</a>
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
          @if ($place_of_work)
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
                <table class="table table-sm table-hover text-nowrap listing ui-sortable">
                  @foreach($place_of_work as $val)
	                    <tr data-id="{{$val->id}}" data-url="{{route('place_of_work.update', $val->id)}}" >
	                     	<td class="align-middle">
	                      		<span class="handle">
		                      		<i class="fa fa-tasks"></i>
                     			</span>
                     		</td>
	                      <td class="align-middle full-width"><a href="{{route('place_of_work.edit', $val->id)}}">{{$val->name}}</a></td>
	                      <td class="align-middle" title="Position in the list"><span class="iposition"><i class="fas fa-arrows-alt"></i> {{ $val->position }}</span></td>
	                      <td class="align-middle"><span><img src="{{ asset('adm/dist/img/flags/4x3/'.$val->lang.'.svg') }}" height="16" /></span></td>
	                      <td class="align-middle">
	                      	<div class="btn-group">
		                        <a href="{{route('place_of_work.edit', $val->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
		                        <form action="{{ route('place_of_work.destroy' , $val->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
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
