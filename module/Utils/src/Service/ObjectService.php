<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ObjectService
 *
 * @author hayk
 */

namespace Utils\Service;

use Exception;
use Zend\Hydrator\ClassMethods;

class ObjectService {

    public static function convertObjToArray($obj)
    {
        if (!is_object($obj)) {
            throw new Exception('No object was given');
        }
        if ($obj instanceof \stdClass) {
            return (array) $obj;
        }
        $hydrator = new ClassMethods();
        $data = $hydrator->extract($obj);
        unset($hydrator);
        unset($obj);

        return $data;
    }

    public static function convertArrayToObj($data, $prototype = null)
    {

        if ($data instanceof \stdClass) {
            $data = (array) $data;
        }

        if (!is_array($data)) {
            throw new Exception('No array was given');
        }



        if (is_null($prototype)) {
            $prototype = new \stdClass();
        }

        $hydrate = new ClassMethods();

        $obj = $hydrate->hydrate($data, $prototype);
        unset($hydrate);
        unset($unit);

        return $obj;
    }

    public static function removeFromArrayNulls($array)
    {
        if (!is_array($array) || 0 == count($array)) {
            return null;
        }

        foreach ($array as $key => $val) {
            if ($val == NULL || $val == '' || $val == 'NULL' || $key == 'submit') {
                unset($array[$key]);
            }
        }

        return $array;
    }

}
