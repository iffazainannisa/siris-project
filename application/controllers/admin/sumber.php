<?php 

class Sumber extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['sumber'] = $this->m_admin->all_sumber();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/sumber', $data);
		$this->load->view('admin/templates_administrator/footer');
		
	}

	public function edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$where  = array('id_sumber' => $id );
		$data['sumber'] = $this->m_admin->edit_sumber($where,'sumber') ->result();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_sumber', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function update_sumber(){
		$id = $this->input->post('id_sumber');
		$nama_sumber = $this->input->post('nama_sumber');

		$data = array(
			'nama_sumber' => $nama_sumber, 

		);

		$where = array(
			'id_sumber' => $id, 
		);

		$this->m_admin->update_sumber($where,$data,'sumber');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Sumber Berhasil di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/sumber');

	}

	public function tambah(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tambah_sumber', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function tambah_aksi(){
		$this->form_validation->set_rules('nama_sumber', 'nama_sumber','required');
		if($this->form_validation->run()== FALSE){
			$this->tambah();
		}else{
			$nama = $this->input->post('nama_sumber');
			
			$data = array(
				'nama_sumber' => $nama,
			);		

			$this->m_admin->insert_sumber($data,'sumber');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Sumber Aset Berhasil Ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/sumber');
		}
	}

	public function sumber_hapus($id){
		$where = array('id_sumber'=>$id);
		$cek = $this->m_admin->is_ada_sumber_barang($id);
		$cek1 = $this->m_admin->is_ada_sumber_bangunan($id);
		$cek2 = $this->m_admin->is_ada_sumber_tanah($id);
		if ((count($cek)>0) || (count($cek2)>0) || (count($cek1)>0) ){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Sumber Tidak bisa dihapus karena dipakai tabel lain<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->m_admin->hapus_sumber($where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Sumber Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('admin/sumber');
	}
}
?>