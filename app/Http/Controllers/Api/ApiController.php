<?php

namespace App\Http\Controllers\Api;

use App\Enums\ApiStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailsResource;
use App\Http\Resources\OrdersCollection;
use App\Services\AtomStoreService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiController extends Controller
{
    public function orders(): JsonResponse|OrdersCollection
    {
        try{
            $orders = (new AtomStoreService())->getOrders();
            return new OrdersCollection($orders->order);
        }catch (Exception $e){
            return response()->json([
                'status' => ApiStatusEnum::ERROR,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function order(int $id): JsonResponse|AnonymousResourceCollection
    {
        try{
            $order = (new AtomStoreService())->getOrder($id);
            if(!$order || empty($order) || !isset($order->order)){
                return response()->json([
                    'status' => ApiStatusEnum::ERROR,
                    'message' => 'Order not found'
                ], 404);
            }

            $order = is_array($order->order) ? $order->order : [$order->order];
            return OrderDetailsResource::collection($order);
        }catch (Exception $e){
            return response()->json([
                'status' => ApiStatusEnum::ERROR,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
