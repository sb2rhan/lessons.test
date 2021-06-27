<?php
namespace App;

use App\Contracts\TagContract;

use App\Traits\BootTraits;
use App\Traits\HasAttributes;
use App\Traits\HasBody;
use App\Traits\HasName;
use JetBrains\PhpStorm\Pure;

abstract class BaseTag implements TagContract
{
    use BootTraits, HasName, HasAttributes, HasBody;

    function __construct(string $name, array $attrs = []) {
        $this->bootTraits($name, $attrs); # will invoke traits
    }

    function appendTo(BaseTag $tag): static
    {
        $tag->append($this);
        return $this;
    }

    function prependTo(BaseTag $tag): static
    {
        $tag->prepend($this);
        return $this;
    }

    #region HOMEWORK 7
    # ПРАВИЛЬНО. Вначале и в конце без пробелов. Между классами один пробел.
    # Без дублирования. Не использовать trim, rtrim, ltrim, str_replace

    /**
     * Adds a class attribute to the tag
     * @param string $class
     * @return BaseTag
     */
    function addClass(string $class): static
    {
        if ($this->attributes()->get('class') == null)
            $this->attr('class', $class);
        elseif (!$this->classExists($class))
            $this->attributes()->append('class', " {$class}");

        return $this;
    }

    /**
     * Checks whether the class attribute contains $class
     * @param string $class
     * @return bool
     */
    #[Pure] function classExists(string $class): bool {
        $class_attr = $this->attributes()->get('class');
        $pos = strpos($class_attr, $class);

        if (is_bool($pos)) return $pos;
        return true;
    }

    /**
     * Removes the given $class from the class attribute
     * @param string $class
     * @return bool
     */
    function removeClass(string $class): bool
    {
        if (!$this->classExists($class)) return false;

        $class_attr = $this->attributes()->get('class');
        $classes = explode(' ', $class_attr);
        $classes = array_filter($classes, function ($val) use($class) {
            return ($val != $class);
        }, ARRAY_FILTER_USE_BOTH);
        $class_attr = implode(' ', $classes);

        if ($class_attr)
            $this->attr('class', $class_attr);
        else
            $this->attributes()->remove('class');

        return true;
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