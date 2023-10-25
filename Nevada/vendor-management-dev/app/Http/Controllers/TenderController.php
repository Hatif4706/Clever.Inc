<?php

namespace App\Http\Controllers;

use App\Helpers\ReportHelper;
use App\Http\Requests\Tender\StoreTenderRequest;
use App\Http\Requests\Tender\TenderRequest;
use App\Http\Requests\Tender\UpdateTenderRequest;
use App\Models\Project;
use App\Models\Tender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TenderRequest $request): View
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $isVendor = $user->hasRole('Vendor');

        if ($isVendor && $user->vendor->status !== 'Verified') {
            return view('dashboard.vendors.notverified');
        }

        $search = $request->search;
        $status = $request->status;
        $perPage = $request->perpage ?? 10;
        $order = $request->order ?? 'asc';
        $sort = $request->sort ?? 'created_at';

        $tenders = Tender::with('project')
            ->where(function (Builder $query) use($search) {
                $query->whereHas('project', function($q) use($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhere('date_start', 'like', "%$search%")
                ->orWhere('date_end', 'like', "%$search%");
            });

        $tenders = $isVendor
            ? $tenders->where('status', 'Open')
                ->where('date_end', '>=', date('Y-m-d'))
                ->where('date_start', '<=', date('Y-m-d'))
            : $tenders->where('status', 'like', "%$status%");

        function orderByProjectName() {
            return Project::select('name')
                ->wherecolumn('projects.id', 'tenders.project_id')
                ->latest()
                ->take(1);
        }

        if ($sort == 'project_name') {
            $tenders = $order == 'asc'
                ? $tenders->orderBy(orderByProjectName())
                : $tenders->orderByDesc(orderByProjectName());
        } else {
            $tenders = $tenders->orderBy($sort, $order);
        }

        $tenders = $tenders->paginate($perPage)->withQueryString();

        return view('dashboard.tenders.index', ['tenders' => $tenders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $projects = Project::where('status', 'New Project')->get();
        return view('dashboard.tenders.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($request->files as $file => $val) {
            $validated[$file] = $request->file($file)
                ->store("documents/tenders/$file");
        }

        $project = Project::find($validated['project_id']);
        $project->update(['status' => 'Tender on process']);

        Tender::create($validated);

        // Create project report
        ReportHelper::create($project, 'Create tender');

        return redirect()
            ->route('tenders.index')
            ->with('success', 'Project tendered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tender $tender): View
    {
        /** @var App\Models\User $user */
        $user = Auth::user();
        $isVendor = $user->hasRole('Vendor');

        if ($isVendor && $user->vendor->status !== 'Verified') {
            return view('dashboard.vendors.notverified');
        }

        return view('dashboard.tenders.detail', ['tender' => $tender]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tender $tender): View
    {
        return view('dashboard.tenders.edit', ['tender' => $tender]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenderRequest $request, Tender $tender): RedirectResponse
    {
        $validated = $request->validated();

        foreach ($request->files as $file => $val) {
            $validated[$file] = $request->file($file)
                ->store("documents/tenders/$file");
        }

        $tender->update($validated);

        // Create project report
        ReportHelper::create($tender->project, 'Edit tender');

        return redirect()->route('tenders.index')
            ->with('success', 'Tender edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender): RedirectResponse
    {
        Storage::delete([
            $tender->tor_doc ?? '',
            $tender->support_doc ?? '',
        ]);

        $tender->delete();

        return back()->with('success', 'Tender deleted successfully');
    }
}
