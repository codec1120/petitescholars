<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenMedicalInformation extends Model
{
    use HasFactory;

    protected $table = "children_medical_informations";
    protected $fillable = [
        'child_id',
        'physician_name',
        'physician_number',
        'physician_address',
        'physician_city',
        'physician_state',
        'physician_zip',
        'child_held_insurance_provider',
        'insurance_policy_number',
        'allergies',
        'prescribe_medication',
        'special_needs',
        'suffer_from',
    ];


    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 
}
