<x-dashboard title="Detail Templates"> 
    <x-slot:breadcrumbs> 
        <li><a href="/">Dashboard</a></li>
        <li><a href="/templates">Templates</a></li>
        <li><a href="/detail">Detail Template</a></li>
    </x-slot:breadcrumbs>

    <div class="lg:flex justify-between items-center mb-8 ">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Detail Templates</h1>
        </div> 
    </div>

            <div class="block lg:grid lg:grid-cols-2 lg:gap-5">
                <x-input class="mb-4" name="template_name" label="Template name" placeholder="Enter template name" value="{{ $dataTemp->template_name }}" readonly>
                    <x-icons.folder input />
                </x-input>
       
                <div class="mb-6">
                    <x-input class="mb-4" name="func" label="Function" placeholder="Enter func" value="{{ $dataTemp->func }}" readonly>
                    <x-icons.clipboard input />
                    </x-input>
                </div>
            <div class="mb-4 col-span-2">

            <label class="label-text" for="description">Description</label>
            <label for="name" class="flex items-center relative mt-2">
                <textarea
                    class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary"
                    id="description" name="description" readonly>{{ $dataTemp->template_description }}</textarea>
            </label>
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

                
                <x-input class="mb-4" name="created_by" label="Added by" placeholder="" value="{{ $dataTemp->createdBy->name }}" readonly>
                    <x-icons.user input />
                </x-input>
                
                <x-input class="mb-6 w-full" name="date_start" label="Created at" placeholder=""  id="created_at" value="{{ $dataTemp->created_at }}" readonly>
                    <x-icons.calendar-days input/>
                </x-input>
                
                <x-input class="mb-4" name="updated_by" label="Updated by " placeholder="" value="{{ $dataTemp->updatedBy ? $dataTemp->updatedBy->name : 'Unknown User' }}" readonly>
                    <x-icons.user input />
                </x-input>

                <x-input class="mb-6 w-full" name="date_start" label="Updated at" placeholder=""  id="updated_at" value="{{ $dataTemp->updated_at }}" readonly>
                    <x-icons.calendar-days input/>
                </x-input>
                
                <x-input class="mb-6 w-full" name="date_start" label="Version" placeholder=""  id="updated_at" value="{{ $dataTemp->version }}" readonly>
                    <x-icons.calendar-days input/>
                </x-input>
                
                <x-input class="mb-6 w-full" name="" label="tes" placeholder=""  id="updated_at" value="" readonly>
                    <x-icons.calendar-days input/>
                </x-input>
                
                
                <div class="flex items-end gap-8 w-full overflow-auto py-3 pt-8">
            <x-document src="{{ $dataTemp->template_file_name }}" name="Dokument Template"
                translate="Dokumen Template" />
        </div>
                
            </div>

        <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
        <script src="{{ asset('js/document.js') }}"></script>

</x-dashboard>