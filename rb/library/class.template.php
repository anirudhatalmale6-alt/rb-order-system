<?php
    class template
    {
        private $template;

        function __construct($template = "index.php")
        {
            if (isset($template))
            {
				$this->template = $template;
                $this->load();
				$this->publish();
            }
        }

        public function load()
        {
			if(!file_exists("public/".$this->template))
			{
				$this->template = "404.php";
			}
			
			else
            {
                $this->template = $this->template;
            }
        }

        public function publish()
        {
            include("public/".$this->template);
        }
    }
?>