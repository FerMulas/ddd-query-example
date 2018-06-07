<?php

namespace Common\Domain\ArraySort;

class FieldNotFoundSortException extends \DomainException
{
    public static function withField(string $field)
    {
        return new self("Can't sort by provided field due to: 'Field " . $field . " not found.'");
    }
}