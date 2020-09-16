<?php 

class Jenis extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['jenis'] = $this->m_admin->all_jenis();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/all_jenis', $data);
		$this->load->view('admin/templates_administrator/footer');
		
	}

	public function edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['jenis'] = $this->m_admin->get_jenis($id);
		$data['kategori'] = $this->m_admin->get_kategori();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_jenis', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function update_jenis(){
		$id = $this->input->post('id_jenis');
		$nama = $this->input->post('nama_jenis');
		$kategori = $this->input->post('kategori');

		$data = array(
			'nama_jenis' => $nama,
			'id_kategoriaset' => $kategori,
		);

		$where = array(
			'id_jenisaset' => $id, 
		);
		$this->m_admin->update_jenis($where,$data,'jenis_aset');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Jenis Aset Berhasil di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/jenis');

	}

	public function tambah(){
		
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['kategori'] = $this->m_admin->get_kategori();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tambah_jenis', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function tambah_aksi(){

		$this->form_validation->set_rules('nama_jenis', 'Nama Jenis','required');

		if($this->form_validation->run()== FALSE){
			$this->tambah();
		}else{
			$nama = $this->input->post('nama_jenis');
			$kategori = $this->input->post('kategori');

			$data = array(
				'nama_jenis' => $nama,
				'id_kategoriaset' => $kategori,
			);
			
			$this->m_admin->insert_jenis($data,'jenis_aset');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Jenis Aset Berhasil ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/jenis');
		}
	}

	public function jenis_hapus($id){
		$where = array('id_jenisaset'=>$id);
		$cek = $this->m_admin->is_ada_jenis_barang($id);
		$cek2 = $this->m_admin->is_ada_jenis_kendaraan($id);
		if ((count($cek)>0)||(count($cek2)>0)){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Jenis Aset Tidak bisa dihapus karena dipakai tabel lain<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->m_admin->hapus_jenis($where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Jenis Aset Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('admin/jenis');
	}

}
?>