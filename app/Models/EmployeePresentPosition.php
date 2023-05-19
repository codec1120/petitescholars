<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class EmployeePresentPosition extends Model
{
    use HasFactory;

    protected $table = "present_positions";
    protected $fillable = ['date_start', 'user_id', 'days_week_available_for_work', 'hours_available_for_work'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    /*
    |--------------------------------------------------------------------------
    | Eloquent Accessors
    |--------------------------------------------------------------------------
    */
    public function getDateStartAttribute()
    {
        return carbon($this->attributes['date_start'])->format('m/d/Y');
    }

}
