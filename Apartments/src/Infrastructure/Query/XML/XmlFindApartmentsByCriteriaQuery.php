<?php

namespace Apartments\Infrastructure\Query\XML;

use Apartments\Application\Query\FindApartmentsByCriteriaQuery;
use Common\ArraySort\Sorter;
use Common\Query\QueryCriteria;
use Common\Query\QueryResult;

class XmlFindApartmentsByCriteriaQuery implements FindApartmentsByCriteriaQuery
{
    private const XML_URL = 'http://feeds.spotahome.com/trovit-Ireland.xml';
    /**
     * @var Sorter
     */
    private $sorter;

    /**
     * XmlFindApartmentsByCriteriaQuery constructor.
     * @param Sorter $sorter
     */
    public function __construct(
        Sorter $sorter
    )
    {
        $this->sorter = $sorter;
    }

    public function find(QueryCriteria $queryCriteria): QueryResult
    {
        $apartments = $this->getXmlArray();

        $resultsCount = 0;
        $totalResults = 0;
        $totalPages = 0;
        $page = $queryCriteria->page();

        $results = $this->sorter->sortByField($queryCriteria->ordinationField(), $apartments);
        $pageResults = [];
        $resultList = [];

        foreach ($results as $apartment) {
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
                array_push($pageResults, $apartment);
            }
        }



        foreach ($pageResults as $result) {
            $res = [
                'id' => $result['id'],
                'data' => json_encode($result, true)
            ];

            array_push($resultList, $res);
        }



        return new QueryResult($resultsCount, $totalResults, $page, $totalPages, new \ArrayIterator($resultList));
    }

    private function getXmlArray(): array
    {
        $xmlArray = [
            [
                'id' => '95539',
                'title' => 'Furnished room for rent in a 2 bedroom apartment close to Phoenix Park, females only',
                'link' => 'https://www.spotahome.com/dublin/for-rent:apartments/95539?utm_source=trovit&utm_medium=cffeeds&utm_campaign=normalads',
                'city' => 'dublin',
                'mainImage' => 'https://d1052pu3rm1xk9.cloudfront.net/fsosw_960_540_verified_ur_6_50/16284d3cea4828fe607e61a8da465da14ff717188f474c159b81068e.jpg',
            ],
           [
                'id' => '95544',
                'title' => 'Beds to rent in 2 bedrooms in a flat in Broadstone, All Utilities Included',
                'link' => 'https://www.spotahome.com/dublin/for-rent:apartments/95544?utm_source=trovit&utm_medium=cffeeds&utm_campaign=normalads',
                'city' => 'dublin',
                'mainImage' => 'https://d1052pu3rm1xk9.cloudfront.net/fsosw_960_540_verified_ur_6_50/186909b8726eb243d20dda8ca69a10438ad82bfbcded4a45d95f73d0.jpg',
            ]
        ];

        return $xmlArray;
    }
}