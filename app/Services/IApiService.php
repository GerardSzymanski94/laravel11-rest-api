<?php

namespace App\Services;
use stdClass;

interface IApiService
{
    public function getOrders(): stdClass;
    public function getOrder(int $id): stdClass;
    public function getProduct(string $code): stdClass;
}
