<?php
namespace App\Http\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

include 'simple_html_dom.php';

class SearchService{
    public function presearch($item){
        $response = Http::asForm()->post('https://calorizator.ru/search/load', [
            'search' => $item['product'],
        ]);
        return $response;
    }

    public function search($item){
        $prod_id = $item['prod_id'];
        try{
            $response = Http::retry(3, 100)->get("https://calorizator.ru/search/result/p/{$prod_id}");
        }catch(RequestException $e){
            return false;
        }

        $html = str_get_html($response);

        $test = $html->find('div[class=field field-type-number-decimal field-field-kcal]', 0);

        if ($test){
            return $html;
        }
        return false;
    }

    public function successSearch($html){
        $name = $html->find('h1[id=page-title]', 0)->innertext();

        $KKAL = $html->find('div[class=field field-type-number-decimal field-field-kcal]', 0)->innertext();
        $KKAL = preg_replace("/[^.0-9]/", '', $KKAL);

        $proteins = $html->find('div[class=field field-type-number-decimal field-field-protein]', 0)->innertext();
        $proteins = preg_replace("/[^.0-9]/", '', $proteins);

        $fats = $html->find('div[class=field field-type-number-decimal field-field-fat]', 0)->innertext();
        $fats = preg_replace("/[^.0-9]/", '', $fats);

        $carbohydrates = $html->find('div[class=field field-type-number-decimal field-field-carbohydrate]', 0)->innertext();
        $carbohydrates = preg_replace("/[^.0-9]/", '', $carbohydrates);

        return [
            'product' => $name,
            'KKAL' => floatval($KKAL),
            'pr' => floatval($proteins),
            'ft' => floatval($fats),
            'cb' => floatval($carbohydrates)
        ];
    }
}