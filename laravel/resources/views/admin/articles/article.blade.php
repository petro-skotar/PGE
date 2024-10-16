@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper form_zone">
	<div class="fz_loagind">
		<div class="fz_loagind_wrapper">
			<div class="">
				<img src="{{ asset('adm/dist/img/loading.gif') }}" />
				<p class="">Ожидайте, идет сохранение</p>
			</div>
		</div>
	</div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">{{$module_info['title']}} <span>{{ request()->routeIs($module_info['module'].'.edit') ? '(Редактирование)': ''}} {{ request()->routeIs($module_info['module'].'.create') ? '(Создание)' : ''}}</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" class="btn btn-info float-right ml-2 mb-2 trigger_btn_save">Сохранить</button>
			@if(!in_array(Auth::user()->role_id,[8,6]))<a href="{{route($module_info['module'].'.index')}}" class="btn btn-primary float-right">Назад</a>@endif
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
          <h5><i class="icon fas fa-ban"></i> Ошибка</h5>

				<ul>
				@foreach ($errors->all() as $error)
					<li>{!! $error !!}</li>
				@endforeach
				</ul>
        </div>
		@endif
		@if (!empty(Session::get('date_errors')))
		<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-ban"></i> {!!Session::get('date_errors')!!}</h5>
        </div>
		@endif

        @if (!empty(Session::get('messages_save')))
		<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <span><i class="icon fas fa-check-circle"></i>{!!Session::get('messages_save')!!}</span>
        </div>
		@endisset

        <form action="{{ (request()->routeIs($module_info['module'].'.edit') || !empty(Session::get('messages_save'))) ? route($module_info['module'].'.update', $Article->id): ''}}{{ request()->routeIs($module_info['module'].'.create') ? route($module_info['module'].'.store'): ''}}" method="post"  enctype="multipart/form-data" id="form">@csrf
			<input type="hidden" name="parent_id" value="{{ (!empty($parent_article) && $parent_article->id ? $parent_article->id : ($Article->parent_id ? $Article->parent_id : 0) ) }}">
        @if (request()->routeIs($module_info['module'].'.edit') || !empty(Session::get('messages_save')))
        	<input type="hidden" name="_method" value="put">
        @endif

        <div class="row">
          <div class="col-12 col-sm-9">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  @foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details)
				  <li class="nav-item">
                    <a class="nav-link @if($lang == $LANG)active @endif {{ request()->routeIs($module_info['module'].'.create') && request()->routeIs($module_info['module'].'.edit') || empty($Article_details[$lang]->name) ? 'empty_lang': ''}}" id="tabs-{{$lang}}-tab" data-toggle="pill" href="#tabs-{{$lang}}" role="tab" aria-controls="tabs-{{$lang}}" aria-selected="true"><img class="icon_lang" src="{{ asset('adm/dist/img/flags/4x3/'.$lang.'.svg') }}"> {{$lang_details['native']}}</a>
                  </li>
                  @endforeach
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  @foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details)
                  <div class="tab-pane fade show @if($lang == $LANG)active @endif" id="tabs-{{$lang}}" data-lang="{{$lang}}" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <input name="details[{{$lang}}][id]" value="{{($Article_details[$lang]->id ? $Article_details[$lang]->id : '')}}" type="hidden" class="form-control">
                     <div class="row">

						<div class="col-sm-12">
	                      <div class="form-group">
	                        <label>
								@if(!empty($module_info['fields']['name']['title']))
									{{$module_info['fields']['name']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['name']['title']))
									{{$module_info['categories'][$Article->id]['fields']['name']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['name']['title']))
									{{$module_info['categories'][$Article->parent_id]['sub_fields']['name']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['name']['title']))
									{{$module_info['categories'][request()->parent_id]['sub_fields']['name']['title']}}
								@else Название @endif <span>[{{$lang}}]</span></label>
	                        <textarea name="details[{{$lang}}][name]" class="form-control name_field {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'create_post' : ''}}" rows="2" placeholder="@if(!empty($module_info['fields']['name']['placeholder'])){!!$module_info['fields']['name']['placeholder']!!} @elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['name']['placeholder'])){!!$module_info['categories'][$Article->id]['fields']['name']['placeholder']!!} @elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['name']['placeholder'])){!!$module_info['categories'][$Article->parent_id]['sub_fields']['name']['placeholder']!!} @elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['name']['placeholder'])){!!$module_info['categories'][request()->parent_id]['sub_fields']['name']['placeholder']!!} @endif ">{{($Article_details[$lang]->name ? $Article_details[$lang]->name : old('details.'.$lang.'.name') )}}</textarea>
							<div class="ano"> (!) Это поле является индикатором существования страницы/записи на сайте на текущем языке ({{$lang}}). Если оно пустое, то вся информация на этой вкладке не будет сохранена. Соответственно для удаления этой записи текущего языка, оставьте это поле пустым и нажмите любую кнопку "Сохранить".</div>
						  </div>
	                    </div>

						{{--
						@if(!empty($module_info['fields']))
							@foreach($module_info['fields'] as $field)

							@endforeach
						@endif
						--}}


						@if(in_array($module_info['module'],['articles','blog','projects']))
							@if(empty($parent_article) && $Article->parent_id == 0 || in_array($module_info['module'],['articles','industries']))
								@if($Article->id != 1)
								<div class="col-sm-12">
									<div class="form-group">
									  <label>URL * <span>(путь к странице):</span></label>
									  <div class="input-group">
										  <input name="details[{{$lang}}][url]" type="text" class="form-control duble_post_url_{{$lang}}" data-add_path="/{{(in_array($module_info['module'],['offers','industries','career','team'])?$module_info['module'].'/':'')}}" placeholder="Url ..." value="{{($Article_details[$lang]->url ? $Article_details[$lang]->url : old('details.'.$lang.'.url') )}}">
										  <div class="input-group-append">
											<a href="" class="input-group-text re_url" title="Определить автоматически"><i class="fas fa-magic"></i></a>
											{{--<a href="" class="input-group-text to_page" title="Посмотреть" target="_blank"><i class="fas fa-desktop"></i></a>--}}
										  </div>
									  </div>
								  </div>
								</div>
								@endif
							@endif
						@endif

						@if(in_array($module_info['module'],['articles','blog','projects']))
							@if(empty($parent_article) && $Article->parent_id == 0 || in_array($module_info['module'],['articles','industries']))
							<div class="col-md-{{ (in_array($module_info['module'],['projects']) ? '6' : '12') }}">
							  <div class="form-group">
								<label>Заголовок <span>[META тег &lt;TITLE&gt;, {{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][title]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="2" placeholder="META-тег <title>">{{($Article_details[$lang]->title ? $Article_details[$lang]->title : old('details.'.$lang.'.title') )}}</textarea>
							  </div>
							</div>
							<div class="col-md-3" @if(!in_array($module_info['module'],['-----'])) style="display: none;" @endif>
							  <div class="form-group">
								<label>Краткое название <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][short_name]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="2" placeholder="Например, пункт меню">{{($Article_details[$lang]->short_name ? $Article_details[$lang]->short_name : old('details.'.$lang.'.short_name') )}}</textarea>
							  </div>
							</div>
                            @if(in_array($module_info['module'],['articles','blog']))
							<div class="col-md-6">
                                <div class="form-group">
                                    <label>Краткое название <span>[пункт меню, {{$lang}}]</span></label>
                                    <textarea name="details[{{$lang}}][short_name]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="2" placeholder="Краткое название">{{($Article_details[$lang]->short_name ? $Article_details[$lang]->short_name : old('details.'.$lang.'.short_name') )}}</textarea>
                                </div>
							</div>
                            @endif
                            @if(in_array($module_info['module'],['articles','blog', 'projects']))
							<div class="col-md-6">
							  <div class="form-group">
								<label>Хлебные крошки <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][bread]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="2" placeholder="Хлебные крошки">{{($Article_details[$lang]->bread ? $Article_details[$lang]->bread : old('details.'.$lang.'.bread') )}}</textarea>
							  </div>
							</div>
							@endif
							<div class="col-md-6">
							  <div class="form-group">
								<label>Краткое описание <span>[META тег &lt;desctiption&gt;, {{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][description]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="5" placeholder="META-тег <description>">{{($Article_details[$lang]->description ? $Article_details[$lang]->description : old('details.'.$lang.'.description') )}}</textarea>
							  </div>
							</div>
							@if(in_array($module_info['module'],['articles','blog']))
							<div class="col-md-6">
							  <div class="form-group">
								<label>Слоган <span>[под &lt;H1&gt; {{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][slogan]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="5" placeholder="Слоган (если есть)">{{($Article_details[$lang]->slogan ? $Article_details[$lang]->slogan : old('details.'.$lang.'.slogan') )}}</textarea>
							  </div>
							</div>
							@endif

							@if(in_array($module_info['module'],['projects']))
							<div class="col-md-6">
							  <div class="form-group">
								<label>Cel projektu <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][annotation]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="5" placeholder="Cel projektu">{{($Article_details[$lang]->annotation ? $Article_details[$lang]->annotation : old('details.'.$lang.'.annotation') )}}</textarea>
							  </div>
							</div>
							@endif

							@if(in_array($module_info['module'],['projects']))
							<div class="col-md-3">
							  <div class="form-group">
								<label>Kod <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][code]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="1" placeholder="Например, 01">{{($Article_details[$lang]->code ? $Article_details[$lang]->code : old('details.'.$lang.'.code') )}}</textarea>
							  </div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<label>Kwota dofinansowania <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][price]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="1" placeholder="Например, 8 340 000 zł">{{($Article_details[$lang]->price ? $Article_details[$lang]->price : old('details.'.$lang.'.price') )}}</textarea>
							  </div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<label>Okres zwrotu <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][long_time]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="1" placeholder="Например, 36 miesięcy">{{($Article_details[$lang]->long_time ? $Article_details[$lang]->long_time : old('details.'.$lang.'.long_time') )}}</textarea>
							  </div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<label>Oczekiwany zwrot <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][percent]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="1" placeholder="Например, 17%">{{($Article_details[$lang]->percent ? $Article_details[$lang]->percent : old('details.'.$lang.'.percent') )}}</textarea>
							  </div>
							</div>
							@endif

							@endif
						@endif

						@if(in_array($module_info['module'],['team']))
							<div class="col-sm-12">
							  <div class="form-group">
								<label>Должность <span>[{{$lang}}]</span></label>
								<textarea name="details[{{$lang}}][annotation]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="2" placeholder="">{{($Article_details[$lang]->annotation ? $Article_details[$lang]->annotation : old('details.'.$lang.'.annotation') )}}</textarea>
							  </div>
							</div>
						@endif

						@if(!empty($module_info['fields']['annotation']) || (in_array($module_info['module'],['sections']) && (!empty($module_info['categories'][$Article->id]['fields']['annotation']) || !empty($module_info['categories'][$Article->parent_id]['sub_fields']['annotation']) || !empty($module_info['categories'][request()->parent_id]['sub_fields']['annotation']))))
						<div class="col-sm-12">
						  <div class="form-group">
							<label>
								@if(!empty($module_info['fields']['annotation']['title']))
									{{$module_info['fields']['annotation']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['annotation']['title']))
									{{$module_info['categories'][$Article->id]['fields']['annotation']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['annotation']['title']))
									{{$module_info['categories'][$Article->parent_id]['sub_fields']['annotation']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['annotation']['title']))
									{{$module_info['categories'][request()->parent_id]['sub_fields']['annotation']['title']}}
								@else Должность @endif<span>[{{$lang}}]</span></label>
							<textarea name="details[{{$lang}}][annotation]" class="form-control {{ request()->routeIs($module_info['module'].'.create') || empty($Article_details[$lang]->name) ? 'duble_post_'.$lang : ''}}" rows="5">{{($Article_details[$lang]->annotation ? $Article_details[$lang]->annotation : old('details.'.$lang.'.annotation') )}}</textarea>
						  </div>
						</div>
						@endif

                        @if(in_array($module_info['module'],['projects']))
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Файл презентации</label>
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="details[{{$lang}}][file]" id="file">
                                    <label class="custom-file-label" for="file">Выбрать файл</label>
                                    </div>
                                    @if($Article_details[$lang]->file)
                                        <ul class="list_thumb as_files">
                                            <li>
                                                <a href="{{ (File::exists($Article_details[$lang]->file) ? asset($Article_details[$lang]->file) : (File::exists('storage/'.$Article_details[$lang]->file) ? asset('storage/'.$Article_details[$lang]->file) : '')) }}" target="_blank">
                                                    <img src="{{ asset('adm/dist/img/docs/pdf.svg') }}" />
                                                    <div class="checkbox_block">
                                                    <input class="custom-control-input" type="checkbox" id="details[{{$lang}}][file_remove]" name="details[{{$lang}}][file_remove]" value="1" >
                                                    <label for="details[{{$lang}}][file_remove]" class="custom-control-label font-weight-normal" title="Удалить после сохранения"></label>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @endif

						@if(!empty($module_info['fields']['content']) || (in_array($module_info['module'],['sections']) && (!empty($module_info['categories'][$Article->id]['fields']['content']) || !empty($module_info['categories'][$Article->parent_id]['sub_fields']['content']) || !empty($module_info['categories'][request()->parent_id]['sub_fields']['content']))))
	                    <div class="col-sm-12">
	                      <div class="form-group">
	                        <label>
								@if(!empty($module_info['fields']['content']['title']))
									{{$module_info['fields']['content']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['content']['title']))
									{{$module_info['categories'][$Article->id]['fields']['content']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][$Article->parent_id]['sub_fields']['content']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][request()->parent_id]['sub_fields']['content']['title']}}
								@else Описание @endif<span>[{{$lang}}]</span></label>
	                        <textarea name="details[{{$lang}}][content]" class="form-control editor" id="editor-{{$lang}}" rows="3">{{($Article_details[$lang]->content ? $Article_details[$lang]->content : old('details.'.$lang.'.content') )}}</textarea>
	                      </div>
	                    </div>
						@endif

						@if(in_array($module_info['module'],['industries']))
	                    <div class="col-sm-12">
	                      <div class="form-group">
	                        <label>@if(!empty($module_info['fields']['content_2']['title'])) {{$module_info['fields']['content_2']['title']}} @else Дополнительное описание 2 @endif <span>[{{$lang}}]</span></label>
	                        <textarea name="details[{{$lang}}][content_2]" class="form-control editor" id="editor-2-{{$lang}}" rows="3" data-h="150">{{($Article_details[$lang]->content_2 ? $Article_details[$lang]->content_2 : old('details.'.$lang.'.content_2') )}}</textarea>
	                      </div>
	                    </div>
	                    <div class="col-sm-12">
	                      <div class="form-group">
	                        <label>@if(!empty($module_info['fields']['content_3']['title'])) {{$module_info['fields']['content_3']['title']}} @else Дополнительное описание 3 @endif <span>[{{$lang}}]</span></label>
	                        <textarea name="details[{{$lang}}][content_3]" class="form-control editor" id="editor-3-{{$lang}}" rows="3" data-h="150">{{($Article_details[$lang]->content_3 ? $Article_details[$lang]->content_3 : old('details.'.$lang.'.content_3') )}}</textarea>
	                      </div>
	                    </div>
						@endif

	                </div>
                  </div>
                  @endforeach
                </div>
               </div>
           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
              </div>

          </div>

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
							  <input name="active" class="custom-control-input" type="checkbox" id="active" name="active" value="1" @if (request()->routeIs($module_info['module'].'.create'))  {{'checked' }} @elseif ($Article->active) checked @endif>
							  <label for="active" class="custom-control-label">Активная</label>
							</div>
						</div>


						@if(in_array($module_info['module'],['career']) && !empty($employmenttypes))
							<hr>
							<div class="form-group">
								<label>Вид занятости<span>:</span></label>
								@foreach($employmenttypes as $employmenttype)
									<div class="custom-control custom-checkbox ml-2">
									  <input name="employmenttype[]" class="custom-control-input" type="checkbox" id="employmenttype_{{ $employmenttype }}" name="active" value="{{ $employmenttype }}" @if ($Article->employmenttype && in_array($employmenttype,json_decode($Article->employmenttype))) checked @endif>
									  <label for="employmenttype_{{ $employmenttype }}" class="custom-control-label">{{ $employmenttype }}</label>
									</div>
								@endforeach
							</div>
							<div class="ano">Параметр employmentType<br> Подробнее о видах занятости <a href="https://developers.google.com/search/docs/advanced/structured-data/job-posting?hl=ru" target="_blank">тут</a></div>
							<hr>
						@endif


					@if(in_array($module_info['module'],['articles']))
						<div class="form-group">
							<div class="custom-control custom-checkbox">
							  <input name="in_nav" class="custom-control-input" type="checkbox" id="in_nav" name="in_nav" value="1" @if (request()->routeIs($module_info['module'].'.create'))  {{'checked' }} @elseif ($Article->in_nav) checked @endif>
							  <label for="in_nav" class="custom-control-label">Отображать в главном меню</label>
							</div>
						</div>
					@endif
						<div class="bootstrap-timepicker">
						  <div class="form-group">
		                    <label>Дата создания/публикации:</label>
							<div class="input-group date" id="created_at" data-target-input="nearest">
							  <input type="text" data-event_time name="created_at" class="form-control datetimepicker-input" data-target="#created_at" value="{{ request()->routeIs($module_info['module'].'.create') ? date('Y-m-d H:i:s') : $Article->created_at }}"  placeholder="2021-12-31 15:30:00"/>
							  <div class="input-group-append" data-target="#created_at" data-toggle="datetimepicker">
								  <div class="input-group-text"><i class="far fa-clock"></i></div>
							  </div>
							</div>
						  </div>
						</div>
						@if(in_array($module_info['module'], ['articles','projects','faq','reviews','benefits','sections']))
						  <div class="form-group">
		                    <label>Позиция в списке:</label>
							<input name="position" value="{{($Article->position ? $Article->position : old('position') )}}" type="text" class="form-control" placeholder="0 или пусто - выставится автомаически">
						  </div>
						@endif

						@if(in_array($module_info['module'],['faq']))
	                      <input type="hidden" value="12" name="faq_categories" />
						  {{--
						  <div class="form-group">
	                        <label>Отображать на странице: </label>
							<select class="form-control" name="faq_categories">
								<optgroup label="На странице:">
									<option value="1" @if($Article->faq_categories=='1') selected="selected" @endif>На главной</option>
									<option value="0" disabled></option>
								</optgroup>
								@if(!empty($offers))
								<optgroup label="На странице предложений:">
									@foreach($offers as $item)
										@if($item->details_one['name'])<option value="{{ $item->id }}" @if($Article->faq_categories == $item->id ) selected="selected" @endif>{{ $item->details_one['name'] }}</option>@endif
									@endforeach
									<option value="0" disabled></option>
								</optgroup>
								@endif
								@if(!empty($industries))
								<optgroup label="На странице отраслей:">
									@foreach($industries as $item)
										@if($item->details_one['name'])<option value="{{ $item->id }}" @if($Article->faq_categories == $item->id ) selected="selected" @endif>{{ $item->details_one['name'] }}</option>@endif
									@endforeach
								</optgroup>
								@endif
							</select>
						  </div>
						  --}}
						@endif

						@if($module_info['module']=='articles')
                      <div class="form-group">
                        <label>Шаблон:</label>
                        <select class="form-control" name="template">
                        	<option value="article" @if($Article->template and $Article->template=='article') selected="selected" @endif>Single page</option>
									<option value="main" @if($Article->template and $Article->template=='main') selected="selected" @endif>Main page</option>
									<option value="offer_for_investor" @if($Article->template and $Article->template=='offer_for_investor') selected="selected" @endif>Offer for investor</option>
									<option value="acquiring_an_investor" @if($Article->template and $Article->template=='acquiring_an_investor') selected="selected" @endif>Acquiring an investor</option>

									<option value="about_why_us" @if($Article->template and $Article->template=='about_why_us') selected="selected" @endif>About - Why us</option>
									<option value="about_shop" @if($Article->template and $Article->template=='about_shop') selected="selected" @endif>About - Shop</option>
									<option value="faq" @if($Article->template and $Article->template=='faq') selected="selected" @endif>About - FAQ</option>
									<option value="services" @if($Article->template and $Article->template=='services') selected="selected" @endif>Services</option>
									<option value="industries" @if($Article->template and $Article->template=='industries') selected="selected" @endif>Industries</option>
									<option value="prices" @if($Article->template and $Article->template=='prices') selected="selected" @endif>Prices</option>
									<option value="blog" @if($Article->template and $Article->template=='blog') selected="selected" @endif>Blog</option>
									<option value="projects" @if($Article->template and $Article->template=='projects') selected="selected" @endif>Projects</option>
									<option value="contacts" @if($Article->template and $Article->template=='contacts') selected="selected" @endif>Contacts</option>
									<option value="team" @if($Article->template and $Article->template=='team') selected="selected" @endif>Team</option>
									<option value="projects" @if($Article->template and $Article->template=='projects') selected="selected" @endif>Projects</option>
						</select>
                      </div>
					   @endif

						@if(!empty($Article->getSubTemplates($module_info['module'])))
						<div class="form-group">
							<label>Шаблон отрасли:</label>
							<select class="form-control" name="sub_template">
								<option value="">Не указано</option>
								@foreach($Article->getSubTemplates($module_info['module']) as $sub_template)
									<option value="{{$sub_template}}" @if($Article->sub_template==$sub_template) selected="selected" @endif>{{$sub_template}}</option>
								@endforeach
							</select>
						  </div>
					    @endif
					@if(!empty($module_info['fields']['files']) || (in_array($module_info['module'],['projects','sections']) && (!empty($module_info['categories'][$Article->id]['fields']['files']) || !empty($module_info['categories'][$Article->parent_id]['sub_fields']['files']) || !empty($module_info['categories'][request()->parent_id]['sub_fields']['files']))))
						<div class="form-group">
							<label>
							@if(!empty($module_info['fields']['files']['title']))
									{{$module_info['fields']['files']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['content']['title']))
									{{$module_info['categories'][$Article->id]['fields']['files']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][$Article->parent_id]['sub_fields']['files']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][request()->parent_id]['sub_fields']['files']['title']}}
								@else Файлы @endif</label>
							<div class="custom-file">
							  <input type="file" class="custom-file-input" name="files[]" id="files" multiple="multiple" >
							  <label class="custom-file-label" for="files">Выбрать файлы</label>
							</div>
							@if($Article->files)
								<ul class="list_thumb as_files">
									@foreach (json_decode($Article->files, true) as $file)
										<li>
											<a href="{{ (File::exists($file) ? asset($file) : (File::exists('storage/'.$file) ? asset('storage/'.$file) : '')) }}" target="_blank">
												<img src="{{ asset('adm/dist/img/file.svg') }}" />
												<div class="checkbox_block">
												  <input class="custom-control-input" type="checkbox" id="files_remove_{{ $loop->index }}" name="files_remove[{{ $loop->index }}]" value="1" >
												  <label for="files_remove_{{ $loop->index }}" class="custom-control-label font-weight-normal" title="Удалить после сохранения"></label>
												</div>
											</a>
										</li>
									@endforeach
								</ul>
							@endif
						</div>
					@endif
					@if(!empty($module_info['fields']['images']) || (in_array($module_info['module'],['projects','sections']) && (!empty($module_info['categories'][$Article->id]['fields']['images']) || !empty($module_info['categories'][$Article->parent_id]['sub_fields']['images']) || !empty($module_info['categories'][request()->parent_id]['sub_fields']['images']))))
						<div class="form-group">
							<label>
							@if(!empty($module_info['fields']['images']['title']))
									{{$module_info['fields']['images']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['content']['title']))
									{{$module_info['categories'][$Article->id]['fields']['images']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][$Article->parent_id]['sub_fields']['images']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][request()->parent_id]['sub_fields']['images']['title']}}
								@else Фото @endif</label>
							<div class="custom-file">
							  <input type="file" class="custom-file-input" name="images[]" id="images" multiple="multiple" >
							  <label class="custom-file-label" for="images">Выбрать фото</label>
							</div>
							@if(!empty($Article->images))
								<ul class="list_thumb">
									@foreach (json_decode($Article->images, true) as $image)
										<li>
											<a href="{{ (File::exists($image) ? asset($image) : (File::exists('storage/'.$image) ? asset('storage/'.$image) : '')) }}" target="_blank">
												<img src="{{ (File::exists($image) ? asset($image) : (File::exists('storage/'.$image) ? asset('storage/'.$image) : '')) }}" />
												<div class="checkbox_block">
												  <input class="custom-control-input" type="checkbox" id="images_remove_{{ $loop->index }}" name="images_remove[{{ $loop->index }}]" value="1" >
												  <label for="images_remove_{{ $loop->index }}" class="custom-control-label font-weight-normal" title="Удалить после сохранения"></label>
												</div>
											</a>
										</li>
									@endforeach
								</ul>
							@endif
						</div>
					@endif
					@if(!empty($module_info['fields']['filepath']) || (in_array($module_info['module'],['sections']) && (!empty($module_info['categories'][$Article->id]['fields']['filepath']) || !empty($module_info['categories'][$Article->parent_id]['sub_fields']['filepath']) || !empty($module_info['categories'][request()->parent_id]['sub_fields']['filepath']))))
						<div class="form-group">
							<label>
							@if(!empty($module_info['fields']['filepath']['title']))
									{{$module_info['fields']['filepath']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['filepath']['title']))
									{{$module_info['categories'][$Article->id]['fields']['filepath']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['filepath']['title']))
									{{$module_info['categories'][$Article->parent_id]['sub_fields']['filepath']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['filepath']['title']))
									{{$module_info['categories'][request()->parent_id]['sub_fields']['filepath']['title']}}
								@else Фото @endif</label>
							<div class="custom-file">
							  <input type="file" class="custom-file-input" name="filepath" id="filepath">
							  <label class="custom-file-label" for="filepath">Выбрать файл</label>
							</div>
							@if($Article->filepath)
							<div class="filepath_img">
								<div class="custom-control custom-checkbox">
								  <input class="custom-control-input" type="checkbox" id="filepath_remove" name="filepath_remove" value="1" >
								  <label for="filepath_remove" class="custom-control-label font-weight-normal">Удалить файл после сохранения</label>
								</div>
								<div class="file_rezult">
									<img class="img-fluid" src="{{ (File::exists($Article->filepath) ? asset($Article->filepath) : (File::exists('storage/'.$Article->filepath) ? asset('storage/'.$Article->filepath) : '')) }}" />
								</div>
							</div>
							@endif
						</div>
					@endif
					@if(!empty($module_info['fields']['logopath']) || (in_array($module_info['module'],['sections']) && (!empty($module_info['categories'][$Article->id]['fields']['logopath']) || !empty($module_info['categories'][$Article->parent_id]['sub_fields']['logopath']) || !empty($module_info['categories'][request()->parent_id]['sub_fields']['logopath']))))
						<div class="form-group">
							<label>
							@if(!empty($module_info['fields']['logopath']['title']))
									{{$module_info['fields']['logopath']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->id]['fields']['content']['title']))
									{{$module_info['categories'][$Article->id]['fields']['logopath']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][$Article->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][$Article->parent_id]['sub_fields']['logopath']['title']}}
								@elseif(in_array($module_info['module'],['sections']) && !empty($module_info['categories'][request()->parent_id]['sub_fields']['content']['title']))
									{{$module_info['categories'][request()->parent_id]['sub_fields']['logopath']['title']}}
								@else Описание @endif</label>
							<div class="custom-file">
							  <input type="file" class="custom-file-input" name="logopath" id="logopath">
							  <label class="custom-file-label" for="logopath">Выбрать файл</label>
							</div>
							@if($Article->logopath)
							<div class="filepath_img">
								<div class="custom-control custom-checkbox">
								  <input class="custom-control-input" type="checkbox" id="logopath_remove" name="logopath_remove" value="1" >
								  <label for="logopath_remove" class="custom-control-label font-weight-normal">Удалить файл после сохранения</label>
								</div>
								<div class="file_rezult">
									<img class="img-fluid" src="{{ (File::exists($Article->logopath) ? asset($Article->logopath) : (File::exists('storage/'.$Article->logopath) ? asset('storage/'.$Article->logopath) : '')) }}" />
								</div>
							</div>
							@endif
						</div>
					@endif

					@if(in_array($module_info['module'],['articles','offers']))
					 @if((empty($parent_article) && $Article->parent_id == 0) || in_array($module_info['module'],['articles']))
						<div class="form-group">
                        <label>Возможность создавать дочерние страницы:</label>
                        @if(in_array($module_info['module'],['articles','offers','team']))
							<div class="custom-control custom-radio">
							  <input class="custom-control-input" type="radio" id="sub_no" name="sub" @if (!$Article->id || $Article->sub=='no') checked @endif value="no">
							  <label for="sub_no" class="custom-control-label font-weight-normal">Нет</label>
							</div>
							<div class="custom-control custom-radio">
							  <input class="custom-control-input" type="radio" id="sub_yes" name="sub" @if ($Article->sub=='yes') checked @endif value="yes">
							  <label for="sub_yes" class="custom-control-label font-weight-normal">Да</label>
							</div>
						@endif
						@if(in_array($module_info['module'],['articles']))
						<div class="custom-control custom-radio">
						  <input class="custom-control-input" type="radio" id="sub_nav" name="sub" @if ($Article->sub=='nav') checked @endif value="nav">
						  <label for="sub_nav" class="custom-control-label font-weight-normal">Да, в отдельном модуле</label>
						</div>
						@endif
                      </div>
					 @endif
					@endif


					@if(!empty($module_info['fields']['faq_category']) || (in_array($module_info['module'],['sections']) && (!empty($module_info['categories'][$Article->id]['fields']['faq_category']) || !empty($module_info['categories'][$Article->parent_id]['sub_fields']['faq_category']) || !empty($module_info['categories'][request()->parent_id]['sub_fields']['faq_category']))))
						<div class="form-group">
							<div class="custom-control custom-checkbox">
							  <input name="faq_category" class="custom-control-input" type="checkbox" id="faq_category" name="faq_category" value="1" @if ($Article->faq_category) checked @endif>
							  <label for="faq_category" class="custom-control-label">Отображать на главной странице</label>
							</div>
						</div>
					@endif

					@if(in_array($module_info['module'],['faq']))
						<div class="form-group">
                        <label>Категория:</label>
							@foreach(DATA::faqCategories as $key=>$val)
							<div class="custom-control custom-radio">
							  <input class="custom-control-input" type="radio" id="faq{{$key}}" name="faq_category" @if((!$Article->id && $loop->first) || $Article->faq_category==$key) checked @endif value="{{$key}}">
							  <label for="faq{{$key}}" class="custom-control-label font-weight-normal">{{$val}}</label>
							</div>
							@endforeach
                      </div>
					@endif

					@if(in_array($module_info['module'],['sections']))

						<input name="section_id" value="{{ ($Article->section_id ? $Article->section_id : (!empty(request()->section_id) ? request()->section_id : old('section_id'))) }}" type="hidden">

						{{--
						<div class="form-group">
							<label>Категория:</label>
							@foreach($module_info['categories'] as $key=>$val)
							<div class="custom-control custom-radio">
							  <input class="custom-control-input" type="radio" id="sections{{$key}}" name="section_id" @if((!$Article->id && $loop->first) || $Article->section_id==$key || (!empty(request()->section_id) && request()->section_id == $key)) checked @endif value="{{$key}}">
							  <label for="sections{{$key}}" class="custom-control-label font-weight-normal">{{$val['title']}}</label>
							</div>
							@endforeach
						</div>
						--}}
					@endif


                    </div>

                </div>
            </div>
           	    <div class="card-footer">
                  <button type="submit" class="btn btn-info trigger_btn">Сохранить</button>
                </div>
		   </div>



		  </div>

        </div>
        </div>
        </form>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
