<?php
namespace Common\Query;

class QueryCriteria
{
    /**
     * @var array
     */
    private $filter;
    /**
     * @var array
     */
    private $ordination;
    /**
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $pageSize;

    /**
     * QueryCriteria constructor.
     * @param array $filter
     * @param array $ordination
     * @param int $page
     * @param int $pageSize
     */
    public function __construct(array $filter, array $ordination, int $page, int $pageSize)
    {
        $this->filter = $filter;
        $this->ordination = $ordination;
        $this->page = $page;
        $this->pageSize = $pageSize;
    }

    /**
     * @return array
     */
    public function filter(): array
    {
        return $this->filter;
    }

    /**
     * @return array
     */
    public function ordination(): array
    {
        return $this->ordination;
    }

    /**
     * @return int
     */
    public function page(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function pageSize(): int
    {
        return $this->pageSize;
    }
}