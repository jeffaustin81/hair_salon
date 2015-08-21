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
	}

	
?>