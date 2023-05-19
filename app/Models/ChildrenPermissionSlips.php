<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenPermissionSlips extends Model
{
    use HasFactory;

    protected $table = "child_permision_slips";
    protected $fillable = [
        'child_id',
        'allow_put_sunscreen',
        'allow_use_hand_sanitizer'
    ];


    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 
}
