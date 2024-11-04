<!-- Footer -->
<footer id="footer" class="footer layer-overlay overlay-theme-colored5" data-tm-bg-color="#102147" data-tm-bg-img="{{ asset('templates/pgeconstruction/images/footer-bg.png') }}">
    <div class="footer-widget-area roofting_footer_widgets">
      <div class="container pt-80 pb-40">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-3 pl-0 pl-lg-15">
            <div class="widget tm-widget-contact-info contact-info-style1 contact-icon-theme-colored4">
              <h4 class="widget-title">About</h4>
              <div class="description">Choose us for your construction needs and gain a team dedicated to quality at every stage. We use top-grade materials and modern tech for durable, reliable results, with a personalized approach tailored to your preferences and budget.</div>

            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-2">
            <div class="widget widget_nav_menu split-nav-menu">
              <h4 class="widget-title">Explore</h4>
              <ul class="menu">
                <li><a href="{{ route('viewServices') }}">Services</a></li>
                <li><a href="{{ route('viewProjects') }}">Our Projects</a></li>
                <li><a href="{{ route('viewBlog') }}">Press & Blog</a></li>
                <li><a href="{{ route('viewArticle',['contacts']) }}">Contacts</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget widget-blog-list clearfix mb-0 mt-lg-40">
              <h4 class="widget-title">Latest News</h4>
              <div class="tm-widget tm-widget-blog-list">
                <!-- the loop -->
                <article class="post mb-30 clearfix">
                  <a class="post-thumb" href="news-details.html">
                    <img src="{{ asset('templates/pgeconstruction/images/temp/5.jpg') }}" class="" alt="images">
                  </a>
                  <div class="post-right">
                    <div class="post-date">
                      <span class="entry-date">Jan 16, 2021</span>
                    </div>
                    <h6 class="post-title"> <a class="text-white" href="news-details.html">We’re Providing the Quality Care </a> </h6>
                  </div>
                </article>
                <article class="post clearfix">
                  <a class="post-thumb" href="news-details.html">
                    <img src="{{ asset('templates/pgeconstruction/images/temp/6.jpg') }}" class="" alt="images">
                  </a>
                  <div class="post-right">
                    <div class="post-date">
                      <span class="entry-date">Jan 16, 2021</span>
                    </div>
                    <h6 class="post-title"> <a class="text-white" href="news-details.html">Success is Through the Roofing Service </a> </h6>
                  </div>
                </article>
                <!-- end of the loop -->
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-4">
            <div class="widget widget-contact clearfix mb-0 mt-lg-40">
              <h4 class="widget-title">Contact</h4>
              <div class="tm-widget tm-widget-contact">
                <ul class="contact-info">
                  <li class="contact-address"><i class="fas fa-map-marked-alt font-icon sm-display-block mr-10"></i> {!! $SETTING['contact_address']['val'] !!}</li>
                  <li class="contact-email"><i class="fas fa-envelope font-icon sm-display-block mr-10"></i> {!! $SETTING['contact_email']['val'] !!}</li>
                  <li class="contact-phone"><i class="fas fa-phone font-icon sm-display-block mr-10"></i> Tel: <a href="tel:{{Str::of($SETTING['contact_phone']['val'])->replace([' ','(',')','-'], '')}}">{!! $SETTING['contact_phone']['val'] !!}</a></li>
                </ul>
                <ul class="mt-10 styled-icons icon-dark icon-md icon-hover-theme-colored2 icon-circled clearfix">
                    <li><a class="social-link" href="#" ><i class="fab fa-facebook"></i></a></li>
                    <li><a class="social-link" href="#" ><i class="fab fa-instagram"></i></a></li>
                  </ul>
                {{--<div class="tm-sc-button">
                  <a href="#" class="btn btn-theme-colored2 mt-10">Request a Quote</a>
                </div>
            --}}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container" data-tm-border-top="1px solid rgba(250,250,250,0.1)">
          <div class="row justify-content-center pt-30 pb-30">
            <div class="col-lg-8">
              <div class="footer-paragraph text-center">
                {{ date('Y',time()) }} © Created by <a href="https://psweb.dev" target="_blank">Petro Skotar</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
