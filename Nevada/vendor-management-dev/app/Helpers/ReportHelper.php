<?php

namespace App\Helpers;

use App\Models\Project;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportHelper {

    public static function create(
        Project $project,
        string $action,
        ?string $status = null
    ): void {

        $user = Auth::user();
        Report::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'action' => $action,
            'status' => $status ?? $project->status
        ]);
    }
}
