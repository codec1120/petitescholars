<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildAuthorizedAdults extends Model
{
    use HasFactory;

    protected $table = "child_authorized_adults_pickups";
    protected $fillable = ['child_id', 'first_name', 'last_name', 'phone_number', 'absentee_first_name', 'absentee_last_name', 'absentee_phone_number', 'absentee_address'];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    }
}
