<x-dashboard title="Project">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="">{{ $project->name }}</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
                <x-icons.check-circle />
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex items-center flex-wrap justify-between gap-4 max-w-5xl mb-6">
        <h1 class="text-2xl font-bold text-textgray dark:text-white">{{ $project->name }}</h1>

        <div class="flex items-center gap-4">
            @role('CAM|Account Manager')
                @if ($project->status === 'Need Evaluation' && $project->tender->evaluations->where('approval', 'Approved')->count() > 0)
                    <x-button-link href="{{ route('projects.po-spk.need', $project->id) }}" class="px-5">
                        <x-icons.document-plus /> Need PO & SPK
                    </x-button-link>
                @elseif ($project->status === 'Need Evaluation')
                    <x-button-link class="px-5 !bg-gray cursor-default">
                        <x-icons.clock /> Waiting for evaluation approval
                    </x-button-link>
                @elseif ($project->status === 'Need Closing')
                    <x-button-link class="px-5 !bg-gray cursor-default">
                        <x-icons.clock /> Waiting for payment
                    </x-button-link>
                @elseif ($project->status === 'Payment Updated')
                    <x-button-link class="px-5" onclick="completeModal.showModal()">
                        <x-icons.folder /> Complete project
                    </x-button-link>
                @elseif ($project->status === 'Need PO & SPK' && $project->poSpk && $project->poSpk->approval === 'Approved')
                    <x-button-link href="/projects/{{ $project->id }}/need-closing" class="px-5">
                        <x-icons.x-circle /> Need Closing
                    </x-button-link>
                @elseif ($project->status === 'Need PO & SPK' && $project->poSpk && !$project->poSpk->approval)
                    <x-button-link class="px-5 !bg-gray cursor-default">
                        <x-icons.clock /> Waiting for PO & SPK approval
                    </x-button-link>
                @elseif ($project->status === 'Need PO & SPK')
                    <x-button-link class="px-5 !bg-gray cursor-default">
                        <x-icons.clock /> Waiting for PO & SPK
                    </x-button-link>
                @endif
            @endrole

            @role('Chief Logistik|Logistik')
                @if ($project->status === 'Need PO & SPK')
                    @if (!$project->poSpk || ($project->poSpk && $project->poSpk->approval === 'Rejected'))
                        <x-button-link href="{{ route('projects.po-spk.create', $project->id) }}" class="px-5">
                            <x-icons.document-plus /> Create PO & SPK
                        </x-button-link>
                    @elseif ($project->poSpk && !$project->poSpk->approval)
                        <x-button-link class="px-5 !bg-gray cursor-default">
                            <x-icons.clock /> Waiting for PO & SPK approval
                        </x-button-link>
                    @endif
                @endif
            @endrole

            @role('Finance')
                @if ($project->status === 'Need Closing')
                    <x-button-link href="{{ route('projects.payment.create', $project->id) }}" class="px-5">
                        <x-icons.banknotes /> Create payment
                    </x-button-link>
                @endif
            @endrole

            <div class="tooltip flex items-center" data-tip="Menu">
                <div class="dropdown dropdown-bottom dropdown-end">
                    <label tabindex="0">
                        <x-icons.ellipsis-vertical class="h-6 w-6 lg:h-8 lg:w-8 hover:bg-base-200 rounded-md p-1.5 box-content cursor-pointer" />
                    </label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        @can('see report')
                            <li><a href="{{ route('projects.report', $project->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                                <x-icons.clipboard-document-list /> Report
                            </a></li>
                        @endcan
                        @can('see tender')
                            @if ($project->tender)
                                <li><a href="{{ route('tenders.show', $project->tender->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                                    <x-icons.document-text /> Tender
                                </a></li>
                            @endif
                        @endcan
                        @if ($project->poSpk)
                            <li><a href="{{ route('projects.po-spk.show', $project->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                                <x-icons.document-plus /> PO & SPK
                            </a></li>
                        @endif
                        @if ($project->payment)
                            <li><a href="{{ route('projects.payment.show', $project->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                                <x-icons.banknotes /> Payment
                            </a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="block lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">

        <x-input class="mb-4" name="name" label="Project name" placeholder="Enter project name" value="{{ $project->name }}" readonly>
            <x-icons.briefcase input />
         </x-input>

        <x-input class="mb-4 disabled" name="job" label="Job name" placeholder="Enter job name" value="{{ $project->job }}" readonly>
            <x-icons.rectangle-stack input />
         </x-input>

         <x-input class="mb-4" name="user_company" label="User company" placeholder="Enter user company" value="{{ $project->user_company }}" readonly>
            <x-icons.building-office2 input />
         </x-input>

         <x-input class="mb-4" name="pic_company" label="PIC company" placeholder="Enter PIC company" value="{{ $project->pic_company }}" readonly>
            <x-icons.identification input />
         </x-input>

         <x-input type="tel" class="mb-4" name="pic_company_phone_number" label="PIC company phone number" placeholder="Enter PIC company phone number" value="{{ $project->pic_company_phone_number }}" readonly>
            <x-icons.phone input />
         </x-input>

         <x-input type="tel" class="mb-4" name="contract_number" label="Contract number" placeholder="Enter contract number" value="{{ $project->contract_number }}" readonly>
            <x-icons.clipboard-document-check input />
         </x-input>

         <x-input type="date" class="mb-4" name="contract_date" label="Contract date" placeholder="Enter contract date" value="{{ $project->contract_date}}" readonly>
            <x-icons.calender-days input />
         </x-input>

         <x-input class="mb-4" name="contract_rate" label="Contract rate" placeholder="Enter contract rate" value="{{ number_format($project->contract_rate, 0, ',', '.') }}" readonly>
            <div class="left-5 absolute">Rp</div>
         </x-input>

         <x-input class="mb-4" name="vendor_deal" label="Vendor deal value" placeholder="Enter vendor deal value" value="{{ number_format($project->vendor_deal, 0, ',', '.') }}" readonly>
            <div class="left-5 absolute">Rp</div>
         </x-input>

        <div class="mb-4">
            <label class="label-text ml-1">Assign PIC AM</label>
            <label class="flex items-center relative mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute left-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>

                <input
                    class="input input-bordered w-full pl-14 dark:bg-darkbgprimary @error('vendor_deal') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror"
                    type="text" id="vendor_deal" value="{{ $project->picAM->name }}" readonly>
            </label>
        </div>

        <div class="mb-4">
            <div class="label-text mb-2">Status</div>
            <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                @if ($project->status === 'New Project') bg-blue-500
                @elseif ($project->status === 'Tender on Process') bg-green-600
                @elseif ($project->status === 'Need Evaluation') bg-red-600
                @elseif ($project->status === 'Need PO & SPK') bg-yellow-600
                @elseif ($project->status === 'Need Closing') bg-stone-500
                @elseif ($project->status === 'Payment Updated') bg-pink-500
                @elseif ($project->status === 'Completed') bg-slate-800
                @endif"
            >
                {{ $project->status }}
            </div>
        </div>

        <div class="mb-4">
            <div class="label-text mb-2">Payment status</div>
            <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                @if ($project->payment_status === 'Done') bg-green-600
                @else bg-red-500
                @endif"
            >
                {{ $project->payment_status }}
            </div>
        </div>

        <div class="mb-4">
            <div class="label-text mb-2">TOR Document status</div>
            <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                @if ($project->tor_doc_status === 'Available') bg-green-600
                @else bg-red-500
                @endif"
            >
                {{ $project->tor_doc_status }}
            </div>
        </div>

        <div class="mb-4">
            <div class="label-text mb-2">PO Document status</div>
            <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                @if ($project->po_doc_status == 'Available') bg-green-600
                @else bg-red-500
                @endif"
            >
                {{ $project->po_doc_status }}
            </div>
        </div>
    </div>

    <div class="flex items-end gap-8 w-full overflow-auto py-3 pt-8">
        <x-document src="{{ $project->tor_vendor_doc }}" name="TOR Vendor Document" translate="Dokumen Kerangka Acuan" />
        <x-document src="{{ $project->boq_final_vendor }}" name="Vendor Final BOQ Document" translate="Dokumen Daftar Kuantitas Akhir Vendor" />
        <x-document src="{{ $project->evaluation_project_doc }}" name="Evaluation Project Document" translate="Dokumen Evaluasi Proyek" />
        <x-document src="{{ $project->ba_reconciliation_doc }}" name="BA Reconciliation Document" translate="Dokumen Rekonsiliasi Bank" />
        <x-document src="{{ $project->bast_doc }}" name="Bast Document" translate="Dokumen Berita Acara Serah Terima" />
    </div>

    <dialog id="completeModal" class="modal">
        <form method="POST" action="{{ route('projects.complete', $project->id) }}" class="modal-box" id="completeForm">
            @csrf
            @method('PATCH')

            <h3 class="font-bold text-lg">Complete Project</h3>
            <p class="my-4">Are you sure to complete project <strong>{{ $project->name }}</strong>?</p>
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="completeModal.close()">Cancel</button>
                <x-button class="rounded-lg px-5">Complete project</x-button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
