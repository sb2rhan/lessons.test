<?php
namespace App;

use App\Contracts\TagContract;

use App\Traits\BootTraits;
use App\Traits\HasAttributes;
use App\Traits\HasBody;
use App\Traits\HasName;

abstract class BaseTag implements TagContract
{
    use BootTraits, HasName, HasAttributes, HasBody;

    function __construct(string $name, array $attrs = []) {
        $this->bootTraits($name, $attrs); # will invoke traits
    }

    function appendTo(BaseTag $tag) {
        $tag->append($this);
        return $this;
    }

    function prependTo(BaseTag $tag) {
        $tag->prepend($this);
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
        $name = $this->name();
        $attrs = $this->attributes();
        $body = $this->body();

        $tag = "<{$name}{$attrs}";

        if ($this->isSelfClosing())
            return "$tag />";

        return "{$tag}>{$body}</{$name}>";
    }

    //region MAGICAL METHODS

    function __toString(): string {
        return $this->toString();
    }
    //endregion
}