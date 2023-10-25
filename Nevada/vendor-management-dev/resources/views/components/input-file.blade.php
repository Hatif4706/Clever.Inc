<div class="w-full {{ $class ?? '' }}">
    <div class="flex items-center gap-1 mb-2">
        <label class="label-text" for="{{ $name }}">{{ $label }}</label>
        <div class="tooltip" data-tip="{{ $info }}">
            <x-icons.info class="w-4 h-4" />
        </div>
    </div>
    <input type="file" name="{{ $name }}" id="{{ $name }}" accept="{{ $accept ?? '' }}" class="file-input file-input-bordered w-full dark:bg-transparent @error($name) file-input-error @enderror"
        @if (isset($required)) required @endif
    />
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

