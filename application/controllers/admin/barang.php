<?php 

class Barang extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['inventaris_barang'] = $this->m_admin->all_inventaris_barang();
		
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tampil_barang_inventaris', $data);
		$this->load->view('admin/templates_administrator/footer');
		
	}

	public function edit_barang($id_inventaris){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();

	
		$data['ruang'] = $this->m_admin->get_ruang1();
		$data['barang'] = $this->m_admin->get_barang1();

		$data['inventaris_barang'] = $this->m_admin->get_barangid($id_inventaris);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_inventaris_barang', $data);
		$this->load->view('admin/templates_administrator/footer');


	}

	public function update1(){
		$this->form_validation->set_rules('tahun_perolehan', 'Tahun Perolehan','numeric');
		

		if($this->form_validation->run()== FALSE){
			$this->edit_bangunan();
		}else{

		// $id_inventaris = $this->input->post('id_inventaris');
		$id_barang = $this->input->post('id_barang'); 
		$nama_barang = $this->input->post('nama_barang');
		$tahun_perolehan= $this->input->post('tahun_perolehan');
		// $keterangan = $this->input->post('keterangan');

		
		$data = array(
			'nama_barang' => $nama_barang,
			// 'id_ruang' => $ruang,
			'tahun_perolehan' => $tahun_perolehan,
			
		 );


		$where = array('id_barang' => $id_barang);

		$this->m_admin->update_barang($where, $data,'barang');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Barang Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/barang/');
		}

	}

	public function update_barang(){
		$this->form_validation->set_rules('ruang', 'Nama Ruang','required');
		

		if($this->form_validation->run()== FALSE){
			$this->edit_bangunan();
		}else{

		$id_inventaris = $this->input->post('id_inventaris');
		// $no_inventaris = $this->input->post('no_inventaris');
		$id_ruang = $this->input->post('ruang');
		$fix = $id_ruang;
		$keterangan = $this->input->post('keterangan');
		$kode_tahun = $this->input->post('tahun_perolehan');

		$kode_ruang = $this->model_user->get_koderuang($id_ruang);
		$kode_urutan = $this->model_user->get_kodeurutan($fix,1);
		$kode_urutan = intval($kode_urutan);

		if(count($kode_urutan)==0){
			$kode_urutan = 1;
		}else{
			$kode_urutan++;
		}

		$no_inventaris = $kode_ruang.".".str_pad( $kode_urutan,'3', "0", STR_PAD_LEFT ).".".$kode_tahun;

		
		$data = array(
			'no_inventaris' => $no_inventaris,
			'id_ruang' => $id_ruang,
			'fix_ruang' => $fix,
			'keterangan' => $keterangan,
			
		 );


		$where = array('id_inventaris' => $id_inventaris);

		$this->m_admin->update_inventaris_barang($where, $data,'inventaris_barang');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Barang Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/barang/');
		}

	}

	public function his_excel(){
		$data = array('inventaris_barang_history'=>$this->m_admin->get_hisbarang());
		$this->load->view('admin/excel_barang_his',$data);
		
	}

	public function excel(){
		$data = array('inventaris_barang'=>$this->m_admin->all_inventaris_barang());
		$this->load->view('admin/excel_barang',$data);
		
	}

	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventaris($id)->row();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/barang_qrcode', $data);
		$this->load->view('admin/templates_administrator/footer');

		
	}

	public function detail_barang($id_inventaris){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();

	
		$data['ruang'] = $this->m_admin->get_ruang1();
		$data['barang'] = $this->m_admin->get_barang1();

		$data['inventaris_barang'] = $this->m_admin->get_barangid($id_inventaris);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/detail_inventaris_barang', $data);
		$this->load->view('admin/templates_administrator/footer');


	}



}
?>