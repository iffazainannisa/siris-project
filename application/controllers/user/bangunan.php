<?php 

class Bangunan extends CI_Controller{

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
		$data['bangunan'] = $this->model_user->get_bangunanall($id_bidang);
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/bangunan/bangunan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_bangunan(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['status'] = $this->model_user->get_status();
		$data['sumber'] = $this->model_user->get_sumber();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/bangunan/tambah_bangunan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_aksi(){
		$this->_rules();

		if($this->form_validation->run()== FALSE){
			$this->tambah_bangunan();
		}else{
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$luas = $this->input->post('luas');
			$lantai = $this->input->post('lantai');
			$tahun = $this->input->post('tahun');
			$nilai = $this->input->post('nilai');
			$nilai = str_replace('.', '', $nilai);
			$njop = $this->input->post('njop');
			$njop = str_replace('.', '', $njop);
			$sumber = $this->input->post('sumber');
			$status = $this->input->post('status');
			$ket = $this->input->post('ket');
			$kategori = 4;
			$bidang = $this->input->post('id_bidang');
			$kode_urutan = $this->model_user->get_kodeurutanbangunan($bidang);
			$kode_bidang = $this->model_user->get_kodebidang($bidang);

			if($status==""||$sumber==""){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Data Status dan Sumber harus diisi<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/bangunan/tambah_bangunan');
			}

			$kode_urutan = $kode_urutan + 1;
				$digit = 2;
				$inventaris = $kode_bidang.".B.".str_pad( $kode_urutan, $digit, "0", STR_PAD_LEFT );

			$data = array(
				'no_inventaris' =>$inventaris,
				'nama_bangunan' =>$nama,
				'alamat' =>$alamat,
				'luas_bangunan' =>$luas,
				'jumlah_lantai' =>$lantai,
				'tahun_perolehan' =>$tahun,
				'nilai_perolehan' =>$nilai,
				'njop' =>$njop,
				'id_sumber' =>$sumber,
				'id_status' =>$status,
				'keterangan' =>$ket,
				'id_bidang' =>$bidang,
				'id_kategoriaset' =>$kategori
			);

			$this->model_user->insert_bangunan($data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Bangunan Berhasil Ditambahkan, Generate QRCode Sekarang!<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/bangunan');
		}
	}

	public function _rules(){
		$this->form_validation->set_rules('tahun', 'Tahun Perolehan','numeric');
		$this->form_validation->set_rules('luas', 'Luas Tanah','numeric');
		$this->form_validation->set_rules('nilai', 'Nilai Perolehan','numeric');
		$this->form_validation->set_rules('njop', 'NJOP','numeric');
		$this->form_validation->set_rules('lantai', 'Jumlah Lantai','numeric');
	}


	public function bangunan_edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['bangunan'] = $this->model_user->get_idinventarisbangunan($id)->result();
		$data['status'] = $this->model_user->get_status();
		$data['sumber'] = $this->model_user->get_sumber();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/bangunan/bangunan_edit', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function bangunan_update(){
		$this->_rules();
		$id = $this->input->post('id_bangunan');

		if($this->form_validation->run()== FALSE){
			$this->bangunan_edit($id);
		}else{
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$luas = $this->input->post('luas');
			$lantai = $this->input->post('lantai');
			$tahun = $this->input->post('tahun');
			$nilai = $this->input->post('nilai');
			$nilai = str_replace('.', '', $nilai);
			$njop = $this->input->post('njop');
			$njop = str_replace('.', '', $njop);
			$sumber = $this->input->post('sumber');
			$status = $this->input->post('status');
			$ket = $this->input->post('ket');
			$bidang = $this->input->post('id_bidang');

			$data = array(
				'nama_bangunan' =>$nama,
				'alamat' =>$alamat,
				'luas_bangunan' =>$luas,
				'jumlah_lantai' =>$lantai,
				'tahun_perolehan' =>$tahun,
				'nilai_perolehan' =>$nilai,
				'njop' =>$njop,
				'id_sumber' =>$sumber,
				'id_status' =>$status,
				'keterangan' =>$ket,
				'id_bidang' =>$bidang,
			);

			$where = array('id_bangunan' => $id);

			$this->model_user->update_bangunan($where, $data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Bangunan Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/bangunan');
		}
	}

	public function bangunan_inventaris_hapus($id){
		$where = array('id_bangunan'=>$id);
		$data = array(
			'keterangan' =>'hapus',
		);

		$this->model_user->update_bangunan($where, $data);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Bangunan Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('user/bangunan');
	}

	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventarisbangunan($id)->row();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/bangunan/qrcode', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function print_qrcode(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang = $this->session->userdata('id_bidang');
		$data ['idin'] = $this->model_user->get_bangunanall($id_bidang);
		$count = $this->model_user->get_bangunanall($id_bidang);
		$data ['stock'] = count($count);
		$this->pdf->load_view('user/bangunan/qrcode_bangunan_All', $data);
	}

	public function print_qrcode_custom(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id = $this->input->post('id_bangunan');
		$jumlah = $this->input->post('jumlah');
		$data['stock'] = $jumlah;
		$data ['idin'] = $this->model_user->get_idinventarisbangunan($id)->row();
		$this->pdf->load_view('user/bangunan/qrcode_bangunan_custom', $data);
	}

	public function laporan(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/bangunan/bangunan_laporan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function laporan_baik(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$first = $this->model_user->get_bangunanhistmin();
		$data['bid'] = $this->model_user->get_bidang($id_bidang);
		$last = $this->input->post('tgl_baik');
		$data['tgl'] = $last;
		$data['kategori'] = "BANGUNAN";
		$data['inventari'] = $this->model_user->get_histallbangunan($first,$last,$id_bidang);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->load_view3('user/bangunan/laporan_baik', $data);
	}

}

?>