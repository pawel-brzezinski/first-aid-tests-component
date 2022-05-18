<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Objects\Assertion;

use PB\Component\FirstAid\Reflection\ReflectionHelper;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
trait ConstructAssertionTrait
{
    protected function isNonPublicConstructor(object $actual): void
    {
//        ReflectionHelper::constructor(get_class($actual))->isPublic();
    }
}
