<x-dashboard title="Create Project">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="">Create</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Create Project</h1>

    <form method="POST" action="/projects" class="max-w-5xl" enctype="multipart/form-data">
        @csrf

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5">

                 <x-input class="mb-4" name="name" label="Project name" placeholder="Enter project name">
                    <x-icons.briefcase input />
                 </x-input>

                <x-input class="mb-4" name="job" label="Job name" placeholder="Enter job name">
                    <x-icons.rectangle-stack input />
                 </x-input>

                 <x-input class="mb-4" name="user_company" label="User company" placeholder="Enter user company">
                    <x-icons.building-office2 input />
                 </x-input>

                 <x-input class="mb-4" name="pic_company" label="PIC company" placeholder="Enter PIC company">
                    <x-icons.identification input />
                 </x-input>

                 <x-input type="tel" class="mb-4" name="pic_company_phone_number" label="PIC company phone number" placeholder="Enter PIC company phone number">
                    <x-icons.phone input />
                 </x-input>

                 <x-input type="tel" class="mb-4" name="contract_number" label="Contract number" placeholder="Enter contract number">
                    <x-icons.clipboard-document-check input />
                 </x-input>

                 <x-input type="date" class="mb-4" name="contract_date" label="Contract date" placeholder="Enter contract date">
                    <x-icons.calender-days input />
                 </x-input>

                 <x-input class="mb-4" name="contract_rate" label="Contract rate" placeholder="Enter contract rate">
                    <div class="left-5 absolute">Rp</div>
                 </x-input>

                 <x-input class="mb-4" name="vendor_deal" label="Vendor deal value" placeholder="Enter vendor deal value">
                    <div class="left-5 absolute">Rp</div>
                 </x-input>

            <div class="mb-4">
                <label class="label-text ml-1" for="assign_pic_am">Assign PIC AM</label>
                  <label for="assign_pic_am" class="flex items-center relative mt-2">
                     <x-icons.user input/>

                     <select class="select select-bordered w-full pl-14 dark:bg-darkbgprimary @error('assign_pic_am') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror" id="assign_pic_am" name="assign_pic_am">
                           <option selected disabled>Select PIC AM</option>
                           @foreach ($ams as $am)
                              <option value="{{ $am->id }}">{{ $am->name }}</option>
                           @endforeach
                     </select>
                  </label>
                @error('assign_pic_am')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>
        <x-button class="mt-8">Create project</x-button>

    </form>

</x-dashboard>
