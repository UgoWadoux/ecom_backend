<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
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
    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
