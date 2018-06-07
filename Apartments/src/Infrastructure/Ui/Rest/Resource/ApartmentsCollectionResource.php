<?php

namespace Apartments\Infrastructure\Ui\Rest\Resource;

use Apartments\Application\Service\GetApartmentsRequest;
use Apartments\Application\Service\GetApartmentsService;
use Apartments\Infrastructure\Ui\Rest\Middleware\AbstractRestFulMiddleware;
use Lukasoppermann\Httpstatus\Httpstatuscodes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Stdlib\Parameters;

class ApartmentsCollectionResource extends AbstractRestFulMiddleware
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $urlQueryParameters = $request->getQueryParams();

        try {
            $carList = $this->applicationService(GetApartmentsService::class)->execute(
                new GetApartmentsRequest(
                    [],
                    [],
                    1,
                    10)
            );
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), Httpstatuscodes::HTTP_BAD_REQUEST);
        }

        return (new JsonResponse($carList->getJsonData(), Httpstatuscodes::HTTP_OK))
            ->withStatus(200, 'OK');
    }
}