<div class="w-48">
    <div class="flex items-start gap-1 mb-2 h-10">
        <label class="label-text" for="company_profile">{{ $name }}</label>
        <div class="tooltip z-10" data-tip="{{ $translate }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
        </div>
    </div>
        @if ($src != null)
            @php $ext = pathinfo($src)['extension']  @endphp
            <div class="bg-white w-48 h-48 overflow-hidden rounded-md shrink-0 border border-base-300 dark:border-base-100">
                <a href=
                    @if ($ext === 'docx') "/preview/{{ $src }}"
                    @else "{{ asset($src) }}"
                    @endif
                target="_blank" class="w-full h-full block">

                    @if ($ext === 'pdf')
                        <canvas class="document w-48" data-src="{{ asset($src) }}"></canvas>
                    @elseif ($ext === 'jpg' || $ext === 'jpeg')
                        <img src="{{ asset($src) }}" class="w-48 h-48 object-cover" />
                    @elseif ($ext === 'docx')
                        <div class="flex items-center justify-center h-full">
                            <img src="{{ asset('images/doc.png') }}" class="w-10" />
                        </div>
                    @endif
                </a>
            </div>
        @else
            <div class="w-48 h-48 rounded-md border border-base-300 bg-base-200 dark:bg-base-100"></div>
        @endif
</div>
