<table>
    <thead>
    <tr>
        <th>№</th>
        <th>Наименование организации</th>
        <th>Адрес</th>
        <th>сайт</th>		
        <th>электронная почта</th>
        <th>телефон</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articles as $key=>$article)
		<tr>
            <td>{{ $key+1 }}</td>
            <td>{{$article->details_one->name}}</td>
            <td>{{$article->details_one->address}}</td>
            <td>{{$article->details_one->site}}</td>
            <td>{{$article->details_one->email}}</td>
            <td>{{$article->details_one->phone}}</td>
        </tr>
    @endforeach
    </tbody>
</table>