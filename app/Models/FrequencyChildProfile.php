<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequencyChildProfile extends Model
{
    use HasFactory;

    protected $table = 'frequency_child_profile';
    protected $fillable = [
        'doc_type',
        'activity',
        'frequency',
        'frequency_type',
    ];
}
