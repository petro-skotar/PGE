@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Участники МСИ <span>/ {{ Config::get('cms.modules.uchastniki-aml.sub.users-aml.name') }}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <a href="{{route('users-aml.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Создать</a>
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
          @if ($managers)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список пользователей {!! ($table_search ? '<span class="table_search_title">|<b>Результаты поиска</b>: <u>'.$table_search.'</u></span>':'') !!}</h3>
                <div class="card-tools">
                  <form class="input-group input-group-sm" style="width: 150px;" action="{{ route('users-aml.index') }}" method="GET">
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
                <table class="table table-sm table-hover text-nowrap-off listing ui-sortable">
                  @foreach($managers as $manager)
	                    <tr data-id="{{$manager->id}}" data-url="{{route('users-aml.update', $manager->id)}}" >
	                     	<td class="align-middle">
	                      		<span class="handle">
		                      		<i class="far fa-user"></i>
                     			</span>
                     		</td>
	                      <td class="align-middle text-nowrap"><a href="{{route('users-aml.edit', $manager->id)}}">{{$manager->surname}} {{$manager->name}} {{$manager->patronymic}}</a></td>
	                      <td class="align-middle pl-4 pr-4 full-width">@if($manager->aml_artile_id && !empty($manager->organization_aml($manager->aml_artile_id)->details_one->name)){{$manager->organization_aml($manager->aml_artile_id)->details_one->name}}@endif</td>
						  <td class="align-middle">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($manager->active)checked="checked" @endif class="custom-control-input active" name="active" id="active{{$manager->id}}">
							  <label class="custom-control-label" for="active{{$manager->id}}"></label>
							</div>
						  </td>
	                      <td class="align-middle">
	                      	  <div class="btn-group">
		                        <a href="{{route('users-aml.edit', $manager->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
								@if($manager->id==1)
		                       	<button type="submit" class="btn btn-sm btn-flat disabled" title="Главного администратора нельзя удалить"><i class="far fa-trash-alt"></i></button>
								@else
		                        <form action="{{ route('users-aml.destroy' , $manager->id)}}" method="POST">
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
						<p><a href="{{ route('users-aml.index') }}">Назад к списку</a></p>
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
