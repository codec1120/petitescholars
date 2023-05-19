<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildParentHandbook extends Model
{
    use HasFactory;

    protected $table = "child_parent_handbook";
    protected $fillable = ['child_id', 'signed_date'];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    }
}
