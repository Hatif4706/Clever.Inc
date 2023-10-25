<x-dashboard title="Edit Project">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="">Edit</a></li>
    </x-slot:breadcrumbs>

    <h1 class="mb-8 font-bold text-2xl text-textgray dark:text-white">Edit Project</h1>

    <form method="POST" action="/projects/{{ $project->id }}" class="max-w-5xl" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5">

                 <x-input class="mb-4" name="name" label="Project name" placeholder="Enter project name" value="{{ $project->name }}">
                    <x-icons.briefcase input />
                 </x-input>

                <x-input class="mb-4" name="job" label="Job name" placeholder="Enter job name" value="{{ $project->job }}">
                    <x-icons.rectangle-stack input />
                 </x-input>

                 <x-input class="mb-4" name="user_company" label="User company" placeholder="Enter user company" value="{{ $project->user_company }}">
                    <x-icons.building-office2 input />
                 </x-input>

                 <x-input class="mb-4" name="pic_company" label="PIC company" placeholder="Enter PIC company" value="{{ $project->pic_company }}">
                    <x-icons.identification input />
                 </x-input>

                 <x-input type="tel" class="mb-4" name="pic_company_phone_number" label="PIC company phone number" placeholder="Enter PIC company phone number" value="{{ $project->pic_company_phone_number }}">
                    <x-icons.phone input />
                 </x-input>

                 <x-input type="tel" class="mb-4" name="contract_number" label="Contract number" placeholder="Enter contract number" value="{{ $project->contract_number }}">
                    <x-icons.clipboard-document-check input />
                 </x-input>

                 <x-input type="date" class="mb-4" name="contract_date" label="Contract date" placeholder="Enter contract date" value="{{ $project->contract_date }}">
                    <x-icons.calender-days input />
                 </x-input>

                 <x-input class="mb-4" name="contract_rate" label="Contract rate" placeholder="Enter contract rate" value="{{ $project->contract_rate }}">
                    <div class="left-5 absolute">Rp</div>
                 </x-input>

                 <x-input class="mb-4" name="vendor_deal" label="Vendor deal value" placeholder="Enter vendor deal value" value="{{ $project->vendor_deal }}">
                    <div class="left-5 absolute">Rp</div>
                 </x-input>

            <div class="mb-4">
                <label class="label-text ml-1" for="assign_pic_am">Assign PIC AM</label>
                <label for="assign_pic_am" class="flex items-center relative mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute left-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>

                    <select class="select select-bordered w-full pl-14 dark:bg-darkbgprimary @error('assign_pic_am') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror" id="assign_pic_am" name="assign_pic_am">
                        @foreach ($ams as $am)
                            <option value="{{ $am->id }}" @if ($am->id === $project->picAM->id) @endif>{{ $am->name }}</option>
                        @endforeach
                    </select>
                </label>
                @error('assign_pic_am')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>


       <x-button class="mt-8">Edit project</x-button>
    </form>

</x-dashboard>
