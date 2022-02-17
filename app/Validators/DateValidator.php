<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{

    public string $message = 'Чтобы продолжить Вам должно быть не менее 18ти лет.';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }
        return (bool)preg_match('/^(192[2-9]|19[3-9][0-9]|200[0-4])-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $this->value);
    }
}
