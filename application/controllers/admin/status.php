<?php 

class Status extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['status'] = $this->m_admin->all_status();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/all_status', $data);
		$this->load->view('admin/templates_administrator/footer');
		
	}

	public function edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$where  = array('id_status' => $id );
		$data['status'] = $this->m_admin->edit_status($where,'status') ->result();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_status', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function update_status(){
		$id = $this->input->post('id_status');
		$nama_status = $this->input->post('nama_status');

		$data = array(
			'nama_status' => $nama_status, 
		);

		$where = array(
			'id_status' => $id, 
		);
		$this->m_admin->update_status($where,$data,'status');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Status Kepemilikan Berhasil di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/status');

	}

	public function tambah(){
		
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tambah_status', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function tambah_aksi(){

		$this->form_validation->set_rules('nama_status', 'nama_status','required');

		if($this->form_validation->run()== FALSE){
			$this->tambah();
		}else{
			$nama = $this->input->post('nama_status');
			
			$data = array(
				'nama_status' => $nama,
			);	
			
			$this->m_admin->insert_status($data,'status');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Status Kepemilikan Berhasil ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/status');
		}
	}

	public function status_hapus($id){
		$where = array('id_status'=>$id);
		$cek = $this->m_admin->is_ada_status_barang($id);
		$cek1 = $this->m_admin->is_ada_status_bangunan($id);
		$cek2 = $this->m_admin->is_ada_status_tanah($id);
		$cek3 = $this->m_admin->is_ada_status_kendaraan($id);
		if ( (count($cek)>0) || (count($cek1)>0) || (count($cek2)>0) || (count($cek3)>0)){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Status Tidak bisa dihapus karena dipakai tabel lain<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->m_admin->hapus_status($where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Status Kepemilikan Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('admin/status');
	}

}
?>