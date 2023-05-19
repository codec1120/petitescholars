<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\EmergencyContact;

class EmergencyContactDetails extends Model
{
    use HasFactory;

    protected $table = "emergency_contact_details";
    protected $fillable = [
        'emergency_contact_name', 
        'emergency_home_phone', 
        'emergency_work_phone', 
        'emergency_cell_phone', 
        'emergency_relation_to_staff', 
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
