<?php

namespace App\Http\Controllers;

use App\Jobs\ProductLiked;
use App\Models\ProductUser;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function like($id, Request $request) {
       $response = Http::get("http://admin-app_admin_1:8000/api/user");

       $user = $response->json();

       try {
           $productUser = ProductUser::create([
               'user_id' => $user['id'],
               'product_id' => $id
           ]);

           ProductLiked::dispatch($productUser->toArray())->onQueue('admin_queue');;

           return response([
               'message' => 'success'
           ]);
       } catch (\Exception $exception) {
            return response([
                'error' => 'You already liked this product!'
            ], Response::HTTP_BAD_REQUEST);
       }

    }
}
