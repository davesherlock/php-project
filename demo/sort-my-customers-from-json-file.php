<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../src/MasterClass.php");
include_once("../src/CustomerClass.php");

$c = new Project\CustomerClass();
$response = $c->getDataFromFile(["file_location" => '../files/customers.json']);


echo "<pre>Method: getDataFromFile <br />************************<br />";
print_r($response);
echo "</pre><br />";

$responseArr = json_decode($response, true);

echo "<pre>Customer Array <br />************************<br />";
print_r($responseArr['data_array']['customers']['data']);
echo "</pre><br />";


$customerArrSorted = $c->sortCustomerData($responseArr['data_array'], "user_id");

echo "<pre>Customer Array Sorted by User ID <br />************************<br />";
print_r($customerArrSorted);
echo "</pre><br />";


$customerArr100KM = $c->getCustomersWithinRangeOfLocation(["customer_arr"=>$customerArrSorted,"range"=>100000,"latitudeFrom"=>53.3368365,"longitudeFrom"=>-6.259532199999967]);




echo '<pre>';
print_r($customerArr100KM);
echo '</pre>';