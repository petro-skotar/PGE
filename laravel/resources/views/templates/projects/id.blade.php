@extends('templates.template')

@section('content')

<!-- Start main-content -->
<div class="main-content-area">
    <!-- Section: Project Details -->
    <section>
      <div class="container pb-70">

        <div class="tm-sc-section-title">
            <div class="row justify-content-md-center">
            <div class="col-xl-12">
                <div class="title-wrapper m-0">
                <h1 class="title m-0"> <span class="font-weight-700 text-theme-colored2">{!! $article->details_one->name !!}</span> </h1>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4">

            <div class="pt-0">
                <h4 class="mt-0">Project Description</h4>
                {!! $article->details_one->content !!}
            </div>

            <dl class="description-list pt-20">
              <dt>Client:</dt>
              <dd>Kodesolution Ltd</dd>

              <dt>Location:</dt>
              <dd>#405, Lan Streen, Los Vegas, USA</dd>

              <dt>Start Date:</dt>
              <dd>January 26, 2016</dd>

              <dt>End Date:</dt>
              <dd>February 10, 2016</dd>

              <dt class="mb-20">Share:</dt>
              <dd>
                <div class="styled-icons icon-dark icon-theme-colored1 icon-circled">
                  <a href="#"><i class="fab fa-facebook"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-google-plus"></i></a>
                </div>
              </dd>
            </dl>


          </div>
          <div class="col-md-8">
            <div class="tm-owl-carousel-1col" data-dots="true" data-nav="true">
                @foreach($article->img('all') as $img)
                    <div class="item"><img src="{{ $img }}" alt="images"></div>
                @endforeach
            </div>
          </div>
        </div>
        <div class="row mt-60">
          <div class="col-md-12">
            <blockquote class="mt-0">
              <p class="mb-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante atur nulla neque nesciunt alias repudiandae doloremque, .</p>
              <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Project -->
    <section>
      <div class="container pt-30">
        <div class="tm-sc-section-title">
            <div class="row justify-content-md-center">
            <div class="col-xl-8">
                <div class="title-wrapper text-center m-0">
                <h2 class="title m-0"><span class="font-weight-500"> Our other projects</span></h2>
                </div>
            </div>
            </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="img-icon-service-box mb-30">
                <div class="tm-thumb">
                  <img class="img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/2.jpg') }}" alt="1.jpg">
                  <div class="icon bg-theme-colored1"><a href="{{ route('viewProject',['innovative-e-commerce-platform']) }}"><span class="fas fa-home"></span></a></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="img-icon-service-box mb-30">
                <div class="tm-thumb">
                  <img class="img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/3.jpg') }}" alt="2.jpg">
                  <div class="icon bg-theme-colored2"><a href="{{ route('viewProject',['innovative-e-commerce-platform']) }}"><span class="fas fa-home"></span></a></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="img-icon-service-box mb-30">
                <div class="tm-thumb">
                  <img class="img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/4.jpg') }}" alt="3.jpg">
                  <div class="icon bg-theme-colored2"><a href="{{ route('viewProject',['innovative-e-commerce-platform']) }}"><span class="fas fa-home"></span></a></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="img-icon-service-box mb-30">
                <div class="tm-thumb">
                  <img class="img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/5.jpg') }}" alt="4.jpg">
                  <div class="icon bg-theme-colored2"><a href="{{ route('viewProject',['innovative-e-commerce-platform']) }}"><span class="fas fa-home"></span></a></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="img-icon-service-box mb-30">
                <div class="tm-thumb">
                  <img class="img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/6.jpg') }}" alt="5.jpg">
                  <div class="icon bg-theme-colored2"><a href="{{ route('viewProject',['innovative-e-commerce-platform']) }}"><span class="fas fa-home"></span></a></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="img-icon-service-box mb-30">
                <div class="tm-thumb">
                  <img class="img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/7.jpg') }}" alt="6.jpg">
                  <div class="icon bg-theme-colored2"><a href="{{ route('viewProject',['innovative-e-commerce-platform']) }}"><span class="fas fa-home"></span></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tm-floating-objects">
        <span class="floating-object-1 tm-animation-floating" data-tm-bg-img="images/photos/bg-shape4.png" data-tm-opacity=".3" data-tm-width="14%" data-tm-height="27%" data-tm-left="auto" data-tm-right="0" data-tm-top="0"></span>
      </div>
      <div class="tm-floating-objects">
        <span class="floating-object-1 tm-animation-floating" data-tm-bg-img="images/photos/bg-shape5.png" data-tm-opacity=".5" data-tm-width="36%" data-tm-height="50%" data-tm-left="0" data-tm-top="51%" data-tm-z-index="0"></span>
      </div>
    </section>
    <!-- End Divider -->
  </div>
  <!-- end main-content -->

    {{--
	  <section class="projects">
        <div class="section_container">
          <h2 class="projects__title lp_title">@if(!empty(App\Models\Article::getArticle(51)->details_one->name)){!! App\Models\Article::getArticle(51)->details_one->name !!}@endif</h2>
          <div class="proects_list">
            <div class="grid"><span></span><span></span><span></span></div>
            <div class="project_item">
              <div class="pr_left"><img src="{{ $article->img(0) }}"></div>
              <div class="pr_right">
                <div class="pr_top">
                  <div class="prc">
                    <div class="pr_title">
                      <h1>{!! $article->details_one->name !!}</h1>
                      <div class="pr_code">{!! $article->details_one->code !!}</div>
                    </div>
                  </div>
                </div>
                <div class="pr_body">
                  <div class="prc">
                    <div class="prc_m_img"><img src="{{ $article->img(0) }}"></div>
                    <div class="prc_m_desc">
                      <p class="pr_b"> <span>@if(!empty(App\Models\Article::getArticle(55)->details_one->name)){!! App\Models\Article::getArticle(55)->details_one->name !!}:@endif</span></p>
                      <p>{!! $article->details_one->annotation !!}</p>
                      @if(!empty(App\Models\Article::getArticle(84)->details_one->name) && !empty($article->details_one->file) && File::exists('storage/'.$article->details_one->file))<a href="{!! asset('storage/'.$article->details_one->file) !!}" class="proects_presentation" target="_blank"><img src="{{ asset('templates/dist/img/icon/download-arrow.svg') }}" alt="Polityka inwestycyjna"><span>{!! App\Models\Article::getArticle(84)->details_one->name !!}</span></a>@endif
                    </div>
                  </div>
                  <div class="prc_two">
                    <p class="pr_b"><span>@if(!empty(App\Models\Article::getArticle(59)->details_one->name)){!! App\Models\Article::getArticle(59)->details_one->name !!}@endif:</span></p>
                    <div class="textcols">
                      {!! $article->details_one->content !!}
                      <div class="pr__btns d-flex">
                      @if($article->getPrevious() && $article->getPrevious()->details_one->url)
                        <a href="{{ route('viewAsItemModules', [$article->getModule()->details_one['url'], $article->getPrevious()->details_one['url']]) }}" title="{{ $article->getPrevious()->details_one->name }}">
                          <svg width="60" height="60" viewbox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M15.6463 29.6464C15.4511 29.8417 15.4511 30.1583 15.6463 30.3536L18.8283 33.5355C19.0236 33.7308 19.3401 33.7308 19.5354 33.5355C19.7307 33.3403 19.7307 33.0237 19.5354 32.8284L16.707 30L19.5354 27.1716C19.7307 26.9763 19.7307 26.6597 19.5354 26.4645C19.3401 26.2692 19.0236 26.2692 18.8283 26.4645L15.6463 29.6464ZM45.9999 29.5L15.9999 29.5V30.5L45.9999 30.5V29.5Z" fill="#B17A36"></path>
                          <rect x="59.4999" y="59.5" width="59" height="59" rx="4.5" transform="rotate(-180 59.4999 59.5)" stroke="#B17A36"></rect>
                          </svg>
                        </a>
                      @endif
                      @if($article->getNext() && $article->getNext()->details_one->url)
                        <a href="{{ route('viewAsItemModules', [$article->getModule()->details_one['url'], $article->getNext()->details_one['url']]) }}" title="{{ $article->getNext()->details_one->name }}">
                          <svg width="60" height="60" viewbox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M44.3536 30.3536C44.5488 30.1583 44.5488 29.8417 44.3536 29.6464L41.1716 26.4645C40.9763 26.2692 40.6597 26.2692 40.4645 26.4645C40.2692 26.6597 40.2692 26.9763 40.4645 27.1716L43.2929 30L40.4645 32.8284C40.2692 33.0237 40.2692 33.3403 40.4645 33.5355C40.6597 33.7308 40.9763 33.7308 41.1716 33.5355L44.3536 30.3536ZM14 30.5H44V29.5H14V30.5Z" fill="#B17A36"></path>
                          <rect x="0.5" y="0.5" width="59" height="59" rx="4.5" stroke="#B17A36"></rect>
                          </svg>
                        </a>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pr_bottom"><img src="{{ $article->img(1) }}"><img src="{{ $article->img(2) }}"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
    --}}

@endsection
