<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class EmergencyContact extends Model
{
    use HasFactory;
    
    protected $table = "emergency_contact";
    protected $fillable = ['completed','user_id', 'date_of_submission', 'staff_allergies', 'staff_reaction_allergies', 'staff_medication', 'staff_medical_conditions', 'actions_needed_to_medical_conditions', 'staff_medical_insurance', 'staff_policy_number'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
