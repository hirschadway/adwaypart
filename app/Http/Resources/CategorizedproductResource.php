<?php

namespace App\Http\Resources;

use App\Models\Kalagroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorizedproductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array

    {

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'kalagroup_id' => $this->kalagroup_id,
            'situation' => $this->situation,
            'price' => $this->price,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
        ];
    }
}
