<x-dashboard title="Tender Vendor">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="{{ route('tenders.show', $tender->id) }}">{{ $tender->project->name }}</a></li>
        <li><a href="/tenders/{{ $tender->id }}/vendors">Vendors</a></li>
        <li><a href="">{{ $tenderVendor->vendor->name }}</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Tender Vendor</h1>

    <div class="lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">
        <x-input label="Vendor name" name="" placeholder="" value="{{ $tenderVendor->vendor->name }}" class="mb-4" readonly>
            <x-icons.user input/>
        </x-input>

        <x-input label="Tender project name" name="" value="{{ $tenderVendor->tender->project->name }}" placeholder="" class="mb-4" readonly>
            <x-icons.document-text input/>
        </x-input>
    </div>

    <div class="flex items-end gap-8 w-full overflow-auto py-3 pt-8">
        <x-document src="{{ $tenderVendor->proposal_doc }}" name="Proposal document" translate="Dokumen proposal" />
        <x-document src="{{ $tenderVendor->boq_doc }}" name="Bill of quantities" translate="Daftar kuantitas" />
    </div>

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
