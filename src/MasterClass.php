<?php

namespace Project;

class MasterClass {

    public function __construct()
    {

    }

    /**
     * loads data from json file
     * @param array $valArr
     * @return array
     */
    public function getDataFromFile($valArr = [])
    {
        $response['success'] = true;

        $data = @file_get_contents($valArr['file_location']);

        if ($data) {
            // success
            $response['data_array'] = json_decode($data, true);
        } else {
            // fail
            $response['success'] = false;
            $response['error'] = "There was a problem loading the file";
        }


        return json_encode($response);
    }


}

