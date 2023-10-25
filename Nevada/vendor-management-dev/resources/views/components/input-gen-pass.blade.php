<div class="{{ $class ?? '' }}">
    <label class="label-text block" for="{{ $name }}">{{ $label }}</label>
    <div class="join mt-2">
        <label for="{{ $name }}" class="flex items-center relative">
            {{ $slot ?? '' }}
            <input class="input input-bordered block rounded-r-none border-r-0 pl-14 w-full dark:bg-darkbgprimary @error($name) border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror"
                type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" autocomplete="off" @if (isset($readonly)) readonly @endif>
        </label>
        <div onclick="generatePass()" class="btn capitalize join-item">Generate</div>
    </div>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
