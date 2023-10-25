@php
    $current = $data->currentPage();
    $last = (int) ceil($data->total() / $data->perPage());
    $prev = $data->previousPageUrl();
    $next = $data->nextPageUrl();
@endphp

@if ($data->hasPages() && $data->count() > 0)
    <div class="flex justify-center my-12">
        <div class="join">
            @if ($prev)
                <a href="{{ $prev }}" class="join-item btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </a>
            @endif
            @if ($current > 4 && $current == $last)
                <a href="{{ $data->url($current - 4) }}" class="join-item btn">{{ $current - 4 }}</a>
            @endif
            @if ($current > 3 && $current >= $last - 1)
                <a href="{{ $data->url($current - 3) }}" class="join-item btn">{{ $current - 3 }}</a>
            @endif
            @if ($current > 2)
                <a href="{{ $data->url($current - 2) }}" class="join-item btn">{{ $current - 2 }}</a>
            @endif
            @if ($current > 1)
                <a href="{{ $data->url($current - 1) }}" class="join-item btn">{{ $current - 1 }}</a>
            @endif
            <a href="" class="join-item btn btn-active">{{ $current }}</a>
            @if ($current + 1 <= $last )
                <a href="{{ $data->url($current + 1) }}" class="join-item btn">{{ $current + 1 }}</a>
            @endif
            @if ($current + 2 <= $last )
                <a href="{{ $data->url($current + 2) }}" class="join-item btn">{{ $current + 2 }}</a>
            @endif
            @if ($current + 3 <= $last && $current <= 2)
                <a href="{{ $data->url($current + 3) }}" class="join-item btn">{{ $current + 3 }}</a>
            @endif
            @if ($current + 4 <= $last && $current <= 1)
                <a href="{{ $data->url($current + 4) }}" class="join-item btn">{{ $current + 4 }}</a>
            @endif
            @if ($next)
                <a href="{{ $next }}" class="join-item btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
@else
    @if ($prev)
        <div class="flex justify-center my-12">
            <a href="{{ $prev }}" class="join-item btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
        </div>
    @endif
@endif
