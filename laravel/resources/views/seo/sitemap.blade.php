@php echo '<?xml version="1.0" encoding="UTF-8"?>'@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
		<loc>{{ route('index') }}</loc>
		<lastmod>{{Date::parse($HOME->created_at)->format('Y-m-d')}}</lastmod>
		<changefreq>weekly</changefreq>
		<priority>1.0</priority>
	</url>
	@foreach($NAV_PAGES as $p_lv_0)
		@if ($p_lv_0['in_nav'])
			@if ($p_lv_0['url'] != '#')
				<url>
					<loc>{{ route('viewArticle',$p_lv_0['url']) }}</loc>
					<lastmod>{{Date::parse($p_lv_0['created_at'])->format('Y-m-d')}}</lastmod>
					<changefreq>weekly</changefreq>
					<priority>{{ (in_array($p_lv_0['template'],['offers','industries']) ? '0.9' : (in_array($p_lv_0['template'],['career']) ? '0.8' : '0.7')) }}</priority>
				</url>
			@endif
		@if(!empty($p_lv_0['sub']))
			@foreach($p_lv_0['sub'] as $p_lv_1)
				@if ($p_lv_1['in_nav'] && $p_lv_1['url'] != '#')
					<url>
						<loc>{{ route('viewArticle',$p_lv_1['url']) }}</loc>
						<lastmod>{{Date::parse($p_lv_1['created_at'])->format('Y-m-d')}}</lastmod>
						<changefreq>weekly</changefreq>
						<priority>{{ (in_array($p_lv_1['template'],['offers','industries']) ? '0.9' : (in_array($p_lv_1['template'],['career']) ? '0.8' : '0.7')) }}</priority>
					</url>
				@endif
			@endforeach
		@endif
		@endif
    @endforeach
	@if(!empty($offers))
		@foreach ($offers as $item)
			<url>
				<loc>{{ route('viewAsItemModules', [$item->getModule()->details_one['url'], $item->details_one['url']]) }}</loc>
				<lastmod>{{Date::parse($item->created_at)->format('Y-m-d')}}</lastmod>
				<changefreq>weekly</changefreq>
				<priority>0.9</priority>
			</url>
		@endforeach
	@endif
	@if(!empty($industries))
		@foreach ($industries as $item)
			<url>
				<loc>{{ route('viewAsItemModules', [$item->getModule()->details_one['url'], $item->details_one['url']]) }}</loc>
				<lastmod>{{Date::parse($item->created_at)->format('Y-m-d')}}</lastmod>
				<changefreq>weekly</changefreq>
				<priority>0.9</priority>
			</url>
		@endforeach
	@endif
	@if(!empty($blog))
		@foreach ($blog as $item)
			<url>
				<loc>{{ route('viewAsItemModules', [$item->getModule()->details_one['url'], $item->details_one['url']]) }}</loc>
				<lastmod>{{Date::parse($item->created_at)->format('Y-m-d')}}</lastmod>
				<changefreq>weekly</changefreq>
				<priority>0.9</priority>
			</url>
		@endforeach
	@endif
</urlset>
