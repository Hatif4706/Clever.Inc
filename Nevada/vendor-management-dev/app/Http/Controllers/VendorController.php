<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vendor\UpdateVendorRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Vendor\VendorRequest;
use App\Http\Requests\Vendor\VerifyVendorRequest;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VendorRequest $request): View
    {
        $search = $request->search;
        $status = $request->status;
        $perPage = $request->perpage ?? 10;
        $order = $request->order ?? 'asc';
        $sort = $request->sort ?? 'created_at';

        $vendors = Vendor::where(function (Builder $query) use($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('website', 'like', "%$search%")
                    ->orWhere('bank_reference', 'like', "%$search%")
                    ->orWhere('company_email', 'like', "%$search%");
            })
            ->where('status', 'like', "$status%")
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('dashboard.vendors.index', ['vendors' => $vendors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor): View
    {
        return view('dashboard.vendors.detail', ['vendor' => $vendor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor): View
    {
        return view('dashboard.vendors.edit', ['vendor' => $vendor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($request->files as $file => $val) {
            if ($request->file($file)) {
                $validated[$file] = $request->file($file)
                    ->store("documents/vendors/$file");
            }
        }

        $vendor->update($validated);

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor edited successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor): RedirectResponse
    {
        Storage::delete([
            $vendor->incorporation_deed ?? '',
            $vendor->approval_deed ?? '',
            $vendor->siup ?? '',
            $vendor->registration_cert ?? '',
            $vendor->annual_spt_proof ?? '',
            $vendor->submission_pph_ssp_proof ?? '',
            $vendor->pkp_npwp ?? '',
            $vendor->domicile_letter ?? '',
            $vendor->company_profile ?? '',
        ]);

        $vendor->user->delete();
        $vendor->delete();

        return back()->with('success', 'Vendor deleted successfully');
    }

    /**
     * Verify new vendor.
     */
    public function verify(VerifyVendorRequest $request, Vendor $vendor): RedirectResponse
    {
        if ($vendor->status !== 'New') return back();

        $vendor->update([
            'rejection_reason' => $request->rejection_reason,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Vendor verify successfully');
    }

}
