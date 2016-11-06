<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../src/MasterClass.php");
include_once("../src/ArrayClass.php");

$a = new Project\ArrayClass();
$response = $a->getDataFromFile(["file_location" => '../files/numbers.json']);


echo "<pre>Method: getDataFromFile <br />************************<br />";
print_r($response);
echo "</pre><br />";

$responseArr = json_decode($response, true);

echo "<pre>Nested Array <br />************************<br />";
print_r($responseArr['data_array']['numbers']);
echo "</pre><br />";

$response = $a->flattenArray(["nested_arr" => $responseArr['data_array']['numbers']]);

echo "<pre>Method: flattenArray <br />************************<br />";
print_r($response);
echo "</pre><br />";

$responseArr = json_decode($response, true);

echo "<pre>Flat Array <br />************************<br />";
print_r($responseArr['flat_array']);
echo "</pre><br />";