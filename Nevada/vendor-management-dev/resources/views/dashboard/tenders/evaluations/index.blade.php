<x-dashboard title="Tender Evaluations">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="{{ route('tenders.show', $tender->id) }}">{{ $tender->project->name }}</a></li>
        <li><a href="">Evaluations</a></li>
    </x-slot:breadcrumbs>

    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex mb-6">
        <h1 class="w-full align-middle text-2xl font-bold text-textgray dark:text-white">Evaluations</h1>
        @if ($tender->status === 'Open')
            <a href="/tenders/{{ $tender->id }}/evaluations/create"
                <x-button class="flex items-center px-4">
                    <x-icons.plus /> Create evaluation
                </x-button>
            </a>
        @endif
    </div>


    @if (session('success'))
        <div class="toast toast-start z-10">
            <div class="alert alert-success flex">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200">
                    <th>No</th>
                    <th>Vendor name</th>
                    <th>Status</th>
                    <th>Approval</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $key => $evaluation)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td class="group cursor-pointer">
                            <a href="/tenders/{{ $tender->id }}/evaluations/{{ $evaluation->id }}" class="group-hover:underline" href="">{{ $evaluation->tenderVendor->vendor->name }}</a>
                        </td>
                        <td>
                            <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                                @if ($evaluation->status === 'Need PO & SPK') bg-yellow-600
                                @elseif ($evaluation->status === 'Need Approval PO & SPK') bg-blue-500
                                @elseif ($evaluation->status === 'Need Closing') bg-stone-500
                                @else hidden
                                @endif"
                            >
                                {{ $evaluation->status }}
                            </div>
                        </td>
                        <td>
                            <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                                @if ($evaluation->approval === 'Approved') bg-green-600
                                @elseif ($evaluation->approval === 'Rejected') bg-red-500
                                @else hidden
                                @endif"
                            >
                                {{ $evaluation->approval }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-dashboard>
