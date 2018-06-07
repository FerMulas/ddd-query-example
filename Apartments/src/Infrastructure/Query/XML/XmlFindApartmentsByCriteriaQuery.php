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

        $results = $this->sorter->sortByField($queryCriteria->ordinationField(), $apartments);
        $resultsCount = sizeof($results);
        $totalPages = (int)ceil($resultsCount/$queryCriteria->pageSize());

//        var_dump($results, $resultsCount, $totalPages);

        $queryResult = new QueryResult(2, 2, 1, 1, $results);

        return $queryResult;
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