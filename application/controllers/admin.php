<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct() 
    {
        parent::__construct();
        
       	$this->load->model('Navigation');
        $this->load->library('form_validation');
        
        $this->template->set_theme('main');
        $this->template->set_layout('admin');
        
        $this->template->set_partial('header','partials/header_admin');
        $this->template->set_partial('footer','partials/footer');
        
        if (isset($_SERVER['HTTP_REFERER']))
         {
         $this->session->set_userdata('previous_page', $_SERVER['HTTP_REFERER']);
         }
         else
         {
         $this->session->set_userdata('previous_page', base_url());
         }
         
         $this->data['notification'] = $this->session->flashdata('notification'); 
        
    }
    
	function index()
	{
		if ($this->ion_auth->logged_in())
		{
			if (!$this->ion_auth->is_admin()) {
				$logout = $this->ion_auth->logout();
				redirect('admin', 'refresh');
			} else {
				redirect('admin/cpanel', 'refresh');
			}
				
		} else {
		
			//validate form input
			$this->form_validation->set_rules('username', 'User Name', 'required|min_length[5]|max_length[15]');
			$this->form_validation->set_rules('password', 'Password', 'required');
	
			if ($this->form_validation->run() == true)
			{ //check to see if the user is logging in
				//check for "remember me"
				$remember = (bool) FALSE;
	
				if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember))
				{ //if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->session->set_flashdata('notification', 'Bienvenido, '.$this->input->post('username').'.');
					redirect('admin/cpanel', 'refresh');
				}
				else
				{ //if the login was un-successful
					//redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('admin', 'refresh');
				}
			}
			else
			{  //the user is not logging in so display the login page
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	
				$this->data['username'] = array('name' => 'username',
					'id' => 'user_name',
					'type' => 'text',
					'value' => $this->form_validation->set_value('username'),
					'placeholder' => 'Nombre de Usuario'
				);
				$this->data['password'] = array('name' => 'password',
					'id' => 'user_pass',
					'type' => 'password',
					'placeholder' => 'Contraseña'
				);
				
				$this->data['query_main_nav'] = $this->Navigation->get_header_entries();
				
				$this->template->title('Colegio del arte Mayor de la seda | LOG IN');
				        
				$this->template->build('admin/login', $this->data);
			}
		}
	}
	
	function logout()
	{
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('admin', 'refresh');
	}
	
	function cpanel()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		$this->template->title('Colegio del arte Mayor de la seda | CPANEL');
	            
	    $this->template->build('admin/cpanel', $this->data);
	}
	
	function articulos()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		$this->load->library('pagination');
		$this->load->model('Article');
		
		$where = '';
		$this->data['sId'] = '';
		if ($this->input->get('s')) {
			$this->data['sId'] = $this->input->get('s');
			$where = array('articles.sectionId' => $this->data['sId']);
		}
		
		$this->data['sId'] = $this->input->get('s');
		
		// Pagination configuration
		$this->data['offset'] = $this->uri->segment(4);
		$this->data['limit'] = 5;
		
		$config['base_url'] = site_url() . '/admin/list/articulos/';
		$this->data['count'] = $config['total_rows'] = $this->Article->count_all($this->data['sId']);
		
		$config['per_page'] = $this->data['limit'];
		$config['uri_segment'] = 4;
		$config['num_links'] = 2;
		
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		
		$this->data['paginator'] = $paginator;
		// End pagination confiuration
		
		// Dropdown section selector
		$this->db->select('id, name');
		
		$query = $this->db->get('menus2')->result_array();
		$list = array('0' => 'Seleccione una seccion:');
		foreach ($query as $value) {
			$list[$value['id']] = $value['name'];
		}
		$this->data['droplist'] = $list;
		// end dropdown selector
		
		$this->data['articles'] = $this->Article->get_articulos_array($where, 
														 $this->data['limit'], 
														 $this->data['offset']);
		
		$this->template->title('Colegio del arte Mayor de la seda | CPANEL');
	    $this->template->build('admin/articulos', $this->data);
	}
	
	function delete_articulo( $id = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$this->load->model('Article');
			$result = $this->Article->delete($id);
			
			if ($result) {
				$data['status'] = TRUE;
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				echo json_encode($data);
			}
		}
	}
	
	function activate_articulo( $id = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$this->load->model('Article');
			
			if ( $this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				$result = $this->Article->activate($id);
					
			if ($result) {
				$data['status'] = TRUE;
				$data['message'] = 'Articulo activado!';
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al activar el articulo...';
				echo json_encode($data);
			}
		}
	}
	
	function deactivate_articulo( $id = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$this->load->model('Article');
			
			if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			{
				$result = $this->Article->deactivate($id);
			}
					
			if ($result) {
				$data['status'] = TRUE;
				$data['message'] = 'Articulo desactivado!';
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al desactivar el articulo...';
				echo json_encode($data);
			}
		}
	}
	
	function edit_articulo($id=NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		$this->load->model('Article');
		
		//validate form input
		$this->form_validation->set_rules('title', 'Titulo', 'required');
		$this->form_validation->set_rules('content', 'contenido', 'required');

		if ($this->form_validation->run() == true)
		{
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
			
			$data = array( 'title' => $this->input->post('title'),
							'content' => $this->input->post('content'),
							'slug' => $slug,
							'author' => $this->session->userdata('user_id'),
							'sectionId' => $this->input->post('menus_drop')
						);
						
			$result = $this->Article->update($id, $data);
			//print_r($data);
			if ($result) {
				$this->session->set_flashdata('notification', 'Articulo actualizado correctamente');
			} else {
				$this->session->set_flashdata('notification', 'Error actualizando el articulo, contacte con el administrador');
			}
			redirect('admin/edit/articulo/'.$id, 'refresh');
			
		} else {
			
			$where = array('articles.id' => $id);
			$this->data['article'] = $this->Article->get_articulo_array($where);
			
			$this->db->select('id, name');
			
			$query = $this->db->get('menus2')->result_array();
			$list = array();
			foreach ($query as $value) {
				$list[$value['id']] = $value['name'];
			}
			$this->data['droplist'] = $list;
			
			$this->data['message'] = $this->session->flashdata('message');
			
			$this->data['submit'] = array('name' => 'submit',
			'id' => 'submitButton',
			'type' => 'submit',
			'value' => 'Guardar Cambios',
			'onclick' => 'my_instance.post()'
			);
			
			$this->data['title'] = array('name' => 'title',
			'id' => 'titleArticle',
			'type' => 'text',
			'value' => $this->data['article']['title'],
			);
			$this->data['content'] = array('name' => 'content',
				'id' => 'contentArticle',
				'value' => $this->data['article']['content']
			);
			
			$this->template->title('Colegio del arte Mayor de la seda | CPANEL');
			$this->template->build('admin/editArticle', $this->data);
		}
		
	}
	
	function new_articulo()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		$this->load->model('Article');
		
		//validate form input
		//$this->form_validation->set_rules('title', 'Titulo', 'required');
		$this->form_validation->set_rules('content', 'contenido', 'required');

		if ($this->form_validation->run() == true)
		{
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
			
			$data = array( 'title' => $this->input->post('title'),
							'content' => $this->input->post('content'),
							'slug' => $slug,
							'author' => $this->session->userdata('user_id'),
							'sectionId' => $this->input->post('menus_drop'),
							'active' => $this->input->post('active')
						);
			
			if ($this->Article->create($data)) {
				$this->session->set_flashdata('message', 'Articulo actualizado correctamente'. $this->input->post('menus_drop') );
				$id = $this->db->insert_id();
				redirect('admin/edit/articulo/'.$id, 'refresh');
			} else {
				$this->session->set_flashdata('message', 'Error insertando el articulo, contacte con el administrador');
				redirect('admin/new/articulo', 'refresh');
			}
			
		} else {
			
			$this->db->select('id, name');
			
			$query = $this->db->get('menus2')->result_array();
			$list = array('0' => 'Seleccione una seccion:');
			foreach ($query as $value) {
				$list[$value['id']] = $value['name'];
			}
			$this->data['droplist'] = $list;
			
			$this->data['message'] = $this->session->flashdata('message');
			
			$this->data['title'] = array('name' => 'title',
				'id' => 'titleArticle',
				'type' => 'text',
				'value' => '',
			);
			$this->data['content'] = array('name' => 'content',
				'id' => 'contentArticle',
				'value' => ''
			);
			$this->data['check'] = array('name' => 'active',
				'id' => 'active_check',
				'value' => 1,
				'checked' => FALSE
			);
			
			$this->template->title('Colegio del arte Mayor de la seda | Nuevo Articulo');
			$this->template->build('admin/newArticle', $this->data);
		}
		
	}
		
	function users()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		$this->load->library('pagination');
		
		$this->data['offset'] = $this->uri->segment(4);
		$this->data['limit'] = 10;
		
		$this->data['gId'] = $this->input->get('g');
		
		$this->load->model('User');
		$this->data['users'] = $this->ion_auth->get_users_array($this->data['gId'], 
																$this->data['limit'], 
																$this->data['offset']);
		
		
		//$query = $this->ion_auth->get_groups_array();
		$query = $this->db->get('groups')->result_array();
		$list = array('0' => 'Seleccione un grupo de usuarios:');
		foreach ($query as $value) {
			$list[$value['name']] = $value['description'];
		}
		$this->data['droplist'] = $list;
		
		
		$config['base_url'] = site_url() . '/admin/list/users/';
		// El total rows lo debo de meter en el modelo users
		$this->data['count'] = $config['total_rows'] = $this->User->count_all();
		$config['per_page'] = $this->data['limit'];
		$config['uri_segment'] = 4;
		$config['num_links'] = 2;
		//$config['anchor_class'] = 'class="buttonLink"';
		
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		
		$this->data['paginator'] = $paginator;
		        
		$this->template->title('Colegio del arte Mayor de la seda | CPANEL');
	    $this->template->build('admin/users', $this->data);
	}
	
	function delete_user( $uid = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$result = $this->ion_auth->delete_user($uid);
			
			if ($result) {
				$data['status'] = TRUE;
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				echo json_encode($data);
			}
		}
	}
	
	function activate_user( $uid = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			
			if ($this->ion_auth->is_admin())
				$result = $this->ion_auth->activate($uid);
					
			if ($result) {
				$data['status'] = TRUE;
				$data['message'] = 'Usuario activado!';
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al activar el usuario...';
				echo json_encode($data);
			}
		}
	}
	
	function deactivate_user( $uid = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			{
				$result = $this->ion_auth->deactivate($uid);
			}
					
			if ($result) {
				$data['status'] = TRUE;
				$data['message'] = 'Usuario desactivado!';
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al desactivar el usuario...';
				echo json_encode($data);
			}
		}
	}
	
	function makeAdmin( $uid = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			if ($this->ion_auth->is_admin())
				$result = $this->ion_auth->update_user($uid, array( 'group_id' => 1 ));
					
			if ($result) {
				$data['status'] = TRUE;
				$data['message'] = 'Usuario pasado a grupo Administrador!';
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al cambiar el grupo del usuario...';
				echo json_encode($data);
			}
		}
	}
	
	function upload($tipo='') {
		
		$this->load->library('upload');
		$this->load->library('image_lib'); 
		$this->load->model('Gallery');
		
		$config['upload_path'] = './img/uploads/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|tiff';
	    $config['max_size']    = '3000';
	    
	    
	    $resize['image_library'] = 'gd2';
	    $resize['create_thumb'] = TRUE;
	    $resize['maintain_ratio'] = TRUE;
	    $resize['width']	 = 80;
	    $resize['height']	= 80;
	    
	    foreach($_FILES as $key => $value)
        {
            if( ! empty($key['name']))
            {
            	$config['file_name'] = $this->input->post('articleId').'_'.now().'_'.$_FILES[$key]['name'];
            	
            	$this->upload->initialize($config);
        		
                if ( !$this->upload->do_upload($key))
                {
                    $this->session->set_flashdata('message', $this->upload->display_errors() );
                    redirect($this->session->userdata('previous_page'));
                }    
                else
                {
                	
                	$data = $this->upload->data();
                	$name = $data['file_name'];
                	
    	        	$img = array(
    	        	   'articleId' => $this->input->post("articleId"),
    	        	   'descripcion' => $this->input->post('desc'),
    	        	   'name' => $name,
    	        	   'tipo' => $tipo
    	        	);
    	        	
    	        	$this->Gallery->create($img); 
                	
                    redirect($this->session->userdata('previous_page'));
                }
            }
        }
	}
	
	function noticias()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		$this->load->library('pagination');
		$this->load->model('Gallery');
		
		$this->data['offset'] = $this->uri->segment(4);
		$this->data['limit'] = 2;
		
		$this->data['tId'] = $this->input->get('t');
		
		$this->load->model('News');
		$this->data['news'] = $this->News->get_noticias_array($this->data['tId'], 
												  $this->data['limit'], 
												  $this->data['offset']);
		foreach ($this->data['news'] as &$noticia) {
			$noticia['images'] = $this->Gallery->get_images_array($noticia['id']);
			$noticia['tags'] = $this->News->get_tags_array($noticia['id']);
		}
		
		$this->db->select('id, name');
		
		$query = $this->db->get('tags')->result_array();
		$list = array('0' => 'Seleccione una etiqueta:');
		foreach ($query as $value) {
			$list[$value['id']] = $value['name'];
		}
		$this->data['droplist'] = $list;
		
		$config['base_url'] = site_url() . '/admin/list/noticias/';
		$this->data['count'] = $config['total_rows'] = $this->News->count_all($this->data['tId']);
		$config['per_page'] = $this->data['limit'];
		$config['uri_segment'] = 4;
		$config['num_links'] = 2;
		
		$this->pagination->initialize($config);
		$paginator=$this->pagination->create_links();
		
		$this->data['paginator'] = $paginator;
		
		$this->template->title('Colegio del arte Mayor de la seda | CPANEL');
	    $this->template->build('admin/noticias', $this->data);
	}
	
	function new_noticia()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		$this->load->model('News');
		
		//validate form input
		$this->form_validation->set_rules('item', 'Tags', 'required');
		$this->form_validation->set_rules('title', 'Titulo', 'required');
		//$this->form_validation->set_rules('content', 'contenido', 'required');

		if ($this->form_validation->run() == true)
		{
			
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
			
			$regs = '';
			$url = $this->input->post('source');
			
			
			$data = array( 'title' => $this->input->post('title'),
							'content' => $this->input->post('content'),
							'slug' => $slug,
							'author' => $this->session->userdata('user_id'),
							'active' => $this->input->post('active'),
							'source' => $url,
							'source_name' => $this->input->post('source_name')
						);
			$tags = $this->input->post('item');
			
			if ($this->News->create($data, $tags['tags'])) {
				$this->session->set_flashdata('message', 'Articulo actualizado correctamente');
				$id = $this->db->select('id')->where('slug',$slug)->get('news')->row_array();
				redirect('admin/edit/noticia/'.$id['id'], 'refresh');
			} else {
				$this->session->set_flashdata('message', 'Error insertando el articulo, contacte con el administrador');
				redirect('admin/new/noticia', 'refresh');
			}
			
		} else {
			
			$this->data['message'] = $this->session->flashdata('message');
			
			$this->data['title'] = array('name' => 'title',
				'id' => 'titleArticle',
				'type' => 'text',
				'placeholder' => 'Titulo',
				'value' => '',
			);
			$this->data['content'] = array('name' => 'content',
				'id' => 'contentArticle',
				'placeholder' => 'Contenido',
				'value' => ''
			);
			$this->data['source'] = array('name' => 'source',
				'id' => 'sourceArticle',
				'type' => 'text',
				'placeholder' => 'Url',
				'value' => ''
			);
			$this->data['source_name'] = array('name' => 'source_name',
				'id' => 'source_nameArticle',
				'type' => 'text',
				'placeholder' => 'Nombre de la web',
				'value' => ''
			);
			$this->data['check'] = array('name' => 'active',
				'id' => 'active_check',
				'value' => 1,
				'checked' => FALSE
			);
			
			$this->template->title('Colegio del arte Mayor de la seda | Nueva Noticia');
			$this->template->build('admin/newNoticia', $this->data);
		}
		
	}
	
	function edit_noticia($id=NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		$this->load->model('News');
		
		//validate form input
		$this->form_validation->set_rules('item', 'Tags', 'required');
		$this->form_validation->set_rules('title', 'Titulo', 'required');
		$this->form_validation->set_rules('content', 'contenido', 'required');

		if ($this->form_validation->run() == true)
		{
			$slug = url_title($this->input->post('title'), 'dash', TRUE);
			
			$regs = '';
			$url = $this->input->post('source');
			
			$data = array( 'title' => $this->input->post('title'),
							'content' => $this->input->post('content'),
							'slug' => $slug,
							'author' => $this->session->userdata('user_id'),
							'source' => $url,
							'source_name' => $this->input->post('source_name')
						);
			$tags = $this->input->post('item');	
			$result = $this->News->update($id, $data, $tags['tags']);
			
			if ($result) {
				$this->session->set_flashdata('message', '<p>Articulo actualizado correctamente</p>');
			} else {
				$this->session->set_flashdata('message', 'Error actualizando la noticia, contacte con el administrador');
			}
			redirect('admin/edit/noticia/'.$id, 'refresh');
			
		} else {
			
			$this->load->model('Gallery');
			
			$this->data['noticia'] = $this->News->get_noticia_array(array('news.id' => $id));
			
			$this->data['noticia']['images'] = $this->Gallery->get_images_array($id);
			$this->data['noticia']['tags'] = $this->News->get_tags_array($id);
			
			$this->data['message'] = $this->session->flashdata('message');
			
			$this->data['title'] = array('name' => 'title',
			'id' => 'titleArticle',
			'type' => 'text',
			'value' => $this->data['noticia']['title'],
			);
			$this->data['content'] = array('name' => 'content',
				'id' => 'contentArticle',
				'value' => $this->data['noticia']['content']
			);
			$this->data['source'] = array('name' => 'source',
				'id' => 'sourceArticle',
				'type' => 'text',
				'placeholder' => 'Url',
				'value' => $this->data['noticia']['source']
			);
			$this->data['source_name'] = array('name' => 'source_name',
				'id' => 'source_nameArticle',
				'type' => 'text',
				'placeholder' => 'Nombre de la web',
				'value' => $this->data['noticia']['source_name']
			);
			$this->data['submit'] = array('name' => 'submit',
			'id' => 'submitButton',
			'type' => 'submit',
			'value' => 'Guardar Cambios',
			'onclick' => 'my_instance.post()'
			);
			
			
			$this->template->title('Colegio del arte Mayor de la seda | CPANEL');
			$this->template->build('admin/editNoticia', $this->data);
		}
		
	}
	
	function delete_noticia( $id = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$this->load->model('News');
			$result = $this->News->delete($id);
			
			if ($result) {
				$data['status'] = TRUE;
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				echo json_encode($data);
			}
		}
	}
	
	function activate_noticia( $id = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$this->load->model('News');
			
			if ( $this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				$result = $this->News->activate($id);
					
			if ($result) {
				$data['status'] = TRUE;
				$data['message'] = 'Articulo activado!';
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al activar el articulo...';
				echo json_encode($data);
			}
		}
	}
	
	function deactivate_noticia( $id = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$this->load->model('News');
			
			if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			{
				$result = $this->News->deactivate($id);
			}
					
			if ($result) {
				$data['status'] = TRUE;
				$data['message'] = 'Articulo desactivado!';
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al desactivar el articulo...';
				echo json_encode($data);
			}
		}
	}
	
	function delete_image( $id = NULL ) {
		
		if ($this->input->is_ajax_request())
		{
			$this->load->model('Gallery');
			$result = $this->Gallery->delete(array('id'=>$id));
			
			$this->load->model('Navigation');
			$result = $this->Navigation->delete_destacado(array('imageId'=>$id));
			
			if ($result) {
				$data['status'] = TRUE;
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				echo json_encode($data);
			}
		}
	}
		
	function test() {
		if ($this->input->is_ajax_request())
		{
			if ($this->ion_auth->is_admin())
				$this->load->model('News');
				$tags = array();
				$query = $this->db->get('tags')->result_array();
				foreach ($query as $value) {
					$tags[] = $value['name'];
				}
					
			if (is_array($tags)) {
				$data = array( 'tags' => $tags );
				echo json_encode($data);
			} else {
				$data['status'] = FALSE;
				$data['message'] = 'Se ha producido un error al cambiar el grupo del usuario...';
				echo json_encode($data);
			}
		}
	}
	
	function secciones()
	{
		// Posibles Extras.
		// - Opcion para cambiar el tipo de vista de la seccion
		// - Mostrar el numero de articulos de la seccion??
		// - ..
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		/* //Dropdown section selector
		$this->db->select('id, name');
		$query = $this->db->get('menus2')->result_array();
		
		$list = array('0' => 'Seleccione una seccion:');
		foreach ($query as $value) {
			$list[$value['id']] = $value['name'];
		}
		$this->data['droplist'] = $list;
		//end dropdown selector */
		
		// Hack, como solo hay n subnivel, es igual que el header, y nos vale.
		$this->data['secciones'] = $this->Navigation->get_header_entries();
		
		$this->template->title('Colegio del arte Mayor de la seda | SECCIONES');
	    $this->template->build('admin/secciones', $this->data);
	}
	
	function activate_seccion( $id = NULL ) {
		
		$this->load->model('Navigation');
		
		if ( $this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			$result = $this->Navigation->activate_seccion($id);
				
		$notification  = ($result) ? 'Seccion activada!' : 
									 'Se ha producido un error al activar la seccion...';
		
		$this->session->set_flashdata('notification', $notification);
		redirect('admin/list/secciones', 'refresh');
	}
	
	function deactivate_seccion( $id = NULL ) {
		
		$this->load->model('Navigation');
			
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			$result = $this->Navigation->deactivate_seccion($id);
			
		$notification  = ($result) ? 'Seccion desactivada!' : 
									 'Se ha producido un error al desactivar la seccion...';
		
		$this->session->set_flashdata('notification', $notification);
		redirect('admin/list/secciones', 'refresh');
	}
	
	function destacados()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		/* //Dropdown section selector
		$this->db->select('id, name');
		$query = $this->db->get('menus2')->result_array();
		
		$list = array('0' => 'Seleccione una seccion:');
		foreach ($query as $value) {
			$list[$value['id']] = $value['name'];
		}
		$this->data['droplist'] = $list;
		//end dropdown selector */
		
		// Hack, como solo hay n subnivel, es igual que el header, y nos vale.
		$this->data['destacados'] = $this->Navigation->get_slider_entries();
		
		$this->template->title('Colegio del arte Mayor de la seda | DESTACADOS');
	    $this->template->build('admin/destacados', $this->data);
	}
	
	function edit_destacado($tipo = 'articulo', $imageId = NULL) {
		$this->load->model('Navigation');

		$data = array( 'content' => '',
						'active' => 1,
						'imageId' => $imageId
						);
						
		if ($this->Navigation->create_destacado($data)) {
			$this->session->set_flashdata('notification', 'Destacado actualizado correctamente');
			redirect($this->session->flashdata('previous_page'), 'refresh');
		} else {
			$this->session->set_flashdata('notification', 'Error destacando la imagen...');
			redirect($this->session->flashdata('previous_page'), 'refresh');
		}
	}
	
	function activate_destacado( $id = NULL ) {
		
		$this->load->model('Navigation');
		
		if ( $this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			$result = $this->Navigation->activate_destacado($id);
				
		$notification  = ($result) ? 'destacado activado!' : 
									 'Se ha producido un error al activar el destacado...';
		
		$this->session->set_flashdata('notification', $notification);
		redirect('admin/list/destacados', 'refresh');
	}
	
	function deactivate_destacado( $id = NULL ) {
		
		$this->load->model('Navigation');
			
		if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			$result = $this->Navigation->deactivate_destacado($id);
			
		$notification  = ($result) ? 'Destacado desactivado!' : 
									 'Se ha producido un error al desactivar el destacado...';
		
		$this->session->set_flashdata('notification', $notification);
		redirect('admin/list/destacados', 'refresh');
	}
	
	function delete_destacado( $id = NULL ) {
		
		$this->load->model('Navigation');
		$result = $this->Navigation->delete_destacado(array('id' => $id));
			
		$notification  = ($result) ? 'destacado eliminado!' : 
									 'Se ha producido un error al eliminar el destacado...';
		
		$this->session->set_flashdata('notification', $notification);
		redirect('admin/list/destacados', 'refresh');
	}
	
	function eventos()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
				redirect('admin', 'refresh');		
		}
		
		/* //Dropdown section selector
		$this->db->select('id, name');
		$query = $this->db->get('menus2')->result_array();
		
		$list = array('0' => 'Seleccione una seccion:');
		foreach ($query as $value) {
			$list[$value['id']] = $value['name'];
		}
		$this->data['droplist'] = $list;
		//end dropdown selector */
		
		// Hack, como solo hay n subnivel, es igual que el header, y nos vale.
		//$this->data['destacados'] = $this->Navigation->get_slider_entries();
		
		$this->template->title('Colegio del arte Mayor de la seda | Eventos');
	    $this->template->build('admin/eventos', $this->data);
	}
}