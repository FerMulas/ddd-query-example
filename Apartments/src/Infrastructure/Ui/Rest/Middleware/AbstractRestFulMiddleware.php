<?php

namespace Apartments\Infrastructure\Ui\Rest\Middleware;

use Ddd\Application\Service\ApplicationService;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Lukasoppermann\Httpstatus\Httpstatuscodes;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;

/**
 * @method ResponseInterface get(ServerRequestInterface $request)
 * @method ResponseInterface post(ServerRequestInterface $request)
 * @method ResponseInterface patch(ServerRequestInterface $request)
 * @method ResponseInterface put(ServerRequestInterface $request)
 * @method ResponseInterface delete(ServerRequestInterface $request)
 */
class AbstractRestFulMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $verb = strtolower($request->getMethod());

        if(method_exists($this, $verb)){
            $response = $this->$verb($request);
        } else {
            $response = new ApiProblemResponse(new ApiProblem(Httpstatuscodes::HTTP_METHOD_NOT_ALLOWED, strtoupper($verb) . ' is not allowed'));
        }

        return $response;
    }

    protected function applicationService(string $applicationServiceName): ApplicationService
    {
        return $this->container->get($applicationServiceName);
    }
}