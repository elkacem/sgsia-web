<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasApiTokens;

//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array<int, string>
//     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'is_admin',
    ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static function getSingle($id){
        return self::find($id);
    }

    static function getUser(){
        return self::select('id', 'name', 'username', 'email', 'is_admin', 'created_at')->orderBy('created_at', 'desc')->get();
    }

    public function surveys()
    {
        return $this->hasMany(Surveys::class);

    }

    public function surveydepart()
    {
        return $this->hasMany(Surveydepart::class);

    }

    public function passagerarrive()
    {
        return $this->hasMany(PassagerArrive::class);

    }
}
