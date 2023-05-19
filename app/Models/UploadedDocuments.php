<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_id',
        'doc_file_title',
        'default_file'
    ];

    public function documents()
    {
        return $this->belongsTo(Documents::class, 'doc_id');
    }

    // Scopes
    public function scopeGetDefaultFile($query)
    {
        return $query->where('default_file', 1);
    }
}
