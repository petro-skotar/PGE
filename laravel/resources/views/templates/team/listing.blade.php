@extends('templates.template')

@section('content')

	<section class="crew"> 
        <div class="section_container"> 
          <div class="row"> 
            <div class="col-lg-3"> 
              <h2 class="crew__title lp_title">{!! $article->details_one->name !!}</h2>
            </div>
          </div>
		  @if(!empty($articles))
			@foreach($articles as $item)
			  <div class="row"> 
				<div class="col-md-4 col-lg-3 offset-lg-2"> 
				  <div class="crew__wrapper text-center">
					<div class="crew__block"><img class="crew__img" src="{{ $item->img() }}" alt="{{ $item->details_one->name }}"></div>
					<p class="crew__signature">{{ $item->details_one->annotation }}</p>
				  </div>
				</div>
				<div class="col-md-8 col-lg-5">
				  <h3 class="crew__subtitle">{{ $item->details_one->name }}</h3>
				  <div class="crew__text text_content">{!! $item->details_one->content !!}
				</div>
			  </div>
			  @if(!$loop->last)
				  <div class="container-fluid"></div>
				  <div class="crew__line"></div>
			  @endif
			@endforeach
		  @endif
		  
		  @if(!empty($article->details_one->content))
		  <div class="team_content text_content">
			  {!! $article->details_one->content !!}
        	</div>
		  @endif

        </div>
      </section>
	
	  	
@endsection