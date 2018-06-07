<?php

namespace ApartmentsTests\Application;

use Apartments\Application\Service\GetApartmentsRequest;
use Apartments\Application\Service\GetApartmentsService;
use Apartments\Infrastructure\Query\InMemory\InMemoryFindApartmentsByCriteriaQuery;
use PHPUnit\Framework\TestCase;

class GetApartmentsServiceTest extends TestCase
{
    /**
     * @var GetApartmentsService
     */
    private $getApartmentsService;

    public function setUp()
    {
        $testApartment1 = [
            'id' => 'an id 1',
            'title' => 'Title 1',
            'link' => 'link 1',
            'city' => 'City 1',
            'mainImage' => 'an image url 1',
        ];

        $testApartment2 = [
            'id' => 'an id 2',
            'title' => 'Title 2',
            'link' => 'link 2',
            'city' => 'City 2',
            'mainImage' => 'an image url 2',
        ];

        $findApartmentsByCriteriaQuery = InMemoryFindApartmentsByCriteriaQuery::withFixedApartments(
            $testApartment1,
            $testApartment2
        );

        $this->getApartmentsService = new GetApartmentsService($findApartmentsByCriteriaQuery);
    }
    
    /**
     * @test
     */
    public function shouldReturnAListWithOccurrences()
    {
        $filter = [];
        $ordination = [];
        $page = 1;
        $pageSize = 10;

        $request = new GetApartmentsRequest(
            $filter,
            $ordination,
            $page,
            $pageSize
        );
        
        $result = $this->getApartmentsService->execute($request);

        $this->assertEquals(2, $result->resultCount());
        $this->assertEquals(2, $result->totalResults());
        $this->assertEquals(1, $result->pageCount());
        $this->assertEquals(1, $result->totalPages());
    }
}