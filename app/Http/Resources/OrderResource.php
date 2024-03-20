<?php

namespace App\Http\Resources;

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
        $products = is_array($this->products) ? $this->products : [$this->products];
        $productsCount = count((array)$this->products) ?? 0;

        return [
            'id' => $this->id,
            'external_id' => $this->externalId ?? '',
            'confirmed' => $this->confirmed ?? '',
            'shipping_method' => $this->shippingMethod ?? '',
            'total_products' => $productsCount,
            $this->mergeWhen($request->user()?->isAdmin(), [
                'currency' => $this->currency ?? '',
                //w treści zadania jest order_sum — kwota opłacona brutto, a paid — wartość zamówienia brutto. W dokumentacji Atom jest na odwrót. Traktuję to jako błąd nazewnictwa w zadaniu bo nazwy z Atom są bardzie adekwatne :)
                'order_sum' => $this->order_sum ?? '',
                'paid' => $this->paid ?? '',
                'username' => $this->client->username ?? ''
            ]),
            'products' => new ProductsCollection($products),

        ];
    }
}
