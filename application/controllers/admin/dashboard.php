<?php 

class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$count_data=$this->model_home->countDataAdmin();
        $data['count_data']=$count_data;
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function edit_profile($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['user'] = $this->m_admin->get_admindetail($id)->row();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/e_profile', $data);
		$this->load->view('admin/templates_administrator/footer');

	}


	public function edit_password($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['user'] = $this->m_admin->get_admindetail($id)->row();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/e_password', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function update_profile(){
        //rules
        $this->form_validation->set_rules('nama','Nama', 'required|trim|min_length[5]|max_length[15]', ['required' => 'Nama User harus diisi!']);
        $this->form_validation->set_rules('username','Username', 'required|trim|min_length[5]|max_length[15]',
            [
            'required' => 'Username harus diisi!',
            'min_length[5]' => "Username minimal 5 huruf",
            'max_length[15]' => "Username maksimal 15 huruf",
            ]
        );

        $id = $this->input->post('id_user');

        if($this->form_validation->run() == false){
            $this->edit_profile($id);
        }else{

            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $cek = $this->model_user->is_ada_user($username);
            $before = $this->input->post('before');
            
            if($username != $before){
                if(count($cek)>0){
                    $this->session->set_flashdata('message','<div class="alert alert-danger alert dismissible fade show" role="alert">Username sudah Ada<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('admin/dashboard/edit_profile/'.$id);
                } 
            }

            $data = array (
                'nama_user' => $nama,
                'username' => $username,
            );

            $where = array('id_user' => $id);
            $this->model_user->update_profile($where, $data);

            $userku = $this->db->get_where('user', ['username' => $username])->row_array();
            $data = [
                'usernames' => $userku['username'],
                'levels' => $userku['level'],
                'id_bidangs' => $userku['id_bidang'],
            ];

            $this->session->set_userdata($data);
            $this->session->set_flashdata('message','<div class="alert alert-success alert dismissible fade show" role="alert">Profile Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/dashboard/edit_profile/'.$id);
        }
    }

    public function update_password(){
    	$id = $this->input->post('id_user');
        $data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['user'] = $this->model_user->get_userdetails($id)->row();

        //rule
        $this->form_validation->set_rules('lama', 'Password Lama', 'required|trim', [
            'required' => 'Password Lama harus diisi!']);
        $this->form_validation->set_rules('baru', 'Password Baru', 'required|trim|min_length[5]', 
        	[
            'required' => 'Password Baru harus diisi!',
            'min_length[5]' => 'Password minimal 5 huruf',
            ]);
        $this->form_validation->set_rules('ulang', 'Konfirmasi Password', 'required|trim|min_length[5]|matches[baru]',
        	[
            'required' => 'Konfirmasi Password harus diisi!',
            'min_length[5]' => 'Password minimal 5 huruf',
            'matches[baru]' => 'Password tidak cocok',
            ]
        );

    	if($this->form_validation->run() == false){
    		$this->edit_password($id);
    	}else{
    		$id = $this->input->post('id_user');
        	$lama = $this->input->post('lama');
        	$baru = $this->input->post('baru');
        	$ulang = $this->input->post('ulang');
        	$lama_hash = md5($lama);
        	if($lama_hash != $data['userku']['password']){
        		$this->session->set_flashdata('message','<div class="alert alert-danger alert dismissible fade show" role="alert">Password Lama Salah<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
        		redirect('admin/dashboard/edit_password/'.$id);
        	}else{
        		if ($lama == $baru) {
        			$this->session->set_flashdata('message','<div class="alert alert-danger alert dismissible fade show" role="alert">Password Lama Sama dengan Password Baru<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
        			redirect('admin/dashboard/edit_password/'.$id);
        		}else{
        			//ok
        			$password_baru = md5($baru);
        			$data = array (
            			'password' => $password_baru,
        			);

        			$where = array('id_user' => $id);
        			$this->model_user->update_profile($where, $data);
        			$this->session->set_flashdata('message','<div class="alert alert-success alert dismissible fade show" role="alert">Password Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
        			redirect('admin/dashboard/edit_password/'.$id); 
        		}
        	}
    	}        
    }

}

?>