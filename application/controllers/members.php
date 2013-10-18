<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Navigation');
		
		
		$this->template->set_theme('main');
		$this->template->set_layout('site');
		
		$this->template->set_partial('header','partials/header');
		$this->template->set_partial('footer','partials/footer');
		
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('members/login', 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//Load user info panel
			//$this->load->view('members/index', $this->data);
			
			// Aunque de momento redireccionamos a Home y listo
			redirect($this->config->item('base_url'), 'refresh');
		}
	}

	//log the user in
	function login()
	{
		
		if ($this->ion_auth->logged_in())
		{
			//already logged in so no need to access this page
			redirect($this->config->item('base_url'), 'refresh');
		}
		
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
				redirect($this->config->item('base_url'), 'refresh');
			}
			else
			{ //if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('members/login', 'refresh');
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
				'placeholder' => 'Nombre de usuario'
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'user_pass',
				'type' => 'password',
				'placeholder' => 'Contraseña'
			);
			
			$this->data['query_main_nav'] = $this->Navigation->get_header_entries();
			
			$this->template->title('Colegio del arte Mayor de la seda | LOG IN');
			        
			$this->template->build('members/login', $this->data);
		}
	}

	//log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('members/login', 'refresh');
	}
	
	//log the user in
	function register()
	{
		
		if ($this->ion_auth->logged_in())
		{
			//already logged in so no need to access this page
			redirect($this->config->item('base_url'), 'refresh');
		}
		
		//validate form input
		$this->form_validation->set_rules('name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('tlf', 'Telefono', 'numeric|xss_clean');
		$this->form_validation->set_rules('mail', 'Email Address', 'required|valid_email|callback_mail_check');
		$this->form_validation->set_rules('nick', 'Nick name', 'required|min_length[5]|max_length[15]|callback_username_check|xss_clean');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[pass2]');
		$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == true)
		{
			$username = $this->input->post('nick');
			$email = $this->input->post('mail');
			$password = $this->input->post('pass');

			$additional_data = array('first_name' => $this->input->post('name'),
									 'last_name' => $this->input->post('lastname'),
									 'telefono' => $this->input->post('tlf')
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{ //check to see if we are creating the user
		
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->session->set_flashdata('new_user_name', $username);
			$this->session->set_flashdata('new_user_mail', $email);
			
			// Usuario creado, redireccionar a mensaje de confirmacion de email enviado
			redirect( 'members/message/user_confirmation', 'refresh');
		}
		else
		{ 		
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['name'] = array('name' => 'name',
				'id' => 'user_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('name'),
				'placeholder' => 'Nombre'
			);
			$this->data['lastname'] = array('name' => 'lastname',
				'id' => 'user_last',
				'type' => 'text',
				'value' => $this->form_validation->set_value('lastname'),
				'placeholder' => 'Apellidos'
			);
			$this->data['tlf'] = array('name' => 'tlf',
				'id' => 'user_tlf',
				'type' => 'text',
				'value' => $this->form_validation->set_value('tlf'),
				'placeholder' => 'Telefono*'
			);
			$this->data['nick'] = array('name' => 'nick',
				'id' => 'nick',
				'type' => 'text',
				'value' => $this->form_validation->set_value('nick'),
				'placeholder' => 'Nick'
			);
			$this->data['mail'] = array('name' => 'mail',
				'id' => 'mail',
				'type' => 'text',
				'value' => $this->form_validation->set_value('mail'),
				'placeholder' => 'Email'
			);			
			$this->data['pass'] = array('name' => 'pass',
				'id' => 'pass',
				'type' => 'password',
				'value' => $this->form_validation->set_value('pass'),
				'placeholder' => 'Contraseña'
			);
			$this->data['pass2'] = array('name' => 'pass2',
				'id' => 'pass2',
				'type' => 'password',
				'value' => $this->form_validation->set_value('pass2'),
				'placeholder' => 'Repita su contraseña'
			);

			$this->data['query_main_nav'] = $this->Navigation->get_header_entries();
			
			$this->template->title('Colegio del arte Mayor de la seda | REGISTER');
			$this->template->build('members/register', $this->data);
		}		
	}
	
	function message($mode = '') {
		
		$this->data['query_main_nav'] = $this->Navigation->get_header_entries();
		
		switch ($mode) {
			case 'user_confirmation':
			
				//$this->data['heading'] = "Muchas gracias, " .$this->session->flashdata('new_user_name');
				//$this->data['info'] = "Un email ha sido enviado a la direccion de correo " .$this->session->flashdata('new_user_mail'). ". \n Pulse el enlace para activar su cuenta.";
				$notification = "Muchas gracias, " .$this->session->flashdata('new_user_name')."<br />"."Un email ha sido enviado a la direccion de correo " .$this->session->flashdata('new_user_mail'). ". Pulse el enlace para activar su cuenta.";
				$this->session->set_flashdata('notification', $notification);
				//$this->template->title('Colegio del arte Mayor de la seda | EMAIL CONFIRMATION');
				break;
				
			case 'user_activation':
			
				//$this->data['heading'] = "Bienvenido, " .$this->session->flashdata('user_name');
				//$this->data['info'] = "Su cuenta ha sido activada. Puede ingresar si lo desea desde " . anchor('members/login', 'esta direccion') .".";
				$notification = "Bienvenido, " .$this->session->flashdata('user_name')."<br />"."Su cuenta ha sido activada. Puede ingresar si lo desea desde " . anchor('members/login', 'esta direccion') .".";
				$this->session->set_flashdata('notification', $notification);
				
				//$this->template->title('Colegio del arte Mayor de la seda | USER ACTIVATION');
				break;
				
			default:
				redirect('404');
				break;	
		}
		
		redirect('home', 'refresh');
		//$this->template->build('members/message', $this->data);
	}
	
	
	function activate($id, $code=false)
	{
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);


		if ($activation)
		{
			$user = $this->ion_auth->get_user($id);
			$this->session->set_flashdata('user_name', $user->first_name . ' ' . $user->last_name);
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect('members/message/user_activation', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('members/forgot_password', 'refresh');
		}
	}
		
	function check_free_username()
	{
		if( $this->input->is_ajax_request() )
		{		
			$username = $this->input->post('nick');
			
			if (!$this->ion_auth->username_check($username))
			{
				echo json_encode(TRUE);
			}
			else {
				echo json_encode(FALSE);
			}
		}
	}
	
	function username_check($str)
	{
		if (!$this->ion_auth->username_check($str))
		{
			return TRUE;
		}
		else {
			$this->form_validation->set_message('username_check', 'Nombre de usuario ' . $str . ' ya en uso' );
			return FALSE;
		}
	}
	
	function check_free_mail()
	{
		if( $this->input->is_ajax_request() )
		{		
			$email = $this->input->post('mail');
			
			if (!$this->ion_auth->email_check($email))
			{
				echo json_encode(TRUE);
			}
			else {
				echo json_encode(FALSE);
			}
		}
	}
	function mail_check($str)
	{
		if (!$this->ion_auth->email_check($str))
		{
			return TRUE;
		}
		else {
			$this->form_validation->set_message('mail_check', 'La direccion email ' . $str . ' ya ha sido registrada');
			return FALSE;
		}
	}
	
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
