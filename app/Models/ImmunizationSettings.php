<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImmunizationSettings extends Model
{
    use HasFactory;

    protected $table = "immunization_settings";
    
    protected $fillable = [
        'dose_1age_month',
        'dose_1age_year',
        'dose_2age_month',
        'dose_2age_year',
        'dose_3age_month',
        'dose_3age_year',
        'immunization_index',
        'selected_immunization_dosage',
    ];
}
