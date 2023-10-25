<x-dashboard title="Notification">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/notifications">Notifications</a></li>
        <li><a href="">Read</a></li>
    </x-slot:breadcrumbs>

    <div class="max-w-5xl">
        <h1 class="text-2xl font-bold text-textgray dark:text-white">{{ $notification->title }}</h1>
        <div class="text-gray text-xs mt-2 mb-4">{{ \Carbon\Carbon::parse($notification->created_at)->ago() }}</div>
        <div>{!! $notification->message !!}</div>
    </div>

</x-dashboard>
