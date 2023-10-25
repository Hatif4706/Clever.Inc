<x-dashboard title="Close Project">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="">Close</a></li>
    </x-slot:breadcrumbs>

    <h1 class="mb-8 font-bold text-2xl text-textgray dark:text-white">Need Closing</h1>

    <form method="POST" action="/projects/{{ $project->id }}/closing" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="block lg:grid lg:grid-cols-2 lg:gap-5 max-w-5xl">
            <x-input-file name="evaluation_project_doc" label="Evaluation project" info="Evaluasi proyek" class="mb-4" accept=".pdf,.docx" />
            <x-input-file name="ba_reconciliation_doc" label="BA reconciliation" info="Berita acara rekonsiliasi" class="mb-4" accept=".pdf,.docx" />
            <x-input-file name="bast_doc" label="BAST" info="Berita acara serah terima" class="mb-4" accept=".pdf,.docx" />
        </div>

        <button class="btn mt-8 px-10 bg-purple text-white rounded-full normal-case">Need Closing</button>
    </form>

</x-dashboard>
