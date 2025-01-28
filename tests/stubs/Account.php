<?php

namespace Tonymans33\SearchableWithRecent\Tests\stubs;

use Tonymans33\SearchableWithRecent\Searchable;
use Tonymans33\SearchableWithRecent\SearchResult;

class Account implements Searchable
{
    /** @var string */
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult($this, $this->name);
    }
}
