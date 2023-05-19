<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildImmunizationInformations extends Model
{
    use HasFactory;

    protected $table = "child_immunization_informations";
    protected $fillable = [
        'child_id',
        'date',
        'immunization_index',
        'selected_immunization_dosage',
    ];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    }
}
