<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $keyType = 'string';
//    Tell the model not to use the incrementing system
    public $incrementing = false;
    public static function booted(): void
    {
        static::creating(function ($model){
            $model->id = Str::uuid();
        });
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
