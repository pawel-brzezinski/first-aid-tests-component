<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject\Fake;

use PB\Component\FirstAidTests\MotherObject\SimpleValueObjectMother;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class FakeValueObjectMother extends SimpleValueObjectMother
{
    /**
     * @return string
     */
    protected static function getClass(): string
    {
        return FakeValueObject::class;
    }

    /**
     * @return array
     */
    protected static function getDefaultConstructorArguments(): array
    {
        return [
            'id' => 1,
            'text' => 'Lorem Ipsum Dolor',
        ];
    }
}
