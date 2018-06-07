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
     * @var string
     */
    private $ordinationDirection;

    /**
     * QueryCriteria constructor.
     * @param array $filter
     * @param string $ordinationField
     * @param string $ordinationDirection
     * @param int $page
     * @param int $pageSize
     */
    public function __construct(array $filter, string $ordinationField, string $ordinationDirection, int $page, int $pageSize)
    {
        $this->filter = $filter;
        $this->ordinationField = $ordinationField;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->ordinationDirection = $ordinationDirection;
    }

    /**
     * @return string
     */
    public function ordinationDirection(): string
    {
        return $this->ordinationDirection;
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