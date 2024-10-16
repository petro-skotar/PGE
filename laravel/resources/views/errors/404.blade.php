@extends('templates.template')

@section('content')
	<?php
		$article = new \App\Models\Article();
		$article->details_one = new \App\Models\ArticlesDetails();
		$article->details_one->title = __('messages.404_error');
		$article->details_one->description = __('messages.404_error_desc');
		$article->images = '';
		$article->module = __('404')
	?>
	
	<section class="page page_404"> 
      <div class="section_container">
          <h1 class="lp_title">Error 404</h1>
		  <div class="title_404">@if(!empty(App\Models\Article::getArticle(64)->details_one->name)){!! App\Models\Article::getArticle(64)->details_one->name !!}@endif</div>
		  <div class="description_404">@if(!empty(App\Models\Article::getArticle(64)->details_one->content)){!! App\Models\Article::getArticle(64)->details_one->content !!}@endif</div>
          <div class="for_btn">
			<a class="main__btn button" href="@if(!empty(App\Models\Article::getArticle(3)->details_one->url)){!! App\Models\Article::getArticle(3)->details_one->url !!}@endif/@if(!empty(App\Models\Article::firstChild('projects')->details_one->url)){!! App\Models\Article::firstChild('projects')->details_one->url !!}@endif">@if(!empty(App\Models\Article::getArticle(34)->details_one->name)){!! App\Models\Article::getArticle(34)->details_one->name !!}@endif</a>
		  </div>
      </div>
    </div>
	
@endsection
