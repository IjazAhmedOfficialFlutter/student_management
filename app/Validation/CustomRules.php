<?php

namespace App\Validation;

class CustomRules
{

public function multiLang(?string $str): bool
{
    if ($str === null || trim($str) === '') {
        return true;
    }

    return preg_match(
        "/^[\p{L}\p{M}\p{N}\s.,،'()\-\/&#:]+$/u",
        trim($str)
    ) === 1;
}
}