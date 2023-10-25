<x-dashboard title="Edit Templates"> 
    <x-slot:breadcrumbs> 
        <li><a href="/">Dashboard</a></li>
        <li><a href="/templates">Templates</a></li>
        <li><a href="/edit">Edit Template</a></li>
    </x-slot:breadcrumbs>

    <div class="lg:flex justify-between items-center mb-8 ">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-2xl font-bold text-textgray dark:text-white">Edit Templates</h1>
        </div> 
    </div>

    <form method="POST" action="{{ route('templates.update',$dataTemp->id) }}" class="max-w-5xl" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="block lg:grid lg:grid-cols-2 lg:gap-5">
                <!-- Input nama -->
                <x-input class="mb-4" name="template_name" id="template_name" label="Template name" placeholder="Enter template name" value="{{ $dataTemp->template_name }}">
                    <x-icons.folder input />
                </x-input>

                <!-- Function dropdown -->          
                <div class="mb-6">
                    <label class="label-text ml-1" for="function_id">Function</label>
                    <label for="func" class="flex items-center relative mt-2">
                        <x-icons.clipboard  class="w-6 h-6 absolute left-4"/>
                        <select class="select select-bordered w-full pl-14 dark:bg-darkbgprimary @error('function_id') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror" id="func" name="func">
                            <option selected disabled class="">Select Function</option>
                                <!-- Pake loop masuk database -->
                                <option value="PO" @if($dataTemp->func === 'PO') selected @endif>PO</option>
                                <option value="SPK" @if($dataTemp->func === 'SPK') selected @endif >SPK</option>
                                <option value="BA Rekonsiliasi" @if($dataTemp->func === 'BA Rekonsiliasi') selected @endif>BA Rekonsiliasi</option>
                                <option value="Evaluasi Project" @if($dataTemp->func === 'Evaluasi Projek') selected @endif>Evaluasi Project</option>
                                <option value="Evaluasi Tender Project"  @if($dataTemp->func === 'Evaluasi Tender Projek') selected @endif>Evaluasi Tender Project</option>
                        </select>
                        @error('function_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>
            
                </div>

                <!-- Description -->
                <div class="mb-4 col-span-2">
                    <label class="label-text" for="name">Description</label>
                    <label for="name" class="flex items-center relative mt-2">
                        <textarea
                            class="textarea textarea-bordered mt-2 h-80 w-full resize-none dark:bg-darkbgprimary @error('project_id') border-red-500 dark:border-red-500 focus:outline-red-500 focus:dark:outline-red-500 dark:focus:outline-red-500 @enderror"
                            id="template_description" name="template_description" placeholder="Enter tender description...">{{ $dataTemp->template_description }}</textarea>
                    </label>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <x-input-file class="mb-6 w-full" name="tempdoc" id="tempdoc" label="Template Document" type="file" for="template_file_name" info="Dokumen Templat" accept=".pdf,.docx" value="{{ $dataTemp->template_file_name }}"></x-input-file>
            </div>
            <x-button class="mt-8" type="submit">Update Template</x-button>
    </form>

</x-dashboard>