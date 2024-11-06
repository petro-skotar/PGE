<script type='application/ld+json'>
    [
        {{--{
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "{{ $article->details_one->name }}",
            "description": "{{ $article->details_one->description }}",
            "url": "{{ url()->current() }}",
            "publisher": {
                "@type":"Organization",
                "url":"{{route('index')}}",
                "name":"{{$HOME->details_one->name}}",
                "logo":{
                    "@type":"ImageObject",
                    "url":"{{ asset('templates/pgeconstruction/images/logo-wide-white@2x.png') }}",
                    "name":"{{$HOME->details_one->name}}"
                }
            }
        },--}}
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{!! strip_tags($HOME->details_one->name) !!}",
            "url": "{{route('index')}}",
            "logo": "{{ asset('templates/pgeconstruction/images/logo-wide-white@2x.png') }}",{{--
            "sameAs":[
                @if(!empty($SETTING['contact_instagram']['val']))"{!! $SETTING['contact_instagram']['val'] !!}",@endif
                @if(!empty($SETTING['contact_facebook']['val']))"{!! $SETTING['contact_facebook']['val'] !!}",@endif
            ],--}}
            "slogan": "",
            "keywords": "PGE, construction, Prince Rupert, company",
            "image": "{{ asset('templates/dist/img/how_work_1.webp') }}",
            "telephone": "{!! $SETTING['contact_phone']['val'] !!}",
            "email": "{!! $SETTING['contact_email']['val'] !!}"@if($LANG == 'pl'),
            "address": [{
                "streetAddress" : "801 Fraser St",
                "postalCode" : "V8J 1R1",
                "addressLocality" : "Prince Rupert, BC, Canada"
            }]@endif
        },
        {{--{
            "@context": "https://schema.org/",
            "@type": "WPHeader",
            "headline": "{{ $article->details_one->name }}",
            "description": "{{ $article->details_one->description }}"
        },--}}
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",

          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "item": {
                "@id": "{{ route('index') }}",
                "name": "{!! strip_tags($HOME->details_one->name) !!}"
            }
          }
          @if($article->id != 1)
              @if(!empty($article->details_one->bread))
              ,{
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@id": "{{ ($article->module == 'articles' ? route('viewArticle', $article->details_one->url) : (route('viewAsItemModules', [$article->getModule()->details_one->url, $article->details_one->url]))) }}",
                    "name": "{!! strip_tags($article->details_one->bread) !!}"
                }
              }
              @endif
          @endif
          ]
        },
    @if($article->template == 'about')
        {
            "@context": "https://schema.org",
            "@type": "AboutPage",
            "name": "{!! strip_tags($article->details_one->name) !!}",
            "description": "{{ $article->details_one->description }}",
            "url": "{{ route('viewArticle', $article->details_one->url) }}",
            "image": "{{ asset('templates/dist/img/history/history.png') }}"
        },
    @endif
        {
            "@context": "https://schema.org",
            "@type": "SiteNavigationElement",
            "name": "{!! strip_tags($HOME->details_one->name) !!}",
            "url": "{{route('index')}}"
        }
    @foreach($NAV_PAGES as $p_lv_0)
    @if ($p_lv_0['in_nav'])
        ,{
            "@context": "https://schema.org",
            "@type": "SiteNavigationElement",
            "name": "{{$p_lv_0['name']}}",
            "url": "{{ route('viewArticle',$p_lv_0['url']) }}"
        }
    @endif
    @endforeach
    @if(!empty($sections['faq']))
        ,{
          "@context": "https://schema.org",
          "@type": "FAQPage",
          "mainEntity": [
    @forelse($sections['faq'] as $item)
              {
                "@type": "Question",
                "name": "{{ $item['name'] }}",
                "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "{!! $item['content'] !!}"
                }
              }@if(!$loop->last),@endif
    @endforeach
          ]
        }
    @endif
    ]
    </script>
