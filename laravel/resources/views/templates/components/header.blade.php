<header id="header" class="header @if(Route::current()->getName()=='index')header-layout-type-header-1rows-floating-header header-bg-dark-shadow @else header-layout-type-header-2rows @endif">
    @if(Route::current()->getName()!='index')
      <div class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-xl-auto header-top-left align-self-center text-center text-xl-start">
              <ul class="element contact-info">
                <li class="contact-phone"><i class="fa fa-phone font-icon sm-display-block"></i> Tel: <a href="tel:{{Str::of($SETTING['contact_phone']['val'])->replace([' ','(',')','-'], '')}}">{!! $SETTING['contact_phone']['val'] !!}</a></li>
                <li class="contact-email"><i class="fa fa-envelope font-icon sm-display-block"></i> {!! $SETTING['contact_email']['val'] !!}</li>
                <li class="contact-address"><i class="fa fa-map font-icon sm-display-block"></i> 801 Fraser St, Prince Rupert, BC</li>
              </ul>
            </div>
            <div class="col-xl-auto ms-xl-auto header-top-right align-self-center text-center text-xl-end">
              <div class="element pt-0 pb-0">
                <ul class="styled-icons icon-dark icon-theme-colored1 icon-circled clearfix">
                  @if(!empty($SETTING['contact_facebook']['val']))<li><a class="social-link" href="{!! $SETTING['contact_facebook']['val'] !!}" ><i class="fab fa-facebook"></i></a></li>@endif
                  @if(!empty($SETTING['contact_instagram']['val']))<li><a class="social-link" href="{!! $SETTING['contact_instagram']['val'] !!}" ><i class="fab fa-instagram"></i></a></li>@endif
                </ul>
              </div>
              <div class="element pt-0 pt-lg-10 pb-0">
                <a href="/#contacts_form" class="btn btn-theme-colored2 text-white btn-sm ajaxload-popup-off">Make an Application</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    <div class="header-nav tm-enable-navbar-hide-on-scroll">
      <div class="header-nav-wrapper navbar-scrolltofixed">
        <div class="menuzord-container header-nav-container">
          <div class="container position-relative">
            <div class="row header-nav-col-row">
              <div class="col-sm-auto align-self-center">
                <a class="menuzord-brand site-brand" href="{{ route('index') }}">
                  <img class="logo-light logo-default logo-1x" src="{{ asset('templates/pgeconstruction/images/logo-wide-white.png') }}" alt="Logo">
                  <img class="logo-light logo-default logo-2x retina" style="max-width: @if(Route::current()->getName()=='index')200px; @else 130px @endif; max-height: none;" src="{{ asset('templates/pgeconstruction/images/logo-wide-white@2x.png') }}" alt="Logo">

                  <img class="logo-dark logo-default logo-1x" src="{{ asset('templates/pgeconstruction/images/logo-wide.png') }}" alt="Logo">
                  <img class="logo-dark logo-default logo-2x retina" src="{{ asset('templates/pgeconstruction/images/logo-wide@2x.png') }}" alt="Logo">
                </a>
              </div>
              {{--<div class="col-sm-auto align-self-center">
                <a href="tel:{{Str::of($SETTING['contact_phone']['val'])->replace([' ','(',')','-'], '')}}">{!! $SETTING['contact_phone']['val'] !!}</a>
              </div>--}}
              <div class="col-sm-auto ms-auto pr-0 align-self-center">
                <nav id="top-primary-nav" class="menuzord theme-color2" data-effect="slide" data-animation="none" data-align="right">
                  <ul id="main-nav" class="menuzord-menu">
                    <li @if(Route::current()->getName()=='index') class="active" @endif><a href="{{ route('index') }}">Home</a></li>
                    <li @if(Route::current()->getName()=='viewServices') class="active" @endif><a href="{{ route('viewServices') }}">Services</a></li>
                    <li @if(in_array(Route::current()->getName(), ['viewProjects','viewProject'])) class="active" @endif><a href="{{ route('viewProjects') }}">Our Projects</a></li>
                    <li @if(in_array(Route::current()->getName(), ['viewBlog','viewBlogItem'])) class="active" @endif><a href="{{ route('viewBlog') }}">Blog</a></li>
                    <li @if(Route::current()->getName()=='viewArticle' && request('url') == 'contacts') class="active" @endif><a href="{{ route('viewArticle',['contacts']) }}">Contact</a></li>
                  </ul>
                </nav>
              </div>
              <div class="col-sm-auto align-self-center nav-side-icon-parent">
                <ul class="list-inline nav-side-icon-list">
                  {{--<li class="hidden-mobile-mode"><a href="#" id="top-nav-search-btn"><i class="search-icon fa fa-search"></i></a></li>--}}
                  <li class="hidden-mobile-mode">
                    <div id="side-panel-trigger" class="side-panel-trigger"> <a href="#">
                      <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                      </div>
                      </a> </div>
                  </li>
                </ul>
                <div id="top-nav-search-form" class="clearfix">
                  <form action="#" method="GET">
                    <input type="text" name="s" value="" placeholder="Type and Press Enter..." autocomplete="off" />
                  </form>
                  <a href="#" id="close-search-btn"><i class="fa fa-times"></i></a>
                </div>
              </div>
            </div>
            <div class="row header-nav-clone-col-row d-block d-xl-none">
               <div class="col-12">
                <nav id="top-primary-nav-clone" class="menuzord d-block d-xl-none default menuzord-color-default menuzord-border-boxed menuzord-responsive" data-effect="slide" data-animation="none" data-align="right">
                 <ul id="main-nav-clone" class="menuzord-menu menuzord-right menuzord-indented scrollable">
                 </ul>
                </nav>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
