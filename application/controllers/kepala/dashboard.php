<?php 

class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levell'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/dashboard', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function bidang($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['bidang'] = $this->model_user->get_bidang($id_bidang);
		$data['id_bidang'] = $id_bidang;
		$count_data=$this->model_home->countData($id_bidang);
        $data['count_data']=$count_data;
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/templates_kepala/sidebar',$data);
		$this->load->view('kepala/home', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function edit_profile($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['user'] = $this->model_user->get_userdetails($id)->row();
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/edit_profile', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function edit_password($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['user'] = $this->model_user->get_userdetails($id)->row();
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/edit_password', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function update_profile(){
        //rules
        $this->form_validation->set_rules('nama','Nama', 'required|trim|min_length[5]|max_length[15]', ['required' => 'Nama User harus diisi!']);
        $this->form_validation->set_rules('username','Username', 'required|trim|min_length[5]|max_length[15]',
            [
            'required' => 'Username harus diisi!',
            'min_length[5]' => "Username minimal 5 huruf",
            'max_length[15]' => "Username maksimal 15 huruf",
            ]
        );

        $id = $this->input->post('id_user');

        if($this->form_validation->run() == false){
            $this->edit_profile($id);
        }else{

            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $cek = $this->model_user->is_ada_user($username);
            $before = $this->input->post('before');
            
            if($username != $before){
	            if(count($cek)>0){
	                $this->session->set_flashdata('message','<div class="alert alert-danger alert dismissible fade show" role="alert">Username sudah Ada<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
	                redirect('kepala/dashboard/edit_profile/'.$id);
	            }
	        } 

            $data = array (
                'nama_user' => $nama,
                'username' => $username,
            );

            $where = array('id_user' => $id);
            $this->model_user->update_profile($where, $data);

            $userku = $this->db->get_where('user', ['username' => $username])->row_array();
            $data = [
                'usernamel' => $userku['username'],
                'levell' => $userku['level'],
                'id_bidangl' => $userku['id_bidang'],
            ];
            $this->session->set_userdata($data);

            $this->session->set_flashdata('message','<div class="alert alert-success alert dismissible fade show" role="alert">Profile Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('kepala/dashboard/edit_profile/'.$id);
        }
    }

    public function update_password(){
    	$id = $this->input->post('id_user');
        $data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['user'] = $this->model_user->get_userdetails($id)->row();

        //rule
        $this->form_validation->set_rules('lama', 'Password Lama', 'required|trim', [
            'required' => 'Password Lama harus diisi!']);
        $this->form_validation->set_rules('baru', 'Password Baru', 'required|trim|min_length[5]', 
        	[
            'required' => 'Password Baru harus diisi!',
            'min_length[5]' => 'Password minimal 5 huruf',
            ]);
        $this->form_validation->set_rules('ulang', 'Konfirmasi Password', 'required|trim|min_length[5]|matches[baru]',
        	[
            'required' => 'Konfirmasi Password harus diisi!',
            'min_length[5]' => 'Password minimal 5 huruf',
            'matches[baru]' => 'Password tidak cocok',
            ]
        );

    	if($this->form_validation->run() == false){
    		$this->edit_password($id);
    	}else{
    		$id = $this->input->post('id_user');
        	$lama = $this->input->post('lama');
        	$baru = $this->input->post('baru');
        	$ulang = $this->input->post('ulang');
        	$lama_hash = md5($lama);
        	if($lama_hash != $data['userku']['password']){
        		$this->session->set_flashdata('message','<div class="alert alert-danger alert dismissible fade show" role="alert">Password Lama Salah<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
        		redirect('kepala/dashboard/edit_password/'.$id);
        	}else{
        		if ($lama == $baru) {
        			$this->session->set_flashdata('message','<div class="alert alert-danger alert dismissible fade show" role="alert">Password Lama Sama dengan Password Baru<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
        			redirect('kepala/dashboard/edit_password/'.$id);
        		}else{
        			//ok
        			$password_baru = md5($baru);
        			$data = array (
            			'password' => $password_baru,
        			);

        			$where = array('id_user' => $id);
        			$this->model_user->update_profile($where, $data);
        			$this->session->set_flashdata('message','<div class="alert alert-success alert dismissible fade show" role="alert">Password Berhasil Diupdate<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
        			redirect('kepala/dashboard/edit_password/'.$id); 
        		}
        	}
    	}        
    }

    // KANTOR

    public function laporan_kantor($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['id_bidang'] = $id_bidang;
		$data['ruang'] = $this->model_user->get_ruang($id_bidang);
		$data['bidang'] = $this->model_user->get_bidang($id_bidang);
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/templates_kepala/sidebar',$data);
		$this->load->view('kepala/laporan_kantor', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function laporan_all($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
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
				redirect('kepala/laporan_kantor/'.$id_bidang);
		}
	}

	
	// MESIN
	public function laporan_mesin($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['id_bidang'] = $id_bidang;
		$data['ruang'] = $this->model_user->get_ruang($id_bidang);
		$data['bidang'] = $this->model_user->get_bidang($id_bidang);
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/templates_kepala/sidebar',$data);
		$this->load->view('kepala/laporan_mesin', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function laporan_all_mesin($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['bidang'] = $id_bidang;
		$data['bid'] = $this->model_user->get_bidang($id_bidang);
		$id_ruang = $this->input->post('ruang');
		$kondisi = $this->input->post('kondisi');
		$first = $this->model_user->get_baranghistmin();
		$last = $this->input->post('tgl');
		$data['tgl'] = $last;
		$data['kategori'] = "MESIN ATAU ALAT BERAT";
		
		if(($id_ruang != "all")&&($kondisi == "baik")){
			$data['ruang'] = $this->model_user->get_ruanginv($id_ruang);
			$data['inventaris'] = $this->model_user->get_inventarisruangmesinbaik($first, $last, $id_ruang);
			$this->pdf->load_view2('user/kantor/laporan_ruangan', $data);
		} else if (($id_ruang != "all")&&($kondisi == "rusak")){
			$data['ruang'] = $this->model_user->get_ruanginv($id_ruang);
			$data['inventaris'] = $this->model_user->get_inventarisruangmesinrusak($first, $last, $id_ruang);
			$this->pdf->load_view2('user/kantor/laporan_ruanganrusak', $data);
		} else if(($id_ruang == "all")&&($kondisi == "baik")){
			$data['inventari'] = $this->model_user->get_baranghistallmesin($first,$last,$id_bidang);
			$data['ruang'] = $this->model_user->get_baranghistonruang($first,$last);
			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->load_view3('user/kantor/laporan_baik', $data);	
		} else if(($id_ruang == "all")&&($kondisi == "rusak")){
			$data['inventaris'] = $this->model_user->get_baranghistrusakmesin($first,$last,$id_bidang);
			$this->pdf->load_view3('user/kantor/laporan_buruk', $data);
		} else{
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Ruang dan Kondisi tidak boleh kosong <button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('kepala/dashboard/laporan_mesin/'.$id_bidang);
		}
	}

	// KENDARAAN
	public function laporan_kendaraan($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['id_bidang'] = $id_bidang;
		$data['bidang'] = $this->model_user->get_bidang($id_bidang);
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/templates_kepala/sidebar',$data);
		$this->load->view('kepala/laporan_kendaraan', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function laporan_all_kendaraan($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
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
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Kondisi tidak boleh kosong <button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect('kepala/dashboard/laporan_kendaraan/'.$id_bidang);
		}
	}

	// TANAH
	public function laporan_tanah($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['id_bidang'] = $id_bidang;
		$data['bidang'] = $this->model_user->get_bidang($id_bidang);
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/templates_kepala/sidebar',$data);
		$this->load->view('kepala/laporan_tanah', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function laporan_all_tanah($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['id_bidang'] = $id_bidang;
		$first = $this->model_user->get_tanahhistmin();
		$data['bid'] = $this->model_user->get_bidang($id_bidang);
		$last = $this->input->post('tgl_baik');
		$data['tgl'] = $last;
		$data['kategori'] = "TANAH";
		$data['inventari'] = $this->model_user->get_histalltanah($first,$last,$id_bidang);
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->load_view3('user/tanah/laporan_baik', $data);
	}

	// BANGUNAN
	public function laporan_bangunan($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['id_bidang'] = $id_bidang;
		$data['bidang'] = $this->model_user->get_bidang($id_bidang);
		$this->load->view('kepala/templates_kepala/header');
		$this->load->view('kepala/templates_kepala/sidebar',$data);
		$this->load->view('kepala/laporan_bangunan', $data);
		$this->load->view('kepala/templates_kepala/footer');
	}

	public function laporan_all_bangunan($id_bidang){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernamel')])->row_array();
		$data['id_bidang'] = $id_bidang;
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