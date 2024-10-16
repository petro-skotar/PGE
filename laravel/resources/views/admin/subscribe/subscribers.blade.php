@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-4">
            <h1 class="m-0 text-dark">Подписчики</h1>
          </div><!-- /.col -->
          <div class="col-8">
              <a href="{{route('subscribe-export')}}?{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}{{ (request()->get('r') ? '&r='.request()->get('r') : '') }}{{ (request()->get('c') ? '&c='.request()->get('c') : '') }}{{ (request()->get('a') ? '&a='.request()->get('a') : '') }}" class="btn btn-success float-right ml-3"><i class="fas fa-file-export"></i> Экспорт</a>
              <a href="{{route('subscribe.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Добавить подписчика </a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Список подписчиков {!! (request()->get('table_search') ? '<span class="table_search_title">|<b>Результаты поиска</b>: <u>'.request()->get('table_search').'</u></span>':'('.$subscribers->total().')') !!}</h3>
                <div class="card-tools">
                  <form class="input-group input-group-sm" style="width: 150px;" action="{{ route('subscribe.index') }}" method="GET">
                    <input type="text" name="table_search" class="form-control float-right" value="{{ (request()->get('table_search') ? request()->get('table_search') : '') }}" placeholder="Найти">
					<div class="input-group-append">
                      <button type="submit" class="btn btn-default" name="table_search_submit" value="1"><i class="fas fa-search"></i></button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
          @if (count($subscribers)>0)
              <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover listing ui-sortable">
                  @foreach($subscribers as $subscriber)
	                    <tr data-id="{{$subscriber->id}}" data-url="{{route('subscribe.update', $subscriber->id)}}" >
	                     	<td class="align-middle  pl-3">
	                      		<span class="handle">
		                      		<i class="fa fa-envelope"></i>
                     			</span>
                     		</td>
	                      <td class="align-middle pl-2 pr-4">
                            <a href="{{route('subscribe.edit', $subscriber->id)}}" title="Редактировать">{{$subscriber->name}}</a><br>
                            {{$subscriber->email}}
                          </td>
	                      <td class="align-middle pl-2 pr-4"></td>
	                      @if(!request()->get('r'))<td class="align-middle pl-2 pr-4 white-space">{{$subscriber->region}}</td>@endif
	                      <td class="align-middle pl-2 pr-4">{{$subscriber->city}}</td>
						  <td class="align-middle pr-4 white-space"> @if($subscriber->created_at) {{ Date::parse($subscriber->created_at)->format('d-m-Y | H:i') }} @endif</td>
	                      <td class="align-middle">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($subscriber->active)checked="checked" @endif class="custom-control-input active" name="active" id="active{{$subscriber->id}}">
							  <label class="custom-control-label" for="active{{$subscriber->id}}"></label>
							</div>
						  </td>
	                      <td class="align-middle pr-2">
	                      	  <div class="btn-group">
                                <a href="{{route('subscribe.edit', $subscriber->id)}}" class="btn btn-sm btn-flat" title="Редактировать"><i class="far fa-edit"></i></a>
								<form action="{{ route('subscribe.destroy' , $subscriber->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
		                        </form>
		                      </div>
	                      </td>
	                    </tr>

				  @endforeach
                </table>

				<div class="">
				{{ $subscribers->appends(request()->query())->links('vendor.pagination.tailwind') }}
			    </div>

              </div>
            @else
				<div class="card-body table-responsive">
					<p>Нет подписок</p>
					@if(request()->get('table_search'))
						<p><a href="{{ route('subscribe.index') }}">Назад к списку</a></p>
					@endif
				</div>
            @endif
              <!-- /.card-body -->

             </div>
            <!-- /.card -->
          </div>
          <div class="col-md-3">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Подписаны</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item {{ (!request()->get('a') ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}?{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}{{ (request()->get('r') ? '&r='.request()->get('r') : '') }}" class="nav-link">Все</a></li>
                        <li class="nav-item {{ (request()->get('a') == 1 ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}?a=1{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}{{ (request()->get('r') ? '&r='.request()->get('r') : '') }}" class="nav-link">Подписаны <span class="badge bg-count float-right">{{ $active[1] }}</span></a></li>
                        <li class="nav-item {{ (request()->get('a') == 'no' ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}?a=no{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}{{ (request()->get('r') ? '&r='.request()->get('r') : '') }}" class="nav-link">Не подписаны <span class="badge bg-count float-right">{{ $active[0] }}</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Регионы</h3>
                </div>
                <div class="card-body p-0">
                    @if(!empty($regions))
                        <ul class="nav nav-pills flex-column">
                        <li class="nav-item {{ (!request()->get('r') ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}{{ (request()->get('table_search') ? '?table_search='.request()->get('table_search') : '') }}" class="nav-link">Все</a></li>
                        @foreach($regions as $pluck_region => $count)
                            @if(!empty($pluck_region))
                            <li class="nav-item {{ (request()->get('r') && request()->get('r') == $pluck_region ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}?r={{ $pluck_region }}{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}{{ (request()->get('a') ? '&a='.request()->get('a') : '') }}" class="nav-link">{{ $pluck_region }} <span class="badge bg-count float-right">{{ $count }}</span></a></li>
                            @else
                            <li class="nav-item {{ (request()->get('r') && request()->get('r') == 'no' ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}?r=no{{ $pluck_region }}{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}{{ (request()->get('a') ? '&a='.request()->get('a') : '') }}" class="nav-link">Не указано <span class="badge bg-count float-right">{{ $count }}</span></a></li>
                            @endif
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{--
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Место</h3>
                </div>
                <div class="card-body p-0">
                    @if(!empty($cities))
                        <ul class="nav nav-pills flex-column">
                        <li class="nav-item {{ (!request()->get('c') ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}{{ (request()->get('table_search') ? '?table_search='.request()->get('table_search') : '') }}" class="nav-link">Все <span class="badge bg-count float-right">{{ count($all) }}</span></a></li>
                        @foreach($cities as $pluck_city => $group_cities)
                            @if(!empty($pluck_city))
                            <li class="nav-item {{ (request()->get('c') && request()->get('c') == $pluck_city ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}?c={{ $pluck_city }}{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}" class="nav-link">{{ $pluck_city }} <span class="badge bg-count float-right">{{ count($group_cities) }}</span></a></li>
                            @else
                            <li class="nav-item {{ (request()->get('c') && request()->get('c') == 'no' ? 'active' : '') }}"><a href="{{ route('subscribe.index') }}?c=no{{ $pluck_city }}{{ (request()->get('table_search') ? '&table_search='.request()->get('table_search') : '') }}" class="nav-link">Не указано <span class="badge bg-count float-right">{{ count($group_cities) }}</span></a></li>
                            @endif
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            --}}

          </div>
        </div>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
