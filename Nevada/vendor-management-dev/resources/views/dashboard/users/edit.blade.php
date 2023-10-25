<x-dashboard title="Edit User">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/users">Users</a></li>
        <li><a href="">Edit</a></li>
    </x-slot:breadcrumbs>

    @error('profile_picture')
        <div class="toast toast-start z-50">
            <div class="alert alert-error flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ $message }}</span>
            </div>
        </div>
    @enderror

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <h1 class="mb-8 font-bold text-2xl text-textgray dark:text-white">Edit User</h1>

    <form method="POST" action="/users/{{ $user->id }}" class="max-w-5xl" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="block lg:flex gap-16 mb-8">
            <label for="profilePictureInput" class="block relative h-fit w-fit shrink-0 cursor-pointer mb-8 lg:mb-0 group">
                <input type="file" name="profile_picture" id="profilePictureInput" accept="image/jpg, image/jpeg, image/png" class="invisible absolute" onchange="setPreview(event)" />
                <div class="flex justify-center items-center absolute right-0 bottom-0 bg-purple text-white w-8 h-8 rounded-full border-4 dark:border-darkbgprimary z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                      <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                    </svg>
                </div>
                <img src="{{ asset($user->profile_picture ?? '/images/avatar.jpg') }}" class="w-28 h-28 rounded-full object-cover shadow" id="profilePicture" />
                <div class="w-full h-full absolute bottom-0 rounded-full group-hover:bg-[#00000099] transition-colors flex items-center justify-center">
                    <p class="text-white font-semibold text-xs opacity-0 transition group-hover:opacity-100">Change picture</p>
                </div>
            </label>

            <div class="max-w-sm lg:w-md">
                <div class="label-text cursor-default mb-2">Role</div>
                @if ($user->roles[0]->name == 'Vendor')
                    <label class="badge roleBadge dark:text-white select-none px-5 py-3 mb-2 mr-2 role text-center transition-none text-white" style="background-color: {{ $user->roles[0]->color }};" >
                        {{ $user->roles[0]->name }}
                    </label>
                    <input type="hidden" name="role" value="{{ $user->roles[0]->id }}" />
                @else
                    @foreach ($roles as $role)
                        @if ($role->name == 'Vendor') @continue @endif
                        <label class="badge roleBadge dark:text-white select-none px-5 py-3 mb-2 mr-2 role text-center transition-none cursor-pointer @if ($role->id === $user->roles[0]->id) text-white @else bg-base-200 @endif" for="{{ $role->id }}" data-color="{{ $role->color }}" @if ($role->id === $user->roles[0]->id) style="background-color: {{ $role->color }};" @endif >
                            <input type="radio" name="role" value="{{ $role->id }}" class="invisible w-0 h-0" id="{{ $role->id }}" onchange="changeBadgeBg(event)" @checked($role->id === $user->roles[0]->id) />
                            {{ $role->name }}
                        </label>
                    @endforeach

                    @error('roles')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                @endif
            </div>
        </div>
        <div class="block lg:grid lg:grid-cols-2 lg:gap-5">


            <x-input name="name" placeholder="Enter full name" label="Full name" value="{{ $user->name }}" class="mb-4">
                <x-icons.user input/>
            </x-input>

            <x-input name="email" placeholder="Enter email address" label="Email" value="{{ $user->email }}" class="mb-4">
                <x-icons.envelope input/>
            </x-input>

            <x-input name="phone_number" placeholder="Enter phone number" label="Phone number" value="{{ $user->phone_number }}" class="mb-4">
                <x-icons.phone input/>
            </x-input>

            <x-input-gen-pass name="password" placeholder="Enter password" label="Password" >
                <x-icons.lock-closed input/>
            </x-input-gen-pass>
        </div>

        <x-button class="mt-8">Edit user</x-button>
    </form>

    <script>
        const badges = document.getElementsByClassName('roleBadge');

        function changeBadgeBg(e) {
            for (const badge of badges) {
                badge.style.backgroundColor = '';
                badge.classList.add('bg-base-200');
                badge.classList.remove('text-white');
            }

            const badge = document.querySelector(`label[for="${e.target.id}"]`)
            badge.style.backgroundColor = badge.dataset.color;
            badge.classList.remove('bg-base-200');
            badge.classList.add('text-white');
        }

        function generatePass() {
            const passwordInput = document.getElementById('password');
            const chars = 'abcdefghijklmnopqrstuvwxyz'
            let password = '';

            for (let i = 0; i < 8; i++)
                password += chars[Math.floor(Math.random() * chars.length)];

            passwordInput.value = password;
        }

        function setPreview(e) {
            if (event.target.files.length > 0) {
                const objUrl = URL.createObjectURL(event.target.files[0]);
                document.getElementById('profilePicture').src = objUrl;
            }
        }
    </script>

</x-dashboard>
