<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Plank\Metable\Metable;

use App\Models\User;

class StaffReview extends Model
{
    use Metable;

    protected $fillable = [
        'date_completed',
        'completed_by',
        'yearly_review',
        'title',
        'overall_score'
    ];

    protected $casts = [
        'overall_score' => 'integer',
    ];

    public function getReadableDateCompletedAttribute()
    {
        return carbon($this->date_completed)->format('m-d-Y');
    }

    public function scopeStaff($query, User $staff)
    {
        $query->where('staff_id', $staff->id);
    }

    public function completedBy()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function setCoTeacherEvaluation(array $evaluations): void
    {
        $this->syncMeta($evaluations);
    }

    public function setDirectorEvaluation(array $evaluations): void
    {
        $this->syncMeta($evaluations);
    }
}
