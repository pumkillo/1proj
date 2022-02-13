<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class EnglishOnlyValidator extends AbstractValidator
{

    public string $message = 'Поле :field должно содеражть символы только английского алфавита.';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }
        return (bool)preg_match('/[a-zA-Z\d]$/', $this->value);
    }
}
