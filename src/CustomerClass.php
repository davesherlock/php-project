<?php

namespace Project;

class CustomerClass extends MasterClass {

    public function __construct()
    {
        //parent::__construct();
        //$this->log = parent::createLog(basename(__FILE__));

        /** @param DublinLocation */
        $this->latitudeFrom = 53.3368365;
        $this->longitudeFrom = -6.259532199999967;

    }

    /**
     * Sorts an Array by a given value
     * @param array $valArr
     * @param string $sort_by
     * @return array
     */
    public function sortCustomerData($valArr = [], $sort_by)
    {
        $temp = [];
        foreach ($valArr['customers']['data'] as $key => $value) {
            $temp[$key] = $value[$sort_by];
        }

        array_multisort($temp, SORT_ASC, $valArr['customers']['data']);

        return $valArr;

    }

    /**
     * Traverses an array of customer data which contains gps coordinates and works out which customer
     * is within a certain range of a location and returns that array.
     * @param array $valArr
     * @param int $range
     * @return array
     */
    public function getCustomersWithinRangeOfLocation($valArr = [])
    {
        $latitudeFrom = $this->latitudeFrom;
        $longitudeFrom = $this->longitudeFrom;

        $tempArr = [];
        foreach ($valArr['customers']['data'] as $key => $value) {

            $distance = $this->haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $value['latitude'], $value['longitude']);

            if ($distance <= $valArr['range']) {
                $tempArr[] = $value;
            }
        }

        return $tempArr;

    }

    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param float $earthRadius Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }

}

