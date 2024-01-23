<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $order_sum = null;
        foreach ($this->resource->products as $product) {
            $order_sum += $product->price * $product->pivot->quantity;
        }

//        dd($order_sum);
        return [
            'id' => $this->resource->id,
            'deliver' => $this->resource->deliver,
            'user' => new UserResource($this->resource->user),
            'products' => ProductRessource::collection($this->resource->products),
            'order_sum' => $order_sum,
            'service' => new ServiceResource($this->resource->service)
        ];
    }
}
