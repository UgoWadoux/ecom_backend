<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperComment
 */
class Comment extends Pivot
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'comment'
    ];
    protected $table = 'product_user';

}
