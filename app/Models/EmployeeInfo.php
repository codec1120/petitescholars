<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class EmployeeInfo extends Model
{
    use HasFactory;

    protected $table = "employee_infos";
    protected $fillable = ['address', 'user_id', 'phone_number', 'dob', 'date_submitted'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    /*
    |--------------------------------------------------------------------------
    | Eloquent Accessors
    |--------------------------------------------------------------------------
    */
    public function getDobAttribute ($value)
    {
        return carbon($this->attributes['dob'])->format('m/d/Y');
    }
}
