<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Services\YahooFinanceService;

class ValidateYahooFinanceServiceTest extends TestCase
{
    CONST DEFAULT_COMPANY_SYMBOL = 'AMRN';

    /**
     * Validate API key of Yahoo finance service.
     */
    public function test_validate_yahoo_finance_service(): void
    {
        //For empty Rapid key validation for fail
        $yahooService = new YahooFinanceService();
        $historicalData = $yahooService->historicalData(self::DEFAULT_COMPANY_SYMBOL)->getHistoricalData();

        $this->assertEquals(array_key_exists('message', $historicalData), true);

        //With Valid Rapid API Key
        $yahooService = new YahooFinanceService(env('RAPID_API_KEY'));
        $historicalData = $yahooService->historicalData(self::DEFAULT_COMPANY_SYMBOL)->getHistoricalData();

        $this->assertEquals(array_key_exists('prices', $historicalData), true);

        //Validate with date filter
        $startDate = Carbon::now()->addDays(-4)->startOfDay()->timestamp;
        $endDate = Carbon::now()->addDays(-1)->endOfDay()->timestamp;

        $yahooService = new YahooFinanceService(env('RAPID_API_KEY'));
        $histories = $yahooService->historicalData(self::DEFAULT_COMPANY_SYMBOL)->filterByDate($startDate, $endDate);

        foreach ($histories['history_prices'] as $historyPrice) {
            $priceDate = Carbon::createFromFormat('d/m/Y', $historyPrice['date'])->startOfDay()->timestamp;
            if($startDate <= $priceDate && $endDate >= $priceDate){
                $this->assertTrue(true);
            } else {
                $this->assertTrue(false);
            }
        }

    }
}
