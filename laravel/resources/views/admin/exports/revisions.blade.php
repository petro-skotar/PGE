<table>
    <thead>
    <tr>
        <th>Статистика просмотров на сайте {{ Config::get('cms.sites.'.$MODE.'.site_name') }} с {{ $filter['date_start'] }} по {{ $filter['date_end'] }}</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th>№</th>
        <th>Документ</th>
        <th>Category</th>
        <th>Ссылка на документ</th>
        <th>Формат файла</th>
        <th>Количество просмотров страницы документа</th>
        <th>Количество скачиваний/чтений файла</th>
        <th>Доступен для скачивания</th>
    </tr>
    </thead>
    <tbody>
	@if (count($revisions)>0)
	  @foreach($revisions as $key=>$items)
	    @if($items->document())
		<tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $items->document()->filename }}</td>
            <td>{{ $items->document()->category()->name_ru }}</td>
            <td><a href="{{ route('viewDocument', $items->parent_id ) }}">{{ route('viewDocument', $items->parent_id ) }}</a></td>
            <td>{{ $items->document()->filetype }}</td>
            <td>{{ count($items->views($filter)) }}</td>
            <td>{{ count($items->downloads($filter)) }}</td>
            <td>{{ ($items->document()->only_view ? 'Нет' : 'Да') }}</td>
        </tr>
	    @endif
	  @endforeach
    @endif
    </tbody>
</table>
