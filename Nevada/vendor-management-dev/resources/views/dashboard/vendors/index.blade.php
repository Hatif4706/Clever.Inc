<x-dashboard title="Vendors">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/vendors">Vendors</a></li>
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
        <form method="POST" action="/vendor/id" class="modal-box" id="deleteForm">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-lg">Delete Vendor</h3>
            <p class="py-4">Are you sure to delete <span class="font-bold" id="deleteModalName"> </span>?</p>
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
                    <input type="radio" name="sort" value="company_email" class="radio radio-primary" id="email" @checked(request()->sort == 'company_email') />
                    <label for="email" class="label-text cursor-pointer">Company email</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="website" class="radio radio-primary" id="website" @checked(request()->sort == 'website') />
                    <label for="website" class="label-text cursor-pointer">Website</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="bank_reference" class="radio radio-primary" id="bank_reference" @checked(request()->sort == 'bank_reference') />
                    <label for="bank_reference" class="label-text cursor-pointer">Bank reference</label>
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

            <div class="mt-7 mb-5">Status:</div>
            <div class="flex flex-wrap gap-4">
                <div class="flex items-center gap-2">
                    <input name="status" id="new" value="New" type="radio" class="radio radio-primary" @checked(request()->status == 'New') />
                    <label for="new" class="label-text cursor-pointer">New</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="verified" value="Verified" type="radio" class="radio radio-primary" @checked(request()->status == 'Verified') />
                    <label for="verified" class="label-text cursor-pointer">Verified</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="not-verified" value="Not Verified" type="radio" class="radio radio-primary" @checked(request()->status == 'Not Verified') />
                    <label for="not-verified" class="label-text cursor-pointer">Not Verified</label>
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
        <h1 class="text-2xl font-bold text-textgray dark:text-white mb-3">Manage Vendors</h1>
        <form id="searchForm" class="flex items-center gap-3 lg:flex-row-reverse">
            <div class="join w-full">
                <input class="input w-full bg-base-200 join-item focus:outline-none" type="text" id="searchInput" name="search" placeholder="Search" autocomplete="off" value="{{ request()->search }}" />
                <button class="btn flex items-center join-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </div>
            <div onclick="optionsModal.showModal()" class="tooltip" data-tip="Options">
                <x-icons.adjustments-horizontal class="h-6 w-6 hover:bg-base-300 dark:hover:bg-base-100 p-2 box-content rounded-md cursor-pointer" />
            </div>
            @if (request()->sort) <input type="hidden" name="sort" value="{{ request()->sort }}" /> @endif
            @if (request()->order) <input type="hidden" name="order" value="{{ request()->order }}" /> @endif
            @if (request()->perpage) <input type="hidden" name="perpage" value="{{ request()->perpage }}" /> @endif
            @if (request()->status) <input type="hidden" name="status" value="{{ request()->status }}" /> @endif
        </form>
    </div>

    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200">
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Website</th>
                    <th>Bank reference</th>
                    <th>Company email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $key => $vendor)
                    <tr class="hover:bg-base-200/50 dark:hover:bg-base-100/50 transition-colors">
                        <th>{{ $vendors->firstItem() + $key }}</th>
                        <td>
                            <a href="/vendors/{{ $vendor->id }}" class="block w-full h-full hover:underline">
                                {{ $vendor->name }}
                            </a>
                        </td>
                        <td>{{ $vendor->address }}</td>
                        <td>
                            {{ str_contains($vendor->website, '//') ? explode('//', $vendor->website)[1] : $vendor->website }}
                        </td>
                        <td>{{ $vendor->bank_reference }}</td>
                        <td>{{ $vendor->company_email }}</td>
                        <td>
                            <div class="badge text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                                @if ($vendor->status === 'Verified') bg-green-600
                                @elseif ($vendor->status === 'Not Verified') bg-red-600
                                @else bg-blue-600
                                @endif"
                                data-id="{{ $vendor->id }}"
                                data-name="{{ $vendor->name }}"
                            >
                                {{ $vendor->status }}
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-3 h-max">
                                <a href="vendors/{{ $vendor->id }}/edit" class="tooltip" data-tip="Edit">
                                    <x-icons.pencil-square class="w-6 h-6 text-purple dark:text-purplelight hover:bg-base-300 p-2 rounded-lg box-content transition-colors" />
                                </a>
                                <div class="tooltip cursor-pointer" data-tip="Delete" data-name="{{ $vendor->name }}" data-id="{{ $vendor->id }}">
                                    <x-icons.trash class="w-6 h-6 text-red-500 deleteBtn hover:bg-base-300 p-2 rounded-lg box-content transition-colors" />
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-pagination :data="$vendors" />

    <script>
        const deleteBtns = [...document.getElementsByClassName('deleteBtn')];
        const deleteModalName = document.getElementById('deleteModalName');
        const deleteForm = document.getElementById('deleteForm');

        for (const deleteBtn of deleteBtns) {
            deleteBtn.addEventListener('click', function() {
                deleteModalName.textContent = this.parentElement.dataset.name;
                deleteForm.setAttribute('action', `/vendors/${this.parentElement.dataset.id}`);
                deleteModal.showModal();
            });
        }
    </script>

</x-dashboard>
