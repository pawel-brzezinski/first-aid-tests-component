<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch;

use PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch\Call\AbstractDispatchCall;
use Prophecy\Prophecy\{MethodProphecy, ObjectProphecy};
use Symfony\Component\Messenger\{Envelope, MessageBusInterface};

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
trait QueryDispatchTrait
{

    abstract public function generateEnvelopeWithHandledStamp(string $messageHandler, object $message, $result): Envelope;

    /**
     * @return ObjectProphecy|MessageBusInterface
     */
    abstract protected function queryBusMock();

    /**
     * @param array{AbstractDispatchCall} $dispatchCalls
     */
    protected function mockQueryBusDispatchCalls(array $dispatchCalls): void
    {
        /** @var AbstractDispatchCall $dispatchCall */
        foreach ($dispatchCalls as $dispatchCall) {
            /** @var MethodProphecy $methodProp */
            $methodProp = $this->queryBusMock()->dispatch($dispatchCall->message());

            if (true === $dispatchCall->shouldBeCalled() && false === $dispatchCall->isException()) {
                $envelope = $this->generateEnvelopeWithHandledStamp($dispatchCall->handlerClass(), $dispatchCall->message(), $dispatchCall->result());
                $methodProp->shouldBeCalledTimes($dispatchCall->calls())->willReturn($envelope);
            } elseif (true === $dispatchCall->shouldBeCalled() && true === $dispatchCall->isException()) {
                $methodProp->shouldBeCalledTimes($dispatchCall->calls())->willThrow($dispatchCall->result());
            } else {
                $methodProp->shouldNotBeCalled();
            }
        }
    }
}
