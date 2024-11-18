<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected $forbidden;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct(array $forbidden)
    {
        $this->forbidden = array_map('strtolower',$forbidden);
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void //attribute is fiels name
                                                                                   //value is the value from user
                                                                                   //fail is error message
    {
        if(in_array(strtolower($value), $this->forbidden)) {
            $fail("The :attribute is not allowed");
        }
    }
}
