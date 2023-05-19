<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class EmployeeEducation extends Model
{
    use HasFactory;

    protected $table = "educations";
    protected $fillable = ['user_id', 'school_name', 'school_address', 'grade_completed', 'graduate_date', 'semester_hours_completed', 'degree_earned'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /*
    |--------------------------------------------------------------------------
    | Eloquent Accessors
    |--------------------------------------------------------------------------
    */
    public function getGraduateDateAttribute ($value)
    {
        return carbon($this->attributes['graduate_date'])->format('m/d/Y');
    }
}
