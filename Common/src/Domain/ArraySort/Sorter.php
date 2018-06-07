<?php

namespace Common\Domain\ArraySort;

class Sorter
{
    public function sortByField(string $field, string $direction, array $list)
    {
        usort($list, function ($value1, $value2) use ($field, $direction) {
            $result = 0;

            if (!key_exists($field, $value1) || !key_exists($field, $value2)) {
                throw FieldNotFoundSortException::withField($field);
            }

            switch (gettype($value1[$field])) {
                case "string":
                    $result = $this->sortStringType($value1[$field], $value2[$field], $direction);
                    break;
                case "integer":
                case "float":
                case "double":
                    $result = $this->sortNumberType($value1[$field], $value2[$field], $direction);
                    break;
                default:
                    break;
            }

            return $result;
        });

        return $list;
    }

    /**
     * @param float $value1
     * @param float $value2
     * @param string $direction
     * @return mixed
     */
    private function sortNumberType($value1, $value2, string $direction)
    {
        if ($value1 == $value2) {
            return 0;
        }

        if ($direction === 'DESC') {

            return ($value1 > $value2) ? -1 : 1;
        } else {

            return ($value1 < $value2) ? -1 : 1;
        }
    }

    /**
     * @param string $value1
     * @param string $value2
     * @param string $direction
     * @return mixed
     */
    private function sortStringType(string $value1, string $value2, string $direction)
    {
        if ($direction === 'DESC') {

            return strcmp($value2, $value1);
        } else {

            return strcmp($value1, $value2);
        }
    }
}