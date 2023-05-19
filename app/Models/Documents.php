<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_type',
        'doc_status',
        'doc_owner_ident'
    ];

    public function uploadedDocuments()
    {
        return $this->hasMany(UploadedDocuments::class, 'doc_id');
    }
}
