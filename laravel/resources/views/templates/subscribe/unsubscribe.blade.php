<?php
    $article = new \App\Models\Article();
    $article->details_one = new \App\Models\ArticlesDetails();
    $article->details_one->title = 'Subskrypcja została anulowana pomyślnie';
    $article->details_one->description = 'Subskrypcja została anulowana pomyślnie';
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
            <h1>Subskrypcja została anulowana pomyślnie</h1>
            <br>
            <p>Dziękujemy, że byliście z nami.</p>
            <p>Zawsze możesz ponownie zasubskrybować, klikając <a href="https://fin-asi.com/subscribe-check?email={{$subscribe->email}}" style="text-align: center; text-decoration: underline;" target="_blank">ten link</a></p>
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
