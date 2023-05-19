<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\HasProfilePhoto;

use App\Models\User;

class ParentFormData extends Model
{
    use HasFactory, SoftDeletes, HasProfilePhoto;

    protected $table = "parents";

    protected $fillable = ['first_name', 'last_name', 'phone_number_1', 'phone_type_1', 
                            'phone_number_2', 'phone_type_2', 'email_address', 'profile_type', 
                            'status', 'password', 'user_id', 'address', 'city', 'zip', 'state'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
    */
    protected $hidden = [
        'password',
    ];

    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function user() {
        return $this->belongsTo(User::class);
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
