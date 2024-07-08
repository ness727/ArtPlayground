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
				<!--
                <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    ◀
                </a>
				-->
                <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" class="relative rounded-l-md inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <
                </a>
            @endif
                
            @for($i = $from; $i <= $to; $i++)
                <?php 
                    $isCurrentPage = $paginator->currentPage() == $i; 
                ?>
                <a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}" style="position: relative; display: inline-flex; align-items: center; padding: .5rem 1rem; font-size: 1rem; font-weight: 500; background-color: #fff; {{ $isCurrentPage ? 'color: #fff; background-color: #d97706;' : 'color: #4b5563; border: 1px solid #d1d5db; box-shadow: inset 0 0 0 1px #d1d5db;' }}" onmouseover="{{ !$isCurrentPage ? 'this.style.backgroundColor = `#f9fafb`' : '' }}" onmouseout="{{ !$isCurrentPage ? 'this.style.backgroundColor = `#fff`' : '' }}">

                    {{ $i }}
                </a>
            @endfor
                
            @if($paginator->currentPage() < $paginator->lastPage())
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="relative rounded-r-md inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    >
                </a>
                <!-- <a href="{{ $paginator->url($paginator->lastpage()) }}" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    ▶
                </a>
				-->
            @endif
        </div>
    </nav>
@endif
