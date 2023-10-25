<x-profile title="Edit Password">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/profile">Profile</a></li>
        <li><a href="/profile/password">Password</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast toast-start">
            <div class="alert alert-error flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="pt-2 w-full items-center">
        <form action="/profile/password" method="POST" class="bg-white dark:bg-darkbgprimary dark:text-white">
            @csrf
            @method('PUT')
            <div class="block justify-center">
                <h1 class="font-bold text-2xl">Edit password</h1>
                <div class="block mt-8 md:max-w-2xl">

                <x-input label="Current password" placeholder="Enter your current password" name="current_password"  class="form-control w-full mt-1 mb-4">
                    <x-icons.lock-closed input/>
                </x-input>

                <x-input label="New password" placeholder="Enter your new password" name="new_password"  class="form-control w-full mt-1 mb-4">
                    <x-icons.key input />
                </x-input>

                 <x-input label="Confirm password" placeholder="Confirm your new password" name="new_password_confirmation"  class="form-control w-full mt-1 mb-4">
                    <x-icons.check-circle input />
                </x-input>

                <div class="flex items-center mt-8">
                    <x-button id="changepass">Change password</x-button>
                </div>
            </div>
        </form>
    </div>
</x-profile>
