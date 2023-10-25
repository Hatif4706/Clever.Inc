<x-dashboard title="Project Report">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/projects">Projects</a></li>
        <li><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></li>
        <li><a href="">Report</a></li>
    </x-slot:breadcrumbs>

    <div class="flex items-center justify-between mb-10">
        <h1 class="text-2xl font-bold text-textgray dark:text-white">Project Report</h1>
    </div>

    <ul class=" w-full">
        @if (in_array($project->status, ['Completed']))
            <li class="step step-primary flex min-h-16" >
                <div class=" bg-purple w-2 lg:ml-5 hidden lg:block"></div>
                <div class="bg-purple lg:flex justify-center items-center rounded-full w-12 h-12 text-white absolute left-72 hidden">7</div>
                <div class="block w-full justify-start lg:pl-10">
                    <div class="text-start font-bold text-lg border-b-2 border-base-300 dark:border-base-100 text-textgray dark:text-white">Completed</div>
                    @foreach ($reports['Completed'] as $report)
                        <x-report picture="{{ $report->user->profile_picture }}" name="{{ $report->user->name }}" action="{{ $report->action }}" time="{{ $report->created_at }}" />
                    @endforeach
                </div>
            </li>
        @endif

        @if (in_array($project->status, ['Payment Updated', 'Completed']))
            <li class="step step-primary flex min-h-16" >
                <div class=" bg-purple w-2 lg:ml-5 hidden lg:block"></div>
                <div class="bg-purple lg:flex justify-center items-center rounded-full w-12 h-12 text-white absolute left-72 hidden">6</div>
                <div class="block w-full justify-start lg:pl-10">
                    <div class="text-start font-bold text-lg border-b-2 border-base-300 dark:border-base-100 text-textgray dark:text-white">Payment Updated</div>
                    @foreach ($reports['Payment Updated'] as $report)
                        <x-report picture="{{ $report->user->profile_picture }}" name="{{ $report->user->name }}" action="{{ $report->action }}" time="{{ $report->created_at }}" />
                    @endforeach
                </div>
            </li>
        @endif

        @if (in_array($project->status, ['Need Closing', 'Payment Updated', 'Completed']))
            <li class="step step-primary flex min-h-16" >
                <div class="bg-purple w-2 lg:ml-5 hidden lg:block"></div>
                <div class="bg-purple lg:flex justify-center items-center rounded-full w-12 h-12 text-white absolute left-72 hidden">5</div>
                <div class="block w-full justify-start lg:pl-10">
                    <div class="text-start font-bold text-lg border-b-2 border-base-300 dark:border-base-100 text-textgray dark:text-white">Need Closing</div>
                    @foreach ($reports['Need Closing'] as $report)
                        <x-report picture="{{ $report->user->profile_picture }}" name="{{ $report->user->name }}" action="{{ $report->action }}" time="{{ $report->created_at }}" />
                    @endforeach
                </div>
            </li>
        @endif

        @if (in_array($project->status, ['Need PO & SPK' ,'Need Closing', 'Payment Updated', 'Completed']))
            <li class="step step-primary flex min-h-16" >
                <div class=" bg-purple w-2 lg:ml-5 hidden lg:block"></div>
                <div class=" bg-purple lg:flex justify-center items-center rounded-full w-12 h-12 text-white absolute left-72 hidden">4</div>
                <div class="block w-full justify-start lg:pl-10">
                    <div class="text-start font-bold text-lg border-b-2 border-base-300 dark:border-base-100 text-textgray dark:text-white">Need PO & SPK</div>
                    @foreach ($reports['Need PO & SPK'] as $report)
                        <x-report picture="{{ $report->user->profile_picture }}" name="{{ $report->user->name }}" action="{{ $report->action }}" time="{{ $report->created_at }}" />
                    @endforeach
                </div>
            </li>
        @endif

        @if (in_array($project->status, ['Need Evaluation', 'Need PO & SPK' ,'Need Closing', 'Payment Updated', 'Completed']))
            <li class="step step-primary flex min-h-16" >
                <div class="bg-purple w-2 lg:ml-5 hidden lg:block"></div>
                <div class="bg-purple lg:flex justify-center items-center rounded-full w-12 h-12 text-white absolute left-72 hidden">3</div>
                <div class="block w-full justify-start lg:pl-10">
                    <div class="text-start font-bold text-lg border-b-2 border-base-300 dark:border-base-100 text-textgray dark:text-white">Need Evaluation</div>
                    @foreach ($reports['Need Evaluation'] as $report)
                        <x-report picture="{{ $report->user->profile_picture }}" name="{{ $report->user->name }}" action="{{ $report->action }}" time="{{ $report->created_at }}" />
                    @endforeach
                </div>
            </li>
        @endif

        @if (in_array($project->status, ['Tender on Process' ,'Need Evaluation', 'Need PO & SPK' ,'Need Closing', 'Payment Updated', 'Completed']))
            <li class="step step-primary flex min-h-16" >
                <div class="bg-purple w-2 lg:ml-5 hidden lg:block"></div>
                <div class="bg-purple lg:flex justify-center items-center rounded-full w-12 h-12 text-white absolute left-72 hidden">2</div>
                <div class="block w-full justify-start lg:pl-10">
                    <div class="text-start font-bold text-lg border-b-2 border-base-300 dark:border-base-100 text-textgray dark:text-white">Tender on Process</div>
                    @foreach ($reports['Tender on Process'] as $report)
                        <x-report picture="{{ $report->user->profile_picture }}" name="{{ $report->user->name }}" action="{{ $report->action }}" time="{{ $report->created_at }}" />
                    @endforeach
                </div>
            </li>
        @endif

        @if (in_array($project->status, ['New Project', 'Tender on Process' ,'Need Evaluation', 'Need PO & SPK' ,'Need Closing', 'Payment Updated', 'Completed']))
            <li class="step step-primary flex min-h-16" >
                <div class="bg-purple w-2 lg:ml-5 hidden lg:block"></div>
                <div class="bg-purple lg:flex justify-center items-center rounded-full w-12 h-12 text-white absolute left-72 hidden">1</div>
                <div class="block w-full justify-start lg:pl-10">
                    <div class="text-start font-bold text-lg border-b-2 border-base-300 dark:border-base-100 text-textgray dark:text-white">New Project</div>
                    @foreach ($reports['New Project'] as $report)
                        <x-report picture="{{ $report->user->profile_picture }}" name="{{ $report->user->name }}" action="{{ $report->action }}" time="{{ $report->created_at }}" />
                    @endforeach
                </div>
            </li>
        @endif

      </ul>
</x-dashboard>
