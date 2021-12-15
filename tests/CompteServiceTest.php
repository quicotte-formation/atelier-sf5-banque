<?php

namespace App\Tests;

use App\Service\CompteService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CompteServiceTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $cptService = static::getContainer()->get(CompteService::class);// __ construct
        $cptService->transferer(1, 2, 50);// tr
    }
}
