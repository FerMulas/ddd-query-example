<?php

namespace Apartments\Application\Service;

use Common\Domain\Query\QueryCriteria;

class GetApartmentsRequest
{
    /**
     * @var QueryCriteria
     */
    private $criteria;

    /**
     * GetApartmentsRequest constructor.
     * @param array $filter
     * @param string $ordination
     * @param string $ordinationDirection
     * @param int $page
     * @param int $pageSize
     */
    public function __construct(
        array $filter,
        string $ordination,
        string $ordinationDirection,
        int $page,
        int $pageSize
    )
    {
        $this->criteria = new QueryCriteria($filter, $ordination, $ordinationDirection, $page, $pageSize);
    }

    /**
     * @return QueryCriteria
     */
    public function criteria(): QueryCriteria
    {
        return $this->criteria;
    }
}