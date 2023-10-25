<x-dashboard title="Vendor">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="{{ route('tenders.show', $tender->id) }}">{{ $tender->project->name }}</a></li>
        <li><a href="">Join</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Join Tender</h1>
    <form method="POST" action="/tenders/{{ $tender->id }}/join" class="max-w-5xl" enctype="multipart/form-data">
        @csrf
        <x-input label="Project name" name="" placeholder="Project name" value="{{ $tender->project->name }}" readonly>
            <x-icons.briefcase input/>
        </x-input>

        <div class="lg:flex gap-5 my-6">
            <x-input-file class="mb-6" name="proposal_doc" label="Proposal document" info="Dokumen proposal" accept=".pdf,.docx" />
            <x-input-file class="mb-6" name="boq_doc" info="Daftar kuantitas" label="Bill of quantities" accept=".pdf,.docx" />
        </div>

        <x-button>Join Tender</x-button>
    </form>

</x-dashboard>
