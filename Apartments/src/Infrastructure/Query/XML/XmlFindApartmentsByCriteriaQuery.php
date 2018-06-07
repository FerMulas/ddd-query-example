<?php

namespace Apartments\Infrastructure\Query\XML;

use Apartments\Application\Query\FindApartmentsByCriteriaQuery;
use Assert\Assertion;
use Common\Domain\ArraySort\Sorter;
use Common\Domain\Query\QueryCriteria;
use Common\Domain\Query\QueryResult;

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

        $apartments = $this->removeUnusedFields($apartments);

        $results = $this->sorter->sortByField($queryCriteria->ordinationField(), $apartments);

        list($totalResults, $totalPages, $resultsCount, $pageResults) = $this->getPagination($queryCriteria, $results);

        $resultList = $this->ConvertResultsFormat($pageResults);

        return new QueryResult($resultsCount, $totalResults, $queryCriteria->page(), $totalPages, new \ArrayIterator($resultList));
    }

    public function getXmlArray()
    {
        $result = file_get_contents(self::XML_URL);

        $xml = simplexml_load_string($result, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        return $array;
    }

    /**
     * @param $pageResults
     * @return mixed
     */
    private function ConvertResultsFormat($pageResults)
    {
        $resultList = [];

        foreach ($pageResults as $result) {
            $res = [
                'id' => $result['id'],
                'data' => json_encode($result, true)
            ];

            array_push($resultList, $res);
        }
        return $resultList;
    }

    /**
     * @param QueryCriteria $queryCriteria
     * @param $results
     * @return array
     */
    private function getPagination(QueryCriteria $queryCriteria, $results): array
    {
        $totalResults = 0;
        $resultsCount = 0;
        $totalPages = 0;
        $pageResults = [];

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
        return array($totalResults, $totalPages, $resultsCount, $pageResults);
    }

    private function removeUnusedFields(array $apartments)
    {
        $arrayResult = [];
        foreach ($apartments['ad'] as $apartment) {
            $resultWithNeedleFields = [
                'id' => $apartment['id'],
                'link' => $apartment['url'],
                'title' => $apartment['title'],
                'city' => $apartment['city'],
                'mainImage' => $apartment['pictures']['picture'][0]['picture_url'],
            ];

            array_push($arrayResult, $resultWithNeedleFields);
        }

        return $arrayResult;
    }
}