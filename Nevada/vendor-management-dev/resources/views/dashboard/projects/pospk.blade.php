<x-dashboard title="PO & SPK">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
        <li><a href="">PO & SPK</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
                <x-icons.check-circle />
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="max-w-5xl mt-4">
        <div class="flex flex-wrap justify-between gap-4 max-w-5xl mb-4">
            <h1 class="text-2xl font-bold text-textgray dark:text-white">PO & SPK</h1>

            @role('Chief Logistik')
                @if (!$project->poSpk->approval)
                    <div>
                        <x-button-link onclick="rejectPoSpkModal.showModal()" class="px-5 !bg-red-500 hover:!bg-red-600">
                            <x-icons.x-circle /> Reject
                        </x-button-link>
                        <x-button-link onclick="approvePoSpkModal.showModal()" class="px-5 !bg-green-600 hover:!bg-green-700">
                            <x-icons.check-circle /> Approve
                        </x-button-link>
                    </div>
                @endif
            @endrole
        </div>

        <div class="lg:flex gap-5 mb-8 lg:mb-4">
            <x-input name="" class="w-full mb-4" label="Selected vendor" value="{{ $project->poSpk->vendor->name }}" readonly>
                <x-icons.briefcase input />
             </x-input>
            @if ($project->poSpk->approval)
                <div class="mb-4 w-full">
                    <div class="label-text mb-2">Approval</div>
                    <div class="badge text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                        @if ($project->poSpk->approval === 'Approved') bg-green-600
                        @elseif ($project->poSpk->approval === 'Rejected') bg-red-600
                        @endif">
                        {{ $project->poSpk->approval }}
                    </div>
                </div>
            @else
                <div class="mb-4 w-full">
                    <div class="label-text mb-2">Approval</div>
                    <div class="badge text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default bg-gray">
                        Waiting for approval
                    </div>
                </div>
            @endif
        </div>

        @if ($project->poSpk->approval_reason)
            <div class="my-4 max-w-5xl">
                <label class="label-text" for="rejection_reason">Reason</label>
                <textarea class="textarea textarea-bordered mt-2 h-48 w-full resize-none dark:bg-darkbgprimary" readonly>{{ $project->poSpk->approval_reason }}</textarea>
            </div>
        @endif

        <x-document src="{{ $project->poSpk->pospk_doc }}" name="PO & SPK document" translate="Pesan order & Surat perintah kerja" />
    </div>

    @role('Chief Logistik')
        <dialog id="approvePoSpkModal" class="modal">
            <form method="POST" action="{{ route('projects.po-spk.approve', $project->id) }}" class="modal-box !max-w-full xl:!w-1/2" id="approvePoSpkForm">
                @csrf
                @method('PATCH')

                <h3 class="font-bold text-lg">Approve PO & SPK</h3>
                <p class="my-4">Are you sure to approve PO & SPK ?</p>
                <div class="mb-4">
                    <label class="label-text" for="rejection_reason">Reason</label>
                    <textarea class="textarea textarea-bordered mt-2 h-56 w-full resize-none" id="approval_reason" name="approval_reason" placeholder="Enter reason of approval..."></textarea>
                </div>
                <div class="modal-action">
                    <button type="button" class="btn capitalize" onclick="approvePoSpkModal.close()">Cancel</button>
                    <button name="approval" value="Approved" class="btn btn-success capitalize">Approve</button>
                </div>
            </form>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>

        <dialog id="rejectPoSpkModal" class="modal">
            <form method="POST" action="{{ route('projects.po-spk.approve', $project->id) }}" class="modal-box !max-w-full xl:!w-1/2" id="rejectPoSpkForm">
                @csrf
                @method('PATCH')

                <h3 class="font-bold text-lg">Reject PO & SPK</h3>
                <p class="my-4">Are you sure to reject PO & SPK?</p>
                <div class="mb-4">
                    <label class="label-text" for="rejection_reason">Reason</label>
                    <textarea class="textarea textarea-bordered mt-2 h-56 w-full resize-none" id="rejection_reason" name="approval_reason" placeholder="Enter rejection reason..."></textarea>
                </div>
                <div class="modal-action">
                    <button type="button" class="btn capitalize" onclick="rejectPoSpkModal.close()">Cancel</button>
                    <button name="approval" value="Rejected" class="btn btn-error capitalize">Reject</button>
                </div>
            </form>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    @endrole

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
