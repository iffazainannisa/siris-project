<?php 

class Kendaraan extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['inventaris_kendaraan'] = $this->m_admin->all_inventaris_kendaraan();
		
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tampil_kendaraan_inventaris', $data);
		$this->load->view('admin/templates_administrator/footer');
		
	}

	public function edit_kendaraan($id_kendaraan){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();

		$data['status'] = $this->m_admin->get_status1();
		$data['jenis_aset'] = $this->m_admin->get_jenis_aset();
		$data['bidang'] = $this->m_admin->get_bidang();

		$data['inventaris_kendaraan'] = $this->m_admin->get_kendaraanid($id_kendaraan);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_inventaris_kendaraan', $data);
		$this->load->view('admin/templates_administrator/footer');


	}

	public function update_kendaraan(){
		$this->form_validation->set_rules('tahun_produksi', 'Tahun Produksi','numeric');
		$this->form_validation->set_rules('tahun_perolehan', 'Tahun Perolehan','numeric');
		$this->form_validation->set_rules('nilai_perolehan', 'Nilai Perolehan','numeric');

		if($this->form_validation->run()== FALSE){
			$this->edit_bangunan();
		}else{

		$id_kendaraan = $this->input->post('id_kendaraan');
		$no_plat = $this->input->post('no_plat');
		$no_inventaris = $this->input->post('no_inventaris');
		$status = $this->input->post('status');
		$lokasi = $this->input->post('lokasi');
		$merk = $this->input->post('merk');
		$type = $this->input->post('type');
		$no_rangka = $this->input->post('no_rangka');
		$no_mesin = $this->input->post('no_mesin');
		$tahun_produksi = $this->input->post('tahun_produksi');
		$nilai_perolehan = $this->input->post('nilai_perolehan');
		$tahun_perolehan = $this->input->post('thn_perolehan');
		$jenis_bbm = $this->input->post('jenis_bbm');
		$bpkb = $this->input->post('bpkb');
		$kondisi = $this->input->post('kondisi');
	
		$keterangan = $this->input->post('keterangan');
		$bidang = $this->input->post('bidang');
		$aset = $this->input->post('aset');
		
		$data = array(
			'no_plat' => $no_plat,
			'no_inventaris' => $no_inventaris,
			'id_status' => $status,
			'lokasi' => $lokasi,
			'merk' => $merk,
			'type' => $type,
			'no_rangka' => $no_rangka,
			'no_mesin' => $no_mesin,
			'tahun_produksi' => $tahun_produksi,
			'tahun_perolehan' => $tahun_perolehan,
			'nilai_perolehan' => $nilai_perolehan,
			'jenis_bbm' => $jenis_bbm,
 			'bpkb' => $bpkb,
			'keterangan' => $keterangan,
			'kondisi' => $kondisi,
			'id_bidang' => $bidang,
			'id_jenisaset' => $aset,
		 );


		$where = array('id_kendaraan' => $id_kendaraan);

		$this->m_admin->update_inventaris_kendaraan($where, $data,'inventaris_kendaraan');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Kendaraan Berhasil Di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('admin/kendaraan');
		}

	}

	public function his_excel(){
		$data = array('inventaris_kendaraan_history'=>$this->m_admin->get_hiskendaraan());
		$this->load->view('admin/excel_kendaraan_his',$data);
		
	}

	public function excel(){
		$data = array('inventaris_kendaraan'=>$this->m_admin->all_inventaris_kendaraan());
		$this->load->view('admin/excel_kendaraan',$data);
		
	}

	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventariskendaraan($id)->row();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/kendaraan_qrcode', $data);
		$this->load->view('admin/templates_administrator/footer');

		
	}


	public function detail_kendaraan($id_kendaraan){

		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();

		$data['status'] = $this->m_admin->get_status1();
		$data['jenis_aset'] = $this->m_admin->get_jenis_aset();
		$data['bidang'] = $this->m_admin->get_bidang();

		$data['inventaris_kendaraan'] = $this->m_admin->get_kendaraanid($id_kendaraan);

		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/detail_inventaris_kendaraan', $data);
		$this->load->view('admin/templates_administrator/footer');


	}

}
?>