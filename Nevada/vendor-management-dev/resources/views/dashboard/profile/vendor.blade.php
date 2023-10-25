<x-profile title="Your Vendor">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/profile">Profile</a></li>
        <li><a href="/profile/vendor">Your Vendor</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-50">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <h1 class="mb-8 font-bold text-2xl text-textgray dark:text-white">Your Vendor</h1>

    <form method="POST" action="/profile/vendor" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">

            <x-input name="name" placeholder="Enter vendor name" label="Name" value="{{ $vendor->name }}" class="mb-4" >
                <x-icons.user input />
            </x-input>

            <x-input name="address" placeholder="Enter vendor address" label="Address" value="{{ $vendor->address }}" class="mb-4">
                <x-icons.map-pin input />
            </x-input>

            <x-input name="website" placeholder="Enter vendor website" label="Website" value="{{ $vendor->website }}" class="mb-4">
                <x-icons.globe-alt input />
            </x-input>

            <x-input name="company_email" placeholder="Enter company email" label="Company email" value="{{ $vendor->company_email }}" class="mb-4">
                <x-icons.envelope input />
            </x-input>

            <x-input name="bank_reference" placeholder="Enter bank reference" label="Bank reference" value="{{ $vendor->bank_reference }}" class="mb-4">
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
            <x-edit-document src="{{ $vendor->incorporation_deed }}" name="incorporation_deed" label="Deed of incorporation" info="Akta pendirian perusahaan" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->approval_deed }}" name="approval_deed" label="Approval deed" info="Akta pengesahan" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->siup }}" name="siup" label="Trading business license" info="Surat izin usaha perdagangan" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->registration_cert }}" name="registration_cert" label="Certificate of company registration" info="Tanda daftar perusahaan" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->annual_spt_proof }}" name="annual_spt_proof" label="Proof of annual SPT" info="Bukti SPT tahunan" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->submission_pph_ssp_proof }}" name="submission_pph_ssp_proof" label="Income tax & payment receipt" info="Bukti penyampaian SSP dan PPH" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->pkp_npwp }}" name="pkp_npwp" label="PKP & NPWP" info="PKP & NPWP" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->domicile_letter }}" name="domicile_letter" label="Certificate of domicile" info="Surat domisili" accept=".pdf,.jpg,.jpeg" />
            <x-edit-document src="{{ $vendor->company_profile }}" name="company_profile" label="Company profile" info="Profil perusahaan" accept=".pdf,.jpg,.jpeg" />
        </div>

        <button class="btn mt-8 px-10 bg-purple text-white rounded-full normal-case">Update vendor</button>
    </form>


    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        const canvases = [...document.getElementsByClassName('document')];
        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

        for (const canvas of canvases) {
            if (canvas.dataset.src) {
                renderDocument(canvas, canvas.dataset.src);
            }
        }

        function renderDocument(canvas, src) {
            const loadingTask = pdfjsLib.getDocument(src);
            loadingTask.promise.then(function(pdf) {

              const pageNumber = 1;
              pdf.getPage(pageNumber).then(function(page) {

                const viewport = page.getViewport({scale: 1});
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                  canvasContext: context,
                  viewport: viewport
                };

                const renderTask = page.render(renderContext);
              });
            }, function (reason) {
              console.error(reason);
            });
        }

        function setPreview(e) {
            const canvas = document.querySelector('canvas.' + e.target.id);
            const img = document.querySelector('img.' + e.target.id);
            const filename = document.querySelector('div.' + e.target.id);

            if (e.target.files.length > 0) {

                const file = e.target.files[0];
                const objUrl = URL.createObjectURL(file);
                filename.classList.remove('hidden');
                filename.textContent = `(${file.name})`;

                if (file.type === 'application/pdf') {
                    renderDocument(canvas, objUrl);
                    canvas.style.display = 'block';
                    img.style.display = 'none';
                } else if (file.type === 'image/jpeg') {
                    img.src = objUrl;
                    canvas.style.display = 'none';
                    img.style.display = 'block';
                }
            }
        }
    </script>


</x-profile>
