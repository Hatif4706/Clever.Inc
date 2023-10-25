<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Helpers\ReportHelper;
use App\Http\Requests\PoSpk\ApprovePoSpkRequest;
use App\Http\Requests\PoSpk\NeedPoSpkRequest;
use App\Http\Requests\PoSpk\StorePoSpkRequest;
use App\Models\PoSpk;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PoSpkController extends Controller
{

    /**
     * Show page need PO & SPK.
     */
    public function need(Project $project): View
    {
        return view('dashboard.projects.needpospk', ['project' => $project]);
    }

    /**
     * Update project status to need PO & SPK.
     */
    public function require(NeedPoSpkRequest $request, Project $project): RedirectResponse
    {
        foreach ($request->files as $file => $val) {
            $documents[$file] = $request->file($file)
                ->store("documents/projects/$file");
        }

        $project->update([
            'status' => 'Need PO & SPK',
            'tor_doc_status' => 'Available',
            'tor_vendor_doc' => $documents['tor_vendor_doc'],
            'boq_final_vendor' => $documents['boq_final_vendor'],
        ]);

        // Update evaluation status
        $project->tender->evaluations->where('approval', 'Approved')
            ->first()->update(['status' => 'Need PO & SPK']);

        // Create project report
        ReportHelper::create($project, 'Need PO & SPK', 'Need PO & SPK');

        // create notification
        $routeToPoSpk = route('projects.po-spk.create', $project->id);
        $routeToProject = route('projects.show', $project->id);

        $notification = new NotificationHelper(
            'Project Need PO & SPK',
            "There is project {$project->name} which needs PO & SPK.<br><br>
            <a href=\"{$routeToProject}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">Review TOR & BOQ project</a><br><br>
            <a href=\"{$routeToPoSpk}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">Create PO & SPK</a>"
        );

        $notification->sendTo('Logistik', 'Chief Logistik');

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project status updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project): View
    {
        $vendor = $project->tender->evaluations->where('approval', 'Approved')
            ->first()->tenderVendor->vendor;

        // Create project report
        ReportHelper::create($project, 'Create PO & SPK');

        return view('dashboard.projects.createpospk', [
            'project' => $project,
            'vendor' => $vendor,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePoSpkRequest $request, Project $project): RedirectResponse
    {
        $poSpkDoc = $request->file('pospk_doc')
            ->store('documents/po_spks/pospk_doc');

        if ($project->poSpk) {
            $project->poSpk->update([
                'approval' => null,
                'pospk_doc' => $poSpkDoc
            ]);
        } else {
            PoSpk::create([
                'project_id' => $project->id,
                'vendor_id' => $request->vendor_id,
                'pospk_doc' => $poSpkDoc
            ]);
        }

        // Update evaluation status
        $project->tender->evaluations->where('approval', 'Approved')
            ->first()->update(['status' => 'Need Approval PO & SPK']);

        // create notification
        $routeToPoSpk = route('projects.po-spk.show', $project->id);

        $notification = new NotificationHelper(
            'PO & SPK need approval',
            "The PO and SPK documents on the {$project->name} project are need approval, you can approve or reject the PO & SPK.<br><br>
            <a href=\"{$routeToPoSpk}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">Review PO & SPK</a><br><br>"
        );

        $notification->sendTo('Chief Logistik');

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'PO & SPK created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        return view('dashboard.projects.pospk', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function approve(ApprovePoSpkRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();

        $project->poSpk->update($validated);

        if ($request->approval === 'Approved') {

            // Create project report
            ReportHelper::create($project, 'Approve PO & SPK');

            $project->update(['po_doc_status' => 'Available']);
            return back()->with('success', 'PO & SPK approved successfully');
        }

        // create notification
        $routeToCreatePoSpk = route('projects.po-spk.create', $project->id);
        $routeToPoSpk = route('projects.po-spk.show', $project->id);

        $notification = new NotificationHelper(
            'PO & SPK Documents are rejected',
            "The PO and SPK documents on the {$project->name} project are rejected, you can re-create the PO & SPK documents.<br><br>
            <a href=\"{$routeToPoSpk}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">See the reason</a><br><br>
            <a href=\"{$routeToCreatePoSpk}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">Create PO & SPK</a>"
        );

        $notification->sendTo('Logistik', 'Chief Logistik');

        return back()->with('success', 'PO & SPK rejected successfully');

    }
}
