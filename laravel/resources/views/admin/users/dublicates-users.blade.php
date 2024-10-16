@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Пользователи сайта <span>Дубликаты</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
			<a href="{{route('users.index')}}" class="btn btn-success float-right">Назад</a>
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
			<div class="info-box">
				<span class="info-box-icon bg-danger"><i class="fas fa-exclamation-circle"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">В базе данных сайта найдены пользователи с одинаковыми email. <br>У таких пользователей могут возникнуть проблеммы с авторизацией.</span>
					<span class="info-box-number">Удалите или деактивируйте не нужные.</span>
				</div>
			</div>
			
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список пользователей с одинаковыми email</h3>
              </div>
              <!-- /.card-header -->
          @if (count($managers)>0)		  
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover text-nowrap listing ui-sortable">
                  @foreach($managers as $manager)
	                    <tr data-id="{{$manager->id}}" data-url="{{route('users.update', $manager->id)}}" >
	                     	<td class="align-middle">
	                      		<span class="handle">
		                      		<i class="far fa-user"></i>
                     			</span>
                     		</td>
	                      <td class="align-middle"><a href="{{route('users.edit', $manager->id)}}">{{$manager->surname}} {{$manager->name}} {{$manager->patronymic}}</a></td>
	                      <td class="align-middle  full-width pl-4 pr-4">{{$manager->email}}</td>
	                      <td class="align-middle text-center pr-4">
						  <a href="{{ url('admin/uchastniki-aml/users-aml') }}">{{$manager->roles_one($manager->role_id)['name']}}</a>
						  </td>
						  <td class="align-middle  pr-4" title="Дата регистрации"> {{ Date::parse($manager->created_at)->format('d-m-Y | H:i') }}  </td>
						  <td class="align-middle">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($manager->active)checked="checked" @endif class="custom-control-input active" name="active" id="active{{$manager->id}}">
							  <label class="custom-control-label" for="active{{$manager->id}}"></label>
							</div>                      	
						  </td>
	                      <td class="align-middle">
	                      	  <div class="btn-group">
		                        <a href="{{route('users.edit', $manager->id)}}" class="btn btn-sm btn-flat" title="Редактировать {{$manager->id}}"><i class="far fa-edit"></i></a>
								@if($manager->id==1)
		                       	<button type="submit" class="btn btn-sm btn-flat disabled" title="Главного администратора нельзя удалить"><i class="far fa-trash-alt"></i></button>
								@else
		                        <form action="{{ route( 'dublicates-users.destroy' , $manager->id) }}" method="POST">
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
						<p><a href="{{ route('users.index') }}">Назад к списку</a></p>
					@endif
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