<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Plank\Metable\Metable;
use Plank\Mediable\Mediable;

class ChildInformation extends Model
{
    use HasFactory, SoftDeletes, Metable;

    protected $table = "child_informations";
    protected $fillable = [
            'user_id',
            'first_name', 
            'last_name', 
            'birthdate', 
            'sex', 
            'home_address', 
            'city', 
            'state', 
            'zip', 
            'completed_registration_steps', 
            'status', 
            'docusign_envelop_id'
        ];
    
    public function getChildGuardians () {
        return $this->hasMany(ChildGuardian::class, 'child_id');   
    }

    public function getChildAuthorizedAdults () {
        return $this->hasMany(ChildAuthorizedAdults::class, 'child_id');   
    }
    
    public function getChildEmergencyContact () {
        return $this->hasMany(ChildrenEmergencyContact::class, 'child_id');
    }

    public function getChildMedicalInformation () {
        return $this->hasOne(ChildrenMedicalInformation::class, 'child_id');
    }

    public function getPermissionSlips () {
        return $this->hasOne(ChildrenPermissionSlips::class, 'child_id');
    }

    public function getFeeAgreement () {
        return $this->hasOne(ChildFeeAgreement::class, 'child_id');
    }

    public function getRelativeInformations () {
        return $this->hasMany(ChildRelativesInformation::class, 'child_id');
    }

    public function getFamilyQuestionaire () {
        return $this->hasOne(ChildFamilyQuestionaire::class, 'child_id');
    }

    public function getParentSignedHandbook () {
        return $this->hasOne(ChildParentHandbook::class, 'child_id');
    }

    public function getPhotographPermission ()
    {
        return $this->hasMany(ChildrenPhotographPermissionSlip::class, 'child_id');   
    }

    public function getImmunization ()
    {
        return $this->hasMany(ChildImmunizationInformations::class, 'child_id');   
    }

    public function getFathersInfo ()
    {
        return $this->hasOne(ChildrensFather::class, 'child_id');   
    }

    public function getMothersInfo ()
    {
        return $this->hasOne(ChildrensMother::class, 'child_id');   
    }

    public function getEmergencyContactPersons ()
    {
        return $this->hasMany(ChildEmergencyContactPersons::class, 'child_id');   
    }

    public function getAuthorizePersons ()
    {
        return $this->hasMany(ChildAuthorizedPersons::class, 'child_id');   
    }
}
