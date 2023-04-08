<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CurrentDateAfterOrEqual implements ValidationRule
{
    public function __construct(private $param = null) {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $parseDate = Carbon::createFromFormat('Y-m-d', $value)->startOfDay();

            if ($parseDate->gt(Carbon::now()->startOfDay())) {
                $fail('The :attribute must be less current date.');
            }

            if(!empty($this->param)) {
                $parseParamDate = Carbon::createFromFormat('Y-m-d', request($this->param))->startOfDay();

                if ($parseDate->gt($parseParamDate->startOfDay())) {
                    $fail('The :attribute must be less or equal to '.str_replace('_', ' ', $this->param).'.');
                }

            }
        } catch (\Exception $e) {
            $fail('The :attribute is invalid date.');
        }

    }
}
