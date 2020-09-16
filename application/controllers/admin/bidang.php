<?php 

class Bidang extends CI_Controller{

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['levels'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('auth');
		}
	}

	public function index(){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$data['bidang'] = $this->m_admin->get_bidang();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/tampil_bidang', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function edit($id){
		$data['userku'] = $this->db->get_where('user',['username' => $this->session->userdata('usernames')])->row_array();
		$where  = array('id_bidang' => $id );
		$data['bidang'] = $this->m_admin->edit_bidang($where,'bidang') ->result();
		$this->load->view('admin/templates_administrator/header');
		$this->load->view('admin/templates_administrator/sidebar',$data);
		$this->load->view('admin/edit_bidang', $data);
		$this->load->view('admin/templates_administrator/footer');
	}

	public function update_bidang(){
		$id = $this->input->post('id_bidang');
		$kode = $this->input->post('kode_bidang');
		$nama = $this->input->post('nama_bidang');

		$data = array(
			'kode_bidang' => $kode, 
			'nama_bidang' => $nama, 
		);

		$where = array(
			'id_bidang' => $id, 
		);
		$this->m_admin->update_bidang($where,$data,'bidang');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert dismissible fade show" role="alert">Data Bidang Berhasil di Update<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('admin/bidang');
	}
}

?>