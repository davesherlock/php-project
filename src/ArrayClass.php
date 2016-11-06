<?php

namespace Project;

class ArrayClass extends MasterClass {

    public function __construct()
    {
        //parent::__construct();
        //$this->log = parent::createLog(basename(__FILE__));
    }

    /**
     * flattens a nested array of numbers
     *
     */
    public function flattenArray($valArr = [])
    {
        $response['success'] = true;

        $requiredKeyArr = ['nested_arr'];

        //Check for all the required keys
        foreach ($requiredKeyArr as $value) {
            if (is_array($valArr)) {
                if (!array_key_exists($value, $valArr)) {
                    $response['success'] = false;
                    $response['error'] = $value . " not provided";
                }
            } else {
                $response['success'] = false;
                $response['error'] = $value . " not an array";
            }

        }

        //validate the values
        if ($response['success']) {

            $valArr['nested_arr'] = filter_var($valArr["nested_arr"], FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            //if the array is empty or null
            if (empty($valArr['nested_arr']) || $valArr['nested_arr'] == null) {
                $response['success'] = false;
                $response['error'] = "nested_arr is empty";
            }

        }

        //if all above is OK, continue with the shenanigans
        if ($response['success']) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($valArr['nested_arr']));
            foreach ($iterator as $key => $value) {
                $response['flat_array'][] = $value;
            }
        }

        return json_encode($response);
    }


}

