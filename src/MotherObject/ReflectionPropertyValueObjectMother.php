<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\MotherObject;

use mimic;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class ReflectionPropertyValueObjectMother extends SimpleValueObjectMother
{
    /**
     * @param array $args
     *
     * @return mixed|object
     */
    public static function randomWith(array $args)
    {
        return mimic\hydrate(static::getClass(), self::randomConstructorArguments($args));
    }
}
