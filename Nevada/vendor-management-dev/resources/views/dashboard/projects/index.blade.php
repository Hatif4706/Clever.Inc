<x-dashboard title="Projects">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
    </x-slot:breadcrumbs>

    @if (session('failed'))
        <div class="toast toast-start z-10">
            <div class="alert alert-error flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('failed') }}</span>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <dialog id="deleteModal" class="modal">
        <form method="POST" action="/projects/id" class="modal-box" id="deleteForm">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-lg">Delete Project</h3>
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
                    <input type="radio" name="sort" value="contract_date" class="radio radio-primary" id="contract_date" @checked(request()->sort == 'contract_date') />
                    <label for="contract_date" class="label-text cursor-pointer">Contract date</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="contract_number" class="radio radio-primary" id="contract_number" @checked(request()->sort == 'contract_number') />
                    <label for="contract_number" class="label-text cursor-pointer">Contract number</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="contract_rate" class="radio radio-primary" id="contract_rate" @checked(request()->sort == 'contract_rate') />
                    <label for="contract_rate" class="label-text cursor-pointer">Contract rate</label>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <input type="radio" name="sort" value="vendor_deal" class="radio radio-primary" id="vendor_deal" @checked(request()->sort == 'vendor_deal') />
                    <label for="vendor_deal" class="label-text cursor-pointer">Vendor deal</label>
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
                    <input name="status" id="new-project" value="New Project" type="radio" class="radio radio-primary" @checked(request()->status == 'New Project') />
                    <label for="new-project" class="label-text cursor-pointer">New Project</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="tender-on-process" value="Tender on Process" type="radio" class="radio radio-primary" @checked(request()->status == 'Tender on Process') />
                    <label for="tender-on-process" class="label-text cursor-pointer">Tender on Process</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="need-evaluation" value="Need Evaluation" type="radio" class="radio radio-primary" @checked(request()->status == 'Need Evaluation') />
                    <label for="need-evaluation" class="label-text cursor-pointer">Need Evaluation</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="need-po-spk" value="Need PO & SPK" type="radio" class="radio radio-primary" @checked(request()->status == 'Need PO & SPK') />
                    <label for="need-po-spk" class="label-text cursor-pointer">Need PO & SPK</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="need-closing" value="Need Closing" type="radio" class="radio radio-primary" @checked(request()->status == 'Need Closing') />
                    <label for="need-closing" class="label-text cursor-pointer">Need Closing</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="payment-updated" value="Payment Updated" type="radio" class="radio radio-primary" @checked(request()->status == 'Payment Updated') />
                    <label for="payment-updated" class="label-text cursor-pointer">Payment Updated</label>
                </div>
                <div class="flex items-center gap-2">
                    <input name="status" id="completed" value="Completed" type="radio" class="radio radio-primary" @checked(request()->status == 'Completed') />
                    <label for="completed" class="label-text cursor-pointer">Completed</label>
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
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Manage Projects</h1>
            @role('Account Manager|CAM')
                <div class="sm:hidden flex items-center justify-end">
                    <x-button-link href="/projects/create" class="!btn-md !text-sm">
                        <x-icons.plus /> Create project
                    </x-button-link>
                </div>
            @endrole
        </div>
        <div class="sm:flex items-center gap-3">
            <form id="searchForm" class="flex items-center gap-3 lg:flex-row-reverse">
                <div class="join w-full">
                    <input class="input w-full bg-base-200 join-item focus:outline-none" type="text" id="searchInput" name="search" placeholder="Search" autocomplete="off" value="{{ request()->search }}" />
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
            @role('Account Manager|CAM')
                <div class="hidden sm:flex items-center justify-end">
                    <x-button-link href="/projects/create" class="!btn-md !text-sm">
                        <x-icons.plus /> Create project
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
                    <th>Name</th>
                    <th>Job</th>
                    <th>User company</th>
                    <th>PIC company</th>
                    <th>Contract date</th>
                    <th>Status</th>
                    @role('CAM|Account Manager')
                        <th>Action</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $key => $project)
                    <tr class="hover:bg-base-200/50 dark:hover:bg-base-100/50 transition-colors">
                        <th>{{ $projects->firstItem() + $key }}</th>
                        <td>
                            <a href="/projects/{{ $project->id }}" class="block w-full h-full hover:underline">
                                {{ $project->name }}
                            </a>
                        </td>
                        <td>{{ $project->job }}</td>
                        <td>
                            {{ str_contains($project->user_company, '//') ? explode('//', $project->user_company)[1] : $project->user_company }}
                        </td>
                        <td>{{ $project->pic_company }}</td>
                        <td>{{ $project->contract_date }}</td>
                        <td>
                            <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                                @if ($project->status === 'New Project') bg-blue-500
                                @elseif ($project->status === 'Tender on Process') bg-green-600
                                @elseif ($project->status === 'Need Evaluation') bg-red-600
                                @elseif ($project->status === 'Need PO & SPK') bg-yellow-600
                                @elseif ($project->status === 'Need Closing') bg-stone-500
                                @elseif ($project->status === 'Payment Updated') bg-pink-500
                                @elseif ($project->status === 'Completed') bg-slate-800
                                @endif"
                            >
                                {{ $project->status }}
                            </div>
                        </td>
                        @role('Account Manager|CAM')
                            <td class="whitespace-nowrap">
                                <div class="flex items-center gap-1 h-max">
                                    <a href="projects/{{ $project->id }}/edit" class="tooltip" data-tip="Edit">
                                        <x-icons.pencil-square class="w-6 h-6 text-purple dark:text-purplelight hover:bg-base-300 p-2 rounded-lg box-content transition-colors" />
                                    </a>
                                    <div class="tooltip cursor-pointer" data-tip="Delete" data-name="{{ $project->name }}" data-id="{{ $project->id }}">
                                        <x-icons.trash class="w-6 h-6 text-red-500 deleteBtn hover:bg-base-300 p-2 rounded-lg box-content transition-colors" />
                                    </div>
                                </div>
                            </td>
                        @endrole
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-pagination :data="$projects" />

    <script>
        const deleteBtns = [...document.getElementsByClassName('deleteBtn')];
        const deleteModalName = document.getElementById('deleteModalName');
        const deleteForm = document.getElementById('deleteForm');

        for (const deleteBtn of deleteBtns) {
            deleteBtn.addEventListener('click', function() {
                deleteModalName.textContent = this.parentElement.dataset.name;
                deleteForm.setAttribute('action', `/projects/${this.parentElement.dataset.id}`);
                deleteModal.showModal();
            });
        }
    </script>

</x-dashboard>
