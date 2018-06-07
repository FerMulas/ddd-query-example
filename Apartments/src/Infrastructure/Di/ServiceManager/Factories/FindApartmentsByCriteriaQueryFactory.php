<?php

namespace Apartments\Infrastructure\Di\ServiceManager\Factories;

use Apartments\Infrastructure\Query\XML\XmlFindApartmentsByCriteriaQuery;
use Psr\Container\ContainerInterface;

class FindApartmentsByCriteriaQueryFactory
{
    /**
     * @param ContainerInterface $container
     * @return XmlFindApartmentsByCriteriaQuery
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container)
    {
        return new XmlFindApartmentsByCriteriaQuery();
    }
}