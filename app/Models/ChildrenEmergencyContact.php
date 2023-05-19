<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ChildrenEmergencyContact extends Model
{
    use HasFactory;

    protected $table = "child_emergency_contacts";
    protected $fillable = [
        'child_id',
        'first_name',
        'last_name', 
        'birthdate', 
        'relationship', 
        'phone_number',
        'email'
    ];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 
    
}
