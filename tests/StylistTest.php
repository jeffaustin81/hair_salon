<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
	
	class StylistTest extends PHPUnit_Framework_TestCase
    {
		// protected function teardown()
		// {
		// 	Stylist::deleteAll();
		// }
		
		function test_getStylistName()
        {
            $stylist_name = "Jesse Barnes";
            $test_stylist = new Stylist($stylist_name);
            
            $result = $test_stylist->getStylistName;
            
            $this->assertEquals($stylist_name, $result); 
        }
	}