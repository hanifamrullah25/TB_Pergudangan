<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->load->library('form_validation');
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		//jika user ada
		if ($user) {
			//jika user active
			if ($user['is_active'] == 1) {
				//jika password ada
				if (password_verify($password, $user['password'])) {
					
					$data = [

						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('admin');
					}else{
						redirect('user');
					}


				}else{
					$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
					  Wrong Password
					</div>');
					redirect('auth');	
				}

			}else{
				$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
				  Account need to activated first !
				</div>');
				redirect('auth');	
			}

		}else{
			$this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
				  Account not exist
				</div>');
				redirect('auth');			
		}
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false){			
			$data['title'] = 'Login Page';
			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('template/auth_footer');
		}else{
			$this->_login();
		}		
	}

	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'email already taken!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
				'matches' => 'password not match!',
				'min_length' => 'too short bro!'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]');

		if ($this->form_validation->run() == false){

			$data['title'] = 'User Registration';
			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('template/auth_footer');

		}else{

			$data = [

				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
				  Account has been created!
				</div>');
			redirect('auth');

		}

	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');


		$this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
				  Logout success
				</div>');
			redirect('auth');
	}

}