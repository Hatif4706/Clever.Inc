<x-dashboard title="History">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/histories">History</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Tender History</h1>

    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200">
                    <th>No</th>
                    <th>Project name</th>
                    <th>Created at</th>
                    <th>Status</th>
                    <th>Approval</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenderVendors as $key => $tenderVendor)
                    <tr>
                        <th>{{ $tenderVendors->firstItem() + $key }}</th>
                        <td class="group cursor-pointer">
                            <a class="group-hover:underline" href="{{ route('histories.show', $tenderVendor->id) }}">{{ $tenderVendor->tender->project->name }}</a>
                        </td>
                        <td class="whitespace-nowrap">{{ $tenderVendor->created_at }}</td>
                        <td>
                            @if ($tenderVendor->evaluation)
                                <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                                    @if ($tenderVendor->evaluation->status === 'Need PO & SPK') bg-yellow-600
                                    @elseif ($tenderVendor->evaluation->status === 'Need Approval PO & SPK') bg-yellow-700
                                    @elseif ($tenderVendor->evaluation->status === 'Need Closing') bg-stone-500
                                    @else hidden
                                    @endif"
                                >
                                    {{ $tenderVendor->evaluation->status }}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($tenderVendor->evaluation)
                                <div class="badge statusBtn text-white text-xs mr-1 mb-1 h-fit py-0.5 text-center whitespace-nowrap cursor-default
                                    @if ($tenderVendor->evaluation->approval === 'Approved') bg-green-600
                                    @elseif ($tenderVendor->evaluation->approval === 'Rejected') bg-red-500
                                    @else hidden
                                    @endif"
                                >
                                    {{ $tenderVendor->evaluation->approval }}
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-pagination :data="$tenderVendors" />

</x-dashboard>
