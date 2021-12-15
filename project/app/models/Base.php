<?php

namespace app\models;

class Base {
    protected static function makeCollection($class, $dataArr) : array {
        $collection = [];

        foreach ($dataArr as $data) {
            $obj = new $class($data);
            array_push($collection, $obj);
        }

        return $collection;
    }
}
