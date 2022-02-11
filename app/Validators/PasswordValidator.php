<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PasswordValidator extends AbstractValidator
{

    public string $message = 'Пароль должен содержать как минимум 8 и как максимум 25 символов.<br>Пароль должен содержать заглавные и прописные символы английского алфавита, а также цифры.';

    public function rule(): bool
    {
        if (empty($this->value)) {
            return true;
        }
        return (bool)preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,25}$/', $this->value);
    }
}
