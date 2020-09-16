<?php 

class Tanah extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['level'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$data['tanah'] = $this->model_user->get_tanahall($id_bidang);
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/tanah/tanah', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_tanah(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['status'] = $this->model_user->get_status();
		$data['sumber'] = $this->model_user->get_sumber();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/tanah/tambah_tanah', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_aksi(){
		$this->_rules();

		if($this->form_validation->run()== FALSE){
			$this->tambah_tanah();
		}else{
			$alamat = $this->input->post('alamat');
			$luas = $this->input->post('luas');
			$tahun = $this->input->post('tahun');
			$nilai = $this->input->post('nilai');
			$nilai = str_replace('.', '', $nilai);
			$njop = $this->input->post('njop');
			$njop = str_replace('.', '', $njop);
			$sumber = $this->input->post('sumber');
			$status = $this->input->post('status');
			$ket = $this->input->post('ket');
			$kategori = 3;
			$bidang = $this->input->post('id_bidang');
			$kode_urutan = $this->model_user->get_kodeurutantanah($bidang);
			$kode_bidang = $this->model_user->get_kodebidang($bidang);

			$kode_urutan = $kode_urutan + 1;
				$digit = 2;
				$inventaris = $kode_bidang.".T.".str_pad( $kode_urutan, $digit, "0", STR_PAD_LEFT );

			$data = array(
				'no_inventaris' =>$inventaris,
				'alamat' =>$alamat,
				'luas_tanah' =>$luas,
				'tahun_perolehan' =>$tahun,
				'nilai_perolehan' =>$nilai,
				'njop' =>$njop,
				'id_sumber' =>$sumber,
				'id_status' =>$status,
				'keterangan' =>$ket,
				'id_kategoriaset' =>$kategori,
				'id_bidang' =>$bidang
			);

			$this->model_user->insert_tanah($data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Tanah Berhasil Ditambahkan, Generate QRCode Sekarang!<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/tanah');
		}
	}

	public function _rules(){
		$this->form_validation->set_rules('tahun', 'Tahun Perolehan','numeric');
		$this->form_validation->set_rules('luas', 'Luas Tanah','numeric');
		$this->form_validation->set_rules('nilai', 'Nilai Perolehan','numeric');
		$this->form_validation->set_rules('njop', 'NJOP','numeric');
	}


	public function tanah_edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['tanah'] = $this->model_user->get_idinventaristanah($id)->result();
		$data['status'] = $this->model_user->get_status();
		$data['sumber'] = $this->model_user->get_sumber();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/tanah/tanah_edit', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tanah_update(){
		$this->_rules();
		$id = $this->input->post('id_tanah');

		if($this->form_validation->run()== FALSE){
			$this->tanah_edit($id);
		}else{
			$alamat = $this->input->post('alamat');
			$luas = $this->input->post('luas');
			$tahun = $this->input->post('tahun');
			$nilai = $this->input->post('nilai');
			$nilai = str_replace('.', '', $nilai);
			$njop = $this->input->post('njop');
			$njop = str_replace('.', '', $njop);
			$sumber = $this->input->post('sumber');
			$status = $this->input->post('status');
			$ket = $this->input->post('ket');
			$kategori = 3;
			$bidang = $this->input->post('id_bidang');

			$data = array(
				'alamat' =>$alamat,
				'luas_tanah' =>$luas,
				'tahun_perolehan' =>$tahun,
				'nilai_perolehan' =>$nilai,
				'njop' =>$njop,
				'id_sumber' =>$sumber,
				'id_status' =>$status,
				'keterangan' =>$ket,
				'id_kategoriaset' =>$kategori,
				'id_bidang' =>$bidang
			);

			$where = array('id_tanah' => $id);

			$this->model_user->update_tanah($where, $data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Tanah Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/tanah');
		}
	}

	public function tanah_inventaris_hapus($id){
		$where = array('id_tanah'=>$id);
		$data = array(
			'keterangan' =>'hapus',
		);

		$this->model_user->update_tanah($where, $data);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Tanah Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('user/tanah');
	}

	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventaristanah($id)->row();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/tanah/qrcode', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function print_qrcode(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang = $this->session->userdata('id_bidang');
		$data ['idin'] = $this->model_user->get_tanahall($id_bidang);
		$count = $this->model_user->get_tanahall($id_bidang);
		$data ['stock'] = count($count);
		$this->pdf->load_view('user/tanah/qrcode_tanah_All', $data);
	}

	public function print_qrcode_custom(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id = $this->input->post('id_tanah');
		$jumlah = $this->input->post('jumlah');
		$data['stock'] = $jumlah;
		$data ['idin'] = $this->model_user->get_idinventaristanah($id)->row();
		$this->pdf->load_view('user/tanah/qrcode_tanah_custom', $data);
	}

	public function laporan(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/tanah/tanah_laporan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function laporan_baik(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$first = $this->model_user->get_tanahhistmin();
		$data['bid'] = $this->model_user->get_bidang($id_bidang);
		$last = $this->input->post('tgl_baik');
		$data['tgl'] = $last;
		$data['kategori'] = "TANAH";
		$data['inventari'] = $this->model_user->get_histalltanah($first,$last,$id_bidang);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->load_view3('user/tanah/laporan_baik', $data);
	}

}

?>