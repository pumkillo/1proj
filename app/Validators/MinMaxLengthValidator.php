<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MinMaxLengthvalidator extends AbstractValidator
{

    public string $message = '';

    public function rule(): bool
    {
        $this->message = 'Поле :field должно содержать минимум ' . $this->args[1] . ' и максимум ' . $this->args[2] . ' символов.';
        if (empty($this->value)) {
            return true;
        }
        return (bool)preg_match('/^[а-яА-Яa-zA-Z\d]{' . $this->args[1] . ',' . $this->args[2] . '}$/u', $this->value);
    }
}
