<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Product $resource
 */
class ProductRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'price' => $this->resource->price,
            'description' => $this->resource->description,
            'image'=> $this->resource->image,
            'category' => new CategoryRessource($this->resource->category),
            'quantity' => $this->whenPivotLoaded('order_product', function () {
                return $this->pivot->quantity;
            }),
            'sum_products' => $this->whenPivotLoaded('order_product', function () {
                return $this->pivot->quantity * $this->resource->price;
            })
        ];
    }
}
