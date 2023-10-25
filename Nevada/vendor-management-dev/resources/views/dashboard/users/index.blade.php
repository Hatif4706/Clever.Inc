<x-dashboard title="Users">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/users">Users</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <dialog id="deleteModal" class="modal">
        <form method="POST" action="/users/id" class="modal-box" id="deleteForm">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-lg">Delete User</h3>
            <p class="py-4">Are you sure to delete <span class="font-bold" id="modalName"> </span>?</p>
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="deleteModal.close()">Cancel</button>
                <button class="btn btn-error text-white capitalize">Delete</button>
            </div>
            </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <dialog id="optionsModal" class="modal">
        <form class="modal-box" id="optionsForm">
            <h3 class="font-bold text-lg mb-5">Options</h3>
            <div class="mb-5">Sort by:</div>
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="created_at" class="radio radio-primary" id="created_at" @checked(request()->sort == 'created_at') />
                    <label for="created_at" class="label-text cursor-pointer">Created</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="updated_at" class="radio radio-primary" id="updated_at" @checked(request()->sort == 'updated_at') />
                    <label for="updated_at" class="label-text cursor-pointer">Updated</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="name" class="radio radio-primary" id="name" @checked(request()->sort == 'name') />
                    <label for="name" class="label-text cursor-pointer">Name</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="email" class="radio radio-primary" id="email" @checked(request()->sort == 'email') />
                    <label for="email" class="label-text cursor-pointer">Email</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="phone_number" class="radio radio-primary" id="phone_number" @checked(request()->sort == 'phone_number') />
                    <label for="phone_number" class="label-text cursor-pointer">Phone number</label>
                </div>
            </div>
            <div class="mt-7 mb-5">Order:</div>
            <div>
                <div class="flex items-center gap-2">
                    <input type="radio" name="order" value="asc" class="radio radio-primary" id="ascending" @checked(request()->order == 'asc') />
                    <label for="ascending" class="label-text cursor-pointer flex items-center"><x-icons.arrow-long-up /> Asc</label>
                    <input type="radio" name="order" value="desc" class="radio radio-primary" id="descending" @checked(request()->order == 'desc') />
                    <label for="descending" class="label-text cursor-pointer flex items-center"><x-icons.arrow-long-down /> Desc</label>
                </div>
            </div>

            <div class="mt-7 mb-5">Role:</div>
            <div class="flex flex-wrap gap-4">
                <div class="flex items-center gap-2">
                    <input name="role" id="vendor" value="Vendor" type="radio" class="radio radio-primary" @checked(request()->role == 'Vendor') />
                    <label for="vendor" class="label-text cursor-pointer">Vendor</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="role" id="cam" value="CAM" type="radio" class="radio radio-primary" @checked(request()->role == 'CAM') />
                    <label for="cam" class="label-text cursor-pointer">CAM</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="role" id="account-manager" value="Account Manager" type="radio" class="radio radio-primary" @checked(request()->role == 'Account Manager') />
                    <label for="account-manager" class="label-text cursor-pointer">Account Manager</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="role" id="chief-logistik" value="Chief Logistik" type="radio" class="radio radio-primary" @checked(request()->role == 'Chief Logistik') />
                    <label for="chief-logistik" class="label-text cursor-pointer">Chief Logistik</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="role" id="logistik" value="Logistik" type="radio" class="radio radio-primary" @checked(request()->role == 'Logistik') />
                    <label for="logistik" class="label-text cursor-pointer">Logistik</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="role" id="finance" value="Finance" type="radio" class="radio radio-primary" @checked(request()->role == 'Finance') />
                    <label for="finance" class="label-text cursor-pointer">Finance</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="role" id="hlm" value="HLM" type="radio" class="radio radio-primary" @checked(request()->role == 'HLM') />
                    <label for="hlm" class="label-text cursor-pointer">HLM</label>
                </div>
            </div>


            <div class="mt-7 mb-5">Item per page:</div>
            <input type="number" name="perpage" class="input input-bordered text-center w-20" value="{{ request()->perpage ?? 10 }}" min="1" />
            @if (request()->search) <input type="hidden" name="search" value="{{ request()->search }}" /> @endif
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="optionsModal.close()">Cancel</button>
                <button class="btn btn-primary text-white capitalize">Apply</button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <div class="lg:flex justify-between items-center mb-8">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Manage Users</h1>
            <div class="sm:hidden flex items-center justify-end">
                <x-button-link href="/users/create" class="!btn-md !text-sm">
                    <x-icons.plus /> Create user
                </x-button-link>
            </div>
        </div>
        <div class="sm:flex items-center gap-3">
            <form id="searchForm" class="flex items-center gap-3 lg:flex-row-reverse">
                <div class="join w-full">
                    <input class="input w-full bg-base-200 join-item focus:outline-none" type="text" id="searchInput" name="search" placeholder="Search" autocomplete="off" value="{{ request()->search }}" />
                    @if (request()->sort) <input type="hidden" name="sort" value="{{ request()->sort }}" /> @endif
                    @if (request()->order) <input type="hidden" name="order" value="{{ request()->order }}" /> @endif
                    @if (request()->perpage) <input type="hidden" name="perpage" value="{{ request()->perpage }}" /> @endif
                    @if (request()->role) <input type="hidden" name="role" value="{{ request()->role }}" /> @endif
                    <button class="btn flex items-center join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
                <div onclick="optionsModal.showModal()" class="tooltip" data-tip="Options">
                    <x-icons.adjustments-horizontal class="h-6 w-6 hover:bg-base-300 dark:hover:bg-base-100 p-2 box-content rounded-md cursor-pointer" />
                </div>
            </form>
            <div class="hidden sm:flex items-center justify-end">
                <x-button-link href="/users/create" class="!btn-md !text-sm">
                    <x-icons.plus /> Create user
                </x-button-link>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200">
                    <th>No</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr class="hover:bg-base-200/50 dark:hover:bg-base-100/50 transition-colors">
                        <th>{{ $users->firstItem() + $key }}</th>
                        <td class="whitespace-nowrap pr-16 group">
                            <a href="/users/{{ $user->id }}">
                                <div class="flex items-center space-x-3">
                                    <div class="shrink-0"><img src="{{ asset($user->profile_picture) }}" class="w-12 h-12 rounded-full block object-cover" /></div>
                                    <div class="group-hover:underline">{{ $user->name }}</div>
                                </div>
                            </a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <div class="badge text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center" style="background-color: {{ $user->roles[0]->color }};">{{ $user->roles[0]->name }}</div>
                        </td>
                        <td>
                            <div class="flex items-center gap-3 h-max">
                                <a href="users/{{ $user->id }}/edit" class="tooltip" data-tip="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-purple dark:text-purplelight hover:bg-base-300 p-2 rounded-lg box-content transition-colors">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <div class="tooltip cursor-pointer" data-tip="Delete">
                                    <svg data-name="{{ $user->name }}" data-id="{{ $user->id }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 deleteBtn hover:bg-base-300 p-2 rounded-lg box-content transition-colors">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-pagination :data="$users" />

    <script>
        const deleteBtns = [...document.getElementsByClassName('deleteBtn')];
        const modalName = document.getElementById('modalName');
        const deleteForm = document.getElementById('deleteForm');

        for (const deleteBtn of deleteBtns) {
            deleteBtn.addEventListener('click', function() {
                modalName.textContent = this.dataset.name;
                deleteForm.setAttribute('action', `/users/${this.dataset.id}`);
                deleteModal.showModal();
            });
        }
    </script>

</x-dashboard>
