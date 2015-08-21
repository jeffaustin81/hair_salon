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
	
	class ClientTest extends PHPUnit_Framework_TestCase
    {
		// protected function teardown()
		// {
		// 	Stylist::deleteAll();
		// 	Client::deleteAll();
		// }
		
		function test_getClientName()
        {
            $client_name = "Jimmy Angular";
            $id = null;
			$email = "jimmyangular@gmail.com";
			$stylist_id = null;
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            
            $result = $test_client->getClientName();
            
            $this->assertEquals($client_name, $result); 
        }
        
        function test_getId()
        {
            $client_name = "Jackie Node";
            $id = 1;
			$email = "jackienode5@gmail.com";
			$stylist_id = null;
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            
            $result = $test_client->getId();
            
            $this->assertEquals(true, is_numeric($result));
        }
        
        function test_setClientName()
        {
            $client_name = "Bob Rails";
            $id = 3;
			$email = "bobrails82@gmail.com";
			$stylist_id = null;
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            
            $test_client->setClientName("Terra Code");
            
            $result = $test_client->getClientName();
            
            $this->assertEquals("Terra Code", $result);
            
            
        }
        
        // function test_save()
        // {
        //     $client_name = "Billy Django";
        //     $test_client = new Client($stylist_name);
        //     $test_client->save();
            
        //     $result = Client::getAll();
            
        //     $this->assertEquals($test_client, $result[0]);
        // }
        
        // function test_getAll()
        // {
        //     $client_name = "Billy Django";
        //     $client_name2 = "Jack Drupal";
        //     $test_client = new Client($client_name);
        //     $test_client->save();
        //     $test_client2 = new Client($client_name2);
        //     $test_client2->save();
            
        //     $result = Client::getAll();
            
        //     $this->assertEquals([$test_client, $test_client2], $result);
        // }
	}
?>