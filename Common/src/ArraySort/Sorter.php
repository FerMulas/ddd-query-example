<?php

namespace Common\ArraySort;

class Sorter
{
    public function sortByField(string $field, array $list)
    {
        switch (gettype($field)) {
            case "string":
                $list = $this->sortStringType($field, $list);
                break;
            case "integer":
            case "double":
                $list = $this->sortNumberType($field, $list);
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
    private function sortNumberType(string $field, array $list)
    {
        usort($list, function ($value1, $value2) use ($field) {
            if ($value1 == $value2) {
                return 0;
            }

            return ($value1 < $value2) ? -1 : 1;
        });
        return $list;
    }

    /**
     * @param string $field
     * @param $list
     * @return mixed
     */
    private function sortStringType(string $field, array $list)
    {
        usort($list, function ($value1, $value2) use ($field) {
            return strcmp($value1[$field], $value2[$field]);
        });
        return $list;
    }
}