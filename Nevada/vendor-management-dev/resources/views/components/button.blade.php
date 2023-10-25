<button @if (isset($type)) type="{{ $type }}" @endif
    @if (isset($id)) id="{{ $id }}" @endif
    @if (isset($onclick)) onclick="{{ $onclick }}" @endif
    class="btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all {{ $class ?? '' }}"
    >
    {{ $slot }}
</button>
