<div class="{{ $class ?? '' }}">
    <label class="label-text" for="{{ $name }}">{{ $label }}</label>
    <label for="{{ $name }}" class="flex items-center relative mt-2">
        {{ $slot ?? '' }}
        <input class="input input-bordered pl-14 w-full dark:bg-darkbgprimary @error($name) border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror"
            type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}" autocomplete="off" @if (isset($readonly)) readonly @endif>
    </label>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
