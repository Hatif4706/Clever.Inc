<x-dashboard title="Create PO & SPK">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
        <li><a href="">Create PO & SPK</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6">Create PO & SPK</h1>
    <form method="POST" action="{{ route('projects.po-spk.create', $project->id) }}" class="max-w-5xl" enctype="multipart/form-data">
        @csrf

        <div class="lg:grid lg:grid-cols-2 lg:gap-5 mb-4">
            <input type="hidden" name="vendor_id" value="{{ $vendor->id }}" />

            <x-input label="Project name" name="" placeholder="Project name" value="{{ $project->name }}" class="mb-4" readonly>
                <x-icons.briefcase input/>
            </x-input>

            <x-input label="Selected vendor name" name="" placeholder="Project name" value="{{ $vendor->name }}" class="mb-4" readonly>
                <x-icons.briefcase input/>
            </x-input>

            <x-input-file class="mb-6" name="pospk_doc" info="Pesan order & Surat perintah kerja" label="PO & SPK document" accept=".pdf,.docx" />
        </div>

        <x-button>Create PO & SPK</x-button>
    </form>

</x-dashboard>
