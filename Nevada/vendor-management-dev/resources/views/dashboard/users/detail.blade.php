<x-dashboard title="User">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/users">Users</a></li>
        <li><a href="">{{ $user->name }}</a></li>
    </x-slot:breadcrumbs>

    <div class="flex items-center flex-wrap justify-between gap-4 max-w-5xl mb-6">
        <h1 class="text-2xl font-bold text-textgray dark:text-white">{{ $user->name }}</h1>

        @if ($user->roles[0]->name === 'Vendor')
            <div class="tooltip flex items-center" data-tip="Menu">
                <div class="dropdown dropdown-bottom dropdown-end">
                    <label tabindex="0">
                        <x-icons.ellipsis-vertical class="h-6 w-6 lg:h-8 lg:w-8 hover:bg-base-200 rounded-md p-1.5 box-content cursor-pointer" />
                    </label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('vendors.show', $user->vendor->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                            <x-icons.building-storefront /> Vendor
                        </a></li>
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <div class="max-w-5xl">
        <div class="block lg:flex gap-12 mb-8">
            <img src="{{ asset($user->profile_picture) }}" class="w-28 h-28 rounded-full object-cover shadow" id="profilePicture" />

            <div class="max-w-sm lg:w-md mt-3">
                <div class="label-text cursor-default mb-2">Role</div>
                <label class="badge dark:text-white select-none px-5 py-3 mb-2 mr-2 role text-center transition-none text-white" style="background-color: {{ $user->roles[0]->color }};" >
                    {{ $user->roles[0]->name }}
                </label>
            </div>
        </div>
        <div class="lg:grid lg:grid-cols-2 lg:gap-5">

        <x-input label="Full name" placeholder="Your name" name="name"  value="{{ $user->name }}" class="mb-4" readonly>
            <x-icons.user input/>
        </x-input>

        <x-input label="Email" name="email" placeholder="Your email" value="{{ $user->email }}" class="mb-4" readonly>
            <x-icons.envelope input/>
        </x-input>

        <x-input label="Phone number" name="phone_number" placeholder="Your phone number" value="{{ $user->phone_number  }}" class="mb-4" readonly>
            <x-icons.phone input/>
        </x-input>

        </div>

    </div>


</x-dashboard>
