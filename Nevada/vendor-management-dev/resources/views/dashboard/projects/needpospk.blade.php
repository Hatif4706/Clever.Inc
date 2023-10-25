<x-dashboard title="Project Need PO & SPK">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
        <li><a href="">Need PO & SPK</a></li>
    </x-slot:breadcrumbs>

    <h1 class="mb-8 font-bold text-2xl text-textgray dark:text-white">Need PO & SPK</h1>

    <form method="POST" action="{{ route('projects.po-spk.need', $project->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">
            <div class="mb-4">
                <div class="flex items-center gap-1 mb-2">
                    <label class="label-text" for="tor_vendor_doc">TOR vendor</label>
                    <div class="tooltip" data-tip="Kerangka acuan kerja">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="tor_vendor_doc" id='tor_vendor_doc' class="file-input file-input-bordered w-full dark:bg-transparent @error('tor_vendor_doc') file-input-error @enderror" />
                @error('tor_vendor_doc')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <div class="flex items-center gap-1 mb-2">
                    <label class="label-text" for="boq_final_vendor">BOQ final vendor</label>
                    <div class="tooltip" data-tip="Rencana anggaran biaya">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                    </div>
                </div>
                <input type="file" name="boq_final_vendor" id='boq_final_vendor' class="file-input file-input-bordered w-full dark:bg-transparent @error('boq_final_vendor') file-input-error @enderror" />
                @error('boq_final_vendor')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button class="btn mt-8 px-10 bg-purple text-white rounded-full normal-case">Need PO & SPK</button>
    </form>

</x-dashboard>
