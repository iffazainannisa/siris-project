<?php 

class Bangunan extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['inventaris_bangunan'] = $this->m_admin->all_inventaris_bangunan();
		
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tampil_bangunan_inventaris', $data);
		$this->load->view('admin/templates_administrator/footer');
		
	}

	public function edit_bangunan($id_bangunan){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['kategori'] = $this->m_admin->get_kategori1();
		$data['sumber'] = $this->m_admin->get_sumber1();
		$data['status'] = $this->m_admin->get_status1();
		$data['bidang'] = $this->m_admin->get_bidang();

		$data['inventaris_bangunan'] = $this->m_admin->get_bangunanid($id_bangunan);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_inventaris_bangunan', $data);
		$this->load->view('admin/templates_administrator/footer');


	}

	public function update_bangunan(){
		$this->form_validation->set_rules('luas_bangunan', 'Luas Bangunan','numeric');
		$this->form_validation->set_rules('jumlah_lantai', 'Jumlah Lantai','numeric');
		$this->form_validation->set_rules('nilai_perolehan', 'Nilai Perolehan','numeric');

		if($this->form_validation->run()== FALSE){
			$this->edit_bangunan();
		}else{

		$id_bangunan = $this->input->post('id_bangunan');
		$no_inventaris = $this->input->post('no_inventaris');
		$bangunan = $this->input->post('bangunan');
		$alamat = $this->input->post('alamat');
		$luas_bangunan = $this->input->post('luas_bangunan');
		$jumlah_lantai = $this->input->post('jumlah_lantai');
		$nilai_perolehan = $this->input->post('nilai_perolehan');
		$tahun_perolehan = $this->input->post('thn_perolehan');
		$njop = $this->input->post('njop');
		$sumber = $this->input->post('sumber');
		$status = $this->input->post('status');
		$keterangan = $this->input->post('keterangan');
		$bidang = $this->input->post('bidang');
		$aset = $this->input->post('aset');
		
		$data = array(
			'no_inventaris' => $no_inventaris,
			'nama_bangunan' => $bangunan,
			'alamat' => $alamat,
			'luas_bangunan' => $luas_bangunan,
			'jumlah_lantai' => $jumlah_lantai,
			'tahun_perolehan' => $tahun_perolehan,
			'nilai_perolehan' => $nilai_perolehan,
			'njop' => $njop,
			'id_sumber' => $sumber,
			'id_status' => $status,
			'keterangan' => $keterangan,
			'id_bidang' => $bidang,
			'id_kategoriaset' => $aset,
		 );


		$where = array('id_bangunan' => $id_bangunan);

		$this->m_admin->update_inventaris_bangunan($where, $data,'inventaris_bangunan');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Bangunan Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/bangunan');
		}

	}

	public function his_excel(){
		$data = array('inventaris_bangunan_history'=>$this->m_admin->get_hisbangunan());
		$this->load->view('admin/excel_bangunan_his',$data);
		
	}

	public function excel(){
		$data = array('inventaris_bangunan'=>$this->m_admin->all_inventaris_bangunan());
		$this->load->view('admin/excel_bangunan',$data);
		
	}

	public function hapus_bangunan($id){
		$where = array('id_bangunan'=>$id);
		$this->m_admin->hapus_bangunan($where);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Inventaris Bangunan Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/bangunan');
	}

	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventarisbangunan($id)->row();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/bangunan_qrcode', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function detail_bangunan($id_bangunan){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['kategori'] = $this->m_admin->get_kategori1();
		$data['sumber'] = $this->m_admin->get_sumber1();
		$data['status'] = $this->m_admin->get_status1();
		$data['bidang'] = $this->m_admin->get_bidang();

		$data['inventaris_bangunan'] = $this->m_admin->get_bangunanid($id_bangunan);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/detail_inventaris_bangunan', $data);
		$this->load->view('admin/templates_administrator/footer');


	}

	
}
?>