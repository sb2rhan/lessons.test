<?php


namespace App\Traits;


use App\Tag\Name;

trait HasName
{
    protected Name $name;

    function bootHasName(string $name) {
        $this->name = new Name($name);
    }

    function name(): Name {
        return $this->name;
    }

    function isSelfClosing(): bool {
        return $this->name()->isSelfClosing();
    }
}