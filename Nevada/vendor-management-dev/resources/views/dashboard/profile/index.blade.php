<x-profile title="Profile">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/profile">Profile</a></li>
    </x-slot:breadcrumbs>

    @php $pp = auth()->user()->profile_picture; @endphp

    @if (session('success'))
        <div class="toast toast-start z-50">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @error('profile_picture')
        <div class="toast toast-start z-50">
            <div class="alert alert-error flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ $message }}</span>
            </div>
        </div>
    @enderror

    <form action="/profile" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="pb-10 w-full">
            <div class="h-28 lg:h-36 w-full bg-gradient-to-b from-accent to-blue-200 to-100% rounded-t-xl relative">
                <input type="file" name="profile_picture" id="profilePictureInput" accept="image/jpg, image/jpeg, image/png" class="invisible" onchange="setPreview(event)" />
                <label for="profilePictureInput" class="absolute top-14 left-8 lg:top-20 lg:left-10 cursor-pointer group">
                    <div class="w-full h-full absolute rounded-full group-hover:bg-[#00000099] transition-colors flex items-center justify-center">
                        <p class="text-white font-semibold text-xs sm:text-sm opacity-0 transition group-hover:opacity-100">Change picture</p>
                    </div>
                    <img src="{{ $pp ? $pp : asset('images/avatar.jpg') }}" alt="profile" id="profilePicture" class="block w-28 h-28 lg:w-32 lg:h-32 rounded-full bg-white object-cover shadow dark:shadow-none dark:bg-darkbgprimary" />
                    <div class="bg-purple border-4 border-white w-8 h-8 absolute bottom-0 right-0 rounded-full dark:border-darkbgprimary">
                        <div class="flex items-center justify-center w-full h-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                              <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                            </svg>
                        </div>
                    </div>
                </label>
            </div>
            <div class="pt-16 lg:pt-20 w-full block">
                <h1 class="font-bold text-2xl mb-5">{{ auth()->user()->name }}</h1>
                <div class="flex flex-wrap mt-2 sm:w-80 mb-4">
                    <div class="badge text-white gap-2 mr-1 mb-1 rounded-full role-label dark:border-none text-xs py-3" style="background-color: {{ auth()->user()->roles[0]->color }};" id="roleLabel7">
                        {{ auth()->user()->roles[0]->name }}
                    </div>
                </div>
                    <div class="mt-2 block w-full justify-center">

                        <x-input label="Full name" placeholder="Your name" name="name"  value="{{ auth()->user()->name }}" class="form-control w-full md:max-w-md mb-4">
                            <x-icons.user input/>
                        </x-input>

                        <x-input type="email" label="Email" placeholder="Your email" name="email"  value="{{ auth()->user()->email }}" class="form-control w-full md:max-w-md mb-4">
                            <x-icons.envelope input/>
                        </x-input>
                        <x-input type="tel" label="Phone number" placeholder="Your phone number" name="phone_number"  value="{{ auth()->user()->phone_number }}" class="form-control w-full md:max-w-md">
                            <x-icons.phone input/>
                        </x-input>

                        <div class="mt-8 w-full flex-wrap">
                            <x-button id="updateButton">Update</x-button>
                        </div>
                    </div>
            </div>
        </div>
    </form>

    <script>
        function setPreview(e) {
            if (event.target.files.length > 0) {
                const objUrl = URL.createObjectURL(event.target.files[0]);
                document.getElementById('profilePicture').src = objUrl;
            }
        }
    </script>

</x-profile>
