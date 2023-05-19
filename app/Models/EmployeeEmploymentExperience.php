<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class EmployeeEmploymentExperience extends Model
{
    use HasFactory;
    
    protected $table = "employment_experiences";
    protected $fillable = [
        'employer', 
        'user_id', 
        'employer_address', 
        'job_description', 
        'employment_start_date', 
        'employment_end_date',
        'cnt',
        'job_title'
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
     /*
    |--------------------------------------------------------------------------
    | Eloquent Accessors
    |--------------------------------------------------------------------------
    */
    public function getEmploymentStartDateAttribute()
    {
        return carbon($this->attributes['employment_start_date'])->format('m/d/Y');
    }

    public function getEmploymentEndDateAttribute()
    {
        return carbon($this->attributes['employment_end_date'])->format('m/d/Y');
    }
}
