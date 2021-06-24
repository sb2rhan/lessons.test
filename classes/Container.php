<?php

require_once __DIR__ . '/BaseTag.php';

// final - no child classes
final class Container extends BaseTag
{
    function __construct(array $attrs = [])
    {
        parent::__construct('section', $attrs);
        $this->attr('class', 'container');
    }

    public function getName(): Name
    {
        throw new LogicException("Cannot change container's name");
    }
}