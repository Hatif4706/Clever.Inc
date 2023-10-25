<x-dashboard title="Tender Vendors">

    <x-slot:breadcrumbs>
        <li><a href="/">Dashboard</a></li>
        <li><a href="/tenders">Tenders</a></li>
        <li><a href="{{ route('tenders.show', $tender->id) }}">{{ $tender->project->name }}</a></li>
        <li><a href="">Vendors</a></li>
    </x-slot:breadcrumbs>

    <h1 class="w-full align-middle text-2xl font-bold mb-6 text-textgray dark:text-white">Tender Vendors</h1>

    <div class="overflow-x-auto rounded-xl">
        <table class="table border border-base-200">
            <thead>
                <tr class="bg-base-200">
                    <th>No</th>
                    <th>Vendor name</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenderVendors as $key => $tenderVendor)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td class="group cursor-pointer">
                            <a class="group-hover:underline" href="{{ route('tenders.vendors.show', [$tender->id, $tenderVendor->id]) }}">{{ $tenderVendor->vendor->name }}</a>
                        </td>
                        <td class="whitespace-nowrap">{{ $tenderVendor->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-dashboard>
