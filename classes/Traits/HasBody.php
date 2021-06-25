<?php


namespace App\Traits;


use App\Tag\Body;

trait HasBody
{
    protected Body $body;

    function bootHasBody() {
        $this->body = new Body($this);
    }

    function body(): Body
    {
        return $this->body;
    }

    function append($value): static
    {
        $this->body()->append($value);
        return $this;
    }

    function prepend($value): static
    {
        $this->body()->prepend($value);
        return $this;
    }
}