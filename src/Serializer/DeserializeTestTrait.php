<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Serializer;

use Adbar\Dot;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
trait DeserializeTestTrait
{
    /**
     * Returns array of data without given key.
     *
     * @param array $data
     * @param string $key
     *
     * @return array
     */
    private function returnArrayDataWithoutValue(array $data, string $key): array
    {
        $dot = new Dot($data);
        $dot->delete($key);

        return $dot->getIterator()->getArrayCopy();
    }
}
