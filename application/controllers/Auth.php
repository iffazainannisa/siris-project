<?php 

class Auth extends CI_Controller{

	public function index(){
		$this->load->view('templates_login/header');
		$this->load->view('login');
		$this->load->view('templates_login/footer');
	}

	public function proses_login(){

		$this->form_validation->set_rules('username','Username','required',['required' => 'Username harus diisi!']);
		$this->form_validation->set_rules('password','Password','required',['required' => 'Password harus diisi!']);
		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates_login/header');
			$this->load->view('login');
			$this->load->view('templates_login/footer');
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$usern = $username;
			$pass = md5($password);

			$userku = $this->db->get_where('user', ['username' => $usern, 'password' => $pass])->row_array();

			if ($userku){
				
				if($userku['level'] == 'admin'){
					$data = [
						'usernames' => $userku['username'],
						'levels' => $userku['level'],
						'id_bidangs' => $userku['id_bidang'],
					];
					$this->session->set_userdata($data);
					redirect('admin/dashboard');
				}
				else if($userku['level'] == 'user'){
					$data = [
						'username' => $userku['username'],
						'level' => $userku['level'],
						'id_bidang' => $userku['id_bidang'],
					];
					$this->session->set_userdata($data);
					redirect('user/dashboard');
				}
				else if($userku['level'] == 'kepala'){
					$data = [
						'usernamel' => $userku['username'],
						'levell' => $userku['level'],
						'id_bidangl' => $userku['id_bidang'],
					];
					$this->session->set_userdata($data);
					redirect('kepala/dashboard');
				}
				else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Username atau Password salah<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
					redirect('auth');
				}
			}else{
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Username atau Password salah<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('auth');
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect ('auth');
	}

}

?>
