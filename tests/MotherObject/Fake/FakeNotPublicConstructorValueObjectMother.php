<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject\Fake;

use PB\Component\FirstAidTests\MotherObject\NotPublicConstructorValueObjectMother;
use PB\Component\FirstAidTests\MotherObject\SimpleValueObjectMother;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class FakeNotPublicConstructorValueObjectMother extends NotPublicConstructorValueObjectMother
{
    /**
     * @return string
     */
    protected static function getClass(): string
    {
        return FakeNotPublicConstructorValueObject::class;
    }

    /**
     * @return array
     */
    protected static function getDefaultConstructorArguments(): array
    {
        return [
            'id' => 2,
            'text' => 'Maecenas ut nunc ultrices',
        ];
    }
}
