<?php

return function (\Zend\Expressive\Application $app): void {

    $app->get(
        '/apartments?{query}',
        \Apartments\Infrastructure\Ui\Rest\Resource\ApartmentsCollectionResource::class
    );
};
