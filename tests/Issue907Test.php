<?php

namespace App\Tests;

use App\Factory\ProductFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;
use PHPUnit\Framework\Attributes\Group;

use function Zenstruck\Foundry\Persistence\flush_after;

class Issue907Test extends KernelTestCase
{
    use Factories;

    /**
     * @group 907
     */
    public function testSomething(): void
    {
        ProductFactory::createMany(2);
    }
}
