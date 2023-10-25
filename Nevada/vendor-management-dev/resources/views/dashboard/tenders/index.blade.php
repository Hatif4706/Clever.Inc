<x-dashboard title="Tender">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
    </x-slot:breadcrumbs>

    @if (session('failed'))
    <div class="toast toast-start z-10">
        <div class="alert alert-error flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('failed') }}</span>
        </div>
    </div>
    @endif

    @if (session('success'))
    <div class="toast toast-start z-10">
        <div class="alert alert-success flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <dialog id="deleteModal" class="modal">
        <form method="POST" action="/tenders/id" class="modal-box" id="deleteForm">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-lg">Delete Tender</h3>
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
                    <input type="radio" name="sort" value="project_name" class="radio radio-primary" id="project_name" @checked(request()->sort == 'project_name') />
                    <label for="project_name" class="label-text cursor-pointer">Project name</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="date_start" class="radio radio-primary" id="date_start" @checked(request()->sort == 'date_start') />
                    <label for="date_start" class="label-text cursor-pointer">Date start</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="date_end" class="radio radio-primary" id="date_end" @checked(request()->sort == 'date_end') />
                    <label for="date_end" class="label-text cursor-pointer">Date end</label>
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

            @role ('Account Manager|CAM')
                <div class="mt-7 mb-5">Status:</div>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2">
                        <input name="status" id="open" value="Open" type="radio" class="radio radio-primary" @checked(request()->status == 'Open') />
                        <label for="open" class="label-text cursor-pointer">Open</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input name="status" id="closed" value="Closed" type="radio" class="radio radio-primary" @checked(request()->status == 'Closed') />
                        <label for="closed" class="label-text cursor-pointer">Closed</label>
                    </div>
                </div>
            @endrole

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
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Manage Tenders</h1>
            @role ('Account Manager|CAM')
                <div class="sm:hidden flex items-center justify-end">
                    <x-button-link href="/tenders/create" class="!btn-md !text-sm">
                        <x-icons.plus /> Create tender
                    </x-button-link>
                </div>
            @endrole
        </div>
        <div class="sm:flex items-center gap-3">
            <form class="flex items-center gap-3 lg:flex-row-reverse">
                <div class="join w-full">
                    <input class="input w-full bg-base-200 join-item focus:outline-none" type="text"
                        name="search" placeholder="Search" autocomplete="off" value="{{ request()->search }}" />
                    <button class="btn flex items-center join-item">
                       <x-icons.magnifying-glass/>
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
            @role ('Account Manager|CAM')
                <div class="hidden sm:flex items-center justify-end">
                    <x-button-link href="/tenders/create" class="!btn-md !text-sm">
                        <x-icons.plus /> Create tender
                    </x-button-link>
                </div>
            @endrole
        </div>
    </div>

    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200">
                    <th>No</th>
                    <th>Project name</th>
                    <th>Date start</th>
                    <th>Date end</th>
                    @role('Account Manager|CAM')
                        <th>Action</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach ($tenders as $key => $tender)
                    <tr class="hover:bg-base-200/50 dark:hover:bg-base-100/50 transition-colors">
                        <th>{{ $tenders->firstItem() + $key }}</th>
                        <td class="group cursor-pointer">
                            <a class="block h-full w-full group-hover:underline" href="/tenders/{{ $tender->id }}">{{ $tender->project->name }}</a>

                        </td>
                        <td class="whitespace-nowrap">{{ $tender->date_start }}</td>
                        <td class="whitespace-nowrap">{{ $tender->date_end }}</td>
                        @role ('Account Manager|CAM')
                            <td class="whitespace-nowrap">
                                <a href="tenders/{{ $tender->id }}/edit" class="tooltip" data-tip="Edit">
                                    <x-icons.pencil-square class="w-6 h-6 text-purple dark:text-purplelight hover:bg-base-300 p-2 rounded-lg box-content transition-colors"/>
                                </a>
                                <div data-name="{{ $tender->project->name }}" data-id="{{ $tender->id }}" class="tooltip cursor-pointer" data-tip="Delete">
                                    <x-icons.trash class="w-6 h-6 text-red-500 deleteBtn hover:bg-base-300 p-2 rounded-lg box-content transition-colors"/>
                                </div>
                            </td>
                        @endrole
                @endforeach
            </tbody>
        </table>
    </div>

    <x-pagination :data="$tenders" />

    <script>
        const deleteBtns = [...document.getElementsByClassName('deleteBtn')];
        const deleteModalName = document.getElementById('deleteModalName');
        const deleteForm = document.getElementById('deleteForm');

        for (const deleteBtn of deleteBtns) {
            deleteBtn.addEventListener('click', function () {
                deleteModalName.textContent = this.parentElement.dataset.name;
                deleteForm.setAttribute('action', `/tenders/${this.parentElement.dataset.id}`);
                deleteModal.showModal();
            });
        }
    </script>

</x-dashboard>
