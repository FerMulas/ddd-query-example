<?php
namespace Common\Query;

use ArrayIterator;

class QueryResult
{
    /**
     * @var int
     */
    private $resultCount;
    /**
     * @var int
     */
    private $totalResults;
    /**
     * @var int
     */
    private $pageCount;
    /**
     * @var int
     */
    private $totalPages;
    /**
     * @var array
     */
    private $results;

    /**
     * QueryResult constructor.
     * @param int $resultCount
     * @param int $totalResults
     * @param int $pageCount
     * @param int $totalPages
     * @param ArrayIterator $results
     */
    public function __construct(
        int $resultCount,
        int $totalResults,
        int $pageCount,
        int $totalPages,
        ArrayIterator $results
    ) {

        $this->resultCount = $resultCount;
        $this->totalResults = $totalResults;
        $this->pageCount = $pageCount;
        $this->totalPages = $totalPages;
        $this->results = $results;
    }

    /**
     * @return int
     */
    public function resultCount(): int
    {
        return $this->resultCount;
    }

    /**
     * @return int
     */
    public function totalResults(): int
    {
        return $this->totalResults;
    }

    /**
     * @return int
     */
    public function pageCount(): int
    {
        return $this->pageCount;
    }

    /**
     * @return int
     */
    public function totalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @return ArrayIterator
     */
    public function results(): ArrayIterator
    {
        return $this->results;
    }

    public function getJsonData(): array{
        $results = [];

        foreach ($this->results() as $result) {
            array_push($results, json_decode($result['data'], true));
        }

        $jsonArray = [
            'resultCount' => $this->resultCount(),
            'totalResults' => $this->totalResults(),
            'pageCount' => $this->pageCount(),
            'totalPages' => $this->totalPages(),
            'results' => $results,
        ];

        return $jsonArray;
    }
}