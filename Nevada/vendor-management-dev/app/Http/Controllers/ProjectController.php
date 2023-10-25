<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Helpers\ReportHelper;
use App\Http\Requests\Project\NeedClosingProjectRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectRequest $request): View
    {
        $search = $request->search;
        $status = $request->status;
        $perPage = $request->perpage ?? 10;
        $order = $request->order ?? 'asc';
        $sort = $request->sort ?? 'created_at';

        $projects = Project::where(function (Builder $query) use($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('job', 'like', "%$search%")
                    ->orWhere('user_company', 'like', "%$search%")
                    ->orWhere('pic_company', 'like', "%$search%")
                    ->orWhere('contract_date', 'like', "%$search%");
            })
            ->where('status', 'like', "%$status%")
            ->orderBy($sort, $order);

        // Show projects with a certain status at the top
        if (!$request->search &&
            !$request->status &&
            !$request->order &&
            !$request->sort) {

            /** @var App\Models\User $user */
            $user = Auth::user();

            if ($user->hasRole(['Logistik', 'Chief Logistik'])) {
                $projects = $projects->where('status', '!=', 'Need PO & SPK');
                $projects = Project::where('status', 'Need PO & SPK')->get()
                    ->merge($projects->get());
            } else if ($user->hasRole('Finance')) {
                $projects = $projects->where('status', '!=', 'Need Closing');
                $projects = Project::where('status', 'Need Closing')->get()
                    ->merge($projects->get());
            }
        }

        $projects = $projects->paginate($perPage)
            ->withQueryString();

        return view('dashboard.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $ams = User::whereHas('roles', function($q) {
            $q->where('name', 'Account Manager')->orWhere('name', 'CAM');
        })->get();

        return view('dashboard.projects.create', ['ams' => $ams]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($request->files as $file => $val) {
            if ($request->file($file)) {
                $validated[$file] = $request->file($file)
                    ->store("documents/projects/$file");
            }
        }

        $project = Project::create($validated);

        // Create project report
        ReportHelper::create($project, 'Create project', 'New Project');

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        return view('dashboard.projects.detail', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        $ams = User::whereHas('roles', function($q) {
            $q->where('name', 'Account Manager')->orWhere('name', 'CAM');
        })->get();

        return view('dashboard.projects.edit', [
            'project' => $project,
            'ams' => $ams
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($request->files as $file => $val) {
            if ($request->file($file)) {
                $validated[$file] = $request->file($file)
                    ->store("documents/projects/$file");
            }
        }

        $project->update($validated);

        // Create project report
        ReportHelper::create($project, 'Edit project');

        return redirect('/projects')
            ->with('success', 'Project edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        Storage::delete([
            $project->tor_vendor_doc ?? '',
            $project->boq_final_vendor ?? '',
            $project->evaluation_project_doc ?? '',
            $project->ba_reconciliation_doc ?? '',
            $project->bast_doc ?? '',
        ]);

        $project->delete();

        return back()->with('success', 'Project deleted successfully');
    }

    /**
     * View need closing project.
     */
    public function needClosing(Project $project): View
    {
        return view('dashboard.projects.needclosing', ['project' => $project]);
    }

    /**
     * Update project status to Need Closing.
     */
    public function closing(NeedClosingProjectRequest $request, Project $project): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($request->files as $file => $val) {
            $validated[$file] = $request->file($file)
                ->store("documents/projects/$file");
        }

        $validated['status'] = 'Need Closing';

        $project->update($validated);

        // Create project report
        ReportHelper::create($project, 'Need closing', 'Need Closing');

        // Update evaluation status
        $project->tender->evaluations->where('approval', 'Approved')
            ->first()->update(['status' => 'Need Closing']);

        // create notification
        $routeToPayment = route('projects.payment.create', $project->id);
        $routeToProject = route('projects.show', $project->id);

        $notification = new NotificationHelper(
            'Project Needs Payment Updates',
            "There is project {$project->name} which needs payment updates.<br><br>
            <a href=\"{$routeToProject}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">See project</a><br><br>
            <a href=\"{$routeToPayment}\" class=\"btn px-10 bg-purple hover:bg-purpledarker text-white rounded-full normal-case transition-all\">Create payment</a>"
        );

        $notification->sendTo('Finance');

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project status updated successfully');
    }

    /**
     * Update project status to Completed.
     */
    public function complete(Project $project): RedirectResponse
    {
        // Create project report
        ReportHelper::create($project, 'Complete project', 'Completed');

        $project->update(['status' => 'Completed']);
        return back()->with('success', 'Project completed successfully');
    }

    /**
     * Show project reports page.
     */
    public function report(Project $project): View
    {
        $projectReports = $project->reports()->with('user')->latest()->get();
        $reports = [
            'New Project' => [],
            'Tender on Process' => [],
            'Need Evaluation' => [],
            'Need PO & SPK' => [],
            'Need Closing' => [],
            'Payment Updated' => [],
            'Completed' => [],
        ];

        foreach ($projectReports as $report) {
            array_push($reports[$report->status], $report);
        }

        return view('dashboard.projects.report', [
            'project' => $project,
            'reports' => $reports,
        ]);
    }
}
