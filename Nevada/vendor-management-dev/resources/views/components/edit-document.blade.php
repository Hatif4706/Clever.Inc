<input type="file" name="{{ $name }}" id="{{ $name }}" class="invisible absolute h-0 w-0" onchange="setPreview(event)" accept="{{ $accept }}" />
<div class="w-48">
    <div class="hidden label-text text-xs mb-1 {{ $name }}"></div>
    <div class="flex items-start justify-between gap-1 mb-2 h-10">
        <label class="label-text" for="{{ $name }}">{{ $label }}</label>
        <div class="flex gap-1">
            <div class="tooltip z-10" data-tip="{{ $info }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </div>
            <label for="{{ $name }}" class="tooltip z-10 cursor-pointer" data-tip="Update">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </label>
        </div>
    </div>
    @if ($src != null)
        <div class="bg-white w-48 h-48 overflow-hidden rounded-md shrink-0 border border-base-300 dark:border-base-100">
            <a href="{{ asset($src )}}" target="_blank" class="w-full h-full block">
                @if (pathinfo($src)['extension'] === 'pdf')
                    <canvas class="document w-48 {{ $name }}" data-src="{{ asset($src) }}"></canvas>
                    <img src="{{ asset($src) }}" class="w-48 h-48 object-cover {{ $name }}" style="display: none;" />
                @else
                    <canvas class="document w-48 {{ $name }}" data-src="{{ asset($src) }}" style="display: none;"></canvas>
                    <img src="{{ asset($src) }}" class="w-48 h-48 object-cover {{ $name }}" />
                @endif
            </a>
        </div>
    @else
        <div class="w-48 h-48 rounded-md border border-base-300 bg-base-200 dark:bg-base-100">
            <img src="" class="w-48 h-48 object-cover {{ $name }}" style="display: none;" />
            <canvas class="document w-48 {{ $name }}" data-src="" style="display: none;"></canvas>
        </div>
    @endif
</div>
