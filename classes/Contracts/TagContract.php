<?php


namespace App\Contracts;


use App\Tag\Attributes;
use App\Tag\Body;
use App\Tag\Name;

interface TagContract
{
    function name(): Name;
    function attributes(): Attributes;
    function body(): Body;

    function __toString(): string;
}