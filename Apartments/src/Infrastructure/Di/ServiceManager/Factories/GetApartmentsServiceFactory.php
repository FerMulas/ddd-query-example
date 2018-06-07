<?php

namespace Apartments\Infrastructure\Di\ServiceManager\Factories;

use Apartments\Application\Query\FindApartmentsByCriteriaQuery;
use Apartments\Application\Service\GetApartmentsService;
use Psr\Container\ContainerInterface;

class GetApartmentsServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return GetApartmentsService
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new GetApartmentsService($container->get(FindApartmentsByCriteriaQuery::class));
    }
}