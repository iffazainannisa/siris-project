<?php 

class user extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['user'] = $this->m_admin->all_user();

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tampil_user', $data);
		$this->load->view('admin/templates_administrator/footer',$data);

	}
	public function tambah(){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		// $data['ruang'] = $this->m_admin->get_ruang();
		$data['user'] = $this->m_admin->get_user();
		$data['bidang'] = $this->m_admin->get_bidang1();

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tambah_user', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

		public function tambah_aksi(){
		$this->form_validation->set_rules('nama_user', 'Nama user','required');
		$this->form_validation->set_rules('level', 'Level','required');
		$this->form_validation->set_rules('nama_bidang', 'Nama Bidang','required');
		$this->form_validation->set_rules('username','Username', 'trim|min_length[5]|max_length[15]|is_unique[user.username]',
            [
            'is_unique' => "username is already registered"
            ]
        );
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', 
			[
			'required' => "Password is required",
			'min_length' => "Password too short"
			]
		);
        if($this->form_validation->run()== FALSE){
			$this->tambah();
		}else{
		
			$nama = $this->input->post('nama_user');
			$username = $this->input->post('username');
			$level = $this->input->post('level');
			$password = md5($this->input->post('password'));
			$nama_bidang = $this->input->post('nama_bidang');
			
			
			$data = array(
			'nama_user' => $nama,
			'username' => $username,
			'password' => $password,
			'level' => $level,
			'id_bidang' => $nama_bidang,
			);		

			$this->m_admin->insert_user($data,'user');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data User Berhasil Ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/user');
		}
		
	}

	public function edit($id_user){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['user'] = $this->m_admin->get_userid($id_user);
		$data['bidang'] = $this->m_admin->get_bidang();

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_user', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function update(){
		$this->form_validation->set_rules('nama_user', 'Nama User','required');
		$this->form_validation->set_rules('username', 'Username','required');
		$this->form_validation->set_rules('level', 'Level','required');
		$this->form_validation->set_rules('bidang', 'Nama Bidang','required');

		if ($this->form_validation->run()== FALSE) {
			$this->edit();
		}else{
			$id_user = $this->input->post('id_user');
			$nama_user = $this->input->post('nama_user');
			$username = $this->input->post('username');
			$level = $this->input->post('level');
			$bidang = $this->input->post('bidang');

			$cek = $this->model_user->is_ada_user($username);
            $before = $this->input->post('before');
            

			if($username != $before){
                if(count($cek)>0){
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Username sudah Ada<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('admin/user/edit/'.$id_user);
                } 
            }			

			$data = array(
				'nama_user' => $nama_user,
				'username' => $username,
				'level' => $level,
				'id_bidang' => $bidang,
				 );


			$where = array('id_user' => $id_user);

			$this->m_admin->update_user($where, $data,'user');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data User Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/user');
		}		
	}

	public function update1(){
		 $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', 
			[
			'required' => "Password is required",
			'min_length' => "Password too short"
			]
		);
	

			$id_user = $this->input->post('id_user');
			$password = md5($this->input->post('password'));

			$data = array(
				'password' => $password,
				
				 );


			$where = array('id_user' => $id_user);

			$this->m_admin->update_user1($where, $data,'user');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Password 	User Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/user');
				
	}

	public function user_hapus($id){
		$where = array('id_user'=>$id);
		$this->m_admin->hapus_user($where);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">User Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/user');
	}

}
?>