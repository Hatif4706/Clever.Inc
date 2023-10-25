<x-dashboard title="Tender History">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/histories">History</a></li>
        <li><a href="">{{ $tenderVendor->tender->project->name }}</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Tender History</h1>

    <div class="lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">
        <x-input label="Tender project name" name="" value="{{ $tenderVendor->tender->project->name }}" placeholder="" class="mb-4" readonly>
            <x-icons.user input/>
        </x-input>

        <x-input label="Created at" name="" placeholder="" value="{{ $tenderVendor->created_at }}" class="mb-4" readonly>
            <x-icons.clock input/>
        </x-input>

        @if ($tenderVendor->evaluation)
            @if ($tenderVendor->evaluation->status)
                <div class="mb-4">
                    <div class="label-text mb-2">Status</div>
                    <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                        @if ($tenderVendor->evaluation->status === 'Need PO & SPK') bg-yellow-600
                        @elseif ($tenderVendor->evaluation->status === 'Need Approval PO & SPK') bg-yellow-700
                        @elseif ($tenderVendor->evaluation->status === 'Need Closing') bg-stone-500
                        @else hidden
                        @endif"
                    >
                        {{ $tenderVendor->evaluation->status }}
                    </div>
                </div>
            @endif

            @if ($tenderVendor->evaluation->approval)
                <div class="mb-4">
                    <div class="label-text mb-2">Approval</div>
                    <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                        @if ($tenderVendor->evaluation->approval === 'Approved') bg-green-600
                        @elseif ($tenderVendor->evaluation->approval === 'Rejected') bg-red-500
                        @else hidden
                        @endif"
                    >
                        {{ $tenderVendor->evaluation->approval }}
                    </div>
                </div>
            @endif

        @endif
    </div>

    @if ($tenderVendor->evaluation)
        @if ($tenderVendor->evaluation->reason)
            <div class="max-w-5xl mb-4">
                <label class="label-text" for="description">Reason</label>
                <label for="name" class="flex items-center relative mt-2">
                    <textarea class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary" id="description" name="description" readonly>{{ $tenderVendor->evaluation->reason }}</textarea>
                </label>
            </div>
        @endif
    @endif

    <div class="flex items-end gap-8 w-full overflow-auto py-3 pt-8">
        <x-document src="{{ $tenderVendor->proposal_doc }}" name="Proposal document" translate="Dokumen proposal" />
        <x-document src="{{ $tenderVendor->boq_doc }}" name="Bill of quantities" translate="Daftar kuantitas" />
        @if ($tenderVendor->evaluation)
            <x-document src="{{ $tenderVendor->evaluation->technical_evaluation_doc }}" name="Technical evaluation document" translate="Dokumen evaluasi teknis" />
        @endif
    </div>

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
