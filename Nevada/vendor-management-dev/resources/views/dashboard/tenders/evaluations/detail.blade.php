<x-dashboard title="Tender Evaluation">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="{{ route('tenders.show', $tender->id) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('tenders.evaluations.index', $tender->id) }}">Evaluations</a></li>
        <li><a href="">{{ $evaluation->tenderVendor->vendor->name }}</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex items-center flex-wrap justify-between gap-4 max-w-5xl mb-6">
        <h1 class="text-2xl font-bold text-textgray dark:text-white">{{ $vendor->name }}</h1>

        @if ($evaluation->tender->status === 'Open' && $evaluation->approval === null)
            @role('CAM')
                <div class="flex items-center gap-4">
                    <x-button-link onclick="rejectModal.showModal()" class="px-5 !bg-red-500 hover:!bg-red-600">
                        <x-icons.x-circle /> Reject
                    </x-button-link>
                    <x-button-link onclick="approveModal.showModal()" class="px-5 !bg-green-600 hover:!bg-green-700">
                        <x-icons.check-circle /> Approve
                    </x-button-link>
                </div>
            @endrole
        @endif
    </div>

    <div class="max-w-5xl">
        <div class="lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">
            <x-input name="" label="Vendor name" value="{{ $vendor->name }}" class="mb-4" readonly>
                <x-icons.user input />
            </x-input>
            <x-input name="" label="Tender project name" value="{{ $project->name }}" class="mb-4" readonly>
                <x-icons.document-text input />
            </x-input>

            @if ($evaluation->status)
                <div class="mb-4">
                    <div class="label-text mb-2">Status</div>
                    <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                        @if ($evaluation->status === 'Need PO & SPK') bg-yellow-600
                        @elseif ($evaluation->status === 'Need Approval PO & SPK') bg-yellow-700
                        @elseif ($evaluation->status === 'Need Closing') bg-stone-500
                        @else hidden
                        @endif"
                    >
                        {{ $evaluation->status }}
                    </div>
                </div>
            @endif

            @if ($evaluation->approval)
                <div class="mb-4">
                    <div class="label-text mb-2">Approval</div>
                    <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                        @if ($evaluation->approval === 'Approved') bg-green-600
                        @elseif ($evaluation->approval === 'Rejected') bg-red-500
                        @else hidden
                        @endif"
                    >
                        {{ $evaluation->approval }}
                    </div>
                </div>
            @endif
        </div>

        @if ($evaluation->reason !== null)
            <div class="max-w-5xl mb-4">
                <label class="label-text" for="description">Reason</label>
                <label for="name" class="flex items-center relative mt-2">
                    <textarea class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary" id="description" name="description" readonly>{{ $evaluation->reason }}</textarea>
                </label>
            </div>
        @endif

        <div class="mt-8">
            <x-document src="{{ $evaluation->technical_evaluation_doc }}" name="Technical evaluation document" translate="Dokumen evaluasi teknis" />
        </div>

    </div>

    <dialog id="approveModal" class="modal">
        <form method="POST" action="{{ route('tenders.evaluations.approve', [$tender->id, $evaluation->id]) }}" class="modal-box !max-w-full xl:!w-1/2" id="approveForm">
            @csrf
            @method('PATCH')
            <h3 class="font-bold text-lg mb-4">Approve Evaluation</h3>
            <label class="label-text" for="approval_reason">Are you sure to approve <strong>{{ $evaluation->tenderVendor->vendor->name }} evaluation</strong>?</label>
            <textarea class="textarea textarea-bordered mt-2 h-56 w-full resize-none" id="approval_reason" name="reason" placeholder="Enter reason of approval..." required></textarea>
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="approveModal.close()">Cancel</button>
                <button name="approval" value="Approved" class="btn btn-success capitalize">Approve</button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <dialog id="rejectModal" class="modal">
        <form method="POST" action="{{ route('tenders.evaluations.approve', [$tender->id, $evaluation->id]) }}" class="modal-box !max-w-full xl:!w-1/2" id="rejectForm">
            @csrf
            @method('PATCH')
            <h3 class="font-bold text-lg mb-4">Reject Evaluation</h3>
            <label class="label-text" for="rejection_reason">Are you sure to reject <strong>{{ $evaluation->tenderVendor->vendor->name }} evaluation</strong>?</label>
            <textarea class="textarea textarea-bordered mt-2 h-56 w-full resize-none" id="rejection_reason" name="reason" placeholder="Enter reason of rejection..." required></textarea>
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="rejectModal.close()">Cancel</button>
                <button name="approval" value="Rejected" class="btn btn-error capitalize">Reject</button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
