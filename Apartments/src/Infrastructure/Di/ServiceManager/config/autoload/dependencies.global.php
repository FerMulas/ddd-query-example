<?php

use Apartments\Application\Query\FindApartmentsByCriteriaQuery;
use Apartments\Application\Service\GetApartmentsService;
use Apartments\Infrastructure\Di\ServiceManager\Factories\FindApartmentsByCriteriaQueryFactory;
use Apartments\Infrastructure\Di\ServiceManager\Factories\GetApartmentsServiceFactory;
use Apartments\Infrastructure\Di\ServiceManager\Factories\RestFulMiddlewareAbstractFactory;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterServiceFactory;

return [
    'dependencies' => [
        'abstract_factories' => [
            RestFulMiddlewareAbstractFactory::class
        ],
        'factories' => array(
            //Framework
            Adapter::class => AdapterServiceFactory::class,
            Zend\Expressive\Router\AuraRouter::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
            Zend\Expressive\Application::class => Zend\Expressive\Container\ApplicationFactory::class,

            //Application Service
            GetApartmentsService::class => GetApartmentsServiceFactory::class,

            //Query
            FindApartmentsByCriteriaQuery::class => FindApartmentsByCriteriaQueryFactory::class,

        ),
        'aliases' => [
            'configuration' => 'config',
            \Zend\Expressive\Router\RouterInterface::class => \Zend\Expressive\Router\AuraRouter::class,
        ],
        'invokables' => []
    ],
];
