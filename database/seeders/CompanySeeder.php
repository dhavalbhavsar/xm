<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::truncate();

        $apiCompanies = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json')->json();

        $companies = array_map(function ($company) {
            return [
                'companyName' => $company['Company Name'],
                'financialStatus' => $company['Financial Status'],
                'marketCategory' => $company['Market Category'],
                'roundLotSize' => $company['Round Lot Size'],
                'securityName' => $company['Security Name'],
                'symbol' => $company['Symbol'],
                'testIssue' => $company['Test Issue'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }, $apiCompanies);

        Company::insert($companies);

    }
}
