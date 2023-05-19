<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildFeeAgreement extends Model
{
    use HasFactory;

    protected $table = "child_fee_agreements";
    protected $fillable = [
        'child_id',
        'payee',
        'other_payee_first_name',
        'other_payee_last_name',
        'other_payee_address',
        'other_payee_city',
        'other_payee_state',
        'other_payee_zip',
        'other_payee_phone_number',
        'other_payee_phone_type',
        'other_payee_email_address',
    ];



    public function ChildInformation() {
        return $this->belongsTo(ChildInformation::class, 'child_id');
    } 
}
