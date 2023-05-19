<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImmunizationConfigurations extends Model
{
    use HasFactory;
    protected $table = 'immunization_configurations';
    protected $fillable = [
        'dose_age_month',
        'dose_age_year',
        'immunization_index',
        'selected_immunization_dosage',
    ];
}
