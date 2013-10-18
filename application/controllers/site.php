<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        
        $this->load->model('Navigation');
        $this->load->library('form_validation');
        
        $this->template->set_theme('main');
        $this->template->set_layout('site');
        
        $this->template->set_partial('header','partials/header');
        $this->template->set_partial('footer','partials/footer');
        
        $this->data['notification'] = $this->session->flashdata('notification');   
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
     	redirect('home', 'refresh');     	
	}
	
	public function construction()
	{
	 	$this->load->view('construction');    	
	}
	
	public function test() {
		$this->load->view('test');
	}
	
	
	public function home()
	{
		
		$this->load->model('News');
		
	 	$this->data['query_main_nav'] = $this->Navigation->get_header_entries();
	 	$this->data['query_slider'] = $this->Navigation->get_slider_entries(1);
	 	
	 	//$this->data['breadcrumbs'] = $this->Navigation->get_breadcrumbs('');
	 	//$this->data['sidebar'] = $this->Navigation->load_sidebar(array('mas_leidos', 'ultimos_comentarios'));
	 	
	 	$this->data['news'] = $this->News->get_noticias_array();
	 	
	    $this->template->title('Colegio del arte Mayor de la seda | HOME');
	    $this->template->build('site/home', $this->data);
	}
	
	public function contacto()
	{
		$this->template->set_partial('sidebar','partials/sidebar');
		
		$this->template->title('Colegio del arte Mayor de la seda | CONTACTO');
		
		$this->data['query_main_nav'] = $this->Navigation->get_header_entries();
		$this->data['sidebar'] = $this->Navigation->load_sidebar(array('mas_leidos', 'ultimos_comentarios'));
		
		//validate form input
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('comment', 'Mensaje', 'required');

		if ($this->form_validation->run() == true)
		{ 
			$this->load->library('email');
			
			$this->email->from( $this->input->post('email'), $this->input->post('name'));
			$this->email->to('contact@colegiodelartemayordelaseda.es'); 
			
			$this->email->subject($this->input->post('name').' via formulario de contacto');
			$this->email->message('Mensaje de '.$this->input->post('name').':'.PHP_EOL. $this->input->post('comment'));	
			
			if ( $this->email->send() )
			{ //if the contact email is succesful
				
				$this->session->set_flashdata('notification', 'Mensaje enviado correctamente.');
				redirect('contacto', 'refresh');
			}
			else
			{ //if the contac email was send unsuccesfully
				
				$this->session->set_flashdata('notification', 'Problema enviando mensaje.');
				echo $this->email->print_debugger();
				redirect('contacto', 'refresh');
			}
		} else {
			
			$this->data['message'] = $this->session->flashdata('notification');
			
			if ($this->ion_auth->logged_in()) {
				$user = $this->ion_auth->get_user();
				
				$name_val = $user->first_name . ' ' .$user->last_name;
				$email_val = $user->email;
			} else {
				$name_val = $this->form_validation->set_value('name');
				$email_val = $this->form_validation->set_value('email');
			}
			
			$this->data['name'] = array('name' => 'name',
			'id' => 'contactName',
			'type' => 'text',
			'value' => $name_val,
			);
			$this->data['email'] = array('name' => 'email',
				'id' => 'contactEmail',
				'type' => 'text',
				'value' => $email_val,
			);
			$this->data['comment'] = array('name' => 'comment',
				'id' => 'contactMessage',
				'value' => $this->form_validation->set_value('comment'),
				'rows'	=> 10,
				'cols'	=> 30,
			);
			
			$this->template->build('site/contacto', $this->data);
		}
	}
}