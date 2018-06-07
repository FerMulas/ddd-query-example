<?php

namespace Apartments\Application\Query;

use Common\Query\QueryCriteria;
use Common\Query\QueryResult;

interface FindApartmentsByCriteriaQuery
{
    const PAGE_SIZE = 10;

    public function find(QueryCriteria $queryCriteria): QueryResult;
}