<?php 

class Kendaraan extends CI_Controller{

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
		$data['kendaraan'] = $this->model_user->get_kendaraanall($id_bidang);
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kendaraan/kendaraan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_kendaraan(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['status'] = $this->model_user->get_status();
		$data['jenis'] = $this->model_user->get_jeniskendaraan();

		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/Kendaraan/tambah_kendaraan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_aksi(){
		$this->_rules();

		if($this->form_validation->run()== FALSE){
			$this->tambah_kendaraan();
		}else{
			$plat = $this->input->post('plat');
			$status = $this->input->post('status');
			$lokasi = $this->input->post('lokasi');
			$merk = $this->input->post('merk');
			$type = $this->input->post('type');
			$rangka = $this->input->post('rangka');
			$mesin = $this->input->post('mesin');
			$produksi = $this->input->post('produksi');
			$tahun = $this->input->post('tahun');
			$nilai = $this->input->post('nilai');
			$nilai = str_replace('.', '', $nilai);
			$bbm = $this->input->post('bbm');
			$bpkb = $this->input->post('bpkb');
			$ket = $this->input->post('ket');
			$kondisi = $this->input->post('kondisi');
			$bidang = $this->input->post('id_bidang');
			$jenis = $this->input->post('jenis');
			$has_same = $this->model_user->has_same_kendaraan($plat);
			$kode_urutan = $this->model_user->get_kodeurutankendaraan($bidang);
			$kode_bidang = $this->model_user->get_kodebidang($bidang);

			if(count($has_same)>0){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Kendaraan Sudah Pernah ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kendaraan/tambah_kendaraan');
			}

			$kode_urutan = $kode_urutan + 1;
				$digit = 2;
				$inventaris = $kode_bidang.".K.".str_pad( $kode_urutan, $digit, "0", STR_PAD_LEFT );

			$data = array(
				'no_plat' =>$plat,
				'no_inventaris' =>$inventaris,
				'id_status' =>$status,
				'lokasi' =>$lokasi,
				'merk' =>$merk,
				'type' =>$type,
				'no_rangka' =>$rangka,
				'no_mesin' =>$mesin,
				'tahun_produksi' =>$produksi,
				'tahun_perolehan' =>$tahun,
				'nilai_perolehan' =>$nilai,
				'jenis_bbm' =>$bbm,
				'bpkb' =>$bpkb,
				'keterangan' =>$ket,
				'kondisi' =>$kondisi,
				'id_bidang' =>$bidang,
				'id_jenisaset' =>$jenis
			);

			$this->model_user->insert_kendaraan($data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Kendaraan Berhasil Ditambahkan, Generate QRCode Sekarang!<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/kendaraan');
		}
	}

	public function _rules(){
		$this->form_validation->set_rules('tahun', 'Tahun Perolehan','numeric');
		$this->form_validation->set_rules('produksi', 'Tahun Produksi','numeric');
		$this->form_validation->set_rules('nilai', 'Nilai Perolehan','numeric');
		
	}

	public function kendaraan_inventaris_hapus($id){
		$where = array('id_kendaraan'=>$id);
		$cek = $this->model_user->get_kondisikendaraan($id);
		if ($cek != 'rusak'){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Data Inventaris Tidak bisa dihapus karena kendaraan masih layak<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$data = array(
				'keterangan' => 'hapus'	
			);
			$this->model_user->update_kendaraan($where, $data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('user/kendaraan');
	}


	public function kendaraan_edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['kendaraan'] = $this->model_user->get_idinventariskendaraan($id)->result();
		$data['status'] = $this->model_user->get_status();
		$data['jenis'] = $this->model_user->get_jeniskendaraan();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kendaraan/kendaraan_edit', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function kendaraan_update(){
		$this->_rules();
		$id = $this->input->post('id_kendaraan');

		if($this->form_validation->run()== FALSE){
			$this->barang_mesin_edit($id);
		}else{
			$plat_before = $this->input->post('before');
			$plat = $this->input->post('plat');
			$status = $this->input->post('status');
			$lokasi = $this->input->post('lokasi');
			$merk = $this->input->post('merk');
			$type = $this->input->post('type');
			$rangka = $this->input->post('rangka');
			$mesin = $this->input->post('mesin');
			$produksi = $this->input->post('produksi');
			$tahun = $this->input->post('tahun');
			$nilai = $this->input->post('nilai');
			$nilai = str_replace('.', '', $nilai);
			$bbm = $this->input->post('bbm');
			$bpkb = $this->input->post('bpkb');
			$ket = $this->input->post('ket');
			$kondisi = $this->input->post('kondisi');
			$bidang = $this->input->post('id_bidang');
			$jenis = $this->input->post('jenis');
			$has_same = $this->model_user->has_same_kendaraan_except($plat, $plat_before);

			if(count($has_same)>0){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Nomor Plat Sudah Pernah ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kendaraan/kendaraan_edit/'.$id);
			}

			$data = array(
				'no_plat' =>$plat,
				'id_status' =>$status,
				'lokasi' =>$lokasi,
				'merk' =>$merk,
				'type' =>$type,
				'no_rangka' =>$rangka,
				'no_mesin' =>$mesin,
				'tahun_produksi' =>$produksi,
				'tahun_perolehan' =>$tahun,
				'nilai_perolehan' =>$nilai,
				'jenis_bbm' =>$bbm,
				'bpkb' =>$bpkb,
				'keterangan' =>$ket,
				'kondisi'=>$kondisi,
				'id_bidang' =>$bidang,
				'id_jenisaset' =>$jenis
			);

			$where = array('id_kendaraan' => $id);

			$this->model_user->update_kendaraan($where, $data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Kendaraan Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/kendaraan');
		}
	}

	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventariskendaraan($id)->row();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kendaraan/qrcode', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function print_qrcode(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang = $this->session->userdata('id_bidang');
		$data ['idin'] = $this->model_user->get_kendaraancode($id_bidang);
		$count = $this->model_user->get_kendaraancode($id_bidang);
		$data ['stock'] = count($count);
		$this->pdf->load_view('user/kendaraan/qrcode_kendaraan_All', $data);
	}

	public function print_qrcode_custom(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id = $this->input->post('id_kendaraan');
		$jumlah = $this->input->post('jumlah');
		$data['stock'] = $jumlah;
		$data ['idin'] = $this->model_user->get_idinventariskendaraan($id)->row();
		$this->pdf->load_view('user/kendaraan/qrcode_kendaraan_custom', $data);
	}

	public function laporan(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kendaraan/kendaraan_laporan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function laporan_all(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$first = $this->model_user->get_kendaraanhistmin();
		$data['bid'] = $this->model_user->get_bidang($id_bidang);
		$last = $this->input->post('tgl');
		$data['tgl'] = $last;
		$data['kategori'] = "KENDARAAN";
		$kondisi = $this->input->post('kondisi');
		
		if($kondisi == "baik"){
			$data['inventari'] = $this->model_user->get_baranghistallkendaraan($first,$last,$id_bidang,$kondisi);
			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->load_view3('user/kendaraan/laporan_baik', $data);
		} else if($kondisi == "rusak"){
			$data['inventaris'] = $this->model_user->get_baranghistallkendaraan($first,$last,$id_bidang,$kondisi);
			$this->pdf->load_view3('user/kendaraan/laporan_buruk', $data);
		} else{
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Ruang dan Kondisi tidak boleh kosong <button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kendaraan/laporan');
		}
	}

}

?>