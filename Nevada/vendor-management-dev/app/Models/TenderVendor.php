<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TenderVendor extends Model
{
    use HasFactory;

    protected $table = 'tender_vendor';

    protected $guarded = ['id'];

    public function tender(): BelongsTo
    {
        return $this->belongsTo(Tender::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function evaluation(): HasOne
    {
        return $this->hasOne(TenderProjectEvaluation::class);
    }
}
