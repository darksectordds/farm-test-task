<?php

namespace App\Services;

if (!function_exists('mapper')) {
    /**
     * Переводит массив объектов/массивов в карту, где идентификатор
     * становится ключом нового ассоциативного массива, а значение
     * этим элементом.
     *
     * Пример:
     *  [{id: 8, name: test, soname: hello}, ...] => [8 => {id: 8, name: test, soname: hello}, ...]
     *
     * @param array $array
     * @param string $column
     * @param bool $group
     * @return array
     */
    function mapper(array $array, string $column = 'id', bool $group = false): array
    {
        $result = [];

        foreach ($array as $item) {
            $item_id = is_object($item) ? $item->{$column} : $item[$column];

            if ($group) {
                if (!array_key_exists($item_id, $result)) {
                    $result[$item_id] = [];
                }
                $result[$item_id][] = $item;
            }
            else {
                $result[$item_id] = $item;
            }
        }

        return $result;
    }
}
