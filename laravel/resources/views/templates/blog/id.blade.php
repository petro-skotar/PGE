@extends('templates.template')

@section('content')

<!-- Start main-content -->
<div class="main-content-area">

    <!-- Section: Blog -->
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-sm-9">
            <div class="blog-posts single-post">
              <article class="post clearfix mb-0">
                <div class="tm-sc-section-title entry-header mb-30">
                    <div class="title-wrapper">
                        <h1 class="title">You Need to Know About Roofting</h1>
                    </div>
                  <div class="entry-meta mt-0">
                    <span class="mb-10 text-gray mr-10"><i class="far fa-calendar-alt mr-10 text-theme-colored2"></i> Jul 20, 2021</span>
                    <span class="mb-10 text-gray mr-10"><i class="far fa-comments mr-10 text-theme-colored2"></i> 214 Comments</span>
                  </div>
                  <div class="post-thumb thumb mt-40"> <img src="{{ asset('templates/pgeconstruction/images/temp/3.jpg') }}" alt="images" class="img-responsive img-fullwidth"> </div>
                </div>
                <div class="entry-content">
                  <p>Nostra dapibus varius et semper semper rutrum ad risus felis eros. Cursus libero viverra tempus netus diam vestibulum lorem tincidunt congue porta. Non ligula egestas commodo massa. Lorem non sit vivamus convallis elit mollis. Viverra sodales feugiat natoque sem morbi hac nunc ultricies nibh netus facilisis blandit. Felis purus et iaculis. Semper orci duis montes curabitur potenti a varius quis diam, vel litora et? Quis ridiculus pharetra luctus augue duis.</p>

                  <p>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring natoque sem morbi hac nunc ultricies.</p>

                  <blockquote class="tm-sc-blockquote blockquote-style6  border-left-theme-colored quote-icon-theme-colored">
                    <p >Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution.</p>
                    <footer><cite >Someone famous</cite></footer>
                  </blockquote>
                  <h5>Parturient tortor tortor sed tellus molestie neque</h5>
                  <p>Habitasse justo, sed justo. Senectus morbi, fermentum magna id tortor. Lacinia sociis morbi erat ultricies dictumst condimentum dictum nascetur? Vitae litora erat penatibus nam lorem. Euismod tempus, mollis leo tempus? Semper est cursus viverra senectus lectus feugiat id! Odio porta nibh dictumst nulla taciti lacus nam est praesent.</p>


                  <h5>Porta tellus aliquam ligula sollicitudin</h5>
                  <p>Ultrices conubia vehicula malesuada. Eros commodo a duis accumsan vestibulum adipiscing hendrerit lobortis viverra non justo?</p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet adipiscing elit.</li>
                    <li>Aliquam tincidunt mauris eu risus.</li>
                    <li>Vestibulum auctor dapibus neque.</li>
                    <li>Habitant aliquam taciti tellus leo class.</li>
                    <li>Vitae litora erat penatibus nam lorem</li>
                  </ul>
                </div>
              </article>
              <div class="comment-box mt-30">
                <h3>Leave a Comment</h3>
                <form role="form" id="comment-form">
                <div class="row">
                  <div class="col-12 pt-0 pb-0">
                    <div class="mb-3">
                      <input type="text" class="form-control" required name="contact_name" id="contact_name" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                      <input type="text" required class="form-control" name="contact_email2" id="contact_email2" placeholder="Enter Email">
                    </div>
                    <div class="mb-3">
                      <input type="text" placeholder="Enter Website" required class="form-control" name="subject">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <textarea class="form-control" required name="contact_message2" id="contact_message2"  placeholder="Enter Message" rows="7"></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-3">
                      <button type="submit" class="btn btn-theme-colored1 btn-round m-0" data-loading-text="Please wait...">Send Your Comment</button>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-3 sidebar-area sidebar-right">
            <div class="mt-sm-30">
              <div class="widget">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Search box</h4>
                <form role="search" method="get" class="search-form" action="http://pc1/projects/wp/unittest/">
                  <input type="search" class="form-control search-field" placeholder="Search &hellip;" value="" name="s" />
                  <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                </form>
              </div>
              <div class="widget">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Latest News</h4>
                <div class="latest-posts">
                  <article class="post clearfix pb-0 mb-20">
                    <a class="post-thumb" href="news-details.html"><img src="{{ asset('templates/pgeconstruction/images/temp/4.jpg') }}" alt="images"></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="news-details.html">Sustainable Construction</a></h5>
                      <span class="post-date">
                        <time class="entry-date" datetime="2021-05-15T06:10:26+00:00">April 15, 2021</time>
                      </span>
                    </div>
                  </article>
                  <article class="post clearfix pb-0 mb-20">
                    <a class="post-thumb" href="news-details.html"><img src="{{ asset('templates/pgeconstruction/images/temp/5.jpg') }}" alt="images"></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="news-details.html">Industrial Coatings</a></h5>
                      <span class="post-date">
                        <time class="entry-date" datetime="2021-05-15T06:10:26+00:00">April 15, 2021</time>
                      </span>
                    </div>
                  </article>
                  <article class="post clearfix pb-0 mb-20">
                    <a class="post-thumb" href="news-details.html"><img src="{{ asset('templates/pgeconstruction/images/temp/6.jpg') }}" alt="images"></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="news-details.html">Storefront Installations</a></h5>
                      <span class="post-date">
                        <time class="entry-date" datetime="2021-05-15T06:10:26+00:00">April 15, 2021</time>
                      </span>
                    </div>
                  </article>
                </div>
              </div>

              <div class="widget widget_archive">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Archives</h4>
                <ul>
                  <li><a href='#'>October 2021</a></li>
                  <li><a href='#'>February 2021</a></li>
                </ul>
              </div>
              <div class="widget widget_tag_cloud">
                <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Tags</h4>
                <div class="tagcloud">
                  <a href="#" class="tag-cloud-link">health</a>
                  <a href="#" class="tag-cloud-link">medical</a>
                  <a href="#" class="tag-cloud-link">news</a>
                  <a href="#" class="tag-cloud-link">latest</a>
                </div>
              </div>
              <div class="widget widget_text text-center">
                <div class="textwidget">
                  <div class="section-typo-light bg-theme-colored1 mb-md-40 p-30 pt-40 pb-40"> <img class="size-full wp-image-800 aligncenter" src="{{ asset('templates/pgeconstruction/images/headphone-128.png') }}" alt="images" width="128" height="128" />
                  <h4>Online Help!</h4>
                  <h5><a href="+1234567890">+(123) 456-78-90</a></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
    --}}

@endsection
