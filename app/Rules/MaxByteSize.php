<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxByteSize implements ValidationRule
{
    protected $maxBytes;

    public function __construct($maxBytes)
    {
        $this->maxBytes = $maxBytes;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) > $this->maxBytes) {
            $fail('The :attribute must not be greater than ' . ($this->maxBytes / 1024) . ' kilobytes.');
        }
    }
}
