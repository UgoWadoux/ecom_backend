<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperBlog
 */
class Blog extends Model
{
    use HasFactory, HasUuids;

protected $fillable = [
    'content',
    'user_id',
];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
