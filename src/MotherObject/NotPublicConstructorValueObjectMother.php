<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\MotherObject;

use PB\Component\FirstAid\Reflection\ReflectionHelper;
use ReflectionException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @method static string getClass()
 */
abstract class NotPublicConstructorValueObjectMother extends SimpleValueObjectMother
{
    /**
     * @param array $args
     *
     * @return mixed|object
     *
     * @throws ReflectionException
     */
    public static function randomWith(array $args)
    {
        $classRef = ReflectionHelper::create(static::getClass());
        $constructorRef = $classRef->getConstructor();
        $constructorRef->setAccessible(true);

        $instance = $classRef->newInstanceWithoutConstructor();
        $constructorRef->invoke($instance, ...array_values(self::randomConstructorArguments($args)));

        return $instance;
    }
}
