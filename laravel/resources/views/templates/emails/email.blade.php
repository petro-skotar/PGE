<html>
<head>
	<meta charset="utf-8">
</head>
<body style="padding: 0; margin: 0;">

<table bgcolor="#efefef" border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;  font-size: 15px;  color: #000000;">
	<tbody>
		<tr>
			<td><br><br>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="640" style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;  color: #000000; background-color: #fbfbfb;">
					<tbody>
						<tr><td valign="top" align="center"><br><img src="{{ 'https://pge.construction/templates/pgeconstruction/images/logo-wide@2x.png' }}" border="0" valign="top" width="201" style="vertical-align:top; border-collapse: collapse;" alt="" /><br><br></td></tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="640" style="background: #fff; font-family: Calibri, Arial, 'Helvetica Neue', Helvetica, sans-serif;  color: #ddd859;  ">
					<tbody>
						<tr>
							<td valign="top" align="center" width="55"></td>
							<td valign="top" align="left" style="font-size: 19px; text-align: left; font-family: Calibri, Arial, 'Helvetica Neue', Helvetica, sans-serif;  color: #3f454b;">
								<p style="font-size: 10px;">&nbsp;</p>

								<h2 style="font-size: 26px;"><b>{{$feedback->subject}}</b></h2>
								<p style="font-size: 18px;">
								<b>Name:</b> {{$feedback->firstName}}
								@if(!empty($feedback->lastName))<br><b>Name:</b> {{$feedback->lastName}}@endif
								@if(!empty($feedback->email))<br><b>Email:</b> {{$feedback->email}}@endif
								@if(!empty($feedback->phone))<br><b>Phone:</b> {{$feedback->phone}}@endif
								</p>
								@if(!empty($feedback->message))
									<p style="font-size: 18px;"><b>Message:</b> {!! nl2br($feedback->message) !!}</p>
								@endif
								@if(!empty($feedback->files))
									<p style="font-size: 18px;"><b>Files:</b><ul> {!!$feedback->files!!}</ul></p>
								@endif

                                {{--
								@if(!empty($feedback->checkbox2) || !empty($feedback->checkbox3))
									<p style="font-size: 18px;">
									@if(!empty($feedback->checkbox2))<br><b>@if(!empty(App\Models\Article::getArticle(45)->details_one->name)){!! App\Models\Article::getArticle(45)->details_one->name !!}@endif:</b> {{$feedback->checkbox2}}@endif
									@if(!empty($feedback->checkbox3))<br><b>@if(!empty(App\Models\Article::getArticle(65)->details_one->name)){!! App\Models\Article::getArticle(65)->details_one->name !!}@endif:</b> {{$feedback->checkbox3}}@endif
									</p>
								@endif
								@if(!empty($feedback->checkbox5))
									<p style="font-size: 18px;">
									@if(!empty($feedback->checkbox5))<br><b>@if(!empty(App\Models\Article::getArticle(46)->details_one->name)){!! App\Models\Article::getArticle(46)->details_one->name !!}@endif:</b> {{$feedback->checkbox5}}@endif
									</p>
								@endif
								@if(!empty($feedback->add_check_1))
									<p style="font-size: 18px;">
									@if(!empty($feedback->add_check_1)){{$feedback->add_check_1}}@endif
									</p>
								@endif
								@if(!empty($feedback->add_check_2))
									<p style="font-size: 18px;">
									@if(!empty($feedback->add_check_2)){{$feedback->add_check_2}}@endif
									</p>
								@endif
								@if(!empty($feedback->add_check_3))
									<p style="font-size: 18px;">
									@if(!empty($feedback->add_check_3)){{$feedback->add_check_3}}@endif
									</p>
								@endif
								@if(!empty($feedback->add_check_4))
									<p style="font-size: 18px;">
									@if(!empty($feedback->add_check_4)){{$feedback->add_check_4}}@endif
									</p>
								@endif
								@if(!empty($feedback->add_check_5))
									<p style="font-size: 18px;">
									@if(!empty($feedback->add_check_5)){{$feedback->add_check_5}}@endif
									</p>
								@endif
								@if(!empty($feedback->add_check_6))
									<p style="font-size: 18px;">
									@if(!empty($feedback->add_check_6)){{$feedback->add_check_6}}@endif
									</p>
								@endif
                                --}}
								<p style="font-size: 10px;">&nbsp;</p>
							</td>
							<td valign="top" align="center" width="55"></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="640" style="font-family: Calibri, Arial, 'Helvetica Neue', Helvetica, sans-serif;  color: #ddd859;  ">
					<tbody>
						<tr>
							<td valign="top" align="center" width="55"></td>
							<td valign="top" align="center" style="font-size: 20px; font-family: Calibri, Arial, 'Helvetica Neue', Helvetica, sans-serif;  color: #000000;">
								<p style="font-size: 10px;">&nbsp;</p>

								<p style="font-size: 16px; font-family: Calibri, Arial, 'Helvetica Neue', Helvetica, sans-serif;  color: #b2b4b5;">{{ env('APP_NAME') }}, {{ date('Y') }}</p>

								<p style="font-size: 20px;">&nbsp;</p>
							</td>
							<td valign="top" align="center" width="55"></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>


	</tbody>
</table>

</body>
</html>
