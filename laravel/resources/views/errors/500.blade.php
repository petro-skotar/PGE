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
	
	<section class="page page_500"> 
      <div class="section_container">
          <h1 class="lp_title">Error 500</h1>
		  <div class="title_404">System Error</div>
		  <div class="description_404">
			<!-- 500 -->
			@if(!empty($exception->getMessage()))
				<p><b>Error:</b> {{ $exception->getMessage() }}</p>
			@endif
		  </div>
      </div>
    </div>
	
@endsection
