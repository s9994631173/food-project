<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;

use App\Http\Services\SearchService;

class SearchController extends Controller
{
    public function presearch(SearchRequest $request){
        $validated = $request->validated();
        return SearchService::presearch($validated);
    }

    public function search(SearchRequest $request){
        $validated = $request->validated();

        $result = SearchService::search($validated);
        if ($result){
            return response(SearchService::successSearch($result), 200);
        }
        return response(['message' => 'Ошибка при обращении к серверу'], 422);
    }
}
