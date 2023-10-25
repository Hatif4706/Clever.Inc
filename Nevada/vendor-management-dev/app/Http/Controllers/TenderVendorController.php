<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenderVendor\TenderVendorJoinRequest;
use App\Models\Tender;
use App\Models\TenderVendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TenderVendorController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Tender $tender): View
    {
        $tenderVendors = TenderVendor::with('vendor')
            ->where('tender_id', $tender->id)->get();

        return view('dashboard.tenders.vendors.index', [
            'tenderVendors' => $tenderVendors,
            'tender' => $tender,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tender $tender, TenderVendor $tenderVendor): View
    {
        return view('dashboard.tenders.vendors.detail', [
            'tenderVendor' => $tenderVendor,
            'tender' => $tender,
        ]);
    }

    /**
     * Display the join resource form.
     */
    public function join(Tender $tender): View
    {
        return view('dashboard.tenders.join', ['tender' => $tender]);
    }

    /**
     * Request to join tender.
     */
    public function enter(TenderVendorJoinRequest $request, Tender $tender): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($request->files as $file => $val) {
            $validated[$file] = $request->file($file)
                ->store("documents/tender_vendor/$file");
        }

        TenderVendor::create([
            'tender_id' => $tender->id,
            'vendor_id' => Auth::user()->vendor->id,
            'proposal_doc' => $validated['proposal_doc'],
            'boq_doc' => $validated['boq_doc'],
        ]);

        return redirect()->route('tenders.show', $tender->id)
            ->with('success', 'Join requested successfully');
    }

    /**
     * Display a listing of the tender vendor history.
     */
    public function histories(): View
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $isVendor = $user->hasRole('Vendor');

        if ($isVendor && $user->vendor->status !== 'Verified') {
            return view('dashboard.vendors.notverified');
        }

        $tenderVendors = TenderVendor::where(
            'vendor_id', Auth::user()->vendor->id
        )->paginate(10);

        return view('dashboard.tenders.histories.index', [
            'tenderVendors' => $tenderVendors
        ]);
    }

     /**
     * Display the detail of tender vendor/evaluation history.
     */
    public function history(TenderVendor $tenderVendor): View
    {
        return view('dashboard.tenders.histories.detail', [
            'tenderVendor' => $tenderVendor,
        ]);
    }

}
