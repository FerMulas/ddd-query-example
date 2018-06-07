<?php

namespace Apartments\Infrastructure\Query\InMemory;

use Apartments\Application\Query\FindApartmentsByCriteriaQuery;
use Common\Domain\Query\QueryCriteria;
use Common\Domain\Query\QueryResult;

class InMemoryFindApartmentsByCriteriaQuery implements FindApartmentsByCriteriaQuery
{
    /**
     * @var array 
     */
    private $apartmentList;

    public static function withFixedApartments(array ...$apartments)
    {
        $apartmentList = [];
        
        foreach ($apartments as $apartment) {
            $apartmentList[$apartment['id']] = $apartment;
        }
        
        return new self($apartmentList);
    }

    public function __construct(array $apartmentList)
    {
        $this->apartmentList = $apartmentList;
    }

    public function find(QueryCriteria $queryCriteria): QueryResult
    {
        $resultsCount = 0;
        $results = [];
        $totalResults = 0;
        $totalPages = 0;
        $page = $queryCriteria->page();

        foreach ($this->apartmentList as $apartment) {
            $found = true;
            $filterList = $queryCriteria->filter();
            while (($filter = next($filterList)) && $found) {
                if ($apartment[$filter['field']] !== $filter['value']) {
                    $found = false;
                }
            }

            if ($found) {
                $totalResults++;
                $totalPages = (int)ceil($totalResults / $queryCriteria->pageSize());
            }

            if ($found && $resultsCount <= $queryCriteria->pageSize() && $totalPages === $queryCriteria->page()) {
                $resultsCount++;
                array_push($results, $apartment);
            }
        }

        return new QueryResult($resultsCount, $totalResults, $page, $totalPages, new \ArrayIterator($results));
    }
}