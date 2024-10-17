@extends('templates.template')

@section('content')

  <!-- Start main-content -->
  <div class="main-content-area">

    <!-- Divider: Contact -->
    <section class="divider">
      <div class="container">

        <div class="row pt-30">
          <div class="col-lg-4">
            <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate bg-white-f1 p-30 mb-30">
              <div class="icon-box-wrapper">
                <div class="icon-wrapper">
                  <a class="icon icon-type-font-icon icon-dark icon-circled"> <i class="flaticon-contact-044-call-1"></i> </a>
                </div>
                <div class="icon-text">
                  <h5 class="icon-box-title mt-0">Phone</h5>
                  <div class="content"><a href="tel:+123.456.7890">+123.456.7890</a></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored2 animate-icon-on-hover animate-icon-rotate bg-white-f1 p-30 mb-30">
              <div class="icon-box-wrapper">
                <div class="icon-wrapper">
                  <a class="icon icon-type-font-icon icon-dark icon-circled"> <i class="flaticon-contact-043-email-1"></i> </a>
                </div>
                <div class="icon-text">
                  <h5 class="icon-box-title mt-0">Email</h5>
                  <div class="content"><a href="mailto:needhelp@yourdomain.com">needhelp@yourdomain.com</a></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="icon-box icon-left iconbox-centered-in-responsive iconbox-theme-colored1 animate-icon-on-hover animate-icon-rotate bg-white-f1 p-30 mb-30">
              <div class="icon-box-wrapper">
                <div class="icon-wrapper">
                  <a class="icon icon-type-font-icon icon-dark icon-circled"> <i class="flaticon-contact-025-world"></i> </a>
                </div>
                <div class="icon-text">
                  <h5 class="icon-box-title mt-0">Address</h5>
                  <div class="content">801 Fraser St, Prince Rupert, BC V8J 1R1, Canada</div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <h1 class="mt-0 mb-0">{!! $article->details_one->name !!}</h1>
            <p class="font-size-18-">Active & Ready to use Contact Form!</p>
            <!-- Contact Form -->
            <form id="contact_form" name="contact_form" class="" action="includes/sendmail.php" method="post">
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label>Name <small>*</small></label>
                    <input name="form_name" class="form-control" type="text" placeholder="Enter Name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label>Email <small>*</small></label>
                    <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label>Message</label>
                <textarea name="form_message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
              </div>
              <div class="mb-3">
                <input name="form_botcheck" class="form-control" type="hidden" value="" />
                <button type="submit" class="btn btn-theme-colored1 text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" data-loading-text="Please wait...">Send your message</button>
                <button type="reset" class="btn btn-theme-colored2 text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px">Reset</button>
              </div>
            </form>

            {{--
            <!-- Contact Form Validation-->
            <script>
              (function($) {
                $("#contact_form").validate({
                  submitHandler: function(form) {
                    var form_btn = $(form).find('button[type="submit"]');
                    var form_result_div = '#form-result';
                    $(form_result_div).remove();
                    form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                    var form_btn_old_msg = form_btn.html();
                    form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                    $(form).ajaxSubmit({
                      dataType:  'json',
                      success: function(data) {
                        if( data.status == 'true' ) {
                          $(form).find('.form-control').val('');
                        }
                        form_btn.prop('disabled', false).html(form_btn_old_msg);
                        $(form_result_div).html(data.message).fadeIn('slow');
                        setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                      }
                    });
                  }
                });
              })(jQuery);
            </script>--}}
          </div>
        </div>
      </div>
    </section>

    <!-- Divider: Google Map -->
    <section>
      <div class="container-fluid pt-0 pb-0">
        <div class="row">
          <!-- Google Map HTML Codes -->
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4946.333594750224!2d-130.3278288!3d54.3094946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5472d5124851f0c1%3A0x967be84b92cc3df9!2s801%20Fraser%20St%2C%20Prince%20Rupert%2C%20BC%20V8J%201R1!5e1!3m2!1suk!2sca!4v1729109905552!5m2!1suk!2sca" data-tm-width="100%" height="500" frameborder="0" allowfullscreen=""></iframe>
        </div>
      </div>
    </section>
    <!-- End Divider -->
  </div>
  <!-- end main-content -->

