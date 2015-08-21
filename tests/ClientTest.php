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
        
        function test_save()
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
        
        function test_getAll()
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
        
        function test_updateClient()
        {
            $stylist_name = "Sally Vue";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $stylist_name2 = "Gregory Symfony";
            $test_stylist2 = new Stylist($stylist_name2, $id);
            $test_stylist2->save();

            $test_client = new Client("Jenny Google", $id, "jennygoogle@gmail.com", $test_stylist->getId());

            $new_client_name = "Frank React";
            $new_email = "frankreact@gmail.com";
            $new_stylist_id = $test_stylist2->getId();
            $new_client = new Client($new_client_name, $id, $new_email, $new_stylist_id);

            $test_client->updateClient($new_client_name, $id, $new_email, $new_stylist_id);

            $this->assertEquals($new_client, $test_client);
        }
        
        function test_deleteClient()
        {
            $stylist_name = "Jen Dontknow";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $stylist_name2 = "John Doknow";
            $test_stylist2 = new Stylist($stylist_name2, $id);
            $test_stylist2->save();

            $test_client = new Client("Jeff Student", $id, "jeffstudent@pcc.edu", $test_stylist->getId());
            $test_client->save();

            $test_client2 = new Client("Jeff Developer", $id, "jeffdeveloper@epicodus.com", $test_stylist2->getId());
            $test_client2->save();

            $test_client->deleteClient();

            $this->assertEquals([$test_client2], Client::getAll());
        }
	}
?>