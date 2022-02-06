<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class RequireValidator extends AbstractValidator
{

   protected string $message = 'Это поле обязательно';

   public function rule(): bool
   {
       return !empty($this->value);
   }
}
