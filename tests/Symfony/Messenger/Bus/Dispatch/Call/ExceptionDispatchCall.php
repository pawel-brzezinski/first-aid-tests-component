<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch\Call;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class ExceptionDispatchCall extends AbstractDispatchCall
{
    /**
     * {@inheritDoc}
     */
    public function shouldBeCalled(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isException(): bool
    {
        return true;
    }
}
