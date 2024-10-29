<table>
    <thead>
    <tr>
        <th>Статистика просмотров на сайте {{ Config::get('cms.sites.'.$MODE.'.site_name') }} с {{ $filter['date_start'] }} по {{ $filter['date_end'] }}</th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th>Category</th>
        <th>Subcategory</th>
        <th>Document</th>
        <th>Document Link</th>
        <th>File Format</th>
        <th>Language</th>
        <th>Document Page Views</th>

        <th>File Downloads/Reads</th>
        <th>Available for Download</th>
    </tr>
    </thead>
    <tbody>
	@if (count($MediatekaCategories)>0)
	    @foreach($MediatekaCategories as $category)
	      @if($category->parent_id == 0)
		        <tr>
					<td>{{($category->name_ru ? $category->name_ru : $category->name_en)}}</td>
		        </tr>
				@if(count($category->documents)>0)
					@foreach($category->documents()->orderBy('created_at','desc')->get() as $document)
						<tr>
							<td></td>
							<td></td>
							<td>{{ $document->filename }}</td>
							<td><a href="{{ route('viewDocument', $document->id ) }}">{{ route('viewDocument', $document->id ) }}</a></td>
							<td>{{ $document->filetype }}</td>
							<td>{{ $document->lang }}</td>
							<td>{{ $document->revisions_count('v', $filter) }}</td>
							<td>{{ $document->revisions_count('d', $filter) }}</td>
							<td>{{ ($document->only_view ? 'Нет' : 'Да') }}</td>
						</tr>
					@endforeach
				@endif
				@foreach($MediatekaCategories as $category_lv_2)
					@if($category_lv_2->parent_id == $category->id)
						<tr>
							<td></td>
							<td>{{($category_lv_2->name_ru ? $category_lv_2->name_ru : $category_lv_2->name_en)}}</td>
						</tr>
						@if(count($category_lv_2->documents)>0)
							@foreach($category_lv_2->documents()->orderBy('created_at','desc')->get() as $document)
								<tr>
									<td></td>
									<td></td>
									<td>{{ $document->filename }}</td>
									<td><a href="{{ route('viewDocument', $document->id ) }}">{{ route('viewDocument', $document->id ) }}</a></td>
									<td>{{ $document->filetype }}</td>
									<td>{{ $document->lang }}</td>
									<td>{{ $document->revisions_count('v', $filter) }}</td>
									<td>{{ $document->revisions_count('d', $filter) }}</td>
									<td>{{ ($document->only_view ? 'Нет' : 'Да') }}</td>
								</tr>
							@endforeach
						@endif
							@if(in_array($category_lv_2->parent_id,[53,54,55,56]))
								@foreach($MediatekaCategories as $category_lv_3)
									@if($category_lv_3->parent_id == $category_lv_2->id)
										<tr>
											<td></td>
											<td>{{($category_lv_3->name_ru ? $category_lv_3->name_ru : $category_lv_3->name_en)}}</td>
										</tr>
										@if(count($category_lv_3->documents)>0)
											@foreach($category_lv_3->documents()->orderBy('created_at','desc')->get() as $document)
												<tr>
													<td></td>
													<td></td>
													<td>{{ $document->filename }}</td>
													<td><a href="{{ route('viewDocument', $document->id ) }}">{{ route('viewDocument', $document->id ) }}</a></td>
													<td>{{ $document->filetype }}</td>
													<td>{{ $document->lang }}</td>
													<td>{{ $document->revisions_count('v', $filter) }}</td>
													<td>{{ $document->revisions_count('d', $filter) }}</td>
													<td>{{ ($document->only_view ? 'Нет' : 'Да') }}</td>
												</tr>
											@endforeach
										@endif
									@endif
								@endforeach
							@endif
					@endif
				@endforeach
		  @endif
	    @endforeach
    @endif
    </tbody>
</table>
