<?php

class User extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function getAll( ) {
       return $this->ion_auth->get_users_array();
    }
    
    function count_all() {
    	return $this->db->count_all('users');
    } 
}