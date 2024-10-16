<table>
    <thead>
    <tr>
        <th>Регион</th>
        <th>Название / Имя</th>
        <th>Место / Организация</th>
        <th>Почта</th>
        <th>Сайт</th>
        <th>Должность</th>
        <th>Подписка</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subscribers as $key=>$subscriber)
		<tr>
            <td>{{$subscriber->name}}</td>
            <td>{{$subscriber->region}}</td>
            <td>{{$subscriber->city}}</td>
            <td>{{$subscriber->email}}</td>
            <td>{{$subscriber->site_url}}</td>
            <td>{{$subscriber->position}}</td>
            <td>{{ ($subscriber->active ? 'да' : 'нет') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
