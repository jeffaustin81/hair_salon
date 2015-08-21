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
		protected function teardown()
		{
			Stylist::deleteAll();
			Client::deleteAll();
		}
		
		function testgetClientName()
        {
            $client_name = "Jimmy Angular";
            $id = null;
			$email = "jimmyangular@gmail.com";
			$stylist_id = null;
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            
            $result = $test_client->getClientName();
            
            $this->assertEquals($client_name, $result); 
        }
        
        function testgetId()
        {
            $client_name = "Jackie Node";
            $id = 1;
			$email = "jackienode5@gmail.com";
			$stylist_id = null;
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            
            $result = $test_client->getId();
            
            $this->assertEquals(true, is_numeric($result));
        }
        
        function testsetClientName()
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
        
        function testsave()
        {
            $stylist_name = "Sara Gulp";
			$id = null;
			$test_stylist = new Stylist($stylist_name, $id);
			$test_stylist->save();
			
			$client_name = "Billy Grunt";
			$email = "billygrunt99@gmail.com";
			$stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            $test_client->save();
            
            $result = Client::getAll();
            
            $this->assertEquals($test_client, $result[0]);
        }
        
        function testgetAll()
        {
            $stylist_name = "Edward Scissorhands";
			$id = null;
			$test_stylist = new Stylist($stylist_name, $id);
			$test_stylist->save();
			
			$client_name = "Donna Ember";
            $email = "donnaember4@gmail.com";
			$stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            $test_client->save();
			
			$client_name2 = "Warren Yeoman";
			$email2 = "warrenyeoman89@gmail.com";
            $test_client2 = new Client($client_name2, $id, $email2, $stylist_id);
            $test_client2->save();
            
            $result = Client::getAll();
            
            $this->assertEquals([$test_client, $test_client2], $result);
        }
	}
?>