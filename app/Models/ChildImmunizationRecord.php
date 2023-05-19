<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildImmunizationRecord extends Model
{
    use HasFactory;

    protected $table = "child_immunization_record";
    protected $fillable = [
        'child_id',
        'immunization_index',        
        'dose0',
        'dose1',
        'dose2',
        'dose3',
        'dose4',
        'dose5',
        'dose6',
        'dose7',
        'dose8',
        'dose9',
    ];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    }
}
