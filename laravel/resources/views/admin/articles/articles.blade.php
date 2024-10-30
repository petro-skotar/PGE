@extends('admin.template')

@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">{{$module_info['title']}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            @if(!in_array($module_info['module'],['sections']))
				<a href="{{route($module_info['module'].'.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> {{$module_info['add_button']}}</a>
			@endif
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
          @if ($articles)

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$module_info['list_pages']}}</h3>
              </div>

              <!-- /.card-header -->
              @if(count($articles)>0 || in_array($module_info['module'],['sections']))
              <div class="card-body table-responsive p-0">
				<table class="table table-sm table-hover text-nowrap listing ui-sortable">
				@php
					$faq_category = -999;
					$section_id = -999;
					$section_ids = [];
				@endphp
                  @foreach($articles as $article)
					@if($article->parent_id==0) <?php $parent_article_id = $article->id ?>
						@if(in_array($module_info['module'],['faq']))
							@if($article->faq_category != $faq_category)
								@php $faq_category = $article->faq_category; @endphp
								<tr>
									<td class="align-middle ucolor" colspan="10">
										<i class="fas fa-list"></i>
										&nbsp;
										<span>{{ DATA::faqCategories[$article->faq_category] }}:</span>
									</td>
								</tr>
							@endif
						@endif
						@if(in_array($module_info['module'],['sections']))
							@if(!empty($article->section_id) && $article->section_id != $section_id)
								@php $section_id = $article->section_id; $section_ids[] = $article->section_id; @endphp
								<tr>
									<td class="align-middle ucolor" colspan="9">
										@if(!empty($module_info['class-icon']))
											<i class="{{ $module_info['class-icon'] }}"></i>
										@else
											<i class="fas fa-list"></i>
										@endif
										&nbsp;
										<span>{{ $module_info['categories'][$article->section_id]['title'] }}:</span> &nbsp;
										<a href="{{route($module_info['module'].'.create')}}?section_id={{ $section_id }}" title="Добавить новый пункт" style="color: #007bff; font-weight: normal;"><i class="fas fa-plus"></i> добавить</a>
									</td>
									<td class="text-right ucolor">ID: {{ $section_id }}</td>
								</tr>
							@endif
						@endif
						<tr data-id="{{$article->id}}" data-url="{{route($module_info['module'].'.update', $article->id)}}">
	                     	<td class="align-middle">
	                      		<span class="handle">
		                      		@if(!empty($module_info['categories'][$section_id]['class-icon']))
										<i class="{{ $module_info['categories'][$section_id]['class-icon'] }}"></i>
									@elseif(!empty($module_info['class-icon']))
										<i class="{{ $module_info['class-icon'] }}"></i>
									@else
										<i class="fas fa-list"></i>
									@endif
                     			</span>
                     		</td>
	                      <td class="align-middle full-width pr-3"><a href="{{route($module_info['module'].'.edit', $article->id)}}">
							  @if(!empty($article->details_lang($LANG)['short_name']))
								{!! $article->details_lang($LANG)['short_name'] !!}
							  @elseif(!empty($article->details_lang($LANG)['name']))
								{!! strip_tags($article->details_lang($LANG)['name'], '<sup>') !!}
							  @else
								<span style="color:red">No name in language [{{ $LANG }}]</span>
							  @endif
							  </a>
								@if($article->sub == 'yes') &nbsp; <a href="{{route($module_info['module'].'.create')}}?parent_id={{$article->id}}" title="Create a child page"><span><i class="fas fa-plus"></i></span></a>@endif
								@if($article->sub == 'nav') &nbsp; <a href="{{'/admin/'.$article->template}}" title="Перейти в раздел"><span><i class="far fa-list-alt"></i></span></a>@endif
						  </td>

							  @if(in_array($article->module, ['blog','news']))
								<td class="align-middle text-right" style="padding-right: 20px;"> <span>{{ $article->created_at }}</span>  </td>
							  @else
								<td class="align-middle" title="Position in the list"><span class="iposition"><i class="fas fa-arrows-alt"></i> {{ $article->position }}</span></td>
							  @endif
							@foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details)
								<td class="align-middle text-right">
									@if(!empty($article->details_lang($lang)))
										<img class="icon_lang" src="{{ asset('adm/dist/img/flags/4x3/'.$lang.'.svg') }}" title="{{$lang_details['native']}}" />
									@endif
								</td>
							@endforeach
						  <td class="align-middle pl-3">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($article->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$article->id}}">
							  <label class="custom-control-label" for="active{{$article->id}}"></label>
							</div>
						  </td>
	                      <td class="align-middle text-right">
	                      	<div class="btn-group">
								@if(!empty($article->details_lang($LANG)['url']))
								<a href="@if($article->module == 'offers'){{route('viewOffer', $article->details_lang($LANG)['url'])}}
											 @elseif($article->module == 'industries'){{route('viewIndustry', $article->details_lang($LANG)['url'])}}
											 @elseif($article->module == 'careers'){{route('viewCareer', $article->details_lang($LANG)['url'])}}
											 @elseif($article->module == 'our-teams'){{route('viewOurTeam', $article->details_lang($LANG)['url'])}}
											 @elseif($article->module == 'projects'){{route('viewProject', $article->details_lang($LANG)['url'])}}
											 @else{{route('viewArticle', $article->details_lang($LANG)['url'])}}
										 @endif" class="btn btn-sm btn-flat" title="Посмотреть на сайте" target="_blank"><i class="fas fa-desktop"></i></a>
		                        @endif
								<a href="{{route($module_info['module'].'.edit', $article->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
		                        @if(!in_array($module_info['module'],['sections-off']))
								<form action="{{ route($module_info['module'].'.destroy' , $article->id)}}" method="POST">
    								<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
		                       		<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
		                        </form>
		                        @endif
		                      </div>
	                      </td>
	                    </tr>

						  @foreach($articles as $article)
							@if($article->parent_id==$parent_article_id) <?php $parent_article_id_2 = $article->id ?>
								<tr data-id="{{$article->id}}" data-url="{{route($module_info['module'].'.update', $article->id)}}">
									<td class="align-middle text-right" style="">
										&nbsp;
									</td>
								  <td class="align-middle full-width" ><a href="{{route($module_info['module'].'.edit', $article->id)}}">
									<span class="handle" style="margin-right: 7px;">
										<i class="fas fa-ellipsis-h"></i>
									</span>
								  @if(!empty($article->details_lang($LANG)['short_name']))
									{!! $article->details_lang($LANG)['short_name'] !!}
								  @elseif(!empty($article->details_lang($LANG)['name']))
									{!! strip_tags($article->details_lang($LANG)['name'], '<sup>') !!}
								  @else
									<span style="color:red">No name in language [{{ $LANG }}]</span>
								  @endif
								  </a>
									@if($article->faq_category) <span class="ano">(на главной)</span>@endif
									@if($article->sub == 'yes') &nbsp; <a href="{{route($module_info['module'].'.create')}}?parent_id={{$article->id}}" title="Create a child page"><span><i class="fas fa-plus"></i></span></a>@endif
									@if($article->sub == 'nav') &nbsp; <a href="{{'/admin/'.$article->template}}" title="Перейти в раздел"><span><i class="far fa-list-alt"></i></span></a>@endif
								  </td>

								  @if(!in_array($article->module, ['partners','news','events']))
									<td class="align-middle" title="Position in the list"><span class="iposition"><i class="fas fa-arrows-alt"></i> {{ $article->position }}</span></td>
								  @endif
									@foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details)
										<td class="align-middle text-right">
											@if(!empty($article->details_lang($lang)))
												<img class="icon_lang" src="{{ asset('adm/dist/img/flags/4x3/'.$lang.'.svg') }}" title="{{$lang_details['native']}}" />
											@endif
										</td>
									@endforeach
								  <td class="align-middle pl-3">
									<div class="custom-control custom-switch ajax_check">
									  <input type="checkbox" @if ($article->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$article->id}}">
									  <label class="custom-control-label" for="active{{$article->id}}"></label>
									</div>
								  </td>
								  <td class="align-middle text-right">
									<div class="btn-group">
										@if(!empty($article->details_lang($LANG)['url']))
										<a href="{{route('viewArticle', $article->details_lang($LANG)['url'])}}" class="btn btn-sm btn-flat" title="Посмотреть на сайте" target="_blank"><i class="fas fa-desktop"></i></a>
										@endif
										<a href="{{route($module_info['module'].'.edit', $article->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
										@if(!in_array($module_info['module'],['sections-off']))
										<form action="{{ route($module_info['module'].'.destroy' , $article->id)}}" method="POST">
											<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
											<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
										</form>
										@endif
									  </div>
								  </td>
								</tr>

								@foreach($articles as $article)
									@if($article->parent_id==$parent_article_id_2) <?php $parent_article_id_3 = $article->id ?>
										<tr data-id="{{$article->id}}" data-url="{{route($module_info['module'].'.update', $article->id)}}">
											<td class="align-middle text-right" style="">
												&nbsp;
											</td>
										  <td class="align-middle full-width" style="padding-left: 30px;"><a href="{{route($module_info['module'].'.edit', $article->id)}}">
											<span class="handle" style="margin-right: 7px;">
												<i class="fas fa-ellipsis-h"></i>
											</span>
										  @if(!empty($article->details_lang($LANG)['short_name']))
											{!! $article->details_lang($LANG)['short_name'] !!}
										  @elseif(!empty($article->details_lang($LANG)['name']))
											{!! strip_tags($article->details_lang($LANG)['name'], '<sup>') !!}
										  @else
											<span style="color:red">No name in language [{{ $LANG }}]</span>
										  @endif
										  </a>
											@if($article->sub == 'yes') &nbsp; <a href="{{route($module_info['module'].'.create')}}?parent_id={{$article->id}}" title="Create a child page"><span><i class="fas fa-plus"></i></span></a>@endif
											@if($article->sub == 'nav') &nbsp; <a href="{{'/admin/'.$article->template}}" title="Перейти в раздел"><span><i class="far fa-list-alt"></i></span></a>@endif
										  </td>

										  @if(!in_array($article->module, ['partners','news','events']))
											<td class="align-middle" title="Position in the list"><span class="iposition"><i class="fas fa-arrows-alt"></i> {{ $article->position }}</span></td>
										  @endif
											@foreach (Config::get('laravellocalization.supportedLocales') as $lang => $lang_details)
												<td class="align-middle text-right">
													@if(!empty($article->details_lang($lang)))
														<img class="icon_lang" src="{{ asset('adm/dist/img/flags/4x3/'.$lang.'.svg') }}" title="{{$lang_details['native']}}" />
													@endif
												</td>
											@endforeach

										  <td class="align-middle pl-3">
											<div class="custom-control custom-switch ajax_check">
											  <input type="checkbox" @if ($article->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$article->id}}">
											  <label class="custom-control-label" for="active{{$article->id}}"></label>
											</div>
										  </td>
										  <td class="align-middle text-right">
											<div class="btn-group">
												@if(!empty($article->details_lang($LANG)['url']))
												<a href="{{route('viewArticle', $article->details_lang($LANG)['url'])}}" class="btn btn-sm btn-flat" title="Посмотреть на сайте" target="_blank"><i class="fas fa-desktop"></i></a>
												@endif
												<a href="{{route($module_info['module'].'.edit', $article->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
												@if(!in_array($module_info['module'],['sections']))
												<form action="{{ route($module_info['module'].'.destroy' , $article->id)}}" method="POST">
													<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
													<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
												</form>
												@endif
											  </div>
										  </td>
										</tr>

										@foreach($articles as $article)
											@if($article->parent_id==$parent_article_id_3)
												<tr data-id="{{$article->id}}" data-url="{{route($module_info['module'].'.update', $article->id)}}">
													<td class="align-middle text-right" style="">
														&nbsp;
													</td>
												  <td class="align-middle full-width" style="padding-left: 80px;"><a href="{{route($module_info['module'].'.edit', $article->id)}}">
												  @if(!empty($article->details_lang($LANG)['short_name']))
													{!! $article->details_lang($LANG)['short_name'] !!}
												  @elseif(!empty($article->details_lang($LANG)['name']))
													{!! strip_tags($article->details_lang($LANG)['name'], '<sup>') !!}
												  @else
													<span style="color:red">No name in language [{{ $LANG }}]</span>
												  @endif
												  </a>
													@if($article->sub == 'yes') &nbsp; <a href="{{route($module_info['module'].'.create')}}?parent_id={{$article->id}}" title="Create a child page"><span><i class="fas fa-plus"></i></span></a>@endif
													@if($article->sub == 'nav') &nbsp; <a href="{{'/admin/'.$article->template}}" title="Перейти в раздел"><span><i class="far fa-list-alt"></i></span></a>@endif
												  </td>

												  @if(!in_array($article->module, ['partners','news','events']))
													<td class="align-middle" title="Position in the list"><span class="iposition"><i class="fas fa-arrows-alt"></i> {{ $article->position }}</span></td>
												  @endif

												  <td class="align-middle text-right"><span class="none_lang">@if(empty($article->details_many[0]['name']))<s title="Этой страницы нет на русском языке">RU</s>@endif @if(empty($article->details_many[1]['name']))<s title="Этой страницы нет на английском языке">EN</s>@endif</span></td>
												  <td class="align-middle">
													<div class="custom-control custom-switch ajax_check">
													  <input type="checkbox" @if ($article->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$article->id}}">
													  <label class="custom-control-label" for="active{{$article->id}}"></label>
													</div>
												  </td>
												  <td class="align-middle text-right">
													<div class="btn-group">
														@if(!empty($article->details_lang($LANG)['url']))
														<a href="{{route('viewArticle', $article->details_lang($LANG)['url'])}}" class="btn btn-sm btn-flat" title="Посмотреть на сайте" target="_blank"><i class="fas fa-desktop"></i></a>
														@endif
														<a href="{{route($module_info['module'].'.edit', $article->id)}}" class="btn btn-sm btn-flat" title="Edit"><i class="far fa-edit"></i></a>
														@if(!in_array($module_info['module'],['sections']))
														<form action="{{ route($module_info['module'].'.destroy' , $article->id)}}" method="POST">
															<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
															<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
														</form>
														@endif
													  </div>
												  </td>
												</tr>
											@endif
										@endforeach

									@endif
								@endforeach

							@endif
						  @endforeach

					@endif
				  @endforeach

                </table>
              </div>
			  @else
				<div class="card-body">
					<p>Еще нет записей</p>
				</div>
			  @endif
              <!-- /.card-body -->
				  <div class="card-footer ">
						<div class="row">
							<div class="col-sm-12">
								@if(!in_array($module_info['module'],['sections']))
									<a href="{{route($module_info['module'].'.create')}}" class="btn btn-info"><i class="fas fa-plus"></i> {{$module_info['add_button']}}</a>
								@endif
							</div>
						</div>
					</div>
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
