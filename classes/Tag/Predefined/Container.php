<?php

namespace App\Tag\Predefined;

// final - no child classes
use App\BaseTag;

final class Container extends BaseTag
{
    function __construct(array $attrs = [])
    {
        parent::__construct('section', $attrs);
        $this->attr('class', 'container');
    }

}