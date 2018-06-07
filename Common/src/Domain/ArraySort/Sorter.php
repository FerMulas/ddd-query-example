<?php

namespace Common\Domain\ArraySort;

class Sorter
{
    public function sortByField(string $field, string $direction, array $list)
    {
        switch (gettype($field)) {
            case "string":
                $list = $this->sortStringType($field, $direction, $list);
                break;
            case "integer":
            case "double":
                $list = $this->sortNumberType($field, $direction, $list);
                break;
            default:
                break;
        }

        return $list;
    }

    /**
     * @param string $field
     * @param $list
     * @return mixed
     */
    private function sortNumberType(string $field, string $direction, array $list)
    {
        usort($list, function ($value1, $value2) use ($field, $direction) {
            if (!key_exists($field, $value1) || !key_exists($field, $value2)) {
                throw FieldNotFoundSortException::withField($field);
            }
            if ($value1[$field] == $value2[$field]) {
                return 0;
            }

            if ($direction === 'DESC') {

                return ($value1[$field] > $value2[$field]) ? -1 : 1;
            } else {

                return ($value1[$field] < $value2[$field]) ? -1 : 1;
            }

        });
        return $list;
    }

    /**
     * @param string $field
     * @param $list
     * @return mixed
     */
    private function sortStringType(string $field, string $direction, array $list)
    {
        usort($list, function ($value1, $value2) use ($field, $direction) {
            if (!key_exists($field, $value1) || !key_exists($field, $value2)) {
                throw FieldNotFoundSortException::withField($field);
            }
            if ($direction === 'DESC') {

                return strcmp($value2[$field], $value1[$field]);
            } else {

                return strcmp($value1[$field], $value2[$field]);
            }
        });
        return $list;
    }
}