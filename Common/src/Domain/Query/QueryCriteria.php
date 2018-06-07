<?php
namespace Common\Domain\Query;

class QueryCriteria
{
    /**
     * @var array
     */
    private $filter;
    /**
     * @var string
     */
    private $ordinationField;
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
     * @param string $ordinationField
     * @param int $page
     * @param int $pageSize
     */
    public function __construct(array $filter, string $ordinationField, int $page, int $pageSize)
    {
        $this->filter = $filter;
        $this->ordinationField = $ordinationField;
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
     * @return string
     */
    public function ordinationField(): string
    {
        return $this->ordinationField;
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