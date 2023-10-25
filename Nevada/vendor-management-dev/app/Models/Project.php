<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tender(): HasOne
    {
        return $this->hasOne(Tender::class);
    }

    public function picAM(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assign_pic_am');
    }

    public function poSpk(): HasOne
    {
        return $this->hasOne(PoSpk::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
