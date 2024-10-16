<?php
    $article = new \App\Models\Article();
    $article->details_one = new \App\Models\ArticlesDetails();
    $article->details_one->title = 'Dziękujemy za subskrypcję!';
    $article->details_one->description = 'Dziękujemy za subskrypcję!';
    $article->images = '';
    $article->module = __('subscribe')
    ?>
@extends('templates.template')

@section('content')

	<section class="crew">
        <div class="section_container">
          <div class="row">
            <div class="col-lg-3">
              <h2 class="crew__title lp_title">{!! $article->details_one->name !!}</h2>
            </div>
          </div>

		  <div class="team_content text_content"  style="text-align: center;">
            <br>
            <br>
            <h1>Dziękujemy za subskrypcję!</h1>
            <br>
            <p>Przejść do <a href="/" style="text-align: center; text-decoration: underline;">strony głównej</a></p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
          </div>

        </div>
      </section>


@endsection