{{--
	<section class="contacts">
        <div class="section_container">
          <h2 class="contacts__title lp_title">{!! $article->details_one->name !!}</h2>
        </div>
        <div class="section_container">
          <div class="row_contact">
            <div class="contacts__block">
              <h3 class="contacts__subtitle">@if(!empty(App\Models\Article::getArticle(60)->details_one->name)){!! App\Models\Article::getArticle(60)->details_one->name !!}@endif</h3>
              <div class="text_content">
                <p class="contacts__text">@if(!empty(App\Models\Article::getArticle(60)->details_one->content)){!! App\Models\Article::getArticle(60)->details_one->content !!}@endif</p>
              </div>
            </div>
            <div class="contacts__form-block">
              <form id="form_{{$article->template}}" class="contacts__form js-form" action="{{ route('forms') }}" method="POST">
                @csrf
                <input type="hidden" name="subject" value="@if(!empty(App\Models\Article::getArticle(43)->details_one->name)){!! strip_tags(App\Models\Article::getArticle(43)->details_one->name) !!}@endif">
                <input autocomplete="nope" type="text" name="name" value="">
                <h3 class="contacts__subject">@if(!empty(App\Models\Article::getArticle(43)->details_one->name)){!! App\Models\Article::getArticle(43)->details_one->name !!}@endif</h3>
                <div class="contacts__cover">
                  <label class="contacts__label contacts__label_name" for="firstName">@if(!empty(App\Models\Article::getArticle(37)->details_one->name)){!! App\Models\Article::getArticle(37)->details_one->name !!}@endif *</label>
                  <input class="contacts__input" type="text" name="firstName" placeholder="@if(!empty(App\Models\Article::getArticle(37)->details_one->annotation)){!! App\Models\Article::getArticle(37)->details_one->annotation !!}@endif">
                </div>
                <div class="contacts__cover">
                  <label class="contacts__label contacts__label_last-name" for="lastName">@if(!empty(App\Models\Article::getArticle(38)->details_one->name)){!! App\Models\Article::getArticle(38)->details_one->name !!}@endif</label>
                  <input class="contacts__input" type="text" name="lastName" placeholder="@if(!empty(App\Models\Article::getArticle(38)->details_one->annotation)){!! App\Models\Article::getArticle(38)->details_one->annotation !!}@endif">
                </div>
                <div class="contacts__cover">
                  <label class="contacts__label contacts__label_firm" for="firma">@if(!empty(App\Models\Article::getArticle(40)->details_one->name)){!! App\Models\Article::getArticle(40)->details_one->name !!}@endif</label>
                  <input class="contacts__input" type="text" name="firma" placeholder="@if(!empty(App\Models\Article::getArticle(40)->details_one->annotation)){!! App\Models\Article::getArticle(40)->details_one->annotation !!}@endif">
                </div>
                <div class="contacts__cover">
                  <label class="contacts__label contacts__label_email" for="email">@if(!empty(App\Models\Article::getArticle(39)->details_one->name)){!! App\Models\Article::getArticle(39)->details_one->name !!}@endif * </label>
                  <input class="contacts__input" type="email" name="email" placeholder="@if(!empty(App\Models\Article::getArticle(39)->details_one->annotation)){!! App\Models\Article::getArticle(39)->details_one->annotation !!}@endif">
                </div>
                <div class="contacts__cover">
                  <label class="contacts__label contacts__label_phone" for="phone">@if(!empty(App\Models\Article::getArticle(41)->details_one->name)){!! App\Models\Article::getArticle(41)->details_one->name !!}@endif * </label>
                  <input class="contacts__input" type="tel" name="phone" placeholder="@if(!empty(App\Models\Article::getArticle(41)->details_one->annotation)){!! App\Models\Article::getArticle(41)->details_one->annotation !!}@endif">
                </div>
                <div class="contacts__cover">
                  <label class="contacts__label contacts__label_text" for="phone">@if(!empty(App\Models\Article::getArticle(42)->details_one->name)){!! App\Models\Article::getArticle(42)->details_one->name !!}@endif</label>
                  <textarea class="contacts__input" name="message" placeholder="@if(!empty(App\Models\Article::getArticle(42)->details_one->annotation)){!! App\Models\Article::getArticle(42)->details_one->annotation !!}@endif"></textarea>
                </div>
                @if(!empty(App\Models\Article::getArticle(71)->details_one->name))
                  <div class="contacts__cover">
                    <div class="contacts__wrapper d-flex">
                      <input class="contacts__checkbox" type="checkbox" name="add_check_1" value="{!! App\Models\Article::getArticle(71)->details_one->name !!}" required>
                      <label for="add_check_1">{!! App\Models\Article::getArticle(71)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                  @if(!empty(App\Models\Article::getArticle(72)->details_one->name))
                  <div class="contacts__cover">
                    <div class="contacts__wrapper d-flex">
                      <input class="contacts__checkbox" type="checkbox" name="add_check_2" value="{!! App\Models\Article::getArticle(72)->details_one->name !!}" required>
                      <label for="add_check_2">{!! App\Models\Article::getArticle(72)->details_one->content_modify() !!}</label>
                    </div>
                  </div>
                  @endif
                <button class="contacts__send button" type="submit" name="submit">@if(!empty(App\Models\Article::getArticle(36)->details_one->name)){!! App\Models\Article::getArticle(36)->details_one->name !!}@endif</button>
              </form>
            </div>
            <div class="rc_desc">
			  <div class="contacts__signature text_content">
			  {!! $article->details_one->content !!}
			  </div>
            </div>
          </div>
        </div>
      </section>
--}}
@endsection
