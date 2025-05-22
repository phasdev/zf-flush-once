<?php

namespace App\Tests;

use App\Factory\PizzaFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use PHPUnit\Framework\Attributes\Group;

use function Zenstruck\Foundry\Persistence\flush_after;

class Issue911Test extends KernelTestCase
{
    use Factories;

    /**
     * @group 911
     */
    public function testSomething(): void
    {
        flush_after(function () {
            PizzaFactory::createRange(1, 5);
        });
    }
}
