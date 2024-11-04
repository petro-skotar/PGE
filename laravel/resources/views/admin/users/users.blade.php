@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Пользователи сайта</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
			<a href="{{route('users.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Create</a>
				{{--<a href="{{route('download_users_export')}}" class="btn btn-success float-right mr-2">Экспорт в xlsx (в разработке)</a>--}}
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
			@if(!empty($count_dublicates))
			<div class="info-box">
				<span class="info-box-icon bg-danger"><i class="fas fa-exclamation-circle"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">В базе данных сайта найдены пользователи с одинаковыми email. <br>У таких пользователей могут возникнуть проблеммы с авторизацией.</span>
					<span class="info-box-number"><a href="{{route('dublicates-users.index')}}">Показать дубликаты ({{ count($count_dublicates) }} шт)</a></span>
				</div>
			</div>
			@endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список пользователей {!! ($table_search ? '<span class="table_search_title">|<b>Результаты поиска</b>: <u>'.$table_search.'</u></span>': $managers->total() ) !!}</h3>
				<div class="card-tools">
                  <form class="input-group input-group-sm" style="width: 150px;" action="{{ route('users.index') }}" method="GET">
                    <input type="text" name="table_search" class="form-control float-right" value="{{ $table_search }}" placeholder="Найти">
					<div class="input-group-append">
                      <button type="submit" class="btn btn-default" name="table_search_submit" value="1"><i class="fas fa-search"></i></button>
                    </div>
                  </form>
                </div>
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
						  <td class="align-middle  pr-4"> {{ Date::parse($manager->created_at)->format('d-m-Y | H:i') }}  </td>
	                      <td class="align-middle text-center pr-4">
							@if(!$manager->send_verify_registration)
								<span class="badge bg-danger auto_verify_label">новый</span>
								<button type="submit" class="btn btn-sm btn-primary auto_verify" title="Подтвердить и сообщить об этом пользователю по email"><i class="fas fa-user-check"></i> Подтвердить</button>
								<img class="auto_verify_loading" src="{{ asset('adm/dist/img/loading.gif') }}" />
								<span class="badge bg-primary auto_verify_ok"><i class="fas fa-user-check"></i></span>
							@endif
						  </td>
						  <td class="align-middle">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($manager->active)checked="checked" @endif class="custom-control-input active" name="active" id="active{{$manager->id}}">
							  <label class="custom-control-label" for="active{{$manager->id}}"></label>
							</div>
						  </td>
	                      <td class="align-middle">
	                      	  <div class="btn-group">
		                        <a href="{{route('users.edit', $manager->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
								@if($manager->id==1)
		                       	<button type="submit" class="btn btn-sm btn-flat disabled" title="Главного администратора нельзя удалить"><i class="far fa-trash-alt"></i></button>
								@else
		                        <form action="{{ route('users.destroy' , $manager->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Are you sure you want to delete it?')" title="Delete"><i class="far fa-trash-alt"></i></button>
		                        </form>
								@endif
		                      </div>
	                      </td>
	                    </tr>

				  @endforeach
                </table>

				<div class="">
				{{ $managers->appends(request()->query())->links('vendor.pagination.tailwind') }}
			    </div>

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
