<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        
        $this->load->model('Navigation');
        $this->load->library('form_validation');
        
        $this->template->set_theme('main');
        $this->template->set_layout('site');
        
        $this->template->set_partial('header','partials/header');
        $this->template->set_partial('footer','partials/footer');
    }
    
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
     	$this->template->set_partial('sidebar','partials/sidebar');
     	
 		$this->load->model('Article');
 		$this->load->model('Navigation');
 		
 		$this->data['query_main_nav'] = $this->Navigation->get_header_entries();
 		
 		$this->data['sidebar'] = $this->Navigation->load_sidebar(array('mas_leidos', 'ultimos_comentarios'));
     	
     	$this->data['word'] = $this->input->get('q');
     	
     	$this->data['results']['articulos'] = $this->Article->search($this->data['word']);
     	$total_results = $this->Article->count_search_results($this->data['word']);
     	 
		$this->template->title('Colegio del arte Mayor de la seda | HOME');
			        
		$this->template->build('site/search', $this->data);
		
	}
}