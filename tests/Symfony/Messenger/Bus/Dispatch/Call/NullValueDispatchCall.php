<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch\Call;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class NullValueDispatchCall extends ValueDispatchCall
{
    /**
     * @param string $handlerClass
     * @param mixed $message
     * @param int $calls
     */
    public function __construct(string $handlerClass, $message, int $calls = 1)
    {
        parent::__construct($handlerClass, $message, null, $calls);
    }
}
