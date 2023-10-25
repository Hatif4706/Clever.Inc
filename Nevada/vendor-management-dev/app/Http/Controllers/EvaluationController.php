<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Helpers\ReportHelper;
use App\Http\Requests\Evaluation\ApproveEvaluationRequest;
use App\Http\Requests\Evaluation\StoreEvaluationRequest;
use App\Models\Tender;
use App\Models\TenderProjectEvaluation;
use App\Models\TenderVendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tender $tender): View
    {
        $evaluations = $tender->evaluations()->with('tenderVendor.vendor')->get();
        $approvedFirst = [];
        $rejectedOrPending = [];

        foreach ($evaluations as $evaluation) {
            $evaluation->approval !== 'Approved'
                ? array_push($rejectedOrPending, $evaluation)
                : array_push($approvedFirst, $evaluation);
        }

        array_push($approvedFirst, ...$rejectedOrPending);

        return view('dashboard.tenders.evaluations.index', [
            'evaluations' => $approvedFirst,
            'tender' => $tender,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Tender $tender): View
    {
        $tenderVendors = TenderVendor::with('vendor')
            ->where('tender_id', $tender->id)
            ->doesntHave('evaluation')
            ->get();

        return view('dashboard.tenders.evaluations.create', [
            'tenderVendors' => $tenderVendors,
            'tender' => $tender,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluationRequest $request, Tender $tender): RedirectResponse
    {
        $validated = $request->validated();

        $validated['technical_evaluation_doc'] = $request
            ->file('technical_evaluation_doc')
            ->store('documents/tender_project_evaluation/technical_evaluation_doc');

        foreach ($validated['tender_vendor_ids'] as $tenderVendorId) {
            TenderProjectEvaluation::create([
                'tender_id' => $tender->id,
                'tender_vendor_id' => $tenderVendorId,
                'technical_evaluation_doc' => $validated['technical_evaluation_doc'],
            ]);
        }

        $tender->project->update(['status' => 'Need Evaluation']);

        // Create project report
        ReportHelper::create($tender->project, 'Create evaluation', 'Need Evaluation');

        // create notification
        $routeToEvaluation = route('tenders.evaluations.index', $tender->id);

        $notification = new NotificationHelper(
            'Approval Evaluation Tender Project',
            "There is an evaluation which needs approval on tender project {$tender->project->name}.<br><br>
            <a href=\"{$routeToEvaluation}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">Review evaluation</a>"
        );

        $notification->sendTo('CAM');

        return redirect()
            ->route('tenders.evaluations.index', $tender->id)
            ->with('success', 'Evaluation created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tender $tender, TenderProjectEvaluation $evaluation): View
    {
        return view('dashboard.tenders.evaluations.detail', [
            'evaluation' => $evaluation,
            'tender' => $tender,
            'project' => $tender->project,
            'vendor' => $evaluation->tenderVendor->vendor,
        ]);
    }

    /**
     * Approve tender project evaluation.
     */
    public function approve(ApproveEvaluationRequest $request, Tender $tender, TenderProjectEvaluation $evaluation): RedirectResponse
    {
        $validated = $request->validated();

        if ($tender->status === 'Closed') {
            return back();
        }

        if ($request->approval !== 'Approved'
            && $request->approval !== 'Rejected') {
            return back();
        }

        $evaluation->update($validated);

        if ($validated['approval'] === 'Approved') {
            // Create project report
            ReportHelper::create($tender->project, 'Approve evaluation', 'Need Evaluation');
            $tender->update(['status' => 'Closed']);
        }

        return back()->with('success', 'Evaluation approval updated successfully');
    }
}
