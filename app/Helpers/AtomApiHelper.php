<?php

namespace App\Helpers;

use App\Services\AtomStoreService;

class AtomApiHelper{

    public static function getProductImages(string $code): string
    {
        $product = (new AtomStoreService())->getProduct($code);
        $images = [];
        foreach ($product->product?->images as $image){
            $images[] = $image->url;
        }
        return implode(',', $images);
    }

    public static function createProductArray($product): array{

        $images = self::getProductImages($product->code);

        return [
            'code' => $product->code ?? '',
            'quantity' => $product->quantity ?? 0,
            'images' => $images
        ];
    }
}
