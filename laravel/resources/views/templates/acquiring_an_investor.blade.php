@extends('templates.template')

@section('content')


	<section class="acquisition"> 
        <div class="section_container"> 
          <h2 class="acquisition__title lp_title">{!! $article->details_one->name !!}</h2>
          <h4 class="acquisition__subtitle">{!! $article->details_one->slogan !!}</h4>
          <div class="act_row">
            <div class="act_left"><img class="acquisition__img" src="{{ asset('templates/dist/img/acquisition_bg.webp') }}" alt="{!! $article->details_one->name !!}"></div>
            <div class="act_right">
              <div class="acquisition__text text_content">
				{!! $article->details_one->content !!}
			  </div>
            </div>
          </div>
        </div>
        <div class="section_container">
          <div class="container-form">
            <div class="row"> 
              <div class="col-11 col-lg-6 offset-lg-1 form-wrapper"> 
                <form id="form_{{$article->template}}" class="acquisition__form js-form" action="{{ route('forms') }}" method="POST"> 
                  @csrf
                  <input type="hidden" name="subject" value="{{ $article->details_one->slogan }}">
                  <input autocomplete="nope" type="text" name="name" value="">
                  <div class="acquisition__cover">
                    <label class="acquisition__label acquisition__label_name" for="firstName">@if(!empty(App\Models\Article::getArticle(37)->details_one->name)){!! App\Models\Article::getArticle(37)->details_one->name !!}@endif *</label>
                    <input class="acquisition__input" type="text" name="firstName" placeholder="@if(!empty(App\Models\Article::getArticle(37)->details_one->annotation)){!! App\Models\Article::getArticle(37)->details_one->annotation !!}@endif">
                  </div>
                  <div class="acquisition__cover">
                    <label class="acquisition__label acquisition__label_last-name" for="lastName">@if(!empty(App\Models\Article::getArticle(38)->details_one->name)){!! App\Models\Article::getArticle(38)->details_one->name !!}@endif</label>
                    <input class="acquisition__input" type="text" name="lastName" placeholder="@if(!empty(App\Models\Article::getArticle(38)->details_one->annotation)){!! App\Models\Article::getArticle(38)->details_one->annotation !!}@endif">
                  </div>
                  <div class="acquisition__cover">
                    <label class="acquisition__label acquisition__label_firm" for="firma">@if(!empty(App\Models\Article::getArticle(40)->details_one->name)){!! App\Models\Article::getArticle(40)->details_one->name !!}@endif</label>
                    <input class="acquisition__input" type="text" name="firma" placeholder="@if(!empty(App\Models\Article::getArticle(40)->details_one->annotation)){!! App\Models\Article::getArticle(40)->details_one->annotation !!}@endif">
                  </div>
                  <div class="acquisition__cover">
                    <label class="acquisition__label acquisition__label_email" for="email">@if(!empty(App\Models\Article::getArticle(39)->details_one->name)){!! App\Models\Article::getArticle(39)->details_one->name !!}@endif * </label>
                    <input class="acquisition__input" type="email" name="email" placeholder="@if(!empty(App\Models\Article::getArticle(39)->details_one->annotation)){!! App\Models\Article::getArticle(39)->details_one->annotation !!}@endif">
                  </div>
                  <div class="acquisition__cover">
                    <label class="acquisition__label acquisition__label_phone" for="phone">@if(!empty(App\Models\Article::getArticle(41)->details_one->name)){!! App\Models\Article::getArticle(41)->details_one->name !!}@endif * </label>
                    <input class="acquisition__input" type="tel" name="phone" placeholder="@if(!empty(App\Models\Article::getArticle(41)->details_one->annotation)){!! App\Models\Article::getArticle(41)->details_one->annotation !!}@endif">
                  </div>
                  <div class="acquisition__cover">
                    <div class="attach" data-title="Zamieść swoje CV">
                      <div class="attach__item">
                        <label>
                          <div class="attach__up"><span>@if(!empty(App\Models\Article::getArticle(80)->details_one->name)){!! App\Models\Article::getArticle(80)->details_one->name !!}@endif</span></div>
                          <input class="attach__input" type="file" name="userfile[]">
                        </label>
                        <div class="attach__name"></div>
                        <div class="attach__delete"></div>
                      </div>
                    </div>
                    <div class="file_error">@if(!empty(App\Models\Article::getArticle(81)->details_one->name)){!! App\Models\Article::getArticle(81)->details_one->name !!}@endif: <span></span></div>
                  </div>
                  @if(!empty(App\Models\Article::getArticle(71)->details_one->name))
                  <div class="acquisition__cover">
                    <div class="acquisition__wrapper d-flex">
                      <input class="acquisition__checkbox" type="checkbox" name="add_check_1" value="{!! App\Models\Article::getArticle(71)->details_one->name !!}" required>
                      <label for="add_check_1">{!! App\Models\Article::getArticle(71)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(72)->details_one->name))
                  <div class="acquisition__cover">
                    <div class="acquisition__wrapper d-flex">
                      <input class="acquisition__checkbox" type="checkbox" name="add_check_2" value="{!! App\Models\Article::getArticle(72)->details_one->name !!}" required>
                      <label for="add_check_2">{!! App\Models\Article::getArticle(72)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(73)->details_one->name))
                  <div class="acquisition__cover">
                    <div class="acquisition__wrapper d-flex">
                      <input class="acquisition__checkbox" type="checkbox" name="add_check_3" value="{!! App\Models\Article::getArticle(73)->details_one->name !!}">
                      <label for="add_check_3">{!! App\Models\Article::getArticle(73)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(74)->details_one->name))
                  <div class="acquisition__cover">
                    <div class="acquisition__wrapper d-flex">
                      <input class="acquisition__checkbox" type="checkbox" name="add_check_4" value="{!! App\Models\Article::getArticle(74)->details_one->name !!}">
                      <label for="add_check_4">{!! App\Models\Article::getArticle(74)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(75)->details_one->name))
                  <div class="acquisition__cover">
                    <div class="acquisition__wrapper d-flex">
                      <input class="acquisition__checkbox" type="checkbox" name="add_check_5" value="{!! App\Models\Article::getArticle(75)->details_one->name !!}">
                      <label for="add_check_5">{!! App\Models\Article::getArticle(75)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(76)->details_one->name))
                  <div class="acquisition__cover">
                    <div class="acquisition__wrapper d-flex">
                      <input class="acquisition__checkbox" type="checkbox" name="add_check_6" value="{!! App\Models\Article::getArticle(76)->details_one->name !!}">
                      <label for="add_check_6">{!! App\Models\Article::getArticle(76)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  <button class="acquisition__send button" type="submit" name="submit">@if(!empty(App\Models\Article::getArticle(36)->details_one->name)){!! App\Models\Article::getArticle(36)->details_one->name !!}@endif</button>
                  <div class="acquisition__signature text_content">
                    {{-- @if(!empty(App\Models\Article::getArticle(43)->details_one->content)){!! App\Models\Article::getArticle(43)->details_one->content !!}@endif --}}
                    <br><br>
                  </div>
				        </form>
                <div class="acquisition__subject">@if(!empty(App\Models\Article::getArticle(43)->details_one->name)){!! App\Models\Article::getArticle(43)->details_one->name !!}@endif</div>
              </div>
            </div>
          </div>
        </div>
		
      </section>
@endsection
