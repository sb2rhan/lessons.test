<?php

namespace App\Tag;
use JetBrains\PhpStorm\Pure;

class Attributes
{
    protected array $attributes;

    public function __construct(array $attrs = [])
    {
        $this->setAll($attrs);
    }

    function setAll(array $attr): static
    {
        $this->attributes = $attr;
        return $this;
    }

    function getAll(): array {
        return $this->attributes;
    }

    function set(string $key, $value = null): static
    {
        $old = $this->getAll();
        $old[$key] = $value;
        return $this->setAll($old);
    }

    #[Pure] function get(string $key) {
        return $this->getAll()[$key];
    }

    function append(string $key, $value): static
    {
        $old = $this->get($key);
        return $this->set($key, $old . $value);
    }

    function prepend(string $key, $value): static
    {
        $old = $this->get($key);
        return $this->set($key, $value . $old);
    }

    function remove(string $key): static
    {
        $attrs = $this->getAll();
        unset($attrs[$key]);
        return $this->setAll($attrs);
    }

    #[Pure] function __toString(): string {
        $attrs = $this->getAll();
        $res = '';

        foreach ($attrs as $key => $value) {
            $res .= " {$key}";

            if (!empty($value))
                $res .= "=\"{$value}\"";
        }

        return $res;
    }
}