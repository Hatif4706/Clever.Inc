<div class="py-2 flex-col gap-4 border-t-[1px] border-base-200 dark:border-base-100">
    <div class="flex py-2 gap-2 ">
        <label tabindex="0">
            <img src="{{ asset($picture) }}" alt="Profile picture" class="w-14 h-14 rounded-full object-cover" />
        </label>
        <div class="block text-start">
            <h1 class="font-semibold text-textgray dark:text-white">{!! $action !!}</h1>
            <div class="flex items-center gap-1">
                <h3 class="text-sm">{{ $name }}</h3>
                <h3 class="text-sm text-gray">{{ \Carbon\Carbon::parse($time)->ago() }}</h3>
            </div>
        </div>
    </div>
</div>
