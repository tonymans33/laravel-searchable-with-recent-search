<?php

namespace Tonymans33\SearchableWithRecent;

class SearchResult
{
    /** @var \Tonymans33\SearchableWithRecent\Searchable */
    public $searchable;

    /** @var string */
    public $title;

    /** @var null|string */
    public $url;

    /** @var string */
    public $type;

    public function __construct(Searchable $searchable, string $title, ?string $url = null)
    {
        $this->searchable = $searchable;

        $this->title = $title;

        $this->url = $url;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
