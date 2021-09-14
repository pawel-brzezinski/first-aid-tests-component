<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject\Fake;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class FakeValueObject
{
    public int $id;

    public string $text;

    /**
     * @param int $id
     * @param string $text
     */
    public function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }
}
