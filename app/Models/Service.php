<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory, HasUuids;


protected $fillable = [
    'user_id',
    'name',
    'price',
    'area',
];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
