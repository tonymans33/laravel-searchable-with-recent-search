<?php

namespace Tonymans33\SearchableWithRecent;

interface Searchable
{
    public function getSearchResult(): SearchResult;
}
