<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildImmunization extends Model
{
    use HasFactory;

    protected $table = "child_immunization";
    protected $fillable = [
        'child_id',
        'dose_1age_month',
        'dose_1age_year',
        'dose_2age_month',
        'dose_2age_year',
        'dose_3age_month',
        'dose_3age_year',
        'immunization_index',
        'selected_immunization_dosage'         
    ];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    }
}
