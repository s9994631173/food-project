<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Products;

class ProductController extends Controller
{
    public function update (ProductRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $result = Products::upd($validated);
        if ($result){
            return response('success', 200);
        }
        return response('error', 422);
    }

    public function delete (ProductRequest $request){
        $validated = $request->validated();

        $result = Products::del($validated);
        if ($result){
            return response('success', 200);
        }
        return response('error', 422);
    }
    
    public function new (ProductRequest $request){
        $validated = $request->validated();

        $validated['user_id'] = $request->user()->id;
        $validated['date'] = date("Y-m-d", strtotime($validated['date']));

        $result = Products::new($validated);
        if ($result){
            return response($result, 200);
        }
        return response('error', 422);
    }
}
