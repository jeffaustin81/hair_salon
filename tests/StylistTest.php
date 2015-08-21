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
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            
            $result = $test_stylist->getStylistName();
            
            $this->assertEquals($stylist_name, $result); 
        }
        
        function test_getId()
        {
            $stylist_name = "Jackie Burns";
            $id = 1;
            $test_stylist = new Stylist($stylist_name, $id);
            
            $result = $test_stylist->getId();
            
            $this->assertEquals(true, is_numeric($result));
        }
        
        function test_setStylistName()
        {
            $stylist_name = "Jon Rickles";
            $id = 2;
            $test_stylist = new Stylist($stylist_name, $id);
            
            $test_stylist->setStylistName("Terra Michalson");
            
            $result = $test_stylist->getStylistName();
            
            $this->assertEquals("Terra Michalson", $result);
            
            
        }
	}