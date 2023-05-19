<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildRelativesInformation extends Model
{
    use HasFactory;

    protected $table = "child_relative_informations";
    protected $fillable = [
        'child_id',
        'family_name',
        'relationship',
        'age',
        'pet_species'
    ];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 
}
