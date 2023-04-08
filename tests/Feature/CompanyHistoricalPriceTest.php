<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

use App\Models\Company;

class CompanyHistoricalPriceTest extends TestCase
{
    /**
     * Landing page form of company historical prices.
     */
    public function test_the_company_historical_price_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Form validation of date.
     */
    public function test_validate_form_response(): void
    {
        $faker = \Faker\Factory::create();

        $company = Company::where('symbol', 'AMRN')->first();

        // Validation of future date both start and end date
        $payload = [
            'company_symbol' => $company->id,
            'start_date' => Carbon::now()->addDay()->format('d/m/Y'),
            'end_date' => Carbon::now()->addDays(2)->format('d/m/Y'),
            'email' => $faker->email()
        ];

        $response = $this->post('/historical-quotes', $payload);

        $response->assertStatus(302);

        // Validation of future date of end date
        $payload = [
            'company_symbol' => $company->id,
            'start_date' => Carbon::now()->format('d/m/Y'),
            'end_date' => Carbon::now()->addDays(2)->format('d/m/Y'),
            'email' => $faker->email()
        ];

        $response = $this->post('/historical-quotes', $payload);

        $response->assertStatus(302);


        //Validate the date of start date greater than end date
        $payload = [
            'company_symbol' => $company->id,
            'start_date' => Carbon::now()->format('d/m/Y'),
            'end_date' => Carbon::now()->addDays(-2)->format('d/m/Y'),
            'email' => $faker->email()
        ];

        $response = $this->post('/historical-quotes', $payload);

        $response->assertStatus(302);

        //Validation of required field
        $payload = [
            'company_symbol' => '',
            'start_date' => '',
            'end_date' => '',
            'email' => ''
        ];

        $response = $this->post('/historical-quotes', $payload);

        $response->assertStatus(302);

        //Validate invalid company symbol
        $payload = [
            'company_symbol' => random_int(100000, 999999),
            'start_date' => Carbon::now()->addDays(-3)->format('d/m/Y'),
            'end_date' => Carbon::now()->addDays(-2)->format('d/m/Y'),
            'email' => $faker->email()
        ];

        $response = $this->post('/historical-quotes', $payload);

        $response->assertStatus(302);

        //Validate the date of current - With all valid data
        $payload = [
            'company_symbol' => $company->id,
            'start_date' => Carbon::now()->addDays(-3)->format('d/m/Y'),
            'end_date' => Carbon::now()->addDays(-2)->format('d/m/Y'),
            'email' => $faker->email()
        ];

        $response = $this->post('/historical-quotes', $payload);

        $response->assertStatus(200);
    }
}
