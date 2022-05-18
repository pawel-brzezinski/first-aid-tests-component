<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\Symfony\Messenger\Bus\Dispatch\Call;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class AbstractDispatchCall
{
    private string $handlerClass;

    /**
     * @var mixed
     */
    private $message;

    /**
     * @var mixed
     */
    private $result;

    /**
     * @var int
     */
    private int $calls;

    /**
     * @param string $handlerClass
     * @param mixed $message
     * @param mixed $result
     * @param int $calls
     */
    public function __construct(string $handlerClass, $message, $result, int $calls = 1)
    {
        $this->handlerClass = $handlerClass;
        $this->message = $message;
        $this->result = $result;
        $this->calls = $calls;
    }

    /**
     * @return bool
     */
    abstract public function shouldBeCalled(): bool;

    /**
     * @return bool
     */
    abstract public function isException(): bool;

    /**
     * @return string
     */
    public function handlerClass(): string
    {
        return $this->handlerClass;
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * @return int
     */
    public function calls(): int
    {
        return $this->calls;
    }
}
