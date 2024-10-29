@extends('admin.template')

@section('content')

<form action="{{ (request()->routeIs('setting.edit') || !empty(Session::get('setting'))) ? route('setting.update', $setting->id): ''}}{{ request()->routeIs('setting.create') ? route('setting.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
@if (request()->routeIs('setting.edit') || !empty(Session::get('setting')))
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
            <h1 class="m-0 text-dark">Настройки <span>{{ request()->routeIs('setting.edit') ? '(Editing)': ''}} {{ request()->routeIs('setting.create') ? '(Creation)' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Save</button>
			<a href="{{route('setting.index')}}" class="btn btn-primary float-right">Back</a>
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
				<h3 class="card-title">Данные</h3>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">

				  <div class="form-group">
					<label>Параметр *</label>
					<input name="desc" required value="{{($setting->desc ? $setting->desc : old('desc') )}}" type="text" class="form-control" placeholder="">
				  </div>
				  <div class="form-group">
					<label>Значение</label>
					<textarea name="val" class="form-control" rows="8" placeholder="">{{($setting->val ? $setting->val : old('val') )}}</textarea>
				  </div>

					<div class="form-group">
						<label>Files</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="files[]" id="files" multiple="multiple" >
							<label class="custom-file-label" for="files">Select files</label>
						</div>
						@if($setting->files)
							<ul class="list_thumb as_files">
								@foreach ($setting->files as $file)
									<li>
										<a href="{{ (File::exists($file) ? asset($file) : (File::exists('storage/'.$file) ? asset('storage/'.$file) : '')) }}" target="_blank">
											<img src="{{ asset('adm/dist/img/file.svg') }}" />
											<div class="checkbox_block">
												<input class="custom-control-input" type="checkbox" id="files_remove_{{ $loop->index }}" name="files_remove[{{ $loop->index }}]" value="1" onclick="if(this.checked == true) return confirm('Delete after save?');" >
												<label for="files_remove_{{ $loop->index }}" class="custom-control-label font-weight-normal" title="Delete after save"></label>
											</div>
										</a>
									</li>
								@endforeach
							</ul>
						@endif
					</div>


				  <div class="row">
					  <div class="col-12 col-sm-6">
						  <div class="form-group">
							<label>Код параметра *</label>
							<input name="code" required value="{{($setting->code ? $setting->code : old('code') )}}" type="text" class="form-control" placeholder="code">
						  </div>
					  </div>
					  <div class="col-12 col-sm-6" style="display: none;">
						  <div class="form-group">
							<label>Модуль параметра</label>
							<select class="form-control" name="module">
								@foreach($modules as $key => $val)
									<option value="{{$key}}" {{ ($setting->module == $key ? 'selected':'') }}>{{$val}}</option>
								@endforeach
							</select>
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
