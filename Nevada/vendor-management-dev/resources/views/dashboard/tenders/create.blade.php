<x-dashboard title="Create Tender">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="">Create</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Create Tender</h1>

    <form method="POST" action="/tenders" class="max-w-5xl" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="label-text ml-1" for="project_id">Project Name</label>
            <label for="project_id" class="flex items-center relative mt-2">
                <x-icons.briefcase class="w-6 h-6 absolute left-4"/>

                <select
                    class="select select-bordered w-full pl-14 dark:bg-darkbgprimary @error('project_id') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror"
                    id="project_id" name="project_id">

                    <option selected disabled>Select Project</option>
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                </select>
            </label>
            @error('project_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="label-text" for="name">Description</label>
            <label for="name" class="flex items-center relative mt-2">
                <textarea
                    class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary @error('project_id') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror"
                    id="description" name="description" placeholder="Enter tender description...">{{ old('description') }}</textarea>
            </label>
            @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5 mb-6">
            <x-input class="mb-6 w-full" name="date_start" label="Date Start" placeholder="" type="date" id="date_start">
                <x-icons.calendar-days input/>
            </x-input>

            <x-input class="mb-6 w-full" name="date_end" label="Date End" placeholder="" type="date" id="date_end">
                <x-icons.calendar-days input/>
            </x-input>

            {{-- upload document --}}
            <x-input-file class="mb-6 w-full" name="tor_doc" id="tor_doc" label="Term of Reference Document" type="file" for="tor_doc" info="Dokumen Kerangka Acuan" accept=".pdf,.docx"></x-input-file>
            <x-input-file class="mb-6 w-full" name="support_doc" id="support_doc" type="file" for="support_doc" info="Dokumen Pendukung" label="Supporting Documents" accept=".pdf,.docx"></x-input-file>
        </div>
        <x-button>Create tender</x-button>
    </form>
</x-dashboard>
