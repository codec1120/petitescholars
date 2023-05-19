<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildFamilyQuestionaire extends Model
{
    use HasFactory;

    protected $table = "child_family_questionaire";
    protected $fillable = [
        'child_id',
        'cultural_bg',
        'language',
        'family_celebrate_occasions',
        'daycare_bg',
        'daycare_bg_name',
        'daycare_bg_phone_number',
        'daycare_bg_address',
        'daycare_bg_start_date',
        'daycare_bg_end_date',
        'daycare_bg_reason_termination',
        'daycare_bg_contact_reference',
        'eating_habits',
        'child_drink',
        'special_diet',
        'child_food_refrain',
        'hours_of_sleep',
        'bed_time',
        'nap_days',
        'nickname'
    ];

    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 

}
