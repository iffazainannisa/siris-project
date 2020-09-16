<?php 

class Ruang extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['ruang'] = $this->m_admin->all_ruang();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/ruang_semua', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function tambah(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['bidang'] = $this->m_admin->get_bidang();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tambah_ruang', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function tambah_aksi(){
		$this->form_validation->set_rules('nama_ruang', 'nama_ruang','required');
		$this->form_validation->set_rules('lantai', 'lantai','numeric');
		$this->form_validation->set_rules('kode_bidang', 'kode_bidang','numeric');
		$this->form_validation->set_rules('nama_bidang', 'nama_bidang','required');

		if($this->form_validation->run()== FALSE){
			$this->tambah();
		}else{
			$nama = $this->input->post('nama_ruang');
			$lantai = $this->input->post('lantai');
			$id_bidang = $this->input->post('nama_bidang');
			$kode_bidang = $this->m_admin->get_kodebidang($id_bidang);
			$kode_lantai = str_pad( $lantai, 2, "0", STR_PAD_LEFT );
			$kode_urutan = $this->m_admin->get_kodeurutanruang($id_bidang,$lantai) + 1;
			$ruang = $kode_bidang.'.'.$kode_lantai.'.'.str_pad( $kode_urutan, 2, "0", STR_PAD_LEFT );
			
			$data = array(
				'kode_ruang' => $ruang,
				'nama_ruang' => $nama,
				'lantai' => $lantai,
				'id_bidang' => $id_bidang
			);		

			$this->m_admin->insert_ruang($data,'ruang');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Ruang Berhasil Ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/ruang');
		}
	}

	public function edit($id_ruang){
		$this->load->model("m_admin");
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();

		$data['ruang'] = $this->m_admin->get_ruangid($id_ruang);
		$data['bidang'] = $this->m_admin->get_bidang();

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_ruang', $data);
		$this->load->view('admin/templates_administrator/footer');

	}

	public function update(){
		$this->form_validation->set_rules('lantai', 'lantai','numeric');

		if ($this->form_validation->run()== FALSE) {
			$this->edit();
		}else{
			$id_ruang = $this->input->post('id_ruang');
			$nama = $this->input->post('ruang');
			$lantai = $this->input->post('lantai');
			$id_bidang = $this->input->post('bidang');

			$kode_bidang = $this->m_admin->get_kodebidang($id_bidang);
			$kode_lantai = str_pad( $lantai, 2, "0", STR_PAD_LEFT );
			$kode_urutan = $this->m_admin->get_kodeurutanruangexcept($id_bidang,$id_ruang,$lantai) + 1;
			$ruang = $kode_bidang.'.'.$kode_lantai.'.'.str_pad( $kode_urutan, 2, "0", STR_PAD_LEFT );
			
			$data = array(
				'kode_ruang' => $ruang,
				'nama_ruang' => $nama,
				'lantai' => $lantai,
				'id_bidang' => $id_bidang
			);

			$where = array('id_ruang' => $id_ruang);

			$this->m_admin->update_ruang($where, $data,'ruang');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Ruang Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/ruang');
		}
	}

	public function ruang_hapus($id){
		$where = array('id_ruang'=>$id);
		$cek = $this->m_admin->is_ada_ruang($id);
		if (count($cek)>0){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Ruang Tidak bisa dihapus karena dipakai tabel lain<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->m_admin->hapus_ruang($where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Ruang Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('admin/ruang');
	}



}

?>