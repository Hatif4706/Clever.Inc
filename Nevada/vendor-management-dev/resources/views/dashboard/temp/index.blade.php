<x-dashboard title="Templates"> 
    <x-slot:breadcrumbs> 
        <li><a href="/">Dashboard</a></li>
        <li><a href="/templates">Templates</a></li>
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
        <form method="POST" action="/templates/id" class="modal-box" id="deleteForm">
            @csrf
            @method('DELETE')
            <h3 class="font-bold text-lg">Delete Document</h3>
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

    <div class="lg:flex justify-between items-center mb-8 ">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Manage Templates</h1>
        </div>
        <div class="sm:flex items-center gap-3">
            <form id="searchForm" class="flex items-center gap-3 lg:flex-row-reverse">
                <div class="join w-full">
                    <input class="input w-full bg-base-200 join-item focus:outline-none" type="text" id="searchInput"
                    name="search" placeholder="Search" autocomplete="off" value="{{ request()->search }}" />
                    <!-- search -->
                    <button class="btn flex items-center join-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </div>
        </form>
        <div class="hidden sm:flex items-center justify-end">
            <x-button-link href="/templates/addtemplate" class="!btn-md !text-sm">
                <x-icons.plus /> Create Templates
            </x-button-link>
        </div>
    </div>
    </div>

    
    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200 cursor-default">
                    <th>No</th>
                    <th>Template Name</th>
                    <th>Description</th>
                    <th>Function</th>
                    @role('CAM|Account Manager')
                    <th>Action</th>
                    @endrole
                </tr>
            </thead>

            @foreach ($dataTemp as $dttmp)
            <tbody>
                <tr  class="hover:bg-base-200/50 dark:hover:bg-base-100/50 cursor-pointer transition-colors">
                    <th>{{ $loop->iteration }}</th>
                    <td class="group cursor-pointer " onclick="window.location.href = '{{ route('templates.detail', $dttmp) }}';">
                        <a class="block h-full w-full group-hover:underline" href="templates/detail" id="template_name"></a>
                        {{ $dttmp->template_name }}
                    </td>
                    <td class="whitespace-nowrap" onclick="window.location.href = '{{ route('templates.detail', $dttmp) }}';" id="template_description">{{ $dttmp->template_description }}</td>
                    <td class="whitespace-nowrap" onclick="window.location.href = '{{ route('templates.detail', $dttmp) }}';" id="func">{{ $dttmp->func }}</td>
                    @role ('Account Manager|CAM')

                    <td class="whitespace-nowrap ">
                        <a href="{{ route('templates.edit', $dttmp) }}" class="tooltip" data-tip="Edit">
                            <x-icons.pencil-square class="w-6 h-6 text-purple dark:text-purplelight hover:bg-base-300 p-2 rounded-lg box-content transition-colors"/>
                        </a>
                        <div data-name="{{ $dttmp->template_name }}" data-id="{{ $dttmp->id }}" class="tooltip cursor-pointer" data-tip="Delete">
                            <x-icons.trash
                            class="w-6 h-6 text-red-500 deleteBtn hover:bg-base-300 p-2 rounded-lg box-content transition-colors" />
                        </div>
                    </td>
                    @endrole
                </tr>
            </tbody>
            @endforeach
        
            
        </table>
    </div>

    <script>

        const deleteBtns = document.querySelectorAll('.deleteBtn');
        const deleteModalName = document.getElementById('deleteModalName');
        const deleteForm = document.getElementById('deleteForm');

        deleteBtns.forEach(deleteBtn => {
        deleteBtn.addEventListener('click', function () {
        const dataTemp = this.parentElement.dataset;
        deleteModalName.textContent = dataTemp.name;
        deleteForm.setAttribute('action', `/templates/${dataTemp.id}`);
        deleteModal.showModal();
    });
});

</script>  
</x-dashboard>