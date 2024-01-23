<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->resource->id,
            'comment'=>$this->resource->comment,
            'user_id'=>$this->resource->user_id,
//            'user'=>  UserResource::make(User::find($this->resource->user_id)),

            'product_id'=>$this->resource->product_id
        ];
    }
}
