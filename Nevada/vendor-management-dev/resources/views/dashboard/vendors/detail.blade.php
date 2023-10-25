<x-dashboard title="Vendor">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/vendors">Vendors</a></li>
        <li><a href="">{{ $vendor->name }}</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
                <x-icons.check-circle />
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex flex-wrap justify-between gap-4 max-w-5xl mb-6">
        <h1 class="text-2xl font-bold text-textgray dark:text-white">{{ $vendor->name }}</h1>

        <div class="flex items-center gap-4">
            @if ($vendor->status === 'New')
                <div>
                    <x-button-link onclick="rejectVendor.showModal()" class="px-5 !bg-red-500 hover:!bg-red-600">
                        <x-icons.x-circle /> Reject
                    </x-button-link>
                    <x-button-link onclick="approveVendor.showModal()" class="px-5 !bg-green-600 hover:!bg-green-700">
                        <x-icons.check-circle /> Approve
                    </x-button-link>
                </div>
            @endif

            <div class="tooltip flex items-center" data-tip="Menu">
                <div class="dropdown dropdown-bottom dropdown-end">
                    <label tabindex="0">
                        <x-icons.ellipsis-vertical class="h-6 w-6 lg:h-8 lg:w-8 hover:bg-base-200 rounded-md p-1.5 box-content cursor-pointer" />
                    </label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('users.show', $vendor->user->id) }}" class="flex items-center gap-2 hover:!bg-purple hover:!text-white active:!bg-purple">
                            <x-icons.user /> User
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">
        <x-input class="mb-4" name="name" label="Name" placeholder="Enter vendor name" value="{{ $vendor->name }}" readonly>
            <x-icons.building-storefront input />
        </x-input>

        <x-input class="mb-4" name="address" label="Address" placeholder="Enter vendor address" value="{{ $vendor->address }}" readonly>
            <x-icons.map-pin input />
        </x-input>

        <x-input class="mb-4" name="website" label="Website" placeholder="Enter vendor website" value="{{ $vendor->website }}" readonly>
            <x-icons.globe-alt input />
        </x-input>

        <x-input class="mb-4" name="company_email" label="Company email" placeholder="Enter company email" value="{{ $vendor->company_email }}" readonly type="email">
            <x-icons.envelope input />
        </x-input>

        <x-input class="mb-4" name="bank_reference" label="Bank reference" placeholder="Enter bank reference" value="{{ $vendor->bank_reference }}" readonly>
            <x-icons.banknotes input />
        </x-input>

        <div class="mb-4">
            <div class="label-text mb-2">Status</div>
            <div class="badge text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap
                @if ($vendor->status === 'Verified') bg-green-600
                @elseif ($vendor->status === 'Not Verified') bg-red-600
                @else bg-blue-600
                @endif"
            >
                {{ $vendor->status }}
            </div>
        </div>
    </div>

    @if ($vendor->status === 'Not Verified')
        <div class="my-4 max-w-5xl">
            <label class="label-text" for="rejection_reason">Reason of rejection</label>
            <textarea class="textarea textarea-bordered mt-2 h-48 w-full resize-none dark:bg-darkbgprimary" id="rejection_reason" readonly>{{ $vendor->rejection_reason }}</textarea>
        </div>
    @endif

    <div class="flex items-end gap-8 w-full overflow-auto py-3 pt-8">
        <x-document src="{{ $vendor->incorporation_deed }}" name="Deed of incorporation" translate="Akta pendirian perusahaan" />
        <x-document src="{{ $vendor->approval_deed }}" name="Approval deed" translate="Akta pengesahan" />
        <x-document src="{{ $vendor->siup }}" name="Trading business license" translate="Surat izin usaha perdagangan" />
        <x-document src="{{ $vendor->registration_cert }}" name="Certificate of company registration" translate="Tanda daftar perusahaan" />
        <x-document src="{{ $vendor->annual_spt_proof }}" name="Proof of annual SPT" translate="Bukti SPT tahunan" />
        <x-document src="{{ $vendor->submission_pph_ssp_proof }}" name="Income tax & payment receipt" translate="Bukti penyampaian SSP dan PPH" />
        <x-document src="{{ $vendor->pkp_npwp }}" name="PKP & NPWP" translate="PKP & NPWP" />
        <x-document src="{{ $vendor->domicile_letter }}" name="Certificate of domicile" translate="Surat domisili" />
        <x-document src="{{ $vendor->company_profile }}" name="Company profile" translate="Profil perusahaan" />
    </div>

    <dialog id="approveVendor" class="modal">
        <form method="POST" action="/vendors/{{ $vendor->id }}/verification" class="modal-box" id="approveVendorForm">
            @csrf
            @method('PATCH')

            <h3 class="font-bold text-lg">Approve Vendor</h3>
            <p class="my-4">Are you sure to approve Vendor <strong>{{ $vendor->name }}</strong>?</p>
            <input type="hidden" name="rejection_reason" value="Verified" />
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="approveVendor.close()">Cancel</button>
                <button name="status" value="Verified" class="btn btn-success capitalize">Approve</button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <dialog id="rejectVendor" class="modal">
        <form method="POST" action="/vendors/{{ $vendor->id }}/verification" class="modal-box !max-w-full xl:!w-1/2" id="rejectVendorForm">
            @csrf
            @method('PATCH')

            <h3 class="font-bold text-lg">Reject Vendor</h3>
            <p class="my-4">Are you sure to reject Vendor <strong>{{ $vendor->name }}</strong>?</p>
            <div class="mb-4">
                <label class="label-text" for="rejection_reason">Reason</label>
                <textarea class="textarea textarea-bordered mt-2 h-56 w-full resize-none" id="rejection_reason" name="rejection_reason" placeholder="Enter rejection reason..."></textarea>
            </div>
            <div class="modal-action">
                <button type="button" class="btn capitalize" onclick="rejectVendor.close()">Cancel</button>
                <button name="status" value="Not Verified" class="btn btn-error capitalize">Reject</button>
            </div>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>
