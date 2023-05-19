<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Metable\Metable;
use Plank\Mediable\Mediable;

use App\Traits\HasRole;
use App\Traits\WithStaffRole;

use App\Models\EmployeeEducation;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Metable;
    use SoftDeletes;
    use Mediable;

    // Internal Traits
    use HasRole;
    use WithStaffRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /*
    |--------------------------------------------------------------------------
    | Eloquent Accessors
    |--------------------------------------------------------------------------
    */

    public function getSystemIdAttribute()
    {
        return "{$this->role_initial}{$this->id}";
    }

    public function getRoleInitialAttribute()
    {
        return strtoupper($this->role[0]);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function getFirstNameAttribute()
    {
        return ucfirst($this->attributes['first_name']);
    }

    public function getLastNameAttribute()
    {
        return ucfirst($this->attributes['last_name']);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function scopeUniqueEmail($query, $email, $id)
    {
        $query->where('email', $email)
            ->where('id', '!=', $id);
    }

    public function scopeSearch($query, $search)
    {
        $query->when(
            $search,
            fn ($query) =>
            $query->where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('last_name', 'LIKE', "%{$search}%")
        );
    }

    public function scopeUserRole($query, $role)
    {
        $query->when(
            $role,
            fn ($query) => $query->where('role', $role)
        );
    }

    public function scopeRoles($query, array $roles)
    {
        $query->when(
            collect($roles)->isNotEmpty(),
            fn ($query) => $query->whereIn('role', $roles)
        );
    }

    public function storagePath(): string
    {
        return "users/{$this->system_id}";
    }

    public function invalidTitle(): bool
    {
        return StaffTitle::where('value', $this->title)->count() <= 0;
    }

    public function getEmployeeEducation () {
        return $this->hasOne(EmployeeEducation::class);
    }
    
    public function getEmployeeEmploymentExperience () {
        return $this->hasMany(EmployeeEmploymentExperience::class);
    }

    public function getEmployeeInfo () {
        return $this->hasOne(EmployeeInfo::class);
    }

    public function getEmployeePresentPosition () {
        return $this->hasOne(EmployeePresentPosition::class);
    }

    public function getDisclosureAgreement () {
        return $this->hasOne(DisclosureAgreement::class);
    }

    public function getHandbookAgreement () {
        return $this->hasOne(HandbookAgreement::class);
    }

    public function getEmergencyContact () {
        return $this->hasOne(EmergencyContact::class);   
    }

    public function getEmergencyContactDetails () {
        return $this->hasMany(EmergencyContactDetails::class, 'user_id');   
    }

    public function getParentData () {
        return $this->hasOne(ParentFormData::class);   
    }

    public function getChild () {
        return $this->hasMany(ChildInformation::class, 'user_id');   
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&color=7F9CF5&background=EBF4FF';
    }

    protected function profilePhotoDisk()
    {
        return 'spaces';
    }
}
