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
		protected function teardown()
		{
			Stylist::deleteAll();
            Client::deleteAll();
		}
		
		function test_getStylistName()
        {
            $stylist_name = "Penny Silex";
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
        
        function test_save()
        {
            $stylist_name = "Billy Django";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            
            $result = Stylist::getAll();
            
            $this->assertEquals($test_stylist, $result[0]);
        }
        
        function test_getAll()
        {
            $stylist_name = "Billy Django";
            $stylist_name2 = "Jack Drupal";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();
            
            $result = Stylist::getAll();
            
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }
	}
?>