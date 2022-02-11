<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class RequireValidator extends AbstractValidator
{

    public string $message = 'Поле :field обязательно.';

    public function rule(): bool
    {
        return !empty($this->value);
    }
}
