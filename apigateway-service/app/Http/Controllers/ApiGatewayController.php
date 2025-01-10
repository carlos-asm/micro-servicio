<?php

namespace App\Http\Controllers;

use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ApiGatewayController extends Controller
{



    public function login(Request $request)
    {
        try{
            $response = Http::retry(3,500)
            ->timeout(60000)->post(env('AUTH_SERVICE_URL').'/api/v1/auth/login',$request->all());
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->timeout(60000)->post(env('AUTH_SERVICE_URL').'/api/v1/auth/logout',$request->all());
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function checkToken(Request $request)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $token = str_replace('Bearer ', '', $token);

            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));

            return response()->json(['data' => $decoded]);
        } catch (ExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }
    }

    public function getRecipes(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->get(env('KITCHEN_SERVICE_URL').'/api/v1/orders/recipes');
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()],$ex->getCode());
        }
    }

    public function getOrderHistory(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->get(env('KITCHEN_SERVICE_URL').'/api/v1/orders/purchase-history');
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()],$ex->getCode());
        }
    }

    public function products(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->get(env('KITCHEN_SERVICE_URL').'/api/v1/products');
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()],$ex->getCode());
        }
    }

    public function getOrderWithStatusReceived(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->get(env('KITCHEN_SERVICE_URL').'/api/v1/orders/received');
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()],$ex->getCode());
        }
    }
    public function createOrder(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->get(env('KITCHEN_SERVICE_URL').'/api/v1/orders/create-order');
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()],$ex->getCode());
        }
    }

    public function getPurchaseHistory(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->get(env('STORE_SERVICE_URL').'/api/v1/inventory/purchase-history');
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()],$ex->getCode());
        }
    }

    public function getavailableIngredients(Request $request)
    {
        try{
            $headers = $request->headers->all();
            $response = Http::withHeaders($headers)
            ->retry(3,500)
            ->get(env('STORE_SERVICE_URL').'/api/v1/inventory');
            return $response->json();
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()],$ex->getCode());
        }
    }


}
