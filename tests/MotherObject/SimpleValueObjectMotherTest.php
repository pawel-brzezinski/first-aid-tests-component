<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject;

use PB\Component\FirstAidTests\Tests\MotherObject\Fake\FakeValueObject;
use PB\Component\FirstAidTests\Tests\MotherObject\Fake\FakeValueObjectMother;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class SimpleValueObjectMotherTest extends TestCase
{
    #########################################
    # SimpleValueObjectMother::randomWith() #
    #########################################

    /**
     * @return array
     */
    public function randomWithDataProvider(): array
    {
        // Dataset 1
        $args1 = [];
        $expectedId1 = 1;
        $expectedText1 = 'Lorem Ipsum Dolor';

        // Dataset 2
        $args2 = ['id' => 2];
        $expectedId2 = 2;
        $expectedText2 = 'Lorem Ipsum Dolor';

        // Dataset 3
        $args3 = ['text' => 'Foo Bar'];
        $expectedId3 = 1;
        $expectedText3 = 'Foo Bar';

        // Dataset 4
        $args4 = ['id' => 4, 'text' => 'Sit Amet', 'not' => 'supported'];
        $expectedId4 = 4;
        $expectedText4 = 'Sit Amet';

        return [
            'no custom args' => [$args1, $expectedId1, $expectedText1],
            'custom `id` arg' => [$args2, $expectedId2, $expectedText2],
            'custom `text` arg' => [$args3, $expectedId3, $expectedText3],
            'custom `id` and `text` arg' => [$args4, $expectedId4, $expectedText4],
        ];
    }

    /**
     * @dataProvider randomWithDataProvider
     *
     * @param array $args
     * @param int $expectedId
     * @param string $expectedText
     */
    public function testShouldCallRandomWithStaticMethodAndCheckIfObjectHasBeenCreatedCorrectly(
        array $args,
        int $expectedId,
        string $expectedText
    ): void {
        // Given

        // When
        $actual = FakeValueObjectMother::randomWith($args);

        // Then
        $this->assertInstanceOf(FakeValueObject::class, $actual);
        $this->assertSame($expectedId, $actual->id);
        $this->assertSame($expectedText, $actual->text);
    }

    #######
    # End #
    #######

    #####################################
    # SimpleValueObjectMother::random() #
    #####################################

    public function testShouldCallRandomStaticMethodAndCheckIfObjectHasBeenCreatedCorrectly(): void
    {
        // When
        $actual = FakeValueObjectMother::random();

        // Then
        $this->assertInstanceOf(FakeValueObject::class, $actual);
        $this->assertSame(1, $actual->id);
        $this->assertSame('Lorem Ipsum Dolor', $actual->text);
    }

    #######
    # End #
    #######
}
