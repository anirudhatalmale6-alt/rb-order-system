<?php

class spage
{
	public $pg;
	public $pagepath;
	public $getpage;
	
	public function __construct()
	{
		$this->page();
		$this->path();
	}
	
	/*public function page()
	{
		$this->pg = array('Home'=> 'main'
			,'About Us'=>'about'
			,'Recipes'=>'recipes'
			,'Register'=>'register'
			,'My Cart'=>'cart'
			,'Orders'=>'http://www.google.com'
			,'Contact Us'=>'contact');
	}
	*/
	
	private function subpage($i)
	{
		global $db;
		$sql = "SELECT * FROM ".TB_MENU." WHERE subid = $i";
		return $db->num_rows($sql);
	}
	
	private function page()
	{
		$this->pg = array('Home'
						 ,'Flash Mail'
						 ,'Services'=> array('Website Develop'=>array('Static Website','Dynamic'),'category'=>array('Static Website','Dynamic'))
							 ,'Pricing'=> array('Add Banner'=>'addban','View All'=>'banner')
							 ,'Say Hello'=> array('Add New'=>'addadv','View All'=>'adv')
							 ,'Prtal'=>array('User'=>'userpro'));
	}
	
	public function path()
	{
		if(isset($_GET['page']))
		{
			if(file_exists("public/".$this->getpage.".php"))
			{
				$this->pagepath = $this->getpage;
			}
			
		}
		else
		{
			$this->pagepath = "index"; 
		}
	}
}
?>