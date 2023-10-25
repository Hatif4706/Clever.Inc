<x-dashboard title="Create Payment">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
        <li><a href="">Create Payment</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6">Create Payment</h1>
    <form method="POST" action="{{ route('projects.payment.store', $project->id) }}" class="max-w-5xl" enctype="multipart/form-data">
        @csrf

        <div class="lg:grid lg:grid-cols-2 lg:gap-5 mb-4">
            <x-input label="Project name" name="" placeholder="Project name" value="{{ $project->name }}" class="mb-4" readonly>
                <x-icons.briefcase input/>
            </x-input>

            <x-input type="date" label="Payment date" name="payment_date" placeholder="Payment date" value="{{ old('payment_date') }}" class="mb-4">
                <x-icons.clock input/>
            </x-input>

            <x-input-file name="bast_doc" label="BAST" info="Berita acara serah terima" class="mb-4" accept=".pdf,.docx" />
        </div>

        <x-button>Create payment</x-button>
    </form>

</x-dashboard>
