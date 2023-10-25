<x-layout :title="$title">

    @php
        $pp = auth()->user()->profile_picture;
        $notifCount = auth()->user()->notifications()->wherePivot('is_readed', 0)->count();
        $notifications = auth()->user()->notifications()->limit(3)->get();
    @endphp

    <aside class="hidden w-64 min-h-screen px-5 bg-white border-r border-base-300 dark:border-base-100 text-textgray dark:bg-darkbgprimary lg:block lg:fixed">
        <a href="/" class="flex items-center gap-2 mt-8 mb-12 mx-3">
            <img src="{{ asset('images/logo.png') }}" alt="Nevada logo" class="w-14" />
            <h1 class="font-bold text-2xl dark:text-white">Nevada</h1>
        </a>
        <nav>
            <ul>
                <li>
                    <a href="/profile" class="flex gap-3 mb-3 py-2 px-5 cursor-pointer rounded-full transition-colors @if (request()->route()->getName() === 'profile') bg-purple text-white @else hover:bg-base-300 dark:hover:bg-base-100 dark:text-white @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Profile
                    </a>
                </li>
                @role('Vendor')
                    <li>
                        <a href="/profile/vendor" class="flex gap-3 mb-3 py-2 px-5 cursor-pointer rounded-full transition-colors @if (request()->route()->getName() === 'profile.vendor') bg-purple text-white @else hover:bg-base-300 dark:hover:bg-base-100 dark:text-white @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                            </svg>
                            Vendor
                        </a>
                    </li>
                @endrole
                <li>
                    <a href="/profile/password" class="flex gap-3 mb-3 py-2 px-5 cursor-pointer rounded-full transition-colors @if (request()->route()->getName() === 'profile.password') bg-purple text-white @else hover:bg-base-300 dark:hover:bg-base-100 dark:text-white @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                        Edit password
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <header class="flex justify-between items-center w-full h-14 px-5 border-b border-b-base-300 dark:border-b-base-100 bg-white lg:hidden dark:bg-darkbgprimary">
        <div class="drawer">

            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <label for="my-drawer" class="drawer-button block w-fit -ml-2 p-2 box-content cursor-pointer rounded-lg transition-colors hover:bg-base-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </label>
            </div>
            <div class="drawer-side z-10">
                <label for="my-drawer" class="drawer-overlay"></label>
                <ul class="p-4 w-80 h-full bg-base-200 text-base-content">
                    <a href="/" class="flex items-center gap-2 mt-8 mb-12 mx-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Nevada logo" class="w-14" />
                        <h1 class="font-bold text-2xl dark:text-white">Nevada</h1>
                    </a>
                    <nav>
                        <ul>
                            <li>
                                <a href="/profile" class="flex gap-3 mb-3 py-2 px-5 cursor-pointer rounded-full transition-colors @if (request()->route()->getName() === 'profile') bg-purple text-white @else hover:bg-base-300 dark:text-white @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            @role('Vendor')
                                <li>
                                    <a href="/profile/vendor" class="flex gap-3 mb-3 py-2 px-5 cursor-pointer rounded-full transition-colors @if (request()->route()->getName() === 'profile.vendor') bg-purple text-white @else hover:bg-base-300 dark:text-white @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                                        </svg>
                                        Vendor
                                    </a>
                                </li>
                            @endrole
                            <li>
                                <a href="/profile/password" class="flex gap-3 mb-3 py-2 px-5 cursor-pointer rounded-full transition-colors @if (request()->route()->getName() === 'profile.password') bg-purple text-white @else hover:bg-base-300 dark:text-white @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                    Edit password
                                </a>
                            </li>
                        </ul>
                    </nav>
                </ul>
            </div>
        </div>
        <div class="flex items-center justify-end gap-2">
            <div class="flex items-center tooltip tooltip-bottom" data-tip="Switch theme">
                <label class="swap swap-rotate">
                    <input type="checkbox" onchange="toggleTheme()"/>
                    <svg class="light-mode swap-off fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/></svg>
                    <svg class="dark-mode swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"/></svg>
                </label>
            </div>
            <div class="dropdown dropdown-end">
                <label tabindex="0">
                    <div class="box-content w-6 h-6 p-2 rounded-full cursor-pointer hover:bg-base-300">
                        <div class="indicator">
                            @if ($notifCount > 0)
                                <span class="indicator-item badge text-white text-xs bg-red-500">{{ $notifCount }}</span>
                            @endif
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                    </div>
                </label>
                <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow bg-base-100 rounded-box w-72">
                    @foreach ($notifications as $notification)
                        <li>
                            <a href="/notifications/{{ $notification->pivot->id }}" class="block dark:hover:!text-white active:!bg-purple">
                                <div class="font-bold @if ($notification->pivot->is_readed) text-gray @endif">{{ $notification->title }}</div>

                                <div @if ($notification->pivot->is_readed) class="text-gray" @endif>
                                    @if (strlen($notification->message) > 30)
                                        {{ substr($notification->message, 0, 30).'...' }}
                                    @else
                                        {{ $notification->message }}
                                    @endif
                                </div>

                                <div class="text-gray text-xs">{{ $notification->created_at }}</div>
                            </a>
                        </li>
                    @endforeach
                    <li><a href="/notifications" class="flex items-center text-purple font-bold hover:!bg-purple hover:!text-white mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                          <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                          <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                        </svg>
                        See all
                    </a></li>
                </ul>
            </div>
            <div class="dropdown dropdown-end shrink-0">
                <label tabindex="0">
                    <img src="{{ asset($pp) }}" alt="Profile picture" class="w-8 h-8 rounded-full cursor-pointer box-content -mr-1 p-1 transition-colors hover:bg-base-200 object-cover" />
                </label>
                <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow bg-base-100 rounded-box w-72">
                    <li>
                            <a class="flex !cursor-default active:!bg-purple hover:!bg-transparent active:!bg-transparent active:!text-black dark:active:!text-white dark:hover:!text-white">
                            <img src="{{ asset($pp) }}" alt="Profile picture" class="w-8 h-8 rounded-full object-cover" />
                            <div class="block w-fit">
                                <div>{{ auth()->user()->name }}</div>
                                <div class="text-sm text-slate-400">{{ auth()->user()->email }}</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="/profile" class="flex items-center mt-1 active:!bg-purple dark:hover:!text-white active:!text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="/signout" class="bg-red-500 mt-1 text-white hover:!text-white hover:!bg-red-600 active:!bg-red-700 block p-0">
                            @csrf
                            <button class="flex items-center gap-2 w-full h-full px-3 py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Signout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <main class="p-5 lg:p-8 lg:ml-64">
        <header class="flex justify-between items-center mb-8">
            <div class="text-sm breadcrumbs">
                <ul>
                    {{ $breadcrumbs }}
                </ul>
            </div>
            <div class="hidden items-center gap-5 lg:flex">
                <div class="tooltip" data-tip="Switch theme">
                    <label class="swap swap-rotate">
                        <input type="checkbox" onchange="toggleTheme()"/>
                        <svg class="light-mode swap-off fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/></svg>
                        <svg class="dark-mode swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"/></svg>
                    </label>
                </div>
                <div class="dropdown dropdown-end">
                    <label tabindex="0">
                        <div class="box-content w-6 h-6 p-2 rounded-full cursor-pointer hover:bg-base-300">
                            <div class="indicator">
                                @if ($notifCount > 0)
                                    <span class="indicator-item badge text-white text-xs bg-red-500">{{ $notifCount }}</span>
                                @endif
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </div>
                        </div>
                    </label>
                    <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow bg-base-100 rounded-box w-72">
                        @foreach ($notifications as $notification)
                            <li>
                                <a href="/notifications/{{ $notification->pivot->id }}" class="block dark:hover:!text-white active:!bg-purple">
                                    <div class="font-bold @if ($notification->pivot->is_readed) text-gray @endif">{{ $notification->title }}</div>

                                    <div @if ($notification->pivot->is_readed) class="text-gray" @endif>
                                        @if (strlen($notification->message) > 30)
                                            {{ substr($notification->message, 0, 30).'...' }}
                                        @else
                                            {{ $notification->message }}
                                        @endif
                                    </div>

                                    <div class="text-gray text-xs">{{ $notification->created_at }}</div>
                                </a>
                            </li>
                        @endforeach
                        <li><a href="/notifications" class="flex items-center text-purple font-bold hover:!bg-purple hover:!text-white mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                              <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" />
                            </svg>
                            See all
                        </a></li>
                    </ul>
                </div>
                <div class="dropdown dropdown-end">
                    <label tabindex="0">
                        <img src="{{ asset($pp) }}" alt="Profile picture" class="w-10 h-10 box-content p-1 rounded-full cursor-pointer hover:bg-base-200 object-cover" />
                    </label>
                    <ul tabindex="0" class="dropdown-content z-50 menu p-2 shadow bg-base-100 rounded-box w-72">
                        <li>
                            <a class="flex !cursor-default active:!bg-purple hover:!bg-transparent active:!bg-transparent active:!text-black dark:active:!text-white dark:hover:!text-white">
                                <img src="{{ asset($pp) }}" alt="Profile picture" class="w-8 h-8 rounded-full object-cover" />
                                <div class="block w-fit">
                                    <div>{{ auth()->user()->name }}</div>
                                    <div class="text-sm text-slate-400">{{ auth()->user()->email }}</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/profile" class="flex items-center mt-1 active:!bg-purple dark:hover:!text-white active:!text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="/signout" class="bg-red-500 mt-1 text-white hover:!text-white hover:!bg-red-600 active:!bg-red-700 block p-0">
                                @csrf
                                <button class="flex items-center gap-2 w-full h-full px-3 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                    Signout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        {{ $slot }}
    </main>
</x-layout>
