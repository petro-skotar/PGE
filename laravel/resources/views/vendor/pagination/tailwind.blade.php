@if ($paginator->hasPages())
    
    <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  				
    				@if ($paginator->onFirstPage())
    					<li class="page-item"><a class="page-link">«</a></li>
    				@else
    					<li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">«</a></li>
    				@endif
    				
    				
    				@foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item">{{ $element }}</li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item"><a class="page-link">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    
                    
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())                       
                        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">»</a></li>
                    @else
                        <li class="page-item"><a class="page-link">»</a></li>
                    @endif
                
    </ul>
</div>
              
@endif
