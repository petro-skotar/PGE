@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Роли пользователей</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <a href="{{route('roles.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Create</a>
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
          @if ($roles)
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список ролей</h3>
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
                  @foreach($roles as $role)
	                    <tr data-id="{{$role->id}}" data-url="{{route('roles.update', $role->id)}}" >
	                     	<td class="align-middle">
	                      		<span class="handle">
		                      		<i class="fa fa-tasks"></i>
                     			</span>
								<?php $rm_roles = array(); ?>
								<?php foreach ($role->roles_many as $rm){ ?>
									<?php $rm_roles[] = $rm['module']; ?>
		                        <?php } ?>
                     		</td>
	                      <td class="align-middle full-width"><a href="{{route('roles.edit', $role->id)}}">{{$role->name}}</a></td>
	                      <td class="align-middle text-center m_roles pl-30 pr-30">
		                        <?php foreach (Config::get('cms.modules') as $mod=>$m){?>
								<span class="config_role pl-10 <?php if(in_array($mod, $rm_roles)) echo 'active'; ?>" title="<?php echo $m['name'];?>"><i class="<?php echo $m['class-icon'];?>"></i></span>
		                        <?php } ?>
	                      </td>
	                      <td class="align-middle">
	                      	  <div class="btn-group">
		                        <a href="{{route('roles.edit', $role->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
		                        @if($role->id==1)
		                       	<button type="submit" class="btn btn-sm btn-flat disabled" title="Главного администратора нельзя удалить"><i class="far fa-trash-alt"></i></button>
								@else
								<form action="{{ route('roles.destroy' , $role->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat {{ ($role->id==1 ? 'disabled' : '') }}"  onclick="return confirm('Are you sure you want to delete it?')" title="Delete"><i class="far fa-trash-alt"></i></button>
		                        </form>
								@endif
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
