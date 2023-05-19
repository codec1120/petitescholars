<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class HandbookAgreement extends Model
{
    use HasFactory;

    protected $table = "handbook_agreements";
    protected $fillable = ['user_id', 'date_signed_disclosure_agreement'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setDateAgreementSignedAttribute ( $value ) {
        $this->attributes['date_signed_disclosure_agreement'] = ensure_date_format( $value );
    }
}
