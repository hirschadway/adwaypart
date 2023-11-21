<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'main_id'=>$this->mainproduct_id,
            'shop_id'=>$this->shop_id,
            'kalas'=>KalaResource::collection($this->kalas),
            'groups'=>CategorizedproductResource::collection($this->categorizedproducts),
            'name'=>$this->name,
            'images'=>$this->img,
            'link'=>$this->link,
            'price'=>$this->price,
            'situation'=>(bool) $this->situation,
            'properties'=>$this->properties,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
