<x-dashboard title="Create Evaluations">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="{{ route('tenders.show', $tender->id) }}">{{ $tender->project->name }}</a></li>
        <li><a href="{{ route('tenders.evaluations.index', $tender->id) }}">Evaluations</a></li>
        <li><a href="">Create</a></li>
    </x-slot:breadcrumbs>

    @error ('tender_vendor_ids')
        <div class="toast toast-start">
            <div class="alert alert-error flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>Select tender vendor first</span>
            </div>
        </div>
    @enderror

    @error ('technical_evaluation_doc')
        <div class="toast toast-start">
            <div class="alert alert-error flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ $message }}</span>
            </div>
        </div>
    @enderror

    <div class="flex justify-between mb-6">
        <h1 class="w-full align-middle text-2xl font-bold text-textgray dark:text-white">Create Evaluation</h1>
        <x-button id="createBtn" class="flex items-center px-4">
            <x-icons.plus /> Create evaluation
        </x-button>
    </div>

    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200">
                    <th><label><input id="check-all" type="checkbox" class="checkbox checkbox-primary" name="tender_vendor_id[]" /></label></th>
                    <th>Vendor name</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenderVendors as $key => $tenderVendor)
                    <tr>
                        <th><label><input type="checkbox" class="checkbox checkbox-primary" /></label></th>
                        <td class="group cursor-pointer">
                            <a class="group-hover:underline" href="/tenders/{{ $tender->id }}/vendors/{{ $tenderVendor->id }}">{{ $tenderVendor->vendor->name }}</a>
                        </td>
                        <td class="whitespace-nowrap">{{ $tenderVendor->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <dialog id="createModal" class="modal">
        <form method="POST" class="modal-box !max-w-full xl:!w-1/2" id="createForm" enctype="multipart/form-data">
            @csrf
            <h3 class="font-bold text-lg mb-4">Create Evaluation</h3>
            @foreach ($tenderVendors as $key => $tenderVendor)
                <input type="checkbox" class="invisible w-0 h-0 absolute" name="tender_vendor_ids[]" value="{{ $tenderVendor->id }}" /></label>
            @endforeach
            <x-input-file name="technical_evaluation_doc" label="Technical evaluation document" info="Dokumen evaluasi teknis" class="max-w-lg" accept=".pdf,.docx" required  />
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="createModal.close()">Cancel</button>
                <x-button class="rounded-lg px-4">Create</x-button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        const checkAll = document.getElementById('check-all');
        const checkboxes = [...document.querySelectorAll('tbody .checkbox')];
        const createBtn = document.getElementById('createBtn');
        const realCheckboxes = document.querySelectorAll('dialog input[type="checkbox"]');

        createBtn.addEventListener('click', () => {
            checkboxes.forEach((checkbox, i) => {
                realCheckboxes[i].checked = checkbox.checked;
            });
            createModal.showModal();
        });

        checkAll.addEventListener('change', e => {
            for (const checkbox of checkboxes) {
                checkbox.checked = e.target.checked;
            }
        });

        for (const checkbox of checkboxes) {
            checkbox.addEventListener('change', e => {
                if (!e.target.checked) {
                    checkAll.checked = false;
                    return;
                }
                for (const c of checkboxes) {
                    if (!c.checked) return;
                }

                checkAll.checked = true;
            });
        }
    </script>

</x-dashboard>
