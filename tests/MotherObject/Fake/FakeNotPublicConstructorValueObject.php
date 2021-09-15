<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\MotherObject\Fake;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class FakeNotPublicConstructorValueObject
{
    private int $id;

    private string $text;

    /**
     * @param int $id
     * @param string $text
     */
    private function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function text(): string
    {
        return $this->text;
    }
}
