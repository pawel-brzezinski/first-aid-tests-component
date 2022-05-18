<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch\Call;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class NonExistentDispatchCall  extends AbstractDispatchCall
{
    /**
     * @param mixed $message
     */
    public function __construct($message)
    {
        parent::__construct('not-important', $message, null);
    }

    /**
     * {@inheritDoc}
     */
    public function shouldBeCalled(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function isException(): bool
    {
        return false;
    }
}
