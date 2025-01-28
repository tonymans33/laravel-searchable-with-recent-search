<?php

namespace Tonymans33\SearchableWithRecent\Exceptions;

use Exception;

class InvalidModelSearchAspect extends Exception
{
    public static function noSearchableAttributes(string $model): self
    {
        return new self("Model search aspect for `{$model}` doesn't have any searchable attributes.");
    }
}
