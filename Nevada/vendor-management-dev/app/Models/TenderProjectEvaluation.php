<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenderProjectEvaluation extends Model
{
    use HasFactory;

    protected $table = 'tender_project_evaluation';

    protected $guarded = ['id'];

    public function tender(): BelongsTo {
        return $this->belongsTo(Tender::class);
    }

    public function tenderVendor(): BelongsTo {
        return $this->belongsTo(TenderVendor::class);
    }
}
