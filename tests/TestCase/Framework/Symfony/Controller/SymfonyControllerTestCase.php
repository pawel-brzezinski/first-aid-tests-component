<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\TestCase\Framework\Symfony\Controller;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\{MethodProphecy, ObjectProphecy};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Environment;
use Twig\Error\{LoaderError, RuntimeError, SyntaxError};

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

    /**
     * @param string $id
     * @param bool $expected
     * @param int $calls
     */
    protected function mockHasService(string $id, bool $expected, int $calls = 1): void
    {
        /** @var MethodProphecy $methodProp */
        $methodProp = $this->containerMock->has($id);
        $methodProp->shouldBeCalledTimes($calls)->willReturn($expected);
    }

    /**
     * @param string $id
     * @param object $expected
     * @param int $calls
     */
    protected function mockGetService(string $id, object $expected, int $calls = 1): void
    {
        /** @var MethodProphecy $methodProp */
        $methodProp = $this->containerMock->get($id);
        $methodProp->shouldBeCalledTimes($calls)->willReturn($expected);
    }

    /**
     * @param array{string, array} $args            AbstractContainer::renderView() arguments
     * @param string $expectedContent
     * @param int $calls
     *
     * @throws LoaderError|RuntimeError|SyntaxError
     */
    protected function mockRenderView(array $args, string $expectedContent, int $calls = 1): void
    {
        list('view' => $view, 'parameters' => $parameters) = $args;

        /** @var MethodProphecy $methodProp */
        $methodProp = $this->twigMock->render($view, $parameters);
        $methodProp->shouldBeCalledTimes($calls)->willReturn($expectedContent);

        $this->mockHasService('twig', true, $calls);
        $this->mockGetService('twig', $this->twigMock->reveal(), $calls);
    }
}
