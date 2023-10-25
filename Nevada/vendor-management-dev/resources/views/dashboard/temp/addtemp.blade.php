<x-dashboard title="Add Templates"> 
    <x-slot:breadcrumbs> 
        <li><a href="/">Dashboard</a></li>
        <li><a href="/templates">Templates</a></li>
        <li><a href="/addtemplate">Add Template</a></li>
    </x-slot:breadcrumbs>

    <div class="lg:flex justify-between items-center mb-8 ">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Add Templates</h1>
        </div> 
    </div>

    <form method="POST" action="{{ route('templates.save') }}" class="max-w-5xl" enctype="multipart/form-data">
            @csrf
            <div class="block lg:grid lg:grid-cols-2 lg:gap-5">
                <!-- Input nama -->
                <x-input class="mb-4" name="template_name" id="template_name" type="text" label="Template name" placeholder="Enter template name">
                    <x-icons.folder input />
                </x-input>

                <!-- Function dropdown -->              
                <div class="mb-6">
                    <label class="label-text ml-1" for="function_id">Function</label>
                    <label for="function_id" class="flex items-center relative mt-2">
                        <x-icons.clipboard  class="w-6 h-6 absolute left-4"/>
                        <select class="select select-bordered w-full pl-14 dark:bg-darkbgprimary @error('function_id') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror" name="func" id="func">
                            <option selected disabled value="">Select Function</option>
                            <option value="PO">PO</option>
                            <option value="SPK">SPK</option>
                            <option value="BA Rekonsiliasi">BA Rekonsiliasi</option>
                            <option value="Evaluasi Project">Evaluasi Project</option>
                            <option value="Evaluasi Tender Project">Evaluasi Tender Project</option>
                        </select>
                        @error('function_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>  
                </div>

                <!-- Description -->
                <div class="mb-4 col-span-2">
                    <label class="label-text" for="template_description">Description</label>
                    <label for="template_description" class="flex items-center relative mt-2">
                        <textarea class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary @error('template_description') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror" 
                        name="template_description" id="template_description" placeholder="Enter template description">{{ old('template_description') }}</textarea>
                    </label>
                    @error('template_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                
                <x-input-file class="mb-6 w-full" name="tempdoc" id="tempdoc" label="Template Document" type="file" for="temp_doc" info="Dokumen Templat" accept=".pdf,.docx"></x-input-file>
            </div>
            <x-button class="mt-8" type="submit">Create Template</x-button>
    </form>

</x-dashboard>