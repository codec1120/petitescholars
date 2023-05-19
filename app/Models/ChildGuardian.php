<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ChildInformation;

class ChildGuardian extends Model
{
    use HasFactory;

    protected $table = "child_guardians";
    protected $fillable = ['child_id', 'first_name', 'last_name', 'phone_number_1', 'phone_type_1', 'home_address', 'city', 'state', 'zip', 'primary_guardian', 'sameAsChildAddress' , 'email_address'];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    }

    public function getGuardianChild () {
        return $this->hasMany( ChildInformation::class, 'id' );
    }

}
