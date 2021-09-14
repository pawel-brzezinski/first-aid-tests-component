<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Faker;

use Faker\{Factory, Generator};

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
trait FakerTrait
{
    /**
     * @var Generator[]
     */
    private static array $fakers = [];

    /**
     * @param string $locale
     *
     * @return Generator
     */
    private static function getFaker(string $locale = Factory::DEFAULT_LOCALE): Generator
    {
        return self::$fakers[$locale] ?? (self::$fakers[$locale] = Factory::create($locale));
    }
}
