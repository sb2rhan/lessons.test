<?php

use JetBrains\PhpStorm\Pure;

require_once __DIR__ . './Name.php';
require_once __DIR__ . './Body.php';
require_once __DIR__ . './Attributes.php';

abstract class BaseTag
{
    protected Name $name;
    protected Attributes $attributes;
    protected Body $body;

    public function __construct(string $name, array $attrs = []) {
        $this->name = new Name($name);
        $this->body = new Body($this);
        $this->attributes = new Attributes($attrs);
    }

    function getName(): Name {
        return $this->name;
    }

    function isSelfClosing(): bool {
        return $this->getName()->isSelfClosing();
    }


    function getAttributes(): Attributes
    {
        return $this->attributes;
    }


    function getBody(): Body
    {
        return $this->body;
    }

    function append($value): static
    {
        $this->getBody()->append($value);
        return $this;
    }

    function prepend($value): static
    {
        $this->getBody()->prepend($value);
        return $this;
    }

    function appendTo(BaseTag $tag) {
        $tag->append($this);
        return $this;
    }

    function prependTo(BaseTag $tag) {
        $tag->prepend($this);
        return $this;
    }


    function attr(string $key, $value = null): static
    {
        $this->getAttributes()->set($key, $value);
        return $this;
    }

    #region HOMEWORK 7
    # ПРАВИЛЬНО. Вначале и в конце без пробелов. Между классами один пробел.
    # Без дублирования. Не использовать trim, rtrim, ltrim, str_replace

    /**
     * Adds a class attribute to the tag
     * @param string $class
     */
    function addClass(string $class) {

    }

    /**
     * Checks whether the class attribute contains $class
     * @param string $class
     * @return bool
     */
    function classExists(string $class): bool {

    }

    /**
     * Removes the given $class from the class attribute
     * @param string $class
     */
    function removeClass(string $class) {

    }
    #endregion

    function toString(): string {
        $name = $this->getName();
        $attrs = $this->getAttributes();
        $body = $this->getBody();

        $tag = "<{$name}{$attrs}";

        if ($this->isSelfClosing())
            return "$tag />";

        return "{$tag}>{$body}</{$name}>";
    }

    //region MAGICAL METHODS

    /**
     * It is invoked for methods that are not created
     * We are using href() in index.php that does not exist
     * So its' name 'href' and arguments will be here
     * @param string $name
     * @param array $arguments
     * @return BaseTag
     */
    public function __call(string $name, array $arguments)
    {
        // ... unboxes an array to get just values
        return $this->attr($name, ...$arguments);
    }

    #[Pure] public function __get(string $name)
    {
        return $this->getAttributes()->get($name);
    }

    public function __set(string $name, $value): void
    {
        $this->attr($name, $value);
    }

    function __toString() {
        return $this->toString();
    }
    //endregion
}