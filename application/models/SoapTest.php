<?php

class Application_Model_SoapTest {

    /**
     * Add method
     *
     * @param Int $param1
     * @param Int $param2
     * @return Int
     */
    public function mathAdd($param1, $param2) {
        return $param1 + $param2;
    }

    /**
     * Logical not method
     *
     * @param boolean $param1
     * @return boolean
     */
    public function logicalNot($param1) {
        return !$param1;
    }

    /**
     * Simple array sort
     *
     * @param Array $array
     * @return Array
     */
    public function simpleSort($array) {
        asort($array);
        return $array;
    }

}
