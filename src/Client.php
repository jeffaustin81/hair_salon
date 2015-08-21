<?php 

	class Client
	{
		private $client_name;
		private $id;
		private $email;
		private $stylist_id;
		
		function __construct($client_name, $id, $email, $stylist_id)
		{
			$this->client_name = $client_name;
			$this->id = $id;
			$this->email = $email;
			$this->stylist_id = $stylist_id;
		}
		
		function getClientName()
		{
			return $this->client_name;
		}
		
		function setClientName($new_client_name)
		{
			$this->client_name = $new_client_name;
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function getEmail()
		{
			return $this->email;
		}
		
		function setEmail($new_email)
		{
			$this->email = $new_email;
		}
		
		function getStylistId()
		{
			return $this->stylist_id;
		}
		
		function setStylistId($new_stylist_id)
		{
			$this->stylist_id = $new_stylist_id;
		}
		
		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO clients (client_name, email, stylist_id) VALUES('{$this->getClientName()}', '{$this->getEmail()}', {$this->getStylistId()})");
			$this->id=$GLOBALS['DB']->lastInsertId();
		}
		
		function updateClient($new_client_name, $id, $new_email, $new_stylist_id)
        {
            $GLOBALS['DB']->exec("UPDATE restaurants SET name = '{$new_client_name}', email = '{$new_email}', stylist_id = {$new_stylist_id} WHERE id = $id;");
            $this->setName($new_client_name);
            $this->setEmail($new_email);
            $this->setStylistId($new_stylist_id);
        }
		
		function deleteClient()
		{
			$GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
		}
		
		static function getAll()
		{
			$returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client)
            {
                $client_name = $client['client_name'];
                $id = $client['id'];
                $email = $client['email'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($client_name, $id, $email, $stylist_id);
                array_push($clients, $new_client);
            }
            return $clients;
		}
		
		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM clients;");
		}
		
		
		
	}

	
?>