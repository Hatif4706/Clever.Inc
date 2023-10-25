<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DocumentTemplate extends Model
{
    use HasFactory;

    protected $table = "template_document";
    
    protected $fillable = [
        'id',
        'template_name', 
        'template_description', 
        'func', 
        'template_file_name'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
