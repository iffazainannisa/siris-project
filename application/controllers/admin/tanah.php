<?php 

class Tanah extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['inventaris_tanah'] = $this->m_admin->inventaris_tanah();
		
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tampil_tanah_inventaris', $data);
		$this->load->view('admin/templates_administrator/footer');
		
	}

	public function edit_tanah($id_tanah){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['kategori'] = $this->m_admin->get_kategori1();
		$data['sumber'] = $this->m_admin->get_sumber1();
		$data['status'] = $this->m_admin->get_status1();
		$data['bidang'] = $this->m_admin->get_bidang();

		$data['inventaris_tanah'] = $this->m_admin->get_tanahid($id_tanah);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_inventaris_tanah', $data);
		$this->load->view('admin/templates_administrator/footer');


	}

	public function update_tanah(){
		$this->form_validation->set_rules('luas_tanah', 'Luas Tanah','numeric');
		
		$this->form_validation->set_rules('nilai_perolehan', 'Nilai Perolehan','numeric');

		if($this->form_validation->run()== FALSE){
			$this->edit_bangunan();
		}else{

		$id_tanah = $this->input->post('id_tanah');
		$no_inventaris = $this->input->post('no_inventaris');
		$alamat = $this->input->post('alamat');
		$luas_tanah = $this->input->post('luas_tanah');
		$tahun_perolehan = $this->input->post('thn_perolehan');
		$nilai_perolehan = $this->input->post('nilai_perolehan');
		$njop = $this->input->post('njop');
		$sumber = $this->input->post('sumber');
		$status = $this->input->post('status');
		$keterangan = $this->input->post('keterangan');
		$bidang = $this->input->post('bidang');
		$aset = $this->input->post('aset');
		
		$data = array(
			'no_inventaris' => $no_inventaris,
			'alamat' => $alamat,
			'luas_tanah' => $luas_tanah,
			'tahun_perolehan' => $tahun_perolehan,
			'nilai_perolehan' => $nilai_perolehan,
			'njop' => $njop,
			'id_sumber' => $sumber,
			'id_status' => $status,
			'keterangan' => $keterangan,
			'id_kategoriaset' => $aset,
			'id_bidang' => $bidang,
			
		 );


		$where = array('id_tanah' => $id_tanah);

		$this->m_admin->update_inventaris_tanah($where, $data,'inventaris_tanah');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Tanah Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/tanah');
		}

	}


	public function history_excel(){
		$data = array('inventaris_tanah_history'=>$this->m_admin->get_histanah());
		$this->load->view('admin/excel_tanah_his',$data);
		
	}

	public function excel(){
		$data = array('inventaris_tanah'=>$this->m_admin->inventaris_tanah());
		$this->load->view('admin/excel_tanah',$data);
		
	}

	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventaristanah($id)->row();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tanah_qrcode', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function detail_tanah($id_tanah){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['kategori'] = $this->m_admin->get_kategori1();
		$data['sumber'] = $this->m_admin->get_sumber1();
		$data['status'] = $this->m_admin->get_status1();
		$data['bidang'] = $this->m_admin->get_bidang();

		$data['inventaris_tanah'] = $this->m_admin->get_tanahid($id_tanah);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/detail_inventaris_tanah', $data);
		$this->load->view('admin/templates_administrator/footer');


	}

}
?>