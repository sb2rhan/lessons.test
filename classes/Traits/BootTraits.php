<?php


namespace App\Traits;


trait BootTraits
{
    /**
     * @throws \ReflectionException
     */
    function bootTraits(...$args) {
        $reflection = new \ReflectionClass($this);
        $traits = $this->resolveTraits($reflection);

        $traits = array_map(function ($name) {
            $name = explode('\\', $name);
            return 'boot' . array_pop($name);
        }, $traits);

        foreach ($traits as $method) {
            if (!method_exists($this, $method)) {
                continue;
            }

            $ref = new \ReflectionMethod($this, $method);
            $count = $ref->getNumberOfParameters();
            $method_args = [];
            for ($i = 0; $i < $count; $i++) {
                $method_args[] = array_shift($args);
            }

            $this->{$method}(...$method_args);
        }
    }

    protected function resolveTraits(?\ReflectionClass $reflection = null): array
    {
        if ($reflection == null)
            return [];

        $parent = $reflection->getParentClass();
        if ($parent == false)
            return [];

        return [
            ...$parent->getTraitNames(),
            # recursion which returns trait names of parent of parent ...
            ...$this->resolveTraits($parent)
        ];
    }
}