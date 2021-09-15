<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject\Fake;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class FakeReflectionPropertyValueObject
{
    private int $id = 3;

    private string $text = 'Default text';

    /**
     * @param int $id
     * @param string $text
     */
    public function __construct(int $id, string $text) {}

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function text(): string
    {
        return $this->text;
    }
}
