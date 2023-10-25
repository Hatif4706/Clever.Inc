<x-dashboard title="Edit Tender">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="">Edit</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Edit Tender</h1>

    <form method="POST" action="/tenders/{{ $tender->id }}" class="max-w-5xl" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-input class="mb-6 w-full" name="project_id" label="Project Name" placeholder="" type="text" id="project_id" value="{{ $tender->project->name }}" readonly >
            <x-icons.briefcase input/>
        </x-input>

        <div class="mb-4">
            <label class="label-text" for="description">Description</label>
            <label for="name" class="flex items-center relative mt-2">
                <textarea
                    class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary"
                    id="description" name="description">{{ $tender->description }}</textarea>
            </label>
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5 mb-6">
            <x-input class="mb-6 w-full" name="date_start" label="Date Start" placeholder="" type="date" id="date_start" value="{{ $tender->date_start }}" >
                <x-icons.calendar-days input/>
            </x-input>

            <x-input class="mb-6 w-full" name="date_end" label="Date End" placeholder="" type="date" id="date_end" value="{{ $tender->date_end }}">
                <x-icons.calendar-days input/>
            </x-input>

            {{-- upload document --}}
            <x-input-file class="mb-6 w-full" name="tor_doc" id="tor_doc" label="Term of Reference Document" type="file" for="tor_doc" info="Dokumen Kerangka Acuan" accept=".pdf,.docx" />
            <x-input-file class="mb-6 w-full" name="support_doc" id="support_doc" type="file" for="support_doc" info="Dokumen Pendukung" label="Supporting Documents" accept=".pdf,.docx" />
        </div>
        <x-button>Edit tender</x-button>
    </form>
</x-dashboard>
