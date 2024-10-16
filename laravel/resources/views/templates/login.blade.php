@extends('templates.template')

@section('content')
	<?php
		$article = new \App\Models\Article();
		$article->details_one = new \App\Models\ArticlesDetails();
		$article->details_one->title = __('messages.login_title');
		$article->details_one->bread = __('messages.login_title');
		$article->details_one->description = __('messages.login_title');
        $article->details_one->url = 'login';
		$article->images = '';
		$article->module = 'articles'
	?>

    <section class="feedback">
      <div class="section_container">
        <div class="fb_left"><img class="feedback__bg" src="{{ asset('templates/dist/img/feedback.webp') }}" alt="Feedback background"></div>
        <div class="fb_right">
          <h2 class="feedback__title lp_title">{{ __('messages.login_title') }}</h2>
        </div>
        <div class="fb_form fb_login">
		  <form class="feedback__form login_form" method="POST" action="{{ route('login.custom') }}">
			@csrf

				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{!! Lang::get($error) !!}</li>
							@endforeach
						</ul>
					</div>
				@endif

				@if (!empty(Session::get('date_errors')))
					<div class="alert alert-danger">
						<ul>
							<li>{!!Session::get('date_errors')!!}</li>
						</ul>
					</div>
				@endif

				@if (session('status'))
					<div class="alert alert-succes">
						{{ session('status') }}
					</div>
				@endif

            <input class="feedback__input name" type="text" name="name" value="">
			<div class="feedback__cover">
			  <label class="feedback__label feedback__label_email" for="email">Email </label>
			  <input class="feedback__input" type="email" name="email" placeholder="Wprowadź swój email" required autofocus value="{{ old('email') }}">
			</div>
			<div class="feedback__cover">
			  <label class="feedback__label feedback__label_email" for="password">Password </label>
			  <input class="feedback__input" type="password" name="password" placeholder="Wprowadź password" required autocomplete="current-password">
			</div>
			<div class="feedback__cover" style="font-size: 18px;">
			  <label for="remember_me" class="feedback__label feedback__label_email" style="margin-left: 0;">
				<input id="remember_me" type="checkbox" class="styler" name="remember">
				<span class="">{{ __('messages.remember_me') }}</span>
			  </label>
			  <br><br>
			</div>
			<button class="feedback__send button" type="submit" name="submit">{{ __('messages.login') }}</button>
          </form>
		  <br><br>
        </div>
      </div>
    </section>

@endsection
