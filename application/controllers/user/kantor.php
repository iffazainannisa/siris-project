<?php 

class Kantor extends CI_Controller{

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
		$data['barang'] = $this->model_user->get_barangall($id_bidang);
		$data['cek'] = $this->input->post('nama');
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/barang_kantor', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function inventaris(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$data['barang'] = $this->model_user->get_barangall($id_bidang);
		$id_barang = $this->input->post('nama');
		$data['cek'] = $id_barang;
		$data['aset'] = $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
		if($id_barang=='all' || $id_barang==""){
			$data['inventaris'] = $this->model_user->get_semuainventaris($id_bidang);
		}else{
			$data['inventaris'] = $this->model_user->get_inventarisall($id_barang);
		}
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/barang_inventaris', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_barang(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['sumber'] = $this->model_user->get_sumber();
		$data['status'] = $this->model_user->get_status();
		$data['jenis'] = $this->model_user->get_jenis();

		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/tambah_barang', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function tambah_aksi(){
		$this->_rules();

		if($this->form_validation->run()== FALSE){
			$this->tambah_barang();
		}else{
			$nama = $this->input->post('nama_aset');
			$merk = $this->input->post('merk');
			$type = $this->input->post('type');
			$tahun = $this->input->post('tahun');
			$total = $this->input->post('jumlah');
			$harga = $this->input->post('harga');
			$harga = str_replace('.', '', $harga);
			$sumber = $this->input->post('sumber');
			$status = $this->input->post('status');
			$bidang = $this->input->post('id_bidang');
			$jenis = $this->input->post('jenis');
			$has_same = $this->model_user->has_same_barang($nama,$tahun,$bidang);
			
			if(count($has_same)>0){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Barang Sudah Pernah ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/tambah_barang');
			}

			$data = array(
				'nama_barang' =>$nama,
				'merk' =>$merk,
				'type' =>$type,
				'tahun_perolehan' =>$tahun,
				'jumlah_total' =>$total,
				'harga_satuan' =>$harga,
				'id_sumber' =>$sumber,
				'id_status' =>$status,
				'id_bidang' =>$bidang,
				'id_jenisaset' =>$jenis
			);

			$this->model_user->insert_barang($data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Barang Kantor Berhasil Ditambahkan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/kantor');
		}
	}

	public function _rules(){
		$this->form_validation->set_rules('tahun', 'Tahun Perolehan','numeric');
		$this->form_validation->set_rules('harga', 'Harga Satuan','numeric');
		$this->form_validation->set_rules('jumlah', 'Jumlah Aset','numeric');
	}

	public function letakkan_barang(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$data['barang'] = $this->model_user->get_barang($id_bidang);
		$data['ruang'] = $this->model_user->get_ruang($id_bidang);

		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/letakkan_barang', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function _rules2(){
		$this->form_validation->set_rules('jumlah', 'Jumlah Barang','numeric');
		$this->form_validation->set_rules('baik', 'Jumlah Barang Baik','numeric');
	}

