<x-dashboard title="Notification">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/notifications">Notifications</a></li>
    </x-slot:breadcrumbs>

    <div class="max-w-5xl">
        <div class="flex items-center mb-8">
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Notifications</h1>
            <form method="POST" action="/notifications" class="w-full flex justify-end">
                @csrf
                @method('PATCH')
                <button class="flex items-center text-sm text-purple gap-1 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                      <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                      <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                    </svg>
                    Mark all as read
                </button>
            </form>
        </div>

        @foreach (auth()->user()->notifications()->latest()->get() as $notification)
            <div onclick="location = '/notifications/{{ $notification->pivot->id }}'" class="block py-5 border-t border-base-300 text-textgray dark:text-white group px-3 transition-all hover:bg-base-200 cursor-pointer">
                @if ($notification->pivot->is_readed)
                    <strong class="group-hover:underline text-gray">{{ $notification->title }}</strong>
                    <div class="truncate text-ellipsis text-gray max-h-10">
                        {!! $notification->message !!}
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-2 rounded-full bg-purple"></div>
                        <strong class="group-hover:underline">{{ $notification->title }}</strong>
                    </div>
                    <div class="truncate text-ellipsis max-h-10">
                        {!! $notification->message !!}
                    </div>
                @endif
                <div class="text-gray text-xs mt-1">{{ \Carbon\Carbon::parse($notification->created_at)->ago() }}</div>
            </div>
        @endforeach

        @if (auth()->user()->notifications()->count() === 0)
            <div>No notifications</div>
        @endif

    </div>

</x-dashboard>
