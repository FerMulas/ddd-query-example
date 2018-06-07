<?php

namespace CommonTests\ArraySort;

use Common\Domain\ArraySort\Sorter;
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
        
        $result = $this->arraySorter->sortByField('id', 'ASC', $sourceArray);

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

        $result = $this->arraySorter->sortByField('city', 'ASC', $sourceArray);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldReturnSortedArrayByIdDESC()
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
                'id' => '00002',
                'city' => 'Paris'
            ],
            [
                'id' => '00001',
                'city' => 'Madrid'
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

        $result = $this->arraySorter->sortByField('id', 'DESC', $sourceArray);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function shouldReturnSortedArrayByNumericFieldASC()
    {
        $expectedResult = [
            [
                'id' => 5,
                'price' => 50.50,
                'city' => 'California'
            ],
            [
                'id' => 4,
                'price' => 55.50,
                'city' => 'Cuenca'
            ],
            [
                'id' => 3,
                'price' => 650,
                'city' => 'Londres'
            ],
            [
                'id' => 2,
                'price' => 750.50,
                'city' => 'Paris'
            ],
            [
                'id' => 1,
                'price' => 1750,
                'city' => 'Madrid'
            ]
        ];

        $sourceArray = [
            [
                'id' => 2,
                'price' => 750.50,
                'city' => 'Paris'
            ],
            [
                'id' => 3,
                'price' => 650,
                'city' => 'Londres'
            ],
            [
                'id' => 1,
                'price' => 1750,
                'city' => 'Madrid'
            ],

            [
                'id' => 5,
                'price' => 50.50,
                'city' => 'California'
            ],
            [
                'id' => 4,
                'price' => 55.50,
                'city' => 'Cuenca'
            ]
        ];

        $result = $this->arraySorter->sortByField('price', 'ASC', $sourceArray);

        $this->assertEquals($expectedResult, $result);
    }
}