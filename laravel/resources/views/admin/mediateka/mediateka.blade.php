@extends('admin.template')

@section('content')

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
          <div class="col-sm-6 mb-2">
            <h1 class="m-0 text-dark">
				@if($type == 'category')Раздел медиатеки @endif
				@if($type == 'document')Документ @endif
				<span>
					{{ request()->routeIs('mediateka.edit') ? '(Editing)': ''}}
					{{ request()->routeIs('mediateka.create') ? '(Creation)' : ''}}
				</span>
			</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
			<button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Save</button>
			@if($type == 'document' && !empty($_GET['parent_id']))
			<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$_GET['parent_id']}}" class="btn btn-primary float-right">Назад к списку </a>
			@elseif($type == 'document' && !empty($Mediateka->category_id))
			<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$Mediateka->category_id}}" class="btn btn-primary float-right">Back</a>
			@else
			<a href="{{route('mediateka.index')}}" class="btn btn-primary float-right">Back</a>
			@endif

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

        @isset($messages['save'])
		<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <span><i class="icon fas fa-check-circle"></i>{!!$messages['save']!!}</span>
        </div>
		@endisset

		<form action="{{ (request()->routeIs('mediateka.edit') || isset($messages['save'])) ? route('mediateka.update', $update_id): ''}}{{ request()->routeIs('mediateka.create') ? route('mediateka.store'): ''}}@if($type == 'document')?document @endif" method="post"  enctype="multipart/form-data" id="form">@csrf
			@if (request()->routeIs('mediateka.edit') || isset($messages['save']))
				<input type="hidden" name="_method" value="put">
			@endif
			<input type="hidden" name="type" value="{{$type}}">

			<div class="row">
			  <div class="col-12 @if($type == 'document')col-sm-9 @endif">

				<div class="card card-primary card-outline card-outline-tabs">
				  <div class="card-header">
					<h3 class="card-title">Раздел</h3>
				  </div>
				  <div class="card-body">
					<div class="tab-content" id="custom-tabs-four-tabContent">
					  <label>К какому разделу принадлежит</label>
					  <select class="form-control select2" name="parent_id">
						@if($type == 'category')
						<option value="0">-- Это главный раздел --</option>
						@endif
						@if(!empty($MediatekaCategories))
							@foreach($MediatekaCategories as $category)
								@if($category->parent_id==0)
								<option value="{{$category->id}}" @if ($update_parent_id == $category->id || (!empty($_GET['parent_id']) && $_GET['parent_id'] == $category->id)) selected @endif>{{($category->name_ru ? $category->name_ru : $category->name_en)}}</option>
									@if($type == 'document' || ((in_array($update_parent_id,array(53,54,55,56)) && (in_array($category->parent_id,array(53,54,55,56)) || in_array($category->id,array(53,54,55,56))))) || ($type == 'category' && in_array($category->id,array(53,54,55,56)) ))
									@foreach($MediatekaCategories as $category_lv_2)
										@if($category_lv_2->parent_id==$category->id)
										<option value="{{$category_lv_2->id}}" @if ($update_parent_id == $category_lv_2->id || (!empty($_GET['parent_id']) && $_GET['parent_id'] == $category_lv_2->id)) selected @endif>&nbsp;-&nbsp;-&nbsp;{{($category_lv_2->name_ru ? $category_lv_2->name_ru : $category_lv_2->name_en)}}</option>
											@foreach($MediatekaCategories as $category_lv_3)
												@if($category_lv_3->parent_id==$category_lv_2->id)
												<option value="{{$category_lv_3->id}}" @if ($update_parent_id == $category_lv_3->id || (!empty($_GET['parent_id']) && $_GET['parent_id'] == $category_lv_3->id)) selected @endif>&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;-&nbsp;{{($category_lv_3->name_ru ? $category_lv_3->name_ru : $category_lv_3->name_en)}}</option>
												@endif
											@endforeach
										@endif
									@endforeach
									@endif
								@endif
							@endforeach
						@endif
					  </select>
					</div>
				  </div>
				  <!-- /.card -->
				</div>

				@if($type == 'category')
				<div class="card card-primary card-outline card-outline-tabs">
				  <div class="card-header">
					<h3 class="card-title">Параметры раздела</h3>
				  </div>
				  <div class="card-body">
					 <div class="row">
						@foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $lang => $lang_details)
						<div class="col-sm-6">
						  <div class="form-group">
							<label>Название раздела <span>[{{$lang}}]</span></label>
							<textarea name="name_{{$lang}}" class="form-control {{ request()->routeIs('mediateka.create') ? 'create_post' : ''}}&type=category" rows="2" placeholder="Название">{{($MediatekaCategory->name_ru && $lang=='ru' ? $MediatekaCategory->name_ru: '')}}{{($MediatekaCategory->name_en && $lang=='en' ? $MediatekaCategory->name_en: '')}}</textarea>
						  </div>
						</div>
						@endforeach
					</div>
				  </div>
				  <!-- /.card -->

					<div class="card-footer">
					  <button type="submit" class="btn btn-info trigger_btn">Save</button>
					</div>
				</div>
				@endif

				@if($type == 'document')
					<div class="row">
						<div class="col-sm-12">
							<div class="card card-primary card-outline card-outline-tabs">
							  <div class="card-header">
								<h3 class="card-title">Инфомация о документе</h3>
							  </div>
							  <div class="card-body">
								  <div class="tab-pane fade show">
									 <div class="row">
										<div class="col-sm-6">
										  <div class="form-group">
											<label>Название файла *</label>
											<textarea name="name" required class="form-control {{ request()->routeIs('mediateka.create') ? 'create_post' : ''}}" rows="5" placeholder="Тег <H1>">{{($Mediateka->name ? $Mediateka->name : old('name') )}}</textarea>
										  </div>
										</div>

										<div class="col-sm-6">
										  <div class="form-group">
											<label>Short name файла *</label>
											<input name="filename" required value="{{($Mediateka->filename ? $Mediateka->filename : old('filename') )}}" type="text" class="form-control  {{ request()->routeIs('mediateka.create') ? 'duble_post' : ''}}" placeholder="document.doc">
										  </div>
										  <div class="form-group">
											  <label>Автор</label>
											  <input name="author" value="{{($Mediateka->author ? $Mediateka->author : old('author') )}}" type="text" class="form-control" placeholder="">
											</div>
										</div>

										<div class="col-6">
											<div class="form-group">
												<label>Файл</label>
												<div class="custom-file">
												  <input type="file" class="custom-file-input" name="filepath" id="filepath">
												  <label class="custom-file-label" for="filepath">Выбрать файл</label>
												</div>
												@if($Mediateka->filepath)
												<div class="filepath_img">
													<div class="custom-control custom-checkbox">
													  <input class="custom-control-input" type="checkbox" id="filepath_remove" name="filepath_remove" value="1" >
													  <label for="filepath_remove" class="custom-control-label font-weight-normal">Удалить файл после сохранения</label>
													</div>
													<div class="file_rezult">
														<a href="{{route('download_files',$Mediateka->code())}}" target="_blank">Скачать загруженый файл</a>
													</div>
												</div>
												@endif
											  </div>
											  @if($file_types)
											  <div class="form-group">
												<label>File category</label>
												<select name="category_type" class="form-control">
													@foreach($file_types as $format_key=>$file_type)
													<option value="{{$format_key}}" {{($Mediateka->category_type && $Mediateka->category_type == $format_key ? 'selected' : '')}}>{{$file_type['name']['ru']}}</option>
													@endforeach
												</select>
											  </div>
											  @endif
										</div>
										<div class="col-6">
											  <div class="form-group">
												<label>Превью документа</label>
												<div class="custom-file">
												  <input type="file" class="custom-file-input" name="filepreview" id="filepreview">
												  <label class="custom-file-label" for="filepreview">Выбрать превью</label>
												</div>
												@if($Mediateka->filepreview)
												<div class="filepath_img">
													<div class="custom-control custom-checkbox">
													  <input class="custom-control-input" type="checkbox" id="filepreview_remove" name="filepreview_remove" value="1" >
													  <label for="filepreview_remove" class="custom-control-label font-weight-normal">Удалить превью после сохранения</label>
													</div>
													<div class="file_rezult">
														<img class="img-fluid" src="{{route('getImg',['mediateka_preview', $Mediateka->preview_code(), 250])}}" />
													</div>
												</div>
												@endif
												<div class="ano">
												  Если превью не указано, то оно будет сформировано автоматически (для форматов: pdf, doc, docx, png, jpg, jpeg, mp4)
												</div>
											  </div>
										</div>

										<div class="col-sm-12">
											<div class="form-group">
											  <label>Хештеги <span>(через запятую)</span></label>
											  <textarea name="hashtag" class="form-control" rows="3" placeholder="Через запятую">{{($Mediateka->hashtag ? $Mediateka->hashtag : old('hashtag') )}}</textarea>
											</div>
										</div>
										<div class="col-sm-12">
											<hr>
										</div>
										<div class="col-sm-6" style="display: none;">
										  <div class="form-group">
											<label>Breadcrumbs</label>
											<input name="bread" value="{{($Mediateka->bread ? $Mediateka->bread : old('bread') )}}" type="text" class="form-control {{ request()->routeIs('mediateka.create') ? 'duble_post' : ''}}" placeholder="Breadcrumbs">
										  </div>
										</div>
										<div class="col-sm-6">
										  <div class="form-group">
											<label>Заголовок страницы</label>
											<textarea name="title" class="form-control {{ request()->routeIs('mediateka.create') ? 'duble_post' : ''}}" rows="3" placeholder="META-тег <title>">{{($Mediateka->title ? $Mediateka->title : old('title') )}}</textarea>
										  </div>
										</div>
										<div class="col-sm-6">
										  <div class="form-group">
											<label>Short description</label>
											<textarea name="description" class="form-control {{ request()->routeIs('mediateka.create') ? 'duble_post' : ''}}" rows="3" placeholder="META-тег <description>">{{($Mediateka->description ? $Mediateka->description : old('description') )}}</textarea>
										  </div>
										</div>
										<div class="col-sm-12">
										  <div class="form-group">
											<label>Description</label>
											<textarea name="content" class="form-control editor" id="editor" rows="3">{{($Mediateka->content ? $Mediateka->content : old('content') )}}</textarea>
										  </div>
										</div>
									</div>
								  </div>

							  </div>
								<div class="card-footer">
								  <button type="submit" class="btn btn-info trigger_btn">Save</button>
								</div>
							</div>
						</div>
				   </div>
				@endif
			  </div>

			@if($type == 'document')
			  <div class="col-12 col-sm-3">

				<!-- general form elements disabled -->
				<div class="card card-primary card-outline">
				  <div class="card-header">
					<h3 class="card-title">Настройки</h3>
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body">

					<div class="row">

						<div class="col-sm-12">

						  <div class="form-group">
							<div class="custom-control custom-checkbox">
							  <input class="custom-control-input" type="checkbox" id="active" name="active" value="1" @if (request()->routeIs('mediateka.create'))  {{'checked' }} @elseif ($Mediateka->active) checked @endif>
							  <label for="active" class="custom-control-label font-weight-normal">Активный</label>
							</div>
						  </div>
						  <hr>
						  <div class="form-group">
							<div class="custom-control custom-checkbox">
							  <input class="custom-control-input" type="checkbox" id="only_view" name="only_view" value="1" @if ($Mediateka->only_view) checked @endif>
							  <label for="only_view" class="custom-control-label font-weight-normal">Запретить скачивание докуметна</label>
							</div>
						  </div>
						  <hr>
						  <div class="bootstrap-timepicker">
						  <div class="form-group">
		                  <label>Дата создания:</label>
							<div class="input-group date" id="created_at" data-target-input="nearest">
							  <input type="text" data-event_time name="created_at" class="form-control datetimepicker-input" data-target="#created_at" value="{{ request()->routeIs('mediateka.create') ? date('Y-m-d H:i:s') : $Mediateka->created_at }}"  placeholder="2021-12-31 15:30:00"/>
							  <div class="input-group-append" data-target="#created_at" data-toggle="datetimepicker">
								  <div class="input-group-text"><i class="far fa-clock"></i></div>
							  </div>
							</div>
						</div>
						</div>
						<hr>
						  <div class="form-group">
							<label>Язык:</label>
							@foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $lang => $lang_details)
							<div class="custom-control custom-radio">
							  <input class="custom-control-input" type="radio" id="lang_{{$lang}}" name="lang" @if ($Mediateka->lang == $lang) checked @endif value="{{$lang}}">
							  <label for="lang_{{$lang}}" class="custom-control-label font-weight-normal">{{$lang}}</label>
							</div>
							@endforeach
						  </div>
						  <hr>

						  @if(Auth::user()->id == 1)
						  <div class="form-group">
							<label>Отображать на сайте:</label>
							<div class="custom-control custom-checkbox">
							  <input class="custom-control-input" type="checkbox" id="mumcfm" name="mumcfm" value="1" @if ($Mediateka->mumcfm) checked @endif>
							  <label for="mumcfm" class="custom-control-label font-weight-normal">mumcfm.ru</label>
							</div>
							<div class="custom-control custom-checkbox">
							  <input class="custom-control-input" type="checkbox" id="aml" name="aml" value="1" @if ($Mediateka->aml) checked @endif>
							  <label for="aml" class="custom-control-label font-weight-normal">aml.university</label>
							</div>
							<div class="custom-control custom-checkbox">
							  <input class="custom-control-input" type="checkbox" id="fiu_cis" name="fiu_cis" value="1" @if ($Mediateka->fiu_cis) checked @endif>
							  <label for="fiu_cis" class="custom-control-label font-weight-normal">fiu-cis.org</label>
							</div>
						  </div>
						  <hr>
						  @endif
						  {{--
							  @if($roles)
								   <div class="form-group">
									<label>Доступен для роли:</label>

									@foreach($roles as $r)
									<div class="custom-control custom-checkbox @if($r->id==1) hide @endif">
									  <input class="custom-control-input" type="checkbox" id="role_{{$r->id}}" name="group_roles[]" @if($r->id==1) checked @endif @if (in_array($r->id,$group_roles_array)) checked @endif value="{{$r->id}}">
									  <label for="role_{{$r->id}}" class="custom-control-label font-weight-normal">{{$r->name}}</label>
									</div>
									@endforeach

								  </div>
								  <hr>
							  @endif
						  --}}
							<div class="form-group">
								<label>Доступен неавторизованным пользователям сайта:</label>

								<div class="custom-control custom-radio">
								  <input class="custom-control-input" type="radio" id="open_for_users_0" name="open_for_users" @if (!$Mediateka->open_for_users) checked @endif value="0">
								  <label for="open_for_users_0" class="custom-control-label font-weight-normal">Нет</label>
								</div>
								<div class="custom-control custom-radio">
								  <input class="custom-control-input" type="radio" id="open_for_users_1" name="open_for_users" @if ($Mediateka->open_for_users) checked @endif value="1">
								  <label for="open_for_users_1" class="custom-control-label font-weight-normal">Да</label>
								</div>

							</div>
							<hr>
						  <div class="form-group">
							<label>Комментарии/голосование:</label>
							@foreach($comments_config as $key=>$comment_config)
							<div class="custom-control custom-radio">
							  <input class="custom-control-input" type="radio" id="open_comments_{{$key}}" name="open_comments" @if ($Mediateka->open_comments == $key) checked @endif value="{{$key}}">
							  <label for="open_comments_{{$key}}" class="custom-control-label font-weight-normal">{!!$comment_config!!}</label>
							</div>
							@endforeach
						  </div>
						</div>

					</div>
				</div>
					<div class="card-footer">
					  <button type="submit" class="btn btn-info trigger_btn">Save</button>
					</div>
			   </div>

			  </div>
			@endif


			</div>
        </form>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
