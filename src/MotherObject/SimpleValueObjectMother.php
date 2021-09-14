<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\MotherObject;

/**
 * @author Wojciech Brzezinski <wojciech.brzezinski@smartint.pl>
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class SimpleValueObjectMother
{
    /**
     * @param array $args
     *
     * @return mixed|object
     */
    public static function randomWith(array $args)
    {
        $class = static::getClass();

        return new $class(...array_values(self::randomConstructorArguments($args)));
    }

    /**
     * @return string
     */
    abstract protected static function getClass(): string;

    /**
     * @return array
     */
    abstract protected static function getDefaultConstructorArguments(): array;

    /**
     * @param array $overrides
     *
     * @return array
     */
    protected static function randomConstructorArguments(array $overrides): array
    {
        return array_merge(static::getDefaultConstructorArguments(), $overrides);
    }
}
