@foreach($MediatekaCategories as $category)
	@if($category->parent_id == 0)
		<tr data-id="{{$category->id}}" data-url="{{route('mediateka.update', $category->id)}}?type=category" data-type="category">
		  <td class="align-middle full-width">
			<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$category->id}}" title="{{($category->name_ru ? $category->name_ru : $category->name_en)}}"><i class="fa fa-folder mr-1" aria-hidden="true"></i> {{($category->name_ru ? $category->name_ru : $category->name_en)}}</a>
		  </td>
		  <td class="align-middle pr-4">
			  &nbsp;
		  </td>
		  @if(Auth::user()->id == 1)
		  <td class="align-middle" title="MUMCFM">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($category->mumcfm)checked="checked" @endif class="custom-control-input mumcfm" name="mumcfm" id="mumcfm{{$category->id}}">
			  <label class="custom-control-label" for="mumcfm{{$category->id}}"></label>
			</div>
		  </td>
		  <td class="align-middle" title="aml">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($category->aml)checked="checked" @endif class="custom-control-input aml" name="aml" id="aml{{$category->id}}">
			  <label class="custom-control-label" for="aml{{$category->id}}"></label>
			</div>
		  </td>
		  <td class="align-middle pr-3" title="SFPFR">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($category->fiu_cis)checked="checked" @endif class="custom-control-input fiu_cis" name="fiu_cis" id="fiu_cis{{$category->id}}">
			  <label class="custom-control-label" for="fiu_cis{{$category->id}}"></label>
			</div>
		  </td>
		  @endif
		  <td class="align-middle text-right"><span class="none_lang">@if(!empty($category->name_ru))RU @endif</span></td>
		  <td class="align-middle text-right pr-4"><span class="none_lang">@if(!empty($category->name_en))EN @endif</span></td>
		  <td class="align-middle">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($category->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$category->id}}">
			  <label class="custom-control-label" for="active{{$category->id}}"></label>
			</div>
		  </td>
		  <td class="align-middle">
			<div class="btn-group">
				<a href="{{route('mediateka.edit', $category->id)}}?type=category" class="btn btn-sm btn-flat" title="Edit {{$category->id}}"><i class="far fa-edit"></i></a>
				@if($category->id != 53)
				<form action="{{ route('mediateka.destroy' , $category->id)}}?type=category" method="POST">
					<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
					<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
				</form>
				@endif
			  </div>
		  </td>
		</tr>
		@foreach($MediatekaCategories as $category_lv_2)
			@if($category_lv_2->parent_id == $category->id)
			<tr data-id="{{$category_lv_2->id}}" data-url="{{route('mediateka.update', $category_lv_2->id)}}?type=category" data-type="category">
			  <td class="align-middle full-width">
				@if($category_lv_2->parent_id > 0)
					<span class="ml-3"></span>
				@endif
				<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$category_lv_2->id}}" title="{{($category_lv_2->name_ru ? $category_lv_2->name_ru : $category_lv_2->name_en)}}"><i class="fa fa-folder mr-1" aria-hidden="true"></i> {{($category_lv_2->name_ru ? $category_lv_2->name_ru : $category_lv_2->name_en)}}</a>
			  </td>
			  <td class="align-middle pr-4">
				  @if(!in_array($category_lv_2->parent_id,[53,54,55,56]))
				  <div class="btn-group">
					<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$category_lv_2->id}}" class="tn-block bg-gradient-primary btn btn-xs count_files_in_media_section {{(!count($category_lv_2->documents) ? 'disabled_doc' : '')}}"  title="Просмотр документов этого раздела"><i class="fas fa-file"></i>&nbsp; {{count($category_lv_2->documents)}}</a>
					<a href="{{route('mediateka.create')}}?type=document&parent_id={{$category_lv_2->id}}" class="tn-block bg-gradient-primary btn btn-xs" title="Добавить документ в этот раздел"><i class="fas fa-plus"></i></a>
				  </div>
				  @endif
			  </td>
			  @if(Auth::user()->id == 1)
			  <td class="align-middle" title="MUMCFM">
				<div class="custom-control custom-switch ajax_check">
				  <input type="checkbox" @if ($category_lv_2->mumcfm)checked="checked" @endif class="custom-control-input mumcfm" name="mumcfm" id="mumcfm{{$category_lv_2->id}}">
				  <label class="custom-control-label" for="mumcfm{{$category_lv_2->id}}"></label>
				</div>
			  </td>
			  <td class="align-middle" title="aml">
				<div class="custom-control custom-switch ajax_check">
				  <input type="checkbox" @if ($category_lv_2->aml)checked="checked" @endif class="custom-control-input aml" name="aml" id="aml{{$category_lv_2->id}}">
				  <label class="custom-control-label" for="aml{{$category_lv_2->id}}"></label>
				</div>
			  </td>
			  <td class="align-middle pr-3" title="SFPFR">
				<div class="custom-control custom-switch ajax_check">
				  <input type="checkbox" @if ($category_lv_2->fiu_cis)checked="checked" @endif class="custom-control-input fiu_cis" name="fiu_cis" id="fiu_cis{{$category_lv_2->id}}">
				  <label class="custom-control-label" for="fiu_cis{{$category_lv_2->id}}"></label>
				</div>
			  </td>
			  @endif
			  <td class="align-middle text-right"><span class="none_lang">@if(!empty($category_lv_2->name_ru))RU @endif</span></td>
			  <td class="align-middle text-right pr-4"><span class="none_lang">@if(!empty($category_lv_2->name_en))EN @endif</span></td>
			  <td class="align-middle" title="Активен">
				<div class="custom-control custom-switch ajax_check">
				  <input type="checkbox" @if ($category_lv_2->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$category_lv_2->id}}">
				  <label class="custom-control-label" for="active{{$category_lv_2->id}}"></label>
				</div>
			  </td>
			  <td class="align-middle">
				<div class="btn-group">
					<a href="{{route('mediateka.edit', $category_lv_2->id)}}?type=category" class="btn btn-sm btn-flat" title="Edit {{$category_lv_2->id}}"><i class="far fa-edit"></i></a>
					<form action="{{ route('mediateka.destroy' , $category_lv_2->id)}}?type=category" method="POST">
						<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
						<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
					</form>
				  </div>
			  </td>
			</tr>
			@if(in_array($category_lv_2->parent_id,[53,54,55,56]))
				@foreach($MediatekaCategories as $category_lv_3)
					@if($category_lv_3->parent_id == $category_lv_2->id)
						<tr data-id="{{$category_lv_3->id}}" data-url="{{route('mediateka.update', $category_lv_3->id)}}?type=category" data-type="category">
						  <td class="align-middle full-width">
							@if($category_lv_3->parent_id > 0)
								<span class="ml-5"></span>
							@endif
							<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$category_lv_3->id}}" title="{{($category_lv_3->name_ru ? $category_lv_3->name_ru : $category_lv_3->name_en)}}"><i class="fa fa-folder mr-1" aria-hidden="true"></i> {{($category_lv_3->name_ru ? $category_lv_3->name_ru : $category_lv_3->name_en)}}</a>
						  </td>
						  <td class="align-middle pr-4">
							  <div class="btn-group">
								<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$category_lv_3->id}}" class="tn-block bg-gradient-primary btn btn-xs count_files_in_media_section {{(!count($category_lv_3->documents) ? 'disabled_doc' : '')}}"  title="Просмотр документов этого раздела"><i class="fas fa-file"></i>&nbsp; {{count($category_lv_3->documents)}}</a>
								<a href="{{route('mediateka.create')}}?type=document&parent_id={{$category_lv_3->id}}" class="tn-block bg-gradient-primary btn btn-xs" title="Добавить документ в этот раздел"><i class="fas fa-plus"></i></a>
							  </div>
						  </td>
						  @if(Auth::user()->id == 1)
						  <td class="align-middle" title="MUMCFM">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($category_lv_3->mumcfm)checked="checked" @endif class="custom-control-input mumcfm" name="mumcfm" id="mumcfm{{$category_lv_3->id}}">
							  <label class="custom-control-label" for="mumcfm{{$category_lv_3->id}}"></label>
							</div>
						  </td>
						  <td class="align-middle" title="aml">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($category_lv_3->aml)checked="checked" @endif class="custom-control-input aml" name="aml" id="aml{{$category_lv_3->id}}">
							  <label class="custom-control-label" for="aml{{$category_lv_3->id}}"></label>
							</div>
						  </td>
						  <td class="align-middle pr-3" title="SFPFR">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($category_lv_3->fiu_cis)checked="checked" @endif class="custom-control-input fiu_cis" name="fiu_cis" id="fiu_cis{{$category_lv_3->id}}">
							  <label class="custom-control-label" for="fiu_cis{{$category_lv_3->id}}"></label>
							</div>
						  </td>
						  @endif
						  <td class="align-middle text-right"><span class="none_lang">@if(!empty($category_lv_3->name_ru))RU @endif</span></td>
						  <td class="align-middle text-right pr-4"><span class="none_lang">@if(!empty($category_lv_3->name_en))EN @endif</span></td>
						  <td class="align-middle">
							<div class="custom-control custom-switch ajax_check">
							  <input type="checkbox" @if ($category_lv_3->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$category_lv_3->id}}">
							  <label class="custom-control-label" for="active{{$category_lv_3->id}}"></label>
							</div>
						  </td>
						  <td class="align-middle">
							<div class="btn-group">
								<a href="{{route('mediateka.edit', $category_lv_3->id)}}?type=category" class="btn btn-sm btn-flat" title="Edit {{$category_lv_3->id}}"><i class="far fa-edit"></i></a>
								<form action="{{ route('mediateka.destroy' , $category_lv_3->id)}}?type=category" method="POST">
									<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
									<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
								</form>
							  </div>
						  </td>
						</tr>
					@endif
				@endforeach
			@endif

			@endif
		@endforeach

	@endif

@endforeach
