<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperService
 */
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
    public function orders():HasMany
    {
        return  $this->hasMany(Order::class);
    }
}
