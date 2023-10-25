<x-dashboard title="Pending">

    <x-slot:breadcrumbs></x-slot:breadcrumbs>

    @if (auth()->user()->vendor->status === 'Not Verified')
        <div class="flex flex-wrap items-center gap-2">
            <x-icons.x-circle class="h-8 w-8 text-red-500" />
            <h1 class="text-xl lg:text-2xl font-bold text-center text-textgray dark:text-white">Your vendor are not verified</h1>
        </div>
    @endif

    @if (auth()->user()->vendor->status === 'New')
        <div class="flex flex-wrap items-center gap-2">
            <x-icons.clock class="h-8 w-8 text-gray" />
            <h1 class="text-xl lg:text-2xl font-bold text-center text-textgray dark:text-white">Waiting for approval</h1>
        </div>
    @endif

</x-dashboard>
