<x-layout title="Signup">
    <div class="flex-wrap lg:flex max-h-fit">
        <div class="lg:w-1/2 h-full min-h-screen dark:bg-darkbgprimary hidden lg:flex justify-center items-center bg-gradient-to-b from-[#BEB5F4] to-customblue">
            <img src="{{ asset('images/manwoman.png') }}" class="w-[260PX] h-[450PX]">
        </div>
        <div class="w-[100%] lg:w-[50%] dark:bg-darkbgprimary min-h-screen overflow-y-auto">
            <div class="justify-between flex py-auto md:py-0 my-5">
                <div class="my-auto absolute ml-5 md:hidden">
                    <div class="cursor-pointer" onclick="history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div class="font-bold text-center text-xl lg:text-2xl mx-auto md:mt-1 dark:text-white">Sign Up</div>
            </div>
            <ul class="steps w-full my-10" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="step li" data-tabs-target="#1" role="presentation" id="tabs1"><button href="#1" data-tabs-target="#1" type="button" role="tab" aria-controls="1" aria-selected="false" onclick="opentabs(event, 'tabs1',this)"id="button-tabs1">User</button></li>
                <li class="step li" data-tabs-target="#2" role="presentation" id="tabs2"><button href="#2" data-tabs-target="#2" type="button" role="tab" aria-controls="2" aria-selected="false" onclick="opentabs(event, 'tabs2',this)"id="button-tabs2">Vendor</button></li>
                <li class="step li" data-tabs-target="#3" role="presentation" id="tabs3"><button href="#3" data-tabs-target="#3" type="button" role="tab" aria-controls="3" aria-selected="false" onclick="opentabs(event, 'tabs3',this)"id="button-tabs3">Document</button></li>
            </ul>

            <div id="myTabContent" class="relative dark:text-white">
                <!-- slide 1 -->
                <form method="post" action="/signup" enctype="multipart/form-data">
                @csrf
                    <div class="tab-content-item absolute inset-0" id="1" data-tabs-target="#1">

                        <div class="mx-auto w-full justify-center pt-3 flex-row py-fit md:px-20 px-5">

                            <x-input class="mb-6 w-full" name="name"  type="text" id="name" value="{{ old('name') }}" placeholder="Enter your full name" autocomplete="off" >
                                <x-slot:label>Full name<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.user input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="email" type="text" id="email" value="{{ old('email') }}" placeholder="Enter your Email" autocomplete="off" >
                                <x-slot:label>Email<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.envelope input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="phone_number" type="tel" id="phone_number" value="{{ old('phone_number') }}" placeholder="Enter your Phone Number" autocomplete="off" >
                                <x-slot:label>Phone number<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.phone-arrow-down-left input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="password" type="password" id="password" placeholder="Enter your Password" autocomplete="off" >
                                <x-slot:label>Password<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.lock-closed input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="password_confirmation" type="password" placeholder="Repeat your Password" autocomplete="off" >
                                <x-slot:label>Password confirmation<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.key input/>
                            </x-input>

                            <p class="flex justify-end">
                                <x-button type="button" id="nextBtn1" class="mb-8">Next</x-button>
                            </p>
                        </div>
                    </div>
                    <!-- slide 2 -->
                    <div class="tab-content-item absolute inset-0" id="2" data-tabs-target="#2">

                        <div class="mx-auto w-full justify-center pt-3 flex-row py-fit md:px-20 px-5">
                            <x-input class="mb-6 w-full" name="company_name" type="text" id="company_name" value="{{ old('company_name') }}" placeholder="Enter your Company Name" autocomplete="off" >
                                <x-slot:label>Company name<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.building-office-2 input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="address" type="text" id="address" value="{{ old('address') }}" placeholder="Enter your Company Address" autocomplete="off" >
                                <x-slot:label>Company address<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.map-pin input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="website" type="text" id="website" value="{{ old('website') }}" placeholder="Enter your company address" autocomplete="off" >
                                <x-slot:label>Company website<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.globe-alt input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="company_email" type="email" id="company_email" value="{{ old('company_email') }}" placeholder="Enter your company email" autocomplete="off" >
                                <x-slot:label>Company email<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.briefcase input/>
                            </x-input>

                            <x-input class="mb-6 w-full" name="bank_reference" type="text" id="bank_reference" value="{{ old('bank_reference') }}" placeholder="Enter your bank" autocomplete="off" >
                                <x-slot:label>Bank reference<span class="text-red-500">*</span></x-slot:label>
                                <x-icons.banknotes input/>
                            </x-input>
                            <!-- Tombol "Next" ditempatkan di samping kanan -->
                            <div class="flex justify-center items-center pb-10">
                            <div class="flex w-full justify-between mx-auto">
                                <x-button type="button" id="prevBtn2">Previous</x-button>
                                <x-button type="button" id="nextBtn2">Next</x-button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- slide 3 -->
                    <div class="tab-content-item absolute inset-0" id="3" data-tabs-target="#3">
                        <div class="mx-auto w-full justify-center pt-3 flex-row py-fit md:px-20 px-5">
                            <x-input-file class="mb-6 w-full" name="incorporation_deed" id="incorporation_deed" type="file" for="incorporation_deed" info="Akta Pendirian Perusahaan" label="Deed of Incorporation" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="approval_deed" id="approval_deed" type="file" for="approval_deed" info="Akta Pengesaha" label="Approval Deed" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="siup" id="siup" type="file" for="siup" info="Surat Izin Usaha Perdangan" label="Trading Business License" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="registration_cert" id="registration_cert" type="file" for="registration_cert" info="Tanda Daftar Perusahaan" label="Certificate of Company Registration" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="annual_spt_proof" id="annual_spt_proof" type="file" for="annual_spt_proof" info="Tanda Daftar Perusahaan" label="Proof of Annual SPT" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="submission_pph_ssp_proof" id="submission_pph_ssp_proof" type="file" for="submission_pph_ssp_proof" info="Bukti Penyampaian PPH dan SSP" label="Income Tax & Payment Receipt" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="pkp_npwp" id="pkp_npwp" type="file" for="pkp_npwp" info="PKP & NPWP" label="PKP & NPWP" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="domicile_letter" id="domicile_letter" type="file" for="domicile_letter" info="Surat Domisili" label="Certificate of Domicile" accept=".pdf,.jpg,.jpeg"></x-input-file>
                            <x-input-file class="mb-6 w-full" name="company_profile" id="company_profile" type="file" for="company_profile" info="Profil Perusahaan" label="Company Profile" accept=".pdf,.jpg,.jpeg"></x-input-file>
                        </div>
                        <div class="flex items-center md:mx-20 my-5">
                            <div class="flex w-full justify-between mx-auto mb-10">
                                <x-button type="button" id="prevBtn3">Previous</x-button>
                                <x-button type="submit" id="submit">Done</x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function showTab(tabId) {
        const tabContents = document.querySelectorAll('.tab-content-item');
        const tabs = document.querySelectorAll('button[data-tabs-target]');

        // Menampilkan konten tab yang sesuai
        tabContents.forEach((content) => {
            if (content.id === tabId) {
                content.classList.remove('hidden');
            } else {
                content.classList.add('hidden');
            }
        });

        // Tambahan perubahan saat tab pertama kali dipanggil
        if (tabId === '1') {
            document.getElementById('tabs1').classList.add('step-primary');
            document.getElementById('tabs2').classList.remove('step-primary');
            document.getElementById('tabs3').classList.remove('step-primary');
            // Tambahkan perubahan yang Anda inginkan saat tab pertama kali dipanggil di sini
            // Contoh: document.getElementById('someElementId').classList.add('someClass');
        } else if(tabId == '2'){
            document.getElementById('tabs1').classList.add('step-primary');
            document.getElementById('tabs2').classList.add('step-primary');
            document.getElementById('tabs3').classList.remove('step-primary');
        }
        else if(tabId == '3'){
            document.getElementById('tabs1').classList.add('step-primary');
            document.getElementById('tabs2').classList.add('step-primary');
            document.getElementById('tabs3').classList.add('step-primary');
        }else{
            document.getElementById('tabs1').classList.remove('step-primary');
            document.getElementById('tabs2').classList.remove('step-primary');
            document.getElementById('tabs3').classList.remove('step-primary');
        }
    }

    document.querySelectorAll('button[data-tabs-target]').forEach((tab) => {
        tab.addEventListener('click', function () {
            const tabId = this.getAttribute('data-tabs-target').substr(1);
            showTab(tabId);
        });
    });

    const prevBtn2 = document.getElementById('prevBtn2');
    const prevBtn3 = document.getElementById('prevBtn3');
    const nextBtn1 = document.getElementById('nextBtn1');
    const nextBtn2 = document.getElementById('nextBtn2');

    prevBtn2.addEventListener('click', function () {showTab('1');});
    prevBtn3.addEventListener('click', function () {showTab('2');});
    nextBtn1.addEventListener('click', function () {showTab('2');});
    nextBtn2.addEventListener('click', function () {showTab('3');});

    // Panggil showTab('1') saat halaman pertama kali dimuat
    showTab('1');
    </script>
</x-layout>
