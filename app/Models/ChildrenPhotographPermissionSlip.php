<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenPhotographPermissionSlip extends Model
{
    use HasFactory;

    protected $table = "children_photograph_permissions";
    protected $fillable = [
        'child_id',
        'question_index',
        'question_answer'
    ];

    public function user() 
    {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 
}
