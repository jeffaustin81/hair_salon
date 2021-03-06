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
        
        function test_updateStylist()
        {
            $stylist_name = "Mike Heroku";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $new_stylist_name = "Kyle Sites";

            $test_stylist->updateStylist($new_stylist_name);

            $this->assertEquals("Kyle Sites", $test_stylist->getStylistName());
        }
        
        function test_find()
        {
            $stylist_name = "Maggie Tech";
            $stylist_name2 = "Rex Silex";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();


            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals($test_stylist, $result);
        }

        function test_deleteStylist()
        {
            $stylist_name = "Mike Heroku";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $stylist_name2 = "Kyle Sites";
            $test_stylist2 = new Stylist($stylist_name2, $id);
            $test_stylist2->save();

            $test_stylist->deleteStylist();

            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }
        
        function test_getClients()
        {
            $stylist_name = "Hank Airpair";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Wesley Pong";
            $stylist_id = $test_stylist->getId();
            $email = "wesleypong@gmail.com";
            $test_client = new Client($client_name, $id, $email, $stylist_id);
            $test_client->save();

            $client_name2 = "Wendy Git";
            $email = "wendygit@gmail.com";
            $test_client2 = new Client($client_name2, $id, $email, $stylist_id);
            $test_client2->save();

            $result = $test_stylist->getClients();

            $this->assertEquals([$test_client, $test_client2], $result);
        }

	}
?>