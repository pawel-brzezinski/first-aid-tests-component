<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\TestCase\Framework\Symfony\Controller;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\{ObjectProphecy};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Environment;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class SymfonyControllerTestCase extends TestCase
{
    use ProphecyTrait;

    /** @var ObjectProphecy|ContainerInterface|null */
    private $containerMock;

    /** @var ObjectProphecy|Environment|null */
    private $twigMock;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->containerMock = $this->prophesize(ContainerInterface::class);
        $this->twigMock = $this->prophesize(Environment::class);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->containerMock = null;
        $this->twigMock = null;
    }

    /**
     * @return string
     */
    abstract protected function getControllerClass(): string;

    /**
     * @return AbstractController|object
     */
    protected function createController(): object
    {
        $controllerClass = $this->getControllerClass();
        /** @var AbstractController $controller */
        $controller = new $controllerClass();

        /** @noinspection PhpInternalEntityUsedInspection */
        $controller->setContainer($this->containerMock->reveal());

        return $controller;
    }
}
