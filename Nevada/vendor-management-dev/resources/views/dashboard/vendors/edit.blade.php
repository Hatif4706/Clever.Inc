<x-dashboard title="Edit Vendor">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/vendors">Vendors</a></li>
        <li><a href="">Edit</a></li>
    </x-slot:breadcrumbs>

    <h1 class="mb-8 font-bold text-2xl text-textgray dark:text-white">Edit Vendor</h1>

    <form method="POST" action="/vendors/{{ $vendor->id }}" class="max-w-5xl" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5">

            <x-input class="mb-4" name="name" label="Name" placeholder="Enter vendor name" value="{{ $vendor->name }}">
                <x-icons.building-storefront input />
            </x-input>

            <x-input class="mb-4" name="address" label="Address" placeholder="Enter vendor address" value="{{ $vendor->address }}">
                <x-icons.map-pin input />
            </x-input>

            <x-input class="mb-4" name="website" label="Website" placeholder="Enter vendor website" value="{{ $vendor->website }}">
                <x-icons.globe-alt input />
            </x-input>

            <x-input class="mb-4" name="company_email" label="Company email" placeholder="Enter company email" value="{{ $vendor->company_email }}" type="email">
                <x-icons.envelope input />
            </x-input>

            <x-input class="mb-4" name="bank_reference" label="Bank reference" placeholder="Enter bank reference" value="{{ $vendor->bank_reference }}">
                <x-icons.banknotes input />
            </x-input>

            <div class="mb-4"></div>

            <x-input-file class="mb-4" name="incorporation_deed" label="Deed of incorporation" info="Akta pendirian perusahaan" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="approval_deed" label="Approval deed" info="Akta pengesahan" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="siup" label="Trading business license" info="Surat izin usaha perdagangan" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="registration_cert" label="Certificate of company registration" info="Tanda daftar perusahaan" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="annual_spt_proof" label="Proof of annual SPT" info="Bukti SPT tahunan" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="submission_pph_ssp_proof" label="Income tax & payment receipt" info="Bukti penyampaian SSP dan PPH" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="pkp_npwp" label="PKP & NPWP" info="PKP & NPWP" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="domicile_letter" label="Certificate of domicile" info="Surat domisili" accept=".pdf,.jpg,.jpeg" />

            <x-input-file class="mb-4" name="company_profile" label="Company profile" info="Profil perusahaan" accept=".pdf,.jpg,.jpeg" />

        </div>

        <x-button class="mt-8">Edit Vendor</x-button>
    </form>

</x-dashboard>
