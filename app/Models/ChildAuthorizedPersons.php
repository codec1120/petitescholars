<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildAuthorizedPersons extends Model
{
    use HasFactory;

    protected $table = "child_authorized_persons";
    protected $fillable = [
        'child_id',
        'selected_emergency_contact',
        'first_name',
        'last_name' ,
        'phone_number',  
        'phone_number_type',  
    ];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    }
}
