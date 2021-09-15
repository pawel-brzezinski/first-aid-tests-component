<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject;

use PB\Component\FirstAidTests\Tests\MotherObject\Fake\{
    FakeNotPublicConstructorValueObject,
    FakeNotPublicConstructorValueObjectMother
};
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class NotPublicConstructorValueObjectMotherTest extends TestCase
{
    ###########################################################
    # FakeNotPublicConstructorValueObjectMother::randomWith() #
    ###########################################################

    /**
     * @return array
     */
    public function randomWithDataProvider(): array
    {
        // Dataset 1
        $args1 = [];
        $expectedId1 = 2;
        $expectedText1 = 'Maecenas ut nunc ultrices';

        // Dataset 2
        $args2 = ['id' => 3];
        $expectedId2 = 3;
        $expectedText2 = 'Maecenas ut nunc ultrices';

        // Dataset 3
        $args3 = ['text' => 'Foo Bar'];
        $expectedId3 = 2;
        $expectedText3 = 'Foo Bar';

        // Dataset 4
        $args4 = ['id' => 4, 'text' => 'Pellentesque habitant morbi', 'not' => 'supported'];
        $expectedId4 = 4;
        $expectedText4 = 'Pellentesque habitant morbi';

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
        $actual = FakeNotPublicConstructorValueObjectMother::randomWith($args);

        // Then
        $this->assertInstanceOf(FakeNotPublicConstructorValueObject::class, $actual);
        $this->assertSame($expectedId, $actual->id());
        $this->assertSame($expectedText, $actual->text());
    }

    #######
    # End #
    #######

    #####################################
    # SimpleValueObjectMother::random() #
    #####################################

    /**
     *
     */
    public function testShouldCallRandomStaticMethodAndCheckIfObjectHasBeenCreatedCorrectly(): void
    {
        // When
        $actual = FakeNotPublicConstructorValueObjectMother::random();

        // Then
        $this->assertInstanceOf(FakeNotPublicConstructorValueObject::class, $actual);
        $this->assertSame(2, $actual->id());
        $this->assertSame('Maecenas ut nunc ultrices', $actual->text());
    }

    #######
    # End #
    #######
}
