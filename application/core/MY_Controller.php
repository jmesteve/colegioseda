<?php

class MY_Controller extends CI_Controller
{
	
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('html');
        
        $this->data['is_logged_in'] = FALSE;
        $this->data['is_admin'] = FALSE;
        
        if ($this->ion_auth->logged_in())
        {
        	$this->data['is_logged_in'] = TRUE;
        	$this->data['user'] = $this->ion_auth->get_user();
        }
        
        if ($this->ion_auth->is_admin())
        {
        	$this->data['is_admin'] = TRUE;
        }
        
        $this->load->vars($this->data);
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/libraries/MY_Controller.php */ 