@extends('admin.template')

@section('content')

<form action="{{ (request()->routeIs('subscribe.edit') || !empty(Session::get('subscribe'))) ? route('subscribe.update', $subscribe->id): ''}}{{ request()->routeIs('subscribe.create') ? route('subscribe.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('subscribe.edit') || !empty(Session::get('subscribe')))
	<input type="hidden" name="_method" value="put">
@endif
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper form_zone">
	<div class="fz_loagind">
		<div class="fz_loagind_wrapper">
			<div class="">
				<img src="{{ asset('adm/dist/img/loading.gif') }}" />
				<p class="">Please wait, saving in progress</p>
			</div>
		</div>
	</div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Подписчики <span>{{ request()->routeIs('subscribe.edit') ? '(Editing)': ''}} {{ request()->routeIs('subscribe.create') ? '(Creation)' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Save</button>
			<a href="{{route('subscribe.index')}}" class="btn btn-primary float-right">Back</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        @if(count($errors) > 0)
		<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-ban"></i> Error<</h5>
				<ul>
				@foreach ($errors->all() as $error)
					<li>{!! $error !!}</li>
				@endforeach
				</ul>
        </div>
		@endif

        @if (!empty(Session::get('messages_save')))
		<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <span><i class="icon fas fa-check-circle"></i>{!!Session::get('messages_save')!!}</span>
        </div>
		@endisset

        <div class="row">
          <div class="col-12 col-md-8">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
				<h3 class="card-title">Data</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

                <div class="form-group">
                    <label>Название / Имя</label>
                    <input name="name" value="{{($subscribe->name ? $subscribe->name : old('name') )}}" type="text" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Почта</label>
                    <input name="email" value="{{($subscribe->email ? $subscribe->email : old('email') )}}" type="text" class="form-control lowercase" placeholder="">
                </div>
                <div class="form-group">
                    <label>Место / Организация</label>
                    <select class="form-control milti_select2" name="city" style="width: 100%;">
                        <option value="" @if(empty($subscribe->city)) selected @endif>Не указано</option>
                        @foreach($cities as $city => $group_cities)
                            <option value='{{ $city }}' @if($subscribe->city == $city || old('city') == $city) selected @endif  >{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Job title</label>
                    <textarea name="position" rows="6" class="form-control" placeholder="">{{($subscribe->position ? $subscribe->position : old('position') )}}</textarea>
                </div>

                </div>
              </div>
              <!-- /.card -->

           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info trigger_btn">Save</button>
                </div>

            </div>
          </div>
          <div class="col-12 col-md-4">
            <!-- general form elements disabled -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Настройки</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input name="active" class="custom-control-input" type="checkbox" id="active" name="active" value="1" @if (request()->routeIs('subscribe.create'))  {{'checked' }} @elseif ($subscribe->active) checked @endif>
                          <label for="active" class="custom-control-label">Active</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Регион</label>
                        <select class="form-control milti_select2" name="region" style="width: 100%;">
                            <option value="" @if(empty($subscribe->region)) selected @endif>Не указано</option>
                            @foreach($regions as $region => $group_regions)
                                <option value='{{ $region }}' @if($subscribe->region == $region || old('region') == $region) selected @endif  >{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Сайт</label>
                        <input name="site_url" value="{{($subscribe->site_url ? $subscribe->site_url : old('site_url') )}}" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info trigger_btn">Save</button>
                </div>
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</form>

@endsection
