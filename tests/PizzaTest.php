<?php

namespace App\Tests;

use App\Factory\PizzaFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;

use function Zenstruck\Foundry\Persistence\flush_after;

class PizzaTest extends KernelTestCase
{
    use Factories;

    public function testSomething(): void
    {
        flush_after(function () {
            PizzaFactory::createRange(1, 5);
        });
    }
}
