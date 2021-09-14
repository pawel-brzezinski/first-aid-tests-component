<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Serializer;

use PB\Component\FirstAidTests\Serializer\DeserializeTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class DeserializeTestTraitTest extends TestCase
{
    use DeserializeTestTrait;

    private const DATA = [
        'key-1' => 'value-1',
        'key-2' => [
            'key-2-1' => [
                'key-2-1-1' => 'value-2-1-1',
                'key-2-1-2' => 'value-2-1-2',
            ],
        ],
    ];

    #######################################################
    # DeserializeTestTrait::returnArrayDataWithoutValue() #
    #######################################################

    /**
     * @return array
     */
    public function returnArrayDataWithoutValueDataProvider(): array
    {
        // Dataset 1
        $key1 = 'key-1';
        $expected1 = [
            'key-2' => [
                'key-2-1' => [
                    'key-2-1-1' => 'value-2-1-1',
                    'key-2-1-2' => 'value-2-1-2',
                ],
            ],
        ];

        // Dataset 2
        $key2 = 'key-2.key-2-1.key-2-1-2';
        $expected2 = [
            'key-1' => 'value-1',
            'key-2' => [
                'key-2-1' => [
                    'key-2-1-1' => 'value-2-1-1',
                ],
            ],
        ];

        // Dataset 3
        $key3 = 'key-1000';
        $expected3 = self::DATA;

        return [
            'simple key' => [self::DATA, $key1, $expected1],
            'nested key' => [self::DATA, $key2, $expected2],
            'key not exist' => [self::DATA, $key3, $expected3],
        ];
    }

    /**
     * @dataProvider returnArrayDataWithoutValueDataProvider
     *
     * @param array $data
     * @param string $key
     * @param array $expected
     */
    public function testShouldCallReturnArrayDataWithoutValueTraitMethodAndCheckIfReturnedArrayIsCorrect(
        array $data,
        string $key,
        array $expected
    ): void {
        // When
        $actual = $this->returnArrayDataWithoutValue($data, $key);

        // Then
        $this->assertSame($expected, $actual);
    }

    #######
    # End #
    #######
}
