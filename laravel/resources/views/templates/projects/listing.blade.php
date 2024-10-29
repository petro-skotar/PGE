@extends('templates.template')

@section('content')

<!-- Start main-content -->
<div class="main-content-area">

    <!-- Section: Project -->
    <section>
      <div class="container pb-70">

        <div class="tm-sc-section-title">
            <div class="row justify-content-md-center">
            <div class="col-xl-10">
                <div class="title-wrapper text-center m-0">
                <h1 class="title m-0"> <span class="font-weight-500"> Examples of <br></span> <span class="font-weight-800 text-theme-colored2">Our Successful Construction Projects</span></h1>
                </div>
            </div>
            </div>
        </div>

        <div class="section-content">
          <div class="row">

            @if(!empty($articles))
                @foreach($articles as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="img-icon-service-box mb-30">
                        <div class="tm-thumb">
                        <img class="img-fullwidth" src="{{ $item->img() }}" alt="{{ $item->details_one->name }}">
                        <div class="icon bg-theme-colored2"><a href="{{ route('viewProject',[$item->details_one->url]) }}"><span class="fas fa-home"></span></a></div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

          </div>
        </div>
      </div>
      <div class="tm-floating-objects">
        <span class="floating-object-1 tm-animation-floating" data-tm-bg-img="{{ asset('templates/pgeconstruction/images/photos/bg-shape4.png') }}" data-tm-opacity=".3" data-tm-width="14%" data-tm-height="27%" data-tm-left="auto" data-tm-right="0" data-tm-top="0"></span>
      </div>
      <div class="tm-floating-objects">
        <span class="floating-object-1 tm-animation-floating" data-tm-bg-img="{{ asset('templates/pgeconstruction/images/photos/bg-shape5.png') }}" data-tm-opacity=".5" data-tm-width="36%" data-tm-height="50%" data-tm-left="0" data-tm-top="51%" data-tm-z-index="0"></span>
      </div>
    </section>
    <!-- End Divider -->
  </div>
  <!-- end main-content -->
  {{--
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
	--}}

@endsection
