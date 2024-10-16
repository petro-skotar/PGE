@extends('templates.template')

@section('content')

	<section class="offer"> 
        <div class="section_container"> 
          <div class="row"> 
            <div class="col">
              <h2 class="offer__title lp_title">{!! $article->details_one->name !!}</h2>
              <h4 class="offer__subtitle">{!! $article->details_one->slogan !!}</h4>
            </div>
          </div>
          <div class="row"> 
            <div class="col-10 col-md-7 col-lg-4 offset-lg-2">
              <div class="offer__text">
                {!! $article->details_one->content !!}
              </div>
            </div>
            <div class="col-2 col-md-5 col-lg-4"><img class="offer__img" src="{{ asset('templates/dist/img/offer_bg.webp') }}" alt="Offer"></div>
          </div>
        </div>
        <div class="section_container">
          <div class="container-form">
            <div class="row"> 
              <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-4 form-wrapper"> 
                <form id="form_{{$article->template}}" class="offer__form js-form" action="{{ route('forms') }}" method="POST"> 
                  @csrf
				          <input type="hidden" name="subject" value="{{ $article->details_one->slogan }}">
				          <input autocomplete="nope" type="text" name="name" value="">
                  <div class="offer__cover">
                    <label class="offer__label offer__label_name" for="firstName">@if(!empty(App\Models\Article::getArticle(37)->details_one->name)){!! App\Models\Article::getArticle(37)->details_one->name !!}@endif *</label>
                    <input class="offer__input" type="text" name="firstName" placeholder="@if(!empty(App\Models\Article::getArticle(37)->details_one->annotation)){!! App\Models\Article::getArticle(37)->details_one->annotation !!}@endif">
                  </div>
                  <div class="offer__cover">
                    <label class="offer__label offer__label_last-name" for="lastName">@if(!empty(App\Models\Article::getArticle(38)->details_one->name)){!! App\Models\Article::getArticle(38)->details_one->name !!}@endif</label>
                    <input class="offer__input" type="text" name="lastName" placeholder="@if(!empty(App\Models\Article::getArticle(38)->details_one->annotation)){!! App\Models\Article::getArticle(38)->details_one->annotation !!}@endif">
                  </div>
                  <div class="offer__cover">
                    <label class="offer__label offer__label_firm" for="firma">@if(!empty(App\Models\Article::getArticle(40)->details_one->name)){!! App\Models\Article::getArticle(40)->details_one->name !!}@endif</label>
                    <input class="offer__input" type="text" name="firma" placeholder="@if(!empty(App\Models\Article::getArticle(40)->details_one->annotation)){!! App\Models\Article::getArticle(40)->details_one->annotation !!}@endif">
                  </div>
                  <div class="offer__cover">
                    <label class="offer__label offer__label_email" for="email">@if(!empty(App\Models\Article::getArticle(39)->details_one->name)){!! App\Models\Article::getArticle(39)->details_one->name !!}@endif * </label>
                    <input class="offer__input" type="email" name="email" placeholder="@if(!empty(App\Models\Article::getArticle(39)->details_one->annotation)){!! App\Models\Article::getArticle(39)->details_one->annotation !!}@endif">
                  </div>
                  <div class="offer__cover">
                    <label class="offer__label offer__label_phone" for="phone">@if(!empty(App\Models\Article::getArticle(41)->details_one->name)){!! App\Models\Article::getArticle(41)->details_one->name !!}@endif * </label>
                    <input class="offer__input" type="tel" name="phone" placeholder="@if(!empty(App\Models\Article::getArticle(41)->details_one->annotation)){!! App\Models\Article::getArticle(41)->details_one->annotation !!}@endif">
                  </div>

                  @if(!empty(App\Models\Article::getArticle(71)->details_one->name))
                  <div class="offer__cover">
                    <div class="offer__wrapper d-flex">
                      <input class="offer__checkbox" type="checkbox" name="add_check_1" value="{!! App\Models\Article::getArticle(71)->details_one->name !!}" required>
                      <label for="add_check_1">{!! App\Models\Article::getArticle(71)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(72)->details_one->name))
                  <div class="offer__cover">
                    <div class="offer__wrapper d-flex">
                      <input class="offer__checkbox" type="checkbox" name="add_check_2" value="{!! App\Models\Article::getArticle(72)->details_one->name !!}" required>
                      <label for="add_check_2">{!! App\Models\Article::getArticle(72)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(73)->details_one->name))
                  <div class="offer__cover">
                    <div class="offer__wrapper d-flex">
                      <input class="offer__checkbox" type="checkbox" name="add_check_3" value="{!! App\Models\Article::getArticle(73)->details_one->name !!}">
                      <label for="add_check_3">{!! App\Models\Article::getArticle(73)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(74)->details_one->name))
                  <div class="offer__cover">
                    <div class="offer__wrapper d-flex">
                      <input class="offer__checkbox" type="checkbox" name="add_check_4" value="{!! App\Models\Article::getArticle(74)->details_one->name !!}">
                      <label for="add_check_4">{!! App\Models\Article::getArticle(74)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(75)->details_one->name))
                  <div class="offer__cover">
                    <div class="offer__wrapper d-flex">
                      <input class="offer__checkbox" type="checkbox" name="add_check_5" value="{!! App\Models\Article::getArticle(75)->details_one->name !!}">
                      <label for="add_check_5">{!! App\Models\Article::getArticle(75)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(76)->details_one->name))
                  <div class="offer__cover">
                    <div class="offer__wrapper d-flex">
                      <input class="offer__checkbox" type="checkbox" name="add_check_6" value="{!! App\Models\Article::getArticle(76)->details_one->name !!}">
                      <label for="add_check_6">{!! App\Models\Article::getArticle(76)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  <button class="offer__send button" type="submit" name="submit">@if(!empty(App\Models\Article::getArticle(36)->details_one->name)){!! App\Models\Article::getArticle(36)->details_one->name !!}@endif</button>
                  <div class="offer__signature text_content">
                    {{-- @if(!empty(App\Models\Article::getArticle(43)->details_one->content)){!! App\Models\Article::getArticle(43)->details_one->content !!}@endif --}}
                    <br><br>
                  </div>
                </form>
                <div class="offer__subject">@if(!empty(App\Models\Article::getArticle(43)->details_one->name)){!! App\Models\Article::getArticle(43)->details_one->name !!}@endif</div>
              </div>
            </div>
          </div>
        </div>
		
		@if(!empty(App\Models\Article::getArticle(78)->details_one->name) && !empty($SETTING['invest_file']['files'][0]))
        <div class="section_container"> 
          <div class="row">
            <div class="col-md-3 offset-md-9 col-lg-3 offset-lg-8 offer__download"> 
              <div class="offer__wrap">
                <div class="d-flex align-items-end"> <a class="offer__icon" href="{!! asset('/storage/'.$SETTING['invest_file']['files'][0]) !!}" target="_blank"></a><a class="offer__link" href="{!! asset('/storage/'.$SETTING['invest_file']['files'][0]) !!}" target="_blank"><img src="{{ asset('templates/dist/img/icon/download-arrow.svg') }}" alt="{!! App\Models\Article::getArticle(78)->details_one->name !!}"></a></div>
                <p class="offer__caption">{!! App\Models\Article::getArticle(78)->details_one->name !!}</p>
              </div>
            </div>
          </div>
        </div>
		@endif
		
    @if(!empty(App\Models\Article::getArticle(69)->details_one->name))
      <section class="odi">
        <div class="section_container">
          <div class="text_content">
            @if(!empty(App\Models\Article::getArticle(69)->details_one->content)){!! App\Models\Article::getArticle(69)->details_one->content !!}@endif 
          </div>
        </div>
      </section>
    @endif
      </section>
@endsection
