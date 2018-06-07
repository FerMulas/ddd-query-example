<?php

namespace Apartments\Infrastructure\Di\ServiceManager\Factories;

use Interop\Container\ContainerInterface;
use Apartments\Infrastructure\Ui\Rest\Middleware\AbstractRestFulMiddleware;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class RestFulMiddlewareAbstractFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return is_subclass_of($requestedName, AbstractRestFulMiddleware::class);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName($container);
    }
}