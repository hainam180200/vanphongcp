<?php

namespace App\Models;

use App\Notifications\MailResetPasswordToken;
use App\Traits\Metable;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use HasRoles;
    use Metable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'account_type',
        'email',
        'email_verified_at',
        'password',
        'password2',
        'is_change_password2',
        'google2fa_secret',
        'google2fa_enable',
        'balance',
        'balance_in',
        'balance_out',
        'image',
        'cover',
        'firstname',
        'lastname',
        'fullname',
        'url_display',
        'phone',
        'birtday',
        'gender',
        'address',
        'status',
        'verify_code',
        'verify_code_expired_at',
        'is_verify',
        'odp_code',
        'odp_expired_at',
        'odp_active',
        'odp_fail',
        'last_add_balance',
        'last_minus_balance',
        'lastlogin_at',
        'lastlogout_at',
        'created_by',
        'created_at',

    ];


    protected $meta_field = [
        'avatar',
        'cover',
        'follower',
        'booking_quantity',
        'booking_complete_rate',
        'camera',
        'voice',
        'mic',
        'game_play',
        'album_image',
        'album_video',
        'album_timeline',
        'is_online',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'password2',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function checkBalanceValid()
    {
        if($this->balance<0){
            return false;
        }

        if ($this->balance_in - $this->balance_out - $this->balance == 0) {
            return true;
        } else {
            return false;
        }
    }


    //send mail recover password
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    //hash Google2faSecret
    public function setGoogle2faSecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = encrypt($value);
    }

    public function getGoogle2faSecretAttribute($value)
    {
        if ($value == "") {
            return "";
        }
        return decrypt($value);
    }


    public function setCreatedAtAttribute($value)
    {

        if ($this->verifyDate($value, 'd/m/Y H:i:s')) {
            $this->attributes['created_at'] = Carbon::createFromFormat('d/m/Y H:i:s', $value);;
        } else {
            $this->attributes['created_at'] = Carbon::now();
        }
    }

    function verifyDate($value, $format)
    {
        return (DateTime::createFromFormat($format, $value) !== false);
    }


    public function txns()
    {
        return $this->hasMany(Txns::class);
    }


    public static function boot()
    {
        parent::boot();
        //set default auto add  scope to query
        static::addGlobalScope('global_scope', function (Builder $model) {
            $model->where('users.shop_id', session('shop_id')??1);
        });
        static::saving(function ($model) {
            $model->shop_id = session('shop_id')??1;
        });

        static::creating(function ($model) {
            $model->url_display =  md5("P@ZZ".$model->email);
        });

    }
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
    //1. Check balance valid
    //2. Check số tiền giao dịch  nhở hơn số dự tài khoản
    //3. Check số tiền giao dịch nhỏ <0
    //4. Check giao money limit < số tiền cài đặt giới hạn ( nếu có)

}
