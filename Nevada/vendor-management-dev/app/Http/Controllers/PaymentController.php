<?php

namespace App\Http\Controllers;

use App\Helpers\ReportHelper;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project): View
    {
        return view('dashboard.projects.createpayment', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request, Project $project): RedirectResponse
    {
        $bast = $request->file('bast_doc')->store("documents/projects/bast_doc");

        Payment::create([
            'project_id' => $project->id,
            'payment_date' => $request->payment_date,
        ]);

        $project->update([
            'status' => 'Payment Updated',
            'payment_status' => 'Done',
            'bast_doc' => $bast,
        ]);

        // Create project report
        ReportHelper::create($project, 'Create payment', 'Payment Updated');

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Payment updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        return view('dashboard.projects.payment', ['project' => $project]);
    }
}
