<a @if (isset($href)) href="{{ $href }}" @endif
    @if (isset($type)) type="{{ $type }}" @endif
    @if (isset($id)) id="{{ $id }}" @endif
    @if (isset($onclick)) onclick="{{ $onclick }}" @endif
    class="btn btn-sm py-1.5 text-xs lg:btn-md lg:text-sm rounded-full px-10 bg-purple hover:bg-purpledarker text-white normal-case transition-all h-fit {{ $class ?? '' }}"
    >
    {{ $slot }}
</a>
