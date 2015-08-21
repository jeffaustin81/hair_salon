<?php 
	class Stylist
	{
		private $stylist_name;
		private $id;
		
		function __construct($stylist_name, $id=null)
		{
			$this->stylist_name = $stylist_name;
			$this->id = $id;
		}
		
		function getStylistName()
		{
			return $this->stylist_name;
		}
		
		function setStylistName($new_stylist_name)
		{
			$this->stylist_name = $new_stylist_name;
		}
		
		function getId()
		{
			return $this->id;
		}
		
		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO stylists (stylist_name) VALUES('{$this->getStylistName()}')");
			$this->id=$GLOBALS['DB']->lastInsertId();
		}
		
		static function getAll()
		{
			$returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
			$stylists = array();
			foreach($returned_stylists as $stylist) {
				$stylist_name = $stylist['stylist_name'];
				$id = $stylist['id'];
				$new_stylist = new Stylist($stylist_name, $id);
				array_push($stylists, $new_stylist);
			}
			return $stylists;
		}
		
		function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM stylists;");
		}
	}	
?>