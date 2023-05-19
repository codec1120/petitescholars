<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrensMother extends Model
{
    use HasFactory;

    protected $table = "childrens_mother";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'phone_type',
        'home_address',
        'home_city',
        'home_state',
        'home_zip',
        'businesss_employer',
        'work_phone',
        'work_address',
        'work_city',
        'work_state',
        'work_zip',
        'primary_guardian',
        'secondary_guardian',
        'child_id',
        'sameAsChildAddress'
    ];



    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 
}
