<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

//    Defining the primary key as string
    protected $keyType = 'string';
//    Tell the model not to use the incrementing system
    public $incrementing = false;
    public static function booted(): void
    {
        static::creating(function ($model){
            $model->id = Str::uuid();
        });
    }



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

    public function services():HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function blogs():HasMany
    {
        return $this->hasMany(Blog::class);
    }
    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('comment');
    }
}
