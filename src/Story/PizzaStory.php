<?php

namespace App\Story;

use Zenstruck\Foundry\Story;
use App\Factory\PizzaFactory;

use function Zenstruck\Foundry\Persistence\flush_after;

final class PizzaStory extends Story
{
    public function build(): void
    {        
        // TODO build your story here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#stories)
        flush_after(function () {
            PizzaFactory::createRange(1, 5);
        });        
    }
}
