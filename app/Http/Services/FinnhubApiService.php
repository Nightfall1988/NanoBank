<?php
namespace App\Http\Services;

use App\Models\Share;

class FinnhubApiService
{
    public function getStock($symbol)
    {
        $httpClient = new \GuzzleHttp\Client();
        $request =
            $httpClient
                ->get("https://finnhub.io/api/v1/quote?symbol={$symbol}&token=c2lqataad3ice2ne4sh0");

        $response = json_decode($request->getBody()->getContents());        
        return $response;
    }
}
