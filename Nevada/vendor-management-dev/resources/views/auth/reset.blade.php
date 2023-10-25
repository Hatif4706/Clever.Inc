<x-layout title="Reset Password">

    @error('email')
        <div class="toast toast-start">
            <div class="alert alert-error flex mb-5">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ $message }}</span>
            </div>
        </div>
    @enderror

    <header class="p-8 lg:hidden">
        <div class="absolute cursor-pointer" onclick="history.back()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </div>
        <h1 class="text-center font-bold text-xl">Create New Password</h1>
    </header>

    <main class="block lg:flex min-h-screen">
        <section class="flex lg:bg-gradient-to-b from-[#BEB5F4] to-customblue w-full justify-center items-center">
            <img src="{{ asset('images/key.png') }}" alt="Key" class="w-48 lg:w-1/2" />
        </section>
        <section class="w-full flex items-center px-8 lg:px-16 xl:px-28">
            <form method="POST" action="/reset-password" class="w-full">
                @csrf
                <div class="hidden lg:block">
                    <h1 class="font-bold text-xl md:text-2xl text-center mb-1">Create New Password</h1>
                </div>
                <p class="font-bold text-center mb-12 text-gray dark:text-slate-400">Set the new password for your account.</p>

                <x-input name="password" label="New password" placeholder="Enter your new password" class="mb-4">
                    <x-icons.lock-closed input />
                </x-input>

                <x-input name="password_confirmation" label="Confirm password" placeholder="Enter your confirm password">
                    <x-icons.key input />
                </x-input>

                <input type="hidden" name="email" value="{{ request()->email }}" />
                <input type="hidden" name="token" value="{{ request()->token }}" />

                <div class="flex justify-center mt-10">
                    <button class="btn btn-primary mb-5 bg-purple border-none w-60 rounded-full normal-case text-white">Reset</button>
                </div>

            </form>
        </section>
    </main>

</x-layout>
