<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;

use App\Http\Services\SearchService;

class SearchController extends Controller
{
    public function presearch(SearchRequest $request, SearchService $service){
        $validated = $request->validated();
        return $service->presearch($validated);
    }

    public function search(SearchRequest $request, SearchService $service){
        $validated = $request->validated();

        $result = $service->search($validated);
        if ($result){
            return response($service->successSearch($result), 200);
        }
        return response(['message' => 'Ошибка при обращении к серверу'], 422);
    }
}
