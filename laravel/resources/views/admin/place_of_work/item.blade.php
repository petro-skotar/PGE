@extends('admin.template')

@section('content')

<form action="{{ (request()->routeIs('place_of_work.edit') || !empty(Session::get('place_of_work'))) ? route('place_of_work.update', $place_of_work->id): ''}}{{ request()->routeIs('place_of_work.create') ? route('place_of_work.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('place_of_work.edit') || !empty(Session::get('place_of_work')))
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
            <h1 class="m-0 text-dark">Место работы / учебы <span>{{ request()->routeIs('place_of_work.edit') ? '(Editing места работы / учебы)': ''}} {{ request()->routeIs('place_of_work.create') ? '(Creation)' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Save</button>
			<a href="{{route('place_of_work.index')}}" class="btn btn-primary float-right">Back</a>
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
          <div class="col-12 col-sm-8">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header">
				<h3 class="card-title">Data</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

				  <div class="form-group">
					<label>Место работы / учебы *</label>
					<input name="name" required value="{{($place_of_work->name ? $place_of_work->name : old('name'))}}" type="text" class="form-control" placeholder="">
				  </div>

				  <div class="row">
					  <div class="col-12 col-sm-6">
						  <div class="form-group">
							<label>Язык</label>
							<select class="form-control" name="lang">
								@foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $lang => $lang_details)
									<option value="{{$lang}}" {{ ($place_of_work->lang == $lang ? 'selected':'') }}>{{$lang_details['native']}} - {{$lang}}</option>
								@endforeach
							</select>
						  </div>
					  </div>
					  <div class="col-12 col-sm-6">
						  <div class="form-group">
							<label>Position in the list</label>
							<input name="position" value="{{($place_of_work->position ? $place_of_work->position : '0')}}" type="text" class="form-control" placeholder="Целое число">
						  </div>
					  </div>
				  </div>


                </div>
              </div>
              <!-- /.card -->

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
