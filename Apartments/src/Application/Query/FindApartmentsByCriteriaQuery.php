<?php

namespace Apartments\Application\Query;

use Common\Domain\Query\QueryCriteria;
use Common\Domain\Query\QueryResult;

interface FindApartmentsByCriteriaQuery
{
    const PAGE_SIZE = 10;

    public function find(QueryCriteria $queryCriteria): QueryResult;
}