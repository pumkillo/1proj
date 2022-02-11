<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{

    public string $message = 'Введите верную дату.';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }
        return (bool)preg_match('/^(192[2-9]|19[3-9][0-9]|200[0-4])-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $this->value);
    }
}
