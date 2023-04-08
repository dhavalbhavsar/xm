<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
class YahooFinanceService
{
    private $historicalData = [];

    public function __construct(private $rapidApiKey = null){
    }

    public function historicalData($companySymbol, $region = 'US') {
        $this->historicalData = Http::withHeaders([
            'X-RapidAPI-Key' => $this->rapidApiKey,
            'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com'
        ])->get("https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data", [
            'symbol' => $companySymbol,
            'region' => $region
        ])->json();

        return $this;
    }

    public function getHistoricalData() {
        return $this->historicalData;
    }

    public function filterByDate(int $startDate, int $endDate) {
        $chart = [
            'open' => [],
            'close' => []
        ];

        $historyPrices = collect($this->historicalData['prices'])->whereBetween('date', [$startDate, $endDate])->sortBy('date')->map(function ($historyPrice) use(&$chart){

            //Chart format data
            $chart['open'][] = [
                'date' => Carbon::createFromTimestamp($historyPrice['date'])->format('Y-m-d'),
                'price' => $historyPrice['open']
            ];

            $chart['close'][] = [
                'date' => Carbon::createFromTimestamp($historyPrice['date'])->format('Y-m-d'),
                'price' => $historyPrice['close']
            ];

            return [
                ...$historyPrice,
                'date' => Carbon::createFromTimestamp($historyPrice['date'])->format('Y-m-d')
            ];
        });

        return [
            'history_prices' => $historyPrices,
            'chart' => $chart
        ];
    }

}
