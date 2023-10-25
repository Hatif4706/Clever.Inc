<x-dashboard title="Create Payment">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
        <li><a href="">Payment</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6">Payment</h1>

    <div class="lg:grid lg:grid-cols-2 lg:gap-5 mb-6 max-w-5xl">
        <x-input label="Project name" name="" placeholder="Project name" value="{{ $project->name }}" class="mb-4" readonly>
            <x-icons.briefcase input/>
        </x-input>

        <x-input type="date" label="Payment date" name="payment_date" placeholder="Payment date" value="{{ $project->payment->payment_date }}" class="mb-4" readonly>
            <x-icons.clock input/>
        </x-input>
    </div>

    <x-document src="{{ $project->bast_doc }}" name="Bast Document" translate="Dokumen Berita Acara Serah Terima" />

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
