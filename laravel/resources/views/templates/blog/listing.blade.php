@extends('templates.template')

@section('content')


<!-- Start main-content -->
<div class="main-content-area">

    <!-- Section: Blog -->
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-lg-9">
            <div class="blog-posts single-post">
              <article class="post clearfix mb-0">
                <div class="tm-sc-section-title">
                    <div class="row">
                      <div class="col-xl-8">
                        <div class="title-wrapper text-center m-0">
                          <h1 class="title m-0"><span class="font-weight-800 text-theme-colored2">Latest news</span> <span class="font-weight-500">& blog posts</span></h1>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="entry-content">

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                          <div class="tm-sc-blog blog-style1-current-theme mb-30">
                            <article class="post type-post roofting_blog_post">
                              <div class="entry-header">
                                <div class="post-thumb">
                                  <div class="post-thumb-inner">
                                    <div class="thumb"> <img class="img-fullwidth img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/2.jpg') }}" alt="Image"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="entry-content">
                                <div class="entry-meta">
                                  <span><i class="far fa-clock text-theme-colored2"></i> 20 Mar</span>

                                  <span><i class="far fa-comments text-theme-colored2"></i> 2 Comments</span>
                                </div>
                                <h4 class="entry-title"><a href="{{ route('viewBlogItem', ['blog-post-1']) }}">Tips On Choosing the Right Roofing Contractor</a></h4>
                                <div class="post-excerpt">
                                  <div class="mascot-post-excerpt">Lorem ipsum is simply free text used by copytyping refreshing.</div>
                                </div>
                              </div>
                            </article>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                          <div class="tm-sc-blog blog-style1-current-theme mb-30">
                            <article class="post type-post roofting_blog_post">
                              <div class="entry-header">
                                <div class="post-thumb">
                                  <div class="post-thumb-inner">
                                    <div class="thumb"> <img class="img-fullwidth img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/3.jpg') }}" alt="Image"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="entry-content">
                                <div class="entry-meta">
                                  <span><i class="far fa-clock text-theme-colored2"></i> 20 Mar</span>

                                  <span><i class="far fa-comments text-theme-colored2"></i> 2 Comments</span>
                                </div>
                                <h4 class="entry-title"><a href="{{ route('viewBlogItem', ['blog-post-1']) }}">Success is Through the Roof with Acquisition</a></h4>
                                <div class="post-excerpt">
                                  <div class="mascot-post-excerpt">Lorem ipsum is simply free text used by copytyping refreshing.</div>
                                </div>
                              </div>
                            </article>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                          <div class="tm-sc-blog blog-style1-current-theme mb-30">
                            <article class="post type-post roofting_blog_post">
                              <div class="entry-header">
                                <div class="post-thumb">
                                  <div class="post-thumb-inner">
                                    <div class="thumb"> <img class="img-fullwidth img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/4.jpg') }}" alt="Image"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="entry-content">
                                <div class="entry-meta">
                                  <span><i class="far fa-clock text-theme-colored2"></i> 20 Mar</span>

                                  <span><i class="far fa-comments text-theme-colored2"></i> 2 Comments</span>
                                </div>
                                <h4 class="entry-title"><a href="{{ route('viewBlogItem', ['blog-post-1']) }}">Common Causes of Flat Commercial Roof</a></h4>
                                <div class="post-excerpt">
                                  <div class="mascot-post-excerpt">Lorem ipsum is simply free text used by copytyping refreshing.</div>
                                </div>
                              </div>
                            </article>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                          <div class="tm-sc-blog blog-style1-current-theme mb-30">
                            <article class="post type-post roofting_blog_post">
                              <div class="entry-header">
                                <div class="post-thumb">
                                  <div class="post-thumb-inner">
                                    <div class="thumb"> <img class="img-fullwidth img-fullwidth" src="{{ asset('templates/pgeconstruction/images/temp/4.jpg') }}" alt="Image"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="entry-content">
                                <div class="entry-meta">
                                  <span><i class="far fa-clock text-theme-colored2"></i> 20 Mar</span>

                                  <span><i class="far fa-comments text-theme-colored2"></i> 2 Comments</span>
                                </div>
                                <h4 class="entry-title"><a href="{{ route('viewBlogItem', ['blog-post-1']) }}">Common Causes of Flat Commercial Roof</a></h4>
                                <div class="post-excerpt">
                                  <div class="mascot-post-excerpt">Lorem ipsum is simply free text used by copytyping refreshing.</div>
                                </div>
                              </div>
                            </article>
                          </div>
                        </div>
                      </div>

                </div>
              </article>

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


@endsection
