<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Faker;

use Faker\Generator;
use Faker\Provider\Base;
use PB\Component\FirstAidTests\Faker\FakerTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class FakerTraitTest extends TestCase
{
    use FakerTrait;

    /**
     *
     */
    public function testShouldCallGetFakerStaticMethodAndCheckIfCorrectFakerGeneratorHasBeenReturned(): void
    {
        // When & Then
        $actual1 = self::getFaker();
        $this->assertInstanceOf(Generator::class, $actual1);
        $this->assertFakerLocale($actual1, 'en_US');

        $actual2 = self::getFaker();
        $this->assertSame($actual1, $actual2);

        $actual3 = self::getFaker('pl_PL');
        $this->assertFakerLocale($actual3, 'pl_PL');
    }

    /**
     * @param Generator $generator
     * @param string $expectedLocale
     */
    private function assertFakerLocale(Generator $generator, string $expectedLocale): void
    {
        $test = array_filter($generator->getProviders(), function (Base $provider) use ($expectedLocale) {
            return false !== strpos(get_class($provider), "\\{$expectedLocale}\\");
        });

        $this->assertNotEmpty($test);
    }
}
