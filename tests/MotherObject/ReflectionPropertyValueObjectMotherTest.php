<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject;

use PB\Component\FirstAidTests\Tests\MotherObject\Fake\{
    FakeReflectionPropertyValueObject,
    FakeReflectionPropertyValueObjectMother
};
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class ReflectionPropertyValueObjectMotherTest extends TestCase
{
    #####################################################
    # ReflectionPropertyValueObjectMother::randomWith() #
    #####################################################

    /**
     * @return array
     */
    public function randomWithDataProvider(): array
    {
        // Dataset 1
        $args1 = [];
        $expectedId1 = 4;
        $expectedText1 = 'Phasellus rutrum a ipsum id dignissim';

        // Dataset 2
        $args2 = ['id' => 5];
        $expectedId2 = 5;
        $expectedText2 = 'Phasellus rutrum a ipsum id dignissim';

        // Dataset 3
        $args3 = ['text' => 'Foo Bar'];
        $expectedId3 = 4;
        $expectedText3 = 'Foo Bar';

        // Dataset 4
        $args4 = ['id' => 6, 'text' => 'Donec viverra dolor eget dolor rutrum', 'not' => 'supported'];
        $expectedId4 = 6;
        $expectedText4 = 'Donec viverra dolor eget dolor rutrum';

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
        $actual = FakeReflectionPropertyValueObjectMother::randomWith($args);

        // Then
        $this->assertInstanceOf(FakeReflectionPropertyValueObject::class, $actual);
        $this->assertSame($expectedId, $actual->id());
        $this->assertSame($expectedText, $actual->text());
    }

    #######
    # End #
    #######

    #################################################
    # ReflectionPropertyValueObjectMother::random() #
    #################################################

    /**
     *
     */
    public function testShouldCallRandomStaticMethodAndCheckIfObjectHasBeenCreatedCorrectly(): void
    {
        // When
        $actual = FakeReflectionPropertyValueObjectMother::random();

        // Then
        $this->assertInstanceOf(FakeReflectionPropertyValueObject::class, $actual);
        $this->assertSame(4, $actual->id());
        $this->assertSame('Phasellus rutrum a ipsum id dignissim', $actual->text());
    }

    #######
    # End #
    #######
}
