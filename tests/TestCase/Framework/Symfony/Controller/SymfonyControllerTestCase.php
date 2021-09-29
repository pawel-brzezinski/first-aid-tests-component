<?php

declare(strict_types=1);

namespace PB\Component\FirstAidTests\Tests\TestCase\Framework\Symfony\Controller;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\{MethodProphecy, ObjectProphecy};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
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

    /** @var ObjectProphecy|RouterInterface|null */
    private $routerMock;

    /** @var ObjectProphecy|TokenStorageInterface|null */
    private $tokenStorageMock;

    /** @var ObjectProphecy|Environment|null */
    private $twigMock;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->containerMock = $this->prophesize(ContainerInterface::class);
        $this->routerMock = $this->prophesize(RouterInterface::class);
        $this->tokenStorageMock = $this->prophesize(TokenStorageInterface::class);
        $this->twigMock = $this->prophesize(Environment::class);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->containerMock = null;
        $this->routerMock = null;
        $this->tokenStorageMock = null;
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
        list($view, $parameters) = $args;

        /** @var MethodProphecy $methodProp */
        $methodProp = $this->twigMock->render($view, $parameters);
        $methodProp->shouldBeCalledTimes($calls)->willReturn($expectedContent);

        $this->mockHasService('twig', true, $calls);
        $this->mockGetService('twig', $this->twigMock->reveal(), $calls);
    }

    /**
     * @param UserInterface|null $expectedUser
     * @param int $calls
     */
    protected function mockGetUser(?UserInterface $expectedUser, int $calls = 1): void
    {
        /** @var MethodProphecy $methodProp */
        $methodProp = $this->tokenStorageMock->getToken();
        $methodProp->shouldBeCalledTimes($calls);

        if (null === $expectedUser) {
            $methodProp->willReturn(null);
        } else {
            /** @var ObjectProphecy|TokenInterface $tokenMock */
            $tokenMock = $this->prophesize(TokenInterface::class);

            /** @var MethodProphecy $getUserMethodProp */
            $getUserMethodProp = $tokenMock->getUser();
            $getUserMethodProp->shouldBeCalledTimes($calls)->willReturn($expectedUser);

            $methodProp->willReturn($tokenMock->reveal());
        }

        $this->mockHasService('security.token_storage', true, $calls);
        $this->mockGetService('security.token_storage', $this->tokenStorageMock->reveal(), $calls);
    }

    /**
     * @param array{string, array, int} $args            AbstractController::generateUrl() arguments
     * @param string $expectedUrl
     * @param int $calls
     */
    protected function mockGenerateUrl(array $args, string $expectedUrl, int $calls = 1): void
    {
        list($route, $parameters, $referenceType) = $args;

        /** @var MethodProphecy $methodProp */
        $methodProp = $this->routerMock->generate($route, $parameters, $referenceType);
        $methodProp->shouldBeCalledTimes($calls)->willReturn($expectedUrl);

        $this->mockGetService('router', $this->routerMock->reveal(), $calls);
    }
}
