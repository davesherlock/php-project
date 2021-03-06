<?php

/**
 * CodeTestModelTest creates a UnitTest environment for CodeTestModel
 * Commands to run:
 * cd C:\xampp\htdocs\code-test\    "this is my local site root"
 * phpunit test\CustomerClassTest.php --coverage-text --whitelist="models\CustomerClass.php
 */


require_once('../src/MasterClass.php');
require_once('../src/ArrayClass.php');

class CustomerClassTest extends PHPUnit_Framework_TestCase {
    /**
     * this will be the object to test
     */
    private $model;

    protected function setUp()
    {
        $this->class = new Project\CustomerClass("", "unit");
    }

    /**
     * Testing a simple nested Array
     * Result = Pass
     */
    public function testFlattenArray_PASS_1()
    {
        $postArr = json_decode('{"nested_arr":[[1,2,[3]],4]}', true);
        $this->assertJsonStringEqualsJsonString('{"success":true,"flat_array":[1,2,3,4]}', $this->model->flattenArray($postArr));
    }

    /**
     * Testing a more complicated nested array
     * Result = Pass
     */
    public function testFlattenArray_PASS_2()
    {
        $postArr = json_decode('{"nested_arr":[[1,2,[3]],4,[5,[6],7,[8,9,10]]]}', true);
        $this->assertJsonStringEqualsJsonString('{"success":true,"flat_array":[1,2,3,4,5,6,7,8,9,10]}', $this->model->flattenArray($postArr));
    }

    /**
     * Testing incorrect array key
     * Result = Fail
     */
    public function testFlattenArray_FAIL_1()
    {
        $postArr = json_decode('{"array":[[1,2,[3]],4,[5,[6],7,[8,9,10]]]}', true);
        $this->assertJsonStringEqualsJsonString('{"success":false,"error":"nested_arr not provided"}', $this->model->flattenArray($postArr));
    }

    /**
     * Testing an empty array
     * Result = Fail
     */
    public function testFlattenArray_FAIL_2()
    {
        $postArr = json_decode('{"nested_arr":[]}', true);
        $this->assertJsonStringEqualsJsonString('{"success":false,"error":"nested_arr is empty"}', $this->model->flattenArray($postArr));
    }

    /**
     * Testing Incorrect input (a string instead of an array)
     * Result = Fail
     */
    public function testFlattenArray_FAIL_3()
    {
        $postArr = json_decode('{"nested_arr":"some text"', true);
        $this->assertJsonStringEqualsJsonString('{"success":false,"error":"nested_arr not an array"}', $this->model->flattenArray($postArr));
    }

}
