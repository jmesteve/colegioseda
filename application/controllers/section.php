<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Section extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        
        $this->load->model('Navigation');
        $this->load->model('Article');
        
        $this->template->set_theme('main');
        $this->template->set_layout('site');
        
        $this->template->set_partial('header','partials/header');
        $this->template->set_partial('footer','partials/footer');
        
        $this->data['query_main_nav'] = $this->Navigation->get_header_entries();
        
    }
	
	function index( $sectionSlug, $articleSlug = '' )
	{
		$this->template->set_partial('sidebar','partials/sidebar');
		
		//$this->data['breadcrumbs'] = $this->Navigation->get_breadcrumbs('');
	 	
	 	$this->data['section_info'] = $this->Navigation->get_section_array(array('menus2.slug'=> $sectionSlug) );
	 	$this->Navigation->set_section($this->data['section_info']['id']);
	 	$this->data['sidebar'] = $this->Navigation->load_sidebar(array('secciones','mas_leidos', 'ultimos_comentarios'));
	 	
	 	$this->template->title('Colegio del arte Mayor de la seda');
	 	
	 	if ($this->data['section_info']['active']) {
	 		if ($articleSlug !== '') {
		 		$where = array('articles.slug' => $articleSlug);
		    	$this->data['article'] = $this->Article->get_articulo_array($where);
		    	$this->Article->update($this->data['article']['id'],
		    						 array('visits' => $this->data['article']['visits']+1));
		    	$this->template->build('sections/'.$this->data['section_info']['view'].'-single', $this->data);
		    } else {
		    	$where = array('articles.sectionId' => $this->data['section_info']['id'],
		    					'articles.active' => 1);
		    	$this->data['articles'] = $this->Article->get_articulos_array($where);
		    	$this->template->build('sections/'.$this->data['section_info']['view'].'-home', $this->data);
		    }
		} else {
			$this->template->build('sections/no-active-section', $this->data);
		}
	}
}