<?php

use JetBrains\PhpStorm\Pure;

require_once __DIR__ . './BaseTag.php';

class Body
{
    protected BaseTag $parent;
    protected array $body = [];

    function __construct(BaseTag $parent)
    {
        $this->parent = $parent;
    }

    function getParent(): BaseTag {
        return $this->parent;
    }

    function get(): array {
        return $this->body;
    }

    function set($value): static
    {
        if ($this->getParent()->isSelfClosing())
            throw new LogicException('Tag is self closing');

        if (!is_array($value))
            $value = [$value];

        $this->body = $value;
        return $this;
    }

    /**
     * Value should be and object type not string to modify it in future
     * @param $value
     * @return $this
     */
    function append($value): static
    {
        $old = $this->get();
        $old[] = $value;
        return $this->set($old);
    }

    function prepend($value): static
    {
        $old = $this->get();
        array_unshift($old, $value);
        return $this->set($old);
    }

    #[Pure] function __toString(): string
    {
        return implode($this->get());
    }
}