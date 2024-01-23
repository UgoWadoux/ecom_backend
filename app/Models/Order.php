<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'user_id',
        'deliver',
        'service_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function service ():BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
