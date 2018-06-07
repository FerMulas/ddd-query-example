<?php

namespace Apartments\Application\Service;

use Common\Query\QueryCriteria;

class GetApartmentsRequest
{
    /**
     * @var QueryCriteria
     */
    private $criteria;

    public function __construct(
        array $filter,
        array $ordination,
        int $page,
        int $pageSize
    )
    {
        $this->criteria = new QueryCriteria($filter, $ordination, $page, $pageSize);
    }

    /**
     * @return QueryCriteria
     */
    public function criteria(): QueryCriteria
    {
        return $this->criteria;
    }
}