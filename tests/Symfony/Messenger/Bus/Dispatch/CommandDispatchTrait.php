<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch;

use Prophecy\Prophecy\{MethodProphecy, ObjectProphecy};
use Symfony\Component\Messenger\{Envelope, MessageBusInterface};
use PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch\Call\AbstractDispatchCall;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@db-team.pl>
 */
trait CommandDispatchTrait
{
    abstract public function generateEnvelopeWithHandledStamp(string $messageHandler, object $message, $result): Envelope;

    /**
     * @return ObjectProphecy|MessageBusInterface
     */
    abstract protected function commandBusMock();

    /**
     * @param array{AbstractDispatchCall} $dispatchCalls
     */
    protected function mockCommandBusDispatchCalls(array $dispatchCalls): void
    {
        /** @var AbstractDispatchCall $dispatchCall */
        foreach ($dispatchCalls as $dispatchCall) {
            /** @var MethodProphecy $methodProp */
            $methodProp = $this->commandBusMock()->dispatch($dispatchCall->message());

            if (true === $dispatchCall->shouldBeCalled() && false === $dispatchCall->isException()) {
                // Command dispatch should not return values
                $envelope = $this->generateEnvelopeWithHandledStamp($dispatchCall->handlerClass(), $dispatchCall->message(), null);
                $methodProp->shouldBeCalledTimes($dispatchCall->calls())->willReturn($envelope);
            } elseif (true === $dispatchCall->shouldBeCalled() && true === $dispatchCall->isException()) {
                $methodProp->shouldBeCalledTimes($dispatchCall->calls())->willThrow($dispatchCall->result());
            } else {
                $methodProp->shouldNotBeCalled();
            }
        }
    }
}
