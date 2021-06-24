<?php


class Name
{
    protected string $name;

    function __construct(string $name) {
        $this->set($name);
    }

    function get(): string {
        return $this->name;
    }

    function set(string $name): static
    {
        $this->name = strtolower($name);
        return $this;
    }

    /**
     * Checks whether the tag is self closed
     * @return bool
     */
    function isSelfClosing(): bool {
        $tags = [
            'area', 'base', 'br', 'col',
            'embed', 'hr', 'img', 'input',
            'link', 'meta', 'param', 'source',
            'track', 'wbr', 'command', 'keygen',
            'menuitem'
        ];

        return in_array($this->get(), $tags);
    }

    function __toString(): string {
        return $this->get();
    }
}