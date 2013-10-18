<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        
        $this->load->library('pagination');
        
        $this->load->model('Navigation');
        $this->load->model('News');
        $this->load->model('Gallery');
        
        $this->template->set_theme('main');
        $this->template->set_layout('site');
        
        $this->template->set_partial('header','partials/header');
        $this->template->set_partial('footer','partials/footer');
        
        
        // Carga de datos globales
        
        $this->data['query_main_nav'] = $this->Navigation->get_header_entries();
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
	
	function index()
	{
		$this->template->set_partial('sidebar','partials/sidebar');
		$this->data['sidebar'] = $this->Navigation->load_sidebar(array('tags','mas_leidos', 'ultimos_comentarios', 'twitter'));
		//$this->data['breadcrumbs'] = $this->Navigation->get_breadcrumbs($sectionSlug);
	 	
	 	$this->data['section_info'] = $this->Navigation->get_section_array(array('menus2.slug'=>'noticias') );
	 	
	 	// Paginator config
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
	 	// Fin config aginator
	 	
	 	// Cargar los articulos/noticias
	 	$this->data['news'] = $this->News->get_noticias_array(array('news.active' => 1), 
	 											  			  $this->data['limit'], 
	 											  			  $this->data['offset']);
	 	foreach ($this->data['news'] as &$noticia) {
	 		$noticia['images'] = $this->Gallery->get_images_array($noticia['id']);
	 		$noticia['tags'] = $this->News->get_tags_array($noticia['id']);
	 	}
	 	
	 	$this->template->title('Colegio del arte Mayor de la seda | Noticias');
	 	$this->template->build('sections/noticias-home', $this->data);
	}
	
	function tag($tag = '')
	{
		$this->template->set_partial('sidebar','partials/sidebar');
		$this->data['sidebar'] = $this->Navigation->load_sidebar(array('tags','mas_leidos', 'ultimos_comentarios', 'twitter'));
		//$this->data['breadcrumbs'] = $this->Navigation->get_breadcrumbs($sectionSlug);
	 	
	 	$this->data['section_info'] = $this->Navigation->get_section_array(array('menus2.slug'=>'noticias') );
	 	
	 	// Paginator config
	 	$this->data['offset'] = $this->uri->segment(3);
	 	$this->data['limit'] = 5;
	 	$config['base_url'] = site_url().'/noticias/'.$tag.'/';
	 	$this->data['count'] = $config['total_rows'] = $this->News->count_all(array('tags.name' => $tag));
	 	$config['per_page'] = $this->data['limit'];
	 	$config['uri_segment'] = 3;
	 	$config['num_links'] = 2;
	 	
	 	$this->pagination->initialize($config);
	 	$paginator=$this->pagination->create_links();
	 	
	 	$this->data['paginator'] = $paginator;
	 	// Fin config aginator
	 	
	 	// Cargar los articulos/noticias
	 	$this->data['news'] = $this->News->get_noticias_array(array('tags.name' => $tag, 'news.active' => 1), 
	 											  			  $this->data['limit'], 
	 											  			  $this->data['offset']);
	 	
	 	$this->template->title('Colegio del arte Mayor de la seda | Noticias');
	 	$this->template->build('sections/noticias-home', $this->data);
	}
	
	function single($slug = '')
	{
		$this->template->set_partial('sidebar','partials/sidebar');
		$this->data['sidebar'] = $this->Navigation->load_sidebar(array('tags','mas_leidos', 'ultimos_comentarios','twitter'));
		//$this->data['breadcrumbs'] = $this->Navigation->get_breadcrumbs($sectionSlug);
	 	
	 	//$this->data['section_info'] = $this->Navigation->get_section_array(array('menus2.slug'=>'noticias') );
	 	
	 	// Cargar los articulos/noticias
	 	$this->data['news'] = $this->News->get_noticia_array(array('news.slug' => $slug));
	 	$this->News->update($this->data['news']['id'], array('visits' => $this->data['news']['visits']+1));
	 	
	 	$this->template->title('Colegio del arte Mayor de la seda | Noticias');
	 	$this->template->build('sections/noticias-single', $this->data);
	}
	
}