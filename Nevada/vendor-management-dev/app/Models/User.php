<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasFactory, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function notifications(): BelongsToMany
    {
        return $this->belongsToMany(Notification::class)->withPivot('is_readed', 'id');
    }

    public function vendor(): HasOne
    {
        return $this->hasOne(Vendor::class);
    }

    
    
    public function createdDocumentTemplates()
    {
        return $this->hasMany(DocumentTemplate::class, 'created_by');
    }

    public function updatedDocumentTemplates()
    {
        return $this->hasMany(DocumentTemplate::class, 'updated_by');
    }

    
    
    /**
     * Do not use this method!, Use $user->roles[0] instead.
     *
     * @deprecated
     */
    public function role(): Role
    {
        return $this->roles()->first();
    }
}

