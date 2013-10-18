<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galeria extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        
        //$this->load->library('pagination');
        
        $this->load->model('Navigation');
        $this->load->model('Gallery');
        
        $this->template->set_theme('main');
        $this->template->set_layout('site');
        
        $this->template->set_partial('header','partials/header');
        $this->template->set_partial('footer','partials/footer');
        
        
        // Carga de datos globales
        $this->data['query_main_nav'] = $this->Navigation->get_header_entries();
    }
	
	function index($articleId)
	{
	 	
	 	$this->data['section_info'] = $this->Navigation->get_section_array(array('menus2.slug'=>'noticias') );
	 	
	 	// Paginator config
	 	/*
	 	$this->data['offset'] = $this->uri->segment(2);
	 	$this->data['limit'] = 5;
	 	$config['base_url'] = site_url().'/noticias/';
	 	$this->data['count'] = $config['total_rows'] = $this->News->count_all();
	 	$config['per_page'] = $this->data['limit'];
	 	$config['uri_segment'] = 2;
	 	$config['num_links'] = 2;
	 	
	 	$this->pagination->initialize($config);
	 	$paginator=$this->pagination->create_links();
	 	
	 	$this->data['paginator'] = $paginator;
	 	*/
	 	// Fin config aginator
	 	
	 	// Cargar los articulos/noticias
	 	$this->data['news'] = $this->News->get_noticias_array(array('news.active' => 1), 
	 											  			  $this->data['limit'], 
	 											  			  $this->data['offset']);
	 	
	 	$this->template->title('Colegio del arte Mayor de la seda | Noticias');
	 	$this->template->build('sections/noticias-home', $this->data);
	}
	
	function single($imageId)
	{
		//$this->data['breadcrumbs'] = $this->Navigation->get_breadcrumbs($sectionSlug);
	 	
	 	// Cargar los articulos/noticias
	 	$this->data['news'] = $this->News->get_noticia_array(array('news.slug' => $slug));
	 	
	 	$this->data['section_info'] = $this->Navigation->get_section_array(array('menus2.id'=> $this->data['news']['sectionId']) );
	 	
	 	$this->template->title('Colegio del arte Mayor de la seda | Noticias');
	 	$this->template->build('sections/noticias-single', $this->data);
	}
	
}