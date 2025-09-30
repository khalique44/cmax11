<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    CONST ADMIN = 'admin';
    CONST MEMBER = 'member';
    CONST VENDOR = 'vendor';
    CONST THOMAS = 'Thomas Bardin';

    protected $dates = ['deleted_at'];
    
    use Notifiable, SoftDeletes;

    protected $fillable = ['type','first_name', 'middle_name', 'last_name', 'email','username', 'password', 'phone', 'gender','mobile_number','whatsapp_number',
                            'date_of_birth', 'address_1', 'address_2', 'country', 'state', 'city', 'district_id', 'last_year_member',
                            'registration_type_id', 'registration_year', 'membership_token', 'ack', 'qr_code', 'profile_pic_url',
                            'facebook_url', 'twitter_url', 'remember_token','active','status','is_admin_user','is_paid','is_verified','is_imported','apartment_id'
                        ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latest();
    }

    public function scopeVerified($query){
        return $query->where('is_verified',true)->get();
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function userstate()
    {
        return $this->belongsTo(State::class,'state','id');
    }

    public function usercountry()
    {
        return $this->belongsTo(Country::class,'country','id');
    }
    public function cat()
    {
        return $this->belongsTo(Category::class,'category','id');
    }
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
    }

    public function getAvatarAttribute(){
        $default_image = url('public/assets/images/default-dp.png');
        if(is_null($this->profile_pic_url ) || !file_exists(public_path().'/assets/images/'.$this->profile_pic_url))
        {
            return $default_image;
        }
        else{
            return url('public/assets/images/',$this->profile_pic_url);
        }
    }

    public function contests(){
        return $this->belongsToMany(Contest::class, 'attendees','user_id','contest_id')
            ->withPivot('id')
            ->withPivot('status')
            ->withPivot('is_verify')
            ->withPivot('save_for')
            ->withPivot('is_attendee')
            ->withPivot('qr_code')
            ->withTimestamps();
    }

    public function registration_type(){
        return $this->belongsTo(RegistrationType::class);
    }

    public function reported_issues(){
        return $this->hasOne(ReportedIssues::class,'user_id','id');
    }

    public function laundry_booking(){
        return $this->hasOne(LaundryBooking::class,'user_id','id');
    }

    public static function isVendor(){
        return auth()->user()->type == User::VENDOR;
    }

    public static function isMember(){
        return auth()->user()->type == User::MEMBER;
    }

    public function logs(){
        return $this->hasOne(LogsActivity::class,'user_id','id');
    }
}
