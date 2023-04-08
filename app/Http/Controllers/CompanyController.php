<?php

namespace App\Http\Controllers;

use App\Services\YahooFinanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Mail\HistoricalPriceEmail;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    //Service with dependencies injection
    public function __construct(protected YahooFinanceService $historyService)
    {
    }

    //Show form
    public function index() {
        $companies = Company::pluck( 'symbol', 'id')->prepend('Select Symbol', '');
        return view('company.form', compact('companies'));
    }

    //Generate Historical Quotes
    public function historicalQuotes(StoreCompanyRequest $request) {
        $data = $request->only('company_symbol', 'start_date', 'end_date', 'email');

        $company = Company::find($data['company_symbol']);

        $startDate = Carbon::createFromFormat('Y-m-d', $data['start_date'])->startOfDay()->timestamp;
        $endDate = Carbon::createFromFormat('Y-m-d', $data['end_date'])->endOfDay()->timestamp;

        $histories = $this->historyService->historicalData($company->symbol)->filterByDate($startDate, $endDate);

        //Send Email

        Mail::to('testreceiver@gmail.com’')->send(new HistoricalPriceEmail($company, $histories['history_prices'], $data));

        return view('company.historical', compact('histories', 'company', 'data'));
    }
}
