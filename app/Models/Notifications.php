<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'reminder',
        'emailMessage',
        'field_name'
    ];
}
