@if (isset($paginator) && $paginator->lastPage() > 1)
    <nav aria-label="Page navigation example" class="flex items-center justify-between">
        <div class="flex justify-center">
            <?php
                $interval = isset($interval) ? abs(intval($interval)) : 2 ;
                $from = $paginator->currentPage() - $interval;
                if ($from < 1) $from = 1;
                    
                $to = $paginator->currentPage() + $interval;
                if ($to > $paginator->lastPage()) $to = $paginator->lastPage();
            ?>
                
            @if ($paginator->currentPage() > 1)
				
                <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <<
                </a>
				
                <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <
                </a>
            @endif
                
            @for($i = $from; $i <= $to; $i++)
                <?php 
                    $isCurrentPage = $paginator->currentPage() == $i; 
                ?>
                <a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white {{ $isCurrentPage ? 'text-white bg-blue-500' : 'text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50' }}">
                    {{ $i }}
                </a>
            @endfor
                
            @if($paginator->currentPage() < $paginator->lastPage())
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    >
                </a>
                <a href="{{ $paginator->url($paginator->lastpage()) }}" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    >>
                </a>
				
            @endif
        </div>
    </nav>
@endif
