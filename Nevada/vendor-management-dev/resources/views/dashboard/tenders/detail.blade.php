<x-dashboard title="Tender">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="">{{ $tender->project->name }}</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex items-center flex-wrap justify-between gap-4 max-w-5xl mb-6">
        <h1 class="text-2xl font-bold text-textgray dark:text-white">{{ $tender->project->name }}</h1>

        <div class="flex items-center gap-4">

            @role('Vendor')
                @if (auth()->user()->vendor->status === 'Verified')

                    @php
                        $tenderVendor = $tender->tenderVendors->where('vendor_id', Auth::user()->vendor->id)->first();
                        if ($tenderVendor !== null) {
                            $evaluations = $tender->evaluations->where('tender_vendor_id', $tenderVendor->id);
                        }
                    @endphp

                    <td>
                        @if ($tenderVendor === null)
                            <x-button-link href="{{ route('tenders.join', $tender->id) }}" class="px-5">
                                <x-icons.arrow-left-on-rectangle /> Join tender
                            </x-button-link>
                        @elseif ($evaluations->isEmpty() || empty($evaluations->first()->approval))
                            <x-button-link class="px-5 !bg-gray cursor-default">
                                <x-icons.clock /> Waiting for approval
                            </x-button-link>
                        @elseif ($evaluations->first()->approval === 'Rejected')
                            <x-button-link class="px-5 !bg-red-500 cursor-default">
                                <x-icons.x-circle /> Rejected
                            </x-button-link>
                        @endif
                    </td>
                @endif
            @endrole

            @role('CAM|Account Manager')
                <div class="tooltip flex items-center" data-tip="Menu">
                    <div class="dropdown dropdown-bottom dropdown-end">
                        <label tabindex="0">
                            <x-icons.ellipsis-vertical class="h-6 w-6 lg:h-8 lg:w-8 hover:bg-base-200 rounded-md p-1.5 box-content cursor-pointer" />
                        </label>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a href="{{ route('projects.show', $tender->project_id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                                <x-icons.folder /> Project
                            </a></li>
                            <li><a href="{{ route('tenders.evaluations.index', $tender->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                                <x-icons.clipboard-document-check /> Evaluations
                            </a></li>
                            <li><a href="{{ route('tenders.vendors.index', $tender->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                                <x-icons.building-storefront /> Tender vendors
                            </a></li>
                        </ul>
                    </div>
                </div>
            @endrole
        </div>
    </div>

    <div class="max-w-5xl">
        <x-input class="mb-6 w-full" name="project_id" label="Project Name" placeholder="" type="text" id="project_id" value="{{ $tender->project->name }}" readonly >
            <x-icons.briefcase input/>
        </x-input>

        <div class="mb-4">
            <label class="label-text" for="description">Description</label>
            <label for="name" class="flex items-center relative mt-2">

                <textarea
                    class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary"
                    id="description" name="description" readonly>{{ $tender->description }}</textarea>
            </label>
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="block lg:grid lg:grid-cols-2 lg:gap-5">
            <x-input class="mb-6 w-full" name="date_start" label="Date Start" placeholder="" type="date" id="date_start" value="{{ $tender->date_start }}" readonly>
                <x-icons.calendar-days input/>
            </x-input>

            <x-input class="mb-6 w-full" name="date_end" label="Date End" placeholder="" type="date" id="date_end" value="{{ $tender->date_end }}" readonly>
                <x-icons.calendar-days input/>
            </x-input>
        </div>

        <div class="flex items-end gap-8 w-full overflow-auto py-3 pt-8">
            <x-document src="{{ $tender->tor_doc }}" name="Term of Reference Document"
                translate="Dokumen Kerangka Acuan" />
            <x-document src="{{ $tender->support_doc }}" name="Support Document"
                translate="Dokumen Pendukung" />
        </div>
    </div>

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
