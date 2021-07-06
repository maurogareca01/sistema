@if ($paginator->hasPages())
    <nav class="content-paginacion">
        <div class="content-ant-sig">
            @if ($paginator->onFirstPage())
                <span class="ant-sig">
                <i class="fas fa-arrow-circle-left"></i>
                   
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="ant-sig">
                <i class="fas fa-arrow-circle-left"></i>
                </a>
            @endif

            <div class="content-numeros"> 
                <span class=" ">
                      
                    @foreach ($elements as $element)

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span  >
                                        <span class="link-num">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="link-num">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    
                </span>
            </div> 

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="ant-sig">
                <i class="fas fa-arrow-circle-right"></i>
                </a>
            @else
                <span class="ant-sig">
                <i class="fas fa-arrow-circle-right"></i>
                </span>
            @endif
        </div>

        
    </nav>
@endif
