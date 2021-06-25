<?php


namespace App\Traits;


use App\BaseTag;
use App\Tag\Attributes;
use JetBrains\PhpStorm\Pure;

trait HasAttributes
{
    protected Attributes $attributes;

    function bootHasAttributes(array $attrs) {
        $this->attributes = new Attributes($attrs);
    }

    function attributes(): Attributes
    {
        return $this->attributes;
    }

    function attr(string $key, $value = null): static
    {
        $this->attributes()->set($key, $value);
        return $this;
    }

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
        return $this->attributes()->get($name);
    }

    public function __set(string $name, $value): void
    {
        $this->attr($name, $value);
    }
}