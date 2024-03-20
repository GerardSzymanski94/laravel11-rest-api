<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class OrderDetailsResource extends OrderResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $details = [
            'shipping_first_name' => $this->client->shippingFirstName ?? '',
            'shipping_last_name' => $this->client->shippingLastName ?? '',
            'shipping_company' => $this->client->shippingCompany ?? '',
            'shipping_street' => $this->client->shippingStreet ?? '',
            'shipping_street_number_1' => $this->client->shippingStreetNumber1 ?? '',
            'shipping_street_number_2' => $this->client->shippingStreetNumber2 ?? '',
            'shipping_post_code' => $this->client->shippingPostCode ?? '',
            'shipping_city' => $this->client->shippingCity ?? '',
            'shipping_state_code' => $this->client->shippingStateCode ?? '',
            'shipping_state' => $this->client->shippingState ?? '',
            'shipping_country_code' => $this->client->shippingCountryCode ?? '',
            'shipping_country' => $this->client->shippingCountry ?? '',
        ];

        return [...parent::toArray($request), ...$details];
    }
}
