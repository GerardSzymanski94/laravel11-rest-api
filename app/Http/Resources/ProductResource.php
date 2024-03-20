<?php

namespace App\Http\Resources;

use App\Helpers\AtomApiHelper;
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
        return AtomApiHelper::createProductArray($this);
    }
}
