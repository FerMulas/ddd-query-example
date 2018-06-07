<?php

namespace CommonTests\ArraySort;

use Common\ArraySort\Sorter;
use PHPUnit\Framework\TestCase;

class SorterTest extends TestCase
{
    /**
     * @var Sorter
     */
    private $arraySorter;

    public function setUp()
    {
        $this->arraySorter = new Sorter();
    }

    /**
     * @test
     */
    public function shouldReturnSortedArrayById()
    {
        $expectedResult = [
            [
                'id' => '00001',
                'city' => 'Madrid'
            ],
            [
                'id' => '00002',
                'city' => 'Paris'
            ],
            [
                'id' => '00003',
                'city' => 'Londres'
            ],
            [
                'id' => '00004',
                'city' => 'Cuenca'
            ],
            [
                'id' => '00005',
                'city' => 'California'
            ]
        ];

        $sourceArray = [
            [
                'id' => '00002',
                'city' => 'Paris'
            ],
            [
                'id' => '00003',
                'city' => 'Londres'
            ],
            [
                'id' => '00001',
                'city' => 'Madrid'
            ],

            [
                'id' => '00005',
                'city' => 'California'
            ],
            [
                'id' => '00004',
                'city' => 'Cuenca'
            ]
        ];
        
        $result = $this->arraySorter->sortByField('id', $sourceArray);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldReturnSortedArrayByCity()
    {
        $expectedResult = [
            [
                'id' => '00005',
                'city' => 'California'
            ],
            [
                'id' => '00004',
                'city' => 'Cuenca'
            ],
            [
                'id' => '00003',
                'city' => 'Londres'
            ],
            [
                'id' => '00001',
                'city' => 'Madrid'
            ],
            [
                'id' => '00002',
                'city' => 'Paris'
            ]
        ];

        $sourceArray = [
            [
                'id' => '00002',
                'city' => 'Paris'
            ],
            [
                'id' => '00003',
                'city' => 'Londres'
            ],
            [
                'id' => '00001',
                'city' => 'Madrid'
            ],

            [
                'id' => '00005',
                'city' => 'California'
            ],
            [
                'id' => '00004',
                'city' => 'Cuenca'
            ]
        ];

        $result = $this->arraySorter->sortByField('city', $sourceArray);

        $this->assertEquals($expectedResult, $result);
    }
}