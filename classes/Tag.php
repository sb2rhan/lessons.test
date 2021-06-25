<?php

namespace App;

class Tag extends BaseTag
{
    static function make(string $name, array $attrs = []): BaseTag
    {
        return new static($name, $attrs);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return static::make($name, $arguments);
    }
}