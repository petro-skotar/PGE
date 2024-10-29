
  <div class="card-body table-responsive p-0">
	<table class="table table-sm table-hover listing ui-sortable">
@php
$cat_name = '';
@endphp
@foreach($documents as $document)
		@if(!$table_search)
		<tr>
			@if($cat_name != $document->category())
				@php
					$cat_name = $document->category();
					if(!empty($cat_name)){
						$cat_name_parent = $document->category()->parent_category();
					} else { $cat_name_parent = false; }
					if(!empty($cat_name_parent)){
						$cat_name_parent_parent = $document->category()->parent_category()->parent_category();
					} else {$cat_name_parent_parent = false; }
				@endphp
				<td colspan="{{ (Auth::user()->id == 1 ? '14' : '11') }}" class="pl-3" style="background: #f5f5f5; border-left: 0;">
					<h3 class="card-title pt-2 pb-2">
						<i class="fa fa-folder mr-1" aria-hidden="true"></i>
						@if(!empty($cat_name_parent_parent)) <a href="{{route('mediateka.index')}}?type=documents&parent_id={{$cat_name_parent_parent->id}}">{{ $cat_name_parent_parent->name_ru }}</a> / @endif
						@if(!empty($cat_name_parent)) <a href="{{route('mediateka.index')}}?type=documents&parent_id={{$cat_name_parent->id}}">{{ $cat_name_parent->name_ru }}</a> / @endif
						<a href="{{route('mediateka.index')}}?type=documents&parent_id={{$cat_name->id}}">{{ $cat_name->name_ru }}</a>
					</h3>
				</td>
			@endif
		</tr>
		@endif
		<tr data-id="{{$document->id}}" data-url="{{route('mediateka.update', $document->id)}}" data-type="document">
		  <td class="align-middle text-right pr-2">@if($document->filepreview)<a href="{{route('mediateka.edit', $document->id)}}?type=document"><img src="{{route('getImg',['mediateka_preview', $document->preview_code(), 72])}}" class="icon-filepreview" /></a>@else <span class="s-icon">{{$document->filetype}}</span> @endif</td>
		  <td class="align-middle full-width">
			<a href="{{route('mediateka.edit', $document->id)}}?type=document" title="{{$document->name}}">{{$document->name}}</a>
		  </td>
		  <td class="align-middle pl-4 pr-2 text-left lh78 text-nowrap">
			<span class="file_size" title="Просмотрено страницу документа"><i class="far fa-eye"></i> {{ $document->revisions_count('v') }}</span>
		  </td>
		  <td class="align-middle pr-4 text-left lh78 text-nowrap">
			<span class="file_size" title="Количество скачиваний/чтений документа (файла)"><i class="{{ ( $document->category_type == 'video' ? 'far fa-play-circle' : 'far fa-arrow-alt-circle-down' ) }} {{ $document->revisions_count('d') }}"></i> {{ $document->revisions_count('d') }}</span>
		  </td>
		  <td class="align-middle pr-4 text-right text-nowrap">
			<span class="file_size">
				@if (!empty($document->filepath) && file_exists('storage/'.$document->filepath))
					@php $size = filesize('storage/'.$document->filepath); @endphp
					{{ round($size/1024/1024,2) }} <span>Mb</span>
				@endif
			</span>
		  </td>
		  <td class="align-middle pr-4"><span class="none_lang">{{$document->filetype}}</span></td>
		  @if(Auth::user()->id == 1)
		  <td class="align-middle" title="MUMCFM">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($document->mumcfm)checked="checked" @endif class="custom-control-input mumcfm" name="mumcfm" id="mumcfm{{$document->id}}">
			  <label class="custom-control-label" for="mumcfm{{$document->id}}"></label>
			</div>
		  </td>
		  <td class="align-middle" title="aml">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($document->aml)checked="checked" @endif class="custom-control-input aml" name="aml" id="aml{{$document->id}}">
			  <label class="custom-control-label" for="aml{{$document->id}}"></label>
			</div>
		  </td>
		  <td class="align-middle pr-3" title="SFPFR">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($document->fiu_cis)checked="checked" @endif class="custom-control-input fiu_cis" name="fiu_cis" id="fiu_cis{{$document->id}}">
			  <label class="custom-control-label" for="fiu_cis{{$document->id}}"></label>
			</div>
		  </td>
		  @endif
		  <td class="align-middle text-right pr-4"><img class="icon_lang" src="{{ asset('adm/dist/img/flags/4x3/'.$document->lang.'.svg') }}" /></td>
		  <td class="align-middle" title="Активен">
			<div class="custom-control custom-switch ajax_check">
			  <input type="checkbox" @if ($document->active)checked="checked"@endif class="custom-control-input active" name="active" id="active{{$document->id}}">
			  <label class="custom-control-label" for="active{{$document->id}}"></label>
			</div>
		  </td>
		  <td class="align-middle text-right">@if ($document->filepath)<a href="{{route('download_files',$document->code())}}" class="btn btn-sm btn-flat" title="Скачать документ" target="_blank"><i class="fa fa-download"></i></a>@endif</td>
		  <td class="align-middle text-right"><a href="{{route('viewDocument',$document->id)}}" class="btn btn-sm btn-flat" title="Открыть на сайте" target="_blank"><i class="fas fa-desktop"></i></a></td>
		  <td class="align-middle">
			<div class="btn-group">
				<a href="{{route('mediateka.edit', $document->id)}}?type=document" class="btn btn-sm btn-flat" title="Edit {{$document->id}}"><i class="far fa-edit"></i></a>
				<form action="{{ route('mediateka.destroy' , $document->id)}}?type=documents{{(!empty($_GET['parent_id']) ? '&parent_id='.$_GET['parent_id'] : '')}}" method="POST">
					<input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
					<button type="submit" class="btn btn-sm btn-flat"  onclick="return confirm('Действительно удалить?')" title="Удалить"><i class="far fa-trash-alt"></i></button>
				</form>
			  </div>
		  </td>
		</tr>
@endforeach
	</table>
</div>
