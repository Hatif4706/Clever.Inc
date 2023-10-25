<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PoSpk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function project(): BelongsTo {
        return $this->belongsTo(Project::class);
    }

    public function vendor(): BelongsTo {
        return $this->belongsTo(Vendor::class);
    }
}
