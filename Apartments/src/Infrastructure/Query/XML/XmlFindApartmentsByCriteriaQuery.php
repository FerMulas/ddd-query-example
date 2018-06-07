<?php

namespace Apartments\Infrastructure\Query\XML;

use Apartments\Application\Query\FindApartmentsByCriteriaQuery;
use Common\Query\QueryCriteria;
use Common\Query\QueryResult;

class XmlFindApartmentsByCriteriaQuery implements FindApartmentsByCriteriaQuery
{
    private const XML_URL='http://feeds.spotahome.com/trovit-Ireland.xml';

    public function __construct()
    {
        
    }   

    public function find(QueryCriteria $queryCriteria): QueryResult
    {
        header("Content-Type: text/plain");
        $xml = file_get_contents(self::XML_URL);
        $xmlString = simplexml_load_string($xml);

        var_dump($xmlString);
    }
}