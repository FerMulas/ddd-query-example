<?php

namespace Apartments\Application\Service;

use Apartments\Application\Query\FindApartmentsByCriteriaQuery;
use Ddd\Application\Service\ApplicationService;

class GetApartmentsService implements ApplicationService
{
    /**
     * @var FindApartmentsByCriteriaQuery
     */
    private $findApartmentsByCriteriaQuery;

    /**
     * GetApartmentsService constructor.
     * @param FindApartmentsByCriteriaQuery $findApartmentsByCriteriaQuery
     */
    public function __construct(
        FindApartmentsByCriteriaQuery $findApartmentsByCriteriaQuery
    )
    {
        $this->findApartmentsByCriteriaQuery = $findApartmentsByCriteriaQuery;
    }

    /**
     * @param GetApartmentsRequest $request
     * @return mixed
     */
    public function execute($request = null)
    {
        $apartmentList = $this->findApartmentsByCriteriaQuery->find($request->criteria());

        return $apartmentList;
    }
}