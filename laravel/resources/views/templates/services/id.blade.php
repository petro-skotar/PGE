@extends('templates.template')

@section('content')

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
                      @if(!empty(App\Models\Article::getArticle(56)->details_one->name))<p class="pr_b"><span>{!! App\Models\Article::getArticle(56)->details_one->name !!}:</span><span>{!! $article->details_one->price !!}</span></p>@endif
                      @if(!empty(App\Models\Article::getArticle(57)->details_one->name))<p class="pr_b"><span>{!! App\Models\Article::getArticle(57)->details_one->name !!}:</span><span>{!! $article->details_one->long_time !!}</span></p>@endif
                      @if(!empty(App\Models\Article::getArticle(58)->details_one->name))<p class="pr_b"><span>{!! App\Models\Article::getArticle(58)->details_one->name !!}:</span><span>{!! $article->details_one->percent !!}</span></p>@endif
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

@endsection