	public function letakkan_aksi(){
		$this->_rules2();

		if($this->form_validation->run()== FALSE){
			$this->letakkan_barang();
		}else{
			$id_barang = $this->input->post('nama');
			$jumlah_total = $this->model_user->get_jumlahtotal($id_barang);
			$kode_tahun = $this->model_user->get_kodetahun($id_barang);
			$jumlah = $this->input->post('jumlah');
			$jumlah_akumulasi = $this->model_user->get_jumlahakumulasi($id_barang);
			$cek = $jumlah_akumulasi + $jumlah;
			$baik = $this->input->post('baik');
			$id_ruang = $this->input->post('ruang');
			$fix = $id_ruang;
			$kode_ruang = $this->model_user->get_koderuang($id_ruang);
			$kode_urutan = $this->model_user->get_kodeurutan($fix,1);
			$kode_urutan = intval($kode_urutan);
			$has_same = $this->model_user->has_same_ruang($id_barang,$id_ruang);

			if(($cek>$jumlah_total) && ($cek != $jumlah_total)){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Jumlah Barang Yang Anda Inputkan Lebih Dari Stock<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/letakkan_barang');
			}else{
				$buruk = $jumlah - $baik;
				if(count($kode_urutan)==0){
					$kode_urutan = 1;
				}else{
					$kode_urutan++;
				}
				$digit = 3;
				$inventaris = $kode_ruang.".".str_pad( $kode_urutan, $digit, "0", STR_PAD_LEFT ).".".$kode_tahun;
			}

			if($baik > $jumlah){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Jumlah Barang Baik yang Anda Inputkan Berlebihan<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/letakkan_barang');
			}

			if(count($has_same)>0){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Barang Sudah Pernah ditempatkan di ruang yang sama<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/letakkan_barang');
			}
			
			$data = array(
				'id_barang' =>$id_barang,
				'no_inventaris' =>$inventaris,
				'jumlah_barang' =>$jumlah,
				'jumlah_baik' =>$baik,
				'jumlah_buruk' =>$buruk,
				'id_ruang' =>$id_ruang,
				'fix_ruang' =>$fix,
			);

			$this->model_user->letakkan_barang($data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Barang Berhasil Diletakkan Generate QRCode sekarang!<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/kantor/inventaris');
		}
	}

	public function barang_kantor_edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['barang'] = $this->model_user->get_barangid($id);
		$data['sumber'] = $this->model_user->get_sumber();
		$data['status'] = $this->model_user->get_status();
		$data['jenis'] = $this->model_user->get_jenis();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/barang_kantor_edit', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function barang_kantor_update(){
		$this->_rules();
		$id = $this->input->post('id_barang');
		if($this->form_validation->run()== FALSE){
			$this->barang_kantor_edit($id);
		}else{
			$id = $this->input->post('id_barang');
			$nama = $this->input->post('nama_aset');
			$merk = $this->input->post('merk');
			$type = $this->input->post('type');
			$tahun = $this->input->post('tahun');
			$total = $this->input->post('jumlah');
			$harga = $this->input->post('harga');
			$harga = str_replace('.', '', $harga);
			$sumber = $this->input->post('sumber');
			$status = $this->input->post('status');
			$jenis = $this->input->post('jenis');
			$bidang =  $this->session->userdata('id_bidang');

			$data = array(
				'nama_barang' =>$nama,
				'merk' =>$merk,
				'type' =>$type,
				'tahun_perolehan' =>$tahun,
				'jumlah_total' =>$total,
				'harga_satuan' =>$harga,
				'id_sumber' =>$sumber,
				'id_status' =>$status,
				'id_jenisaset' =>$jenis
			);

			$where = array('id_barang' => $id);

			$this->model_user->update_barang($where, $data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Barang Kantor Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/kantor');
		}
	}

	public function barang_kantor_hapus($id){
		$where = array('id_barang'=>$id);
		$cek = $this->model_user->is_ada_barang($id);
		if (count($cek)>0){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Data Aset Tidak bisa dihapus karena dipakai data inventaris<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$this->model_user->hapus_barang($where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Aset Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('user/kantor');
	}

	public function barang_inventaris_hapus($id){
		$where = array('id_inventaris'=>$id);
		$cek = $this->model_user->get_jumlahbarang($id);
		if ($cek != '0'){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Data Inventaris Tidak bisa dihapus karena barang masih layak<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}else{
			$data = array(
				'keterangan' => 'hapus',
				'jumlah_barang' =>0,
				'jumlah_buruk' =>0,
			);

			$this->model_user->update_inventaris($where, $data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Berhasil Dihapus<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		redirect('user/kantor/inventaris');
	}

	public function barang_inventaris_edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data['inventaris'] = $this->model_user->get_inventarisid($id);
		$id_bidang =  $this->session->userdata('id_bidang');
		$data['ruang'] = $this->model_user->get_ruang($id_bidang);
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/barang_inventaris_edit', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function barang_inventaris_update(){
		$this->_rules2();
		
		$id = $this->input->post('id_inventaris');

		if($this->form_validation->run()== FALSE){
			$this->barang_inventaris_edit($id);
		}else{
			$nomor = $this->input->post('no_inventaris');
			$id = $this->input->post('id_inventaris');
			$total = $this->input->post('jumlah');
			$baik = $this->input->post('baik');
			$buruk = $this->input->post('buruk');
			$ruang = $this->input->post('ruang');
			$id_ruang = $this->input->post('id_ruang');
			$fix = $this->input->post('fix_ruang');
			$nama_ruang = $this->model_user->get_idruang($fix);
			$id_barang = $this->input->post('id_barang');
			$before = $this->input->post('jumlah_before');
			$jumlah_total = $this->model_user->get_jumlahtotal($id_barang);
			$jumlah_akumulasi = $this->model_user->get_jumlahakumulasi($id_barang);
			$cek = $jumlah_akumulasi - $before + $total;

			if ($cek > $jumlah_total){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Jumlah Barang Yang Anda Inputkan Lebih Dari Stock<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/barang_inventaris_edit/'.$id);
			}

			$sum = $baik + $buruk;

			if($sum != $total){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Jumlah Kondisi Barang Baik dan Buruk Tidak Sesuai dengan Total Barang<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/barang_inventaris_edit/'.$id);
			}

			$has_same = $this->model_user->has_same_ruang_except($id_barang,$ruang,$id_ruang);
			if(count($has_same)>0){
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Barang Sudah ada di ruang yang sama<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/barang_inventaris_edit/'.$id);
			}

			$awal = $this->model_user->get_koderuang($ruang);

			if($awal != $nomor){
				$ket = "pindahan dari ".$nama_ruang;
			}else{
				$ket="";
			}

			$data = array(
				'jumlah_barang' =>$total,
				'jumlah_baik' =>$baik,
				'jumlah_buruk' =>$buruk,
				'id_ruang' =>$ruang,
				'keterangan' =>$ket	
			);

			$where = array('id_inventaris' => $id);

			$this->model_user->update_inventaris($where, $data);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Inventaris Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/kantor/inventaris');
		}
	}


	public function qrcode($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$data ['idin'] = $this->model_user->get_idinventaris($id)->row();
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/qrcode', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function print_qrcode(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang = $this->session->userdata('id_bidang');
		$data ['idin'] = $this->model_user->get_allinventaris($id_bidang);
		$data ['stock'] = $this->model_user->get_allqrcode();
		$this->pdf->load_view('user/kantor/qrcode_barang_All', $data);
	}

	public function print_qrcode_custom(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id = $this->input->post('id_inventaris');
		$stock = $this->input->post('stock');
		$jumlah = $this->input->post('jumlah');
		if($jumlah>$stock){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Jumlah QRCode yang dimasukkan berlebihan <button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('user/kantor/qrcode/'.$id);
		}
		$data['jumlah'] = $jumlah;
		$data ['idin'] = $this->model_user->get_idinventaris($id)->row();
		$this->pdf->load_view('user/kantor/qrcode_barang_custom', $data);
	}

	public function laporan(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$data['ruang'] = $this->model_user->get_ruang($id_bidang);
		$this->load->view('user/templates_user/header');
		$this->load->view('user/templates_user/sidebar',$data);
		$this->load->view('user/kantor/barang_laporan', $data);
		$this->load->view('user/templates_user/footer');
	}

	public function laporan_all(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('username')])->row_array();
		$id_bidang =  $this->session->userdata('id_bidang');
		$data['bidang'] = $id_bidang;
		$data['bid'] = $this->model_user->get_bidang($id_bidang);
		$id_ruang = $this->input->post('ruang');
		$kondisi = $this->input->post('kondisi');
		$first = $this->model_user->get_baranghistmin();
		$last = $this->input->post('tgl');
		$data['tgl'] = $last;
		$data['kategori'] = "PERALATAN DAN PERLENGKAPAN KANTOR";
		
		if(($id_ruang != "all")&&($kondisi == "baik")){
			$data['ruang'] = $this->model_user->get_ruanginv($id_ruang);
			$data['inventaris'] = $this->model_user->get_inventarisruangbaik($first, $last, $id_ruang);
			$this->pdf->load_view2('user/kantor/laporan_ruangan', $data);
		} else if (($id_ruang != "all")&&($kondisi == "rusak")){
			$data['ruang'] = $this->model_user->get_ruanginv($id_ruang);
			$data['inventaris'] = $this->model_user->get_inventarisruangrusak($first, $last, $id_ruang);
			$this->pdf->load_view2('user/kantor/laporan_ruanganrusak', $data);
		} else if(($id_ruang == "all")&&($kondisi == "baik")){
			$data['inventari'] = $this->model_user->get_baranghistall($first,$last,$id_bidang);
			$data['ruang'] = $this->model_user->get_baranghistonruang($first,$last);
			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->load_view3('user/kantor/laporan_baik', $data);	
		} else if(($id_ruang == "all")&&($kondisi == "rusak")){
			$data['inventaris'] = $this->model_user->get_baranghistrusak($first,$last,$id_bidang);
			$this->pdf->load_view3('user/kantor/laporan_buruk', $data);
		} else{
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Ruang dan Kondisi tidak boleh kosong <button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('user/kantor/laporan');
		}
	}

}

?>