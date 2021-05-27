<?php 

namespace App\Http\Services;
use App\Models\Share;
use Illuminate\Http\Request;
use App\Http\Services\FinnhubApiService;

class ShareService
{
    private FinnhubApiService $finnhubApiService;

    public function __construct(FinnhubApiService $finnhubApiService)
    {
        $this->finnhubApiService = $finnhubApiService;
    }
    public function getShares(Request $request)
    {
        $symbol = $request->symbol;
        $amount = $request->amount;
        $accountId = $request->accountId;
        $stock = $this->finnhubApiService->getStock($symbol);
        $share = Share::where('stock_symbol', $symbol)->where('account_id', $accountId)->first();
        
        // IF ALREADY BOUGHT
        if ($share != null)
        {
            $lastPrice = $share->price_bought;
            $share->current_price = $stock->c;
            $sub = $stock->c - $lastPrice;
            $diff = round(($sub / $share->price_bought) * 100, 2);
            $share->difference = $diff;
            $share->current_investment = $share->current_investment + ($stock->c * $amount);
            $share->amount += $amount;
            $share->difference = $diff;
            $share->save();
            return Share::where('account_id', $accountId)->get();

        } 

        // IF NEW STOCK
        else 
        {
            $share = new Share;
            $currentInvestment = $stock->c * $amount;
            $share->current_investment = $currentInvestment;
            $share->price_bought = $stock->c;
            $share->stock_symbol = $symbol;
            $share->account_id = $accountId;
            $share->current_price = $stock->c;
            $share->amount = $amount;
            $share->difference = 0;
            $share->save();

            return Share::where('account_id', $accountId)->get();
        }
    }
}

?>