<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject\Fake;

use PB\Component\FirstAidTests\MotherObject\ReflectionPropertyValueObjectMother;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class FakeReflectionPropertyValueObjectMother extends ReflectionPropertyValueObjectMother
{
    /**
     * @return string
     */
    protected static function getClass(): string
    {
        return FakeReflectionPropertyValueObject::class;
    }

    /**
     * @return array
     */
    protected static function getDefaultConstructorArguments(): array
    {
        return [
            'id' => 4,
            'text' => 'Phasellus rutrum a ipsum id dignissim',
        ];
    }
}
