<?php

// namespace App\Http\Controllers;
// use App\Http\Services\Currencies\Import\ImportCurrenciesService;
// use App\Models\Currency;

// class CurrencyController extends Controller
// {
//     public function __construct(ImportCurrenciesService $importCurrenciesService) 
//     {
//         $this->importCurrenciesService = $importCurrenciesService;
//     }

//     public function home()
//     {
//         $symbolArray = [];
//         foreach (Currency::all() as $currency) {
//             $symbolArray[] = $currency->symbol; 
//         }
//         return view('conversionPage', compact('symbolArray'));
//     }

//     public function show()
//     {
//         $amount = request('amount');
//         $symbol = request('currencies');
//         $currency = $this->showCurrencyService->execute(
//             new ShowCurrencyRequest($symbol)
//         );
//         $convertedRate = $this->showCurrencyService->convert($currency, $amount);
        
//         return view('resultPage', compact('convertedRate'));
//     }
// }
