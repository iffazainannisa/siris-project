<?php

class M_admin extends CI_Model
{
	
	public function get_admindetail($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bidang','user.id_bidang = bidang.id_bidang');
		$this->db->where(array('user.id_user' => $id));
		return $this->db->get();
	}

	public function all_sumber(){
		$query = $this->db->query('SELECT * FROM sumber');
		return $query->result();
	}

	// BIDANG

	public function get_bidang(){
		$this->db->select('*');
		$this->db->from('bidang');
		$this->db->where_not_in('nama_bidang','PMI');
		$query=$this->db->get();
		return $query->result();
	}

	public function edit_bidang($where,$table){
		return $this->db->get_where($table,$where);
	}

	public function update_bidang($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	// JENIS
	public function all_jenis(){
		$this->db->select('*');
		$this->db->from('jenis_aset');
		$this->db->join('kategori','kategori.id_kategoriaset = jenis_aset.id_kategoriaset');
		$query=$this->db->get();
		return $query->result();
	}

	public function get_jenis($where){
		$this->db->select('*');
		$this->db->from('jenis_aset');
		$this->db->join('kategori','kategori.id_kategoriaset = jenis_aset.id_kategoriaset');
		$this->db->where(array('id_jenisaset' => $where));
		$query=$this->db->get();
		return $query->result();
	}

	public function get_kategori(){
		$this->db->select('*');
		$this->db->from('kategori');
		$this->db->where_not_in('nama_aset','Tanah');
		$this->db->where_not_in('nama_aset','Bangunan');
		$query=$this->db->get();
		return $query->result();
	}

	public function update_jenis($where, $data,$table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function is_ada_jenis_barang($id){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where(array('id_jenisaset' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function is_ada_jenis_kendaraan($id){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->where(array('id_jenisaset' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function hapus_jenis($where){
		$this->db->where($where);
		$this->db->delete('jenis_aset');
	}

	public function insert_jenis($data,$table){
		$this->db->insert($table,$data);
	}

	// RUANG

	public function get_ruangid($id_ruang){

		$this->db->select('*');
		$this->db->from('ruang');
		$this->db->join('bidang','ruang.id_bidang = bidang.id_bidang');
		$this->db->where(array('id_ruang' => $id_ruang));
		$query=$this->db->get();
   		return $query->result();	
	}

	public function update_ruang($where, $data,$table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_kodebidang($id){
		$this->db->select('*');
		$this->db->from('bidang');
		$this->db->where(array('id_bidang' => $id));
  		$query=$this->db->get();
		$ret = $query->row();
		return $ret->kode_bidang;
	}

	public function get_kodeurutanruang($id,$lantai){
		$this->db->select('COUNT(*) as no');
		$this->db->from('ruang');
		$this->db->where(array('id_bidang' => $id));
		$this->db->where(array('lantai' => $lantai));
		return $this->db->get()->row()->no;
	}

	public function get_kodeurutanruangexcept($id,$ruang,$lantai){
		$this->db->select('COUNT(*) as no');
		$this->db->from('ruang');
		$this->db->where(array('id_bidang' => $id));
		$this->db->where(array('lantai' => $lantai));
		$this->db->where_not_in('id_ruang',$id_ruang);
		return $this->db->get()->row()->no;
	}

	// HAPUS RUANG

	public function is_ada_ruang($id){
		$this->db->select('*');
		$this->db->from('inventaris_barang_history');
		$this->db->where(array('id_ruang' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function hapus_ruang($where){
		$this->db->where($where);
		$this->db->delete('ruang');
	}

	// HAPUS STATUS 
	public function is_ada_status_barang($id){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where(array('id_status' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function is_ada_status_bangunan($id){
		$this->db->select('*');
		$this->db->from('inventaris_bangunan');
		$this->db->where(array('id_status' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function is_ada_status_tanah($id){
		$this->db->select('*');
		$this->db->from('inventaris_tanah');
		$this->db->where(array('id_status' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function is_ada_status_kendaraan($id){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->where(array('id_status' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function hapus_status($where){
		$this->db->where($where);
		$this->db->delete('status');
	}

	// HAPUS SUMBER
	public function is_ada_sumber_tanah($id){
		$this->db->select('*');
		$this->db->from('inventaris_tanah');
		$this->db->where(array('id_sumber' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function is_ada_sumber_barang($id){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where(array('id_sumber' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function is_ada_sumber_bangunan($id){
		$this->db->select('*');
		$this->db->from('inventaris_bangunan');
		$this->db->where(array('id_sumber' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	public function hapus_sumber($where){
		$this->db->where($where);
		$this->db->delete('sumber');
	}

	// HAPUS USER
	public function hapus_user($where){
		$this->db->where($where);
		$this->db->delete('user');
	}


	public function edit_sumber($where,$table){

		return $this->db->get_where($table,$where);
	}

	public function edit_ruang($where,$table){

		return $this->db->get_where($table,$where);
	}

	
	public function update_sumber($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function insert_sumber($data,$table){
		$this->db->insert($table,$data);
	}

	public function insert_status($data,$table){
		$this->db->insert($table,$data);
	}

	public function insert_ruang($data,$table){
		$this->db->insert($table,$data);
	}

	
	
	// STATUS

	public function all_status()
	{
		$query = $this->db->query('SELECT * FROM status');
   		return $query->result();
	}

	public function edit_status($where,$table){

		return $this->db->get_where($table,$where);
	}

	
	public function update_status($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function all_ruang(){
		$this->db->select('*');
		$this->db->from('ruang');
		$this->db->join('bidang','ruang.id_bidang = bidang.id_bidang');
		$this->db->order_by("bidang.id_bidang", "ASC");
		$this->db->order_by("ruang.lantai", "ASC");
		$this->db->order_by("ruang.id_ruang", "ASC");
		$query=$this->db->get();
   		return $query->result();		

	}

	// USER

	public function all_user(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bidang','user.id_bidang = bidang.id_bidang');
		$this->db->where_not_in('level','admin');
		$this->db->order_by("user.nama_user", "ASC");
		$query=$this->db->get();
   		return $query->result();		

	}

	public function get_user(){
		$query = $this->db->query('SELECT * FROM user');
		return $query->result();
	}

	public function get_bidang1(){
	 	$this->db->select('*');
		$this->db->from('bidang');
		$query=$this->db->get();
   		return $query->result();
	}

	public function insert_user($data,$table){
		$this->db->insert($table,$data);
	}

	public function edit_user($where,$table){
		return $this->db->get_where($table,$where);
	}

	public function get_userid($id_user){

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bidang','user.id_bidang = bidang.id_bidang');
		$this->db->where(array('id_user' => $id_user));
		$query=$this->db->get();
   		return $query->result();	
	}

	public function update_user($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function update_user1($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	// BANGUNAN
	public function all_inventaris_bangunan(){
		$this->db->select('*');
		$this->db->from('inventaris_bangunan');
		$this->db->join('sumber','inventaris_bangunan.id_sumber = sumber.id_sumber');
		$this->db->join('status','inventaris_bangunan.id_status = status.id_status');
		$this->db->join('kategori','inventaris_bangunan.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->join('bidang','inventaris_bangunan.id_bidang = bidang.id_bidang');
		$query=$this->db->get();
   		return $query->result();	
	}

	public function get_hisbangunan(){
		$query = $this->db->query('SELECT * FROM inventaris_bangunan_history');
		return $query->result();

	}

	public function get_sumber1(){
		$query = $this->db->query('SELECT * FROM sumber');
		return $query->result();

	}

	public function get_status1(){
		$query = $this->db->query('SELECT * FROM status');
		return $query->result();

	}

	public function get_kategori1(){
		$query = $this->db->query('SELECT * FROM kategori');
		return $query->result();

	}

	public function get_bangunanid($id_bangunan){

		$this->db->select('*');
		$this->db->from('inventaris_bangunan');
		$this->db->join('sumber','inventaris_bangunan.id_sumber = sumber.id_sumber');
		$this->db->join('status','inventaris_bangunan.id_status = status.id_status');
		$this->db->join('kategori','inventaris_bangunan.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->join('bidang','inventaris_bangunan.id_bidang = bidang.id_bidang');
		$this->db->where(array('id_bangunan' => $id_bangunan));
		$query=$this->db->get();
   		return $query->result();	
	}

	public function update_inventaris_bangunan($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	
	public function hapus_bangunan($where){
		$this->db->where($where);
		$this->db->delete('inventaris_bangunan');
	}

	//BARANG KANTOR
	public function all_inventaris_barang(){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','inventaris_barang.id_barang = barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('kategori','jenis_aset.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->where(array('kategori.id_kategoriaset' => '1'));
		$query=$this->db->get();
   		return $query->result();	

	}

	public function get_ruang1(){
		$query = $this->db->query('SELECT * FROM ruang');
		return $query->result();
	}

	public function get_barang1(){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','inventaris_barang.id_barang = barang.id_barang');
		$query=$this->db->get();
   		return $query->result();

	}

	public function get_barangid($id_inventaris){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','inventaris_barang.id_barang = barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang'); 
		$this->db->where(array('id_inventaris' => $id_inventaris));
		$query=$this->db->get();
   		return $query->result();
	}

	public function update_inventaris_barang($where, $data,$table){
		$this->db->where($where);
		$this->db->update($table, $data);

	}

	public function update_barang($where, $data,$table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_tahun($id){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','inventaris_barang.id_barang = barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang'); 
		$this->db->where(array('barang.id_barang' => $id));
		$query=$this->db->get();
   		return $query->result();

	}

	public function get_hisbarang(){
		$this->db->select('*');
		$this->db->from('inventaris_barang_history');
		$this->db->join('barang','inventaris_barang_history.id_barang = barang.id_barang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('kategori','jenis_aset.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->where(array('kategori.id_kategoriaset' => '1'));
		$query=$this->db->get();
   		return $query->result();

	}

	//Mesin
	public function all_inventaris_mesin(){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','inventaris_barang.id_barang = barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('kategori','jenis_aset.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->where(array('kategori.id_kategoriaset' => '2'));
		$query=$this->db->get();
   		return $query->result();	

	}

	public function get_mesinid($id_inventaris){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','inventaris_barang.id_barang = barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang'); 
		$this->db->where(array('id_inventaris' => $id_inventaris));
		$query=$this->db->get();
   		return $query->result();

	}

	public function get_hismesin(){
		$this->db->select('*');
		$this->db->from('inventaris_barang_history');
		$this->db->join('barang','inventaris_barang_history.id_barang = barang.id_barang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('kategori','jenis_aset.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->where(array('kategori.id_kategoriaset' => '2'));
		$query=$this->db->get();
   		return $query->result();	

	}


	//KENDARAAN

	public function all_inventaris_kendaraan(){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		// $this->db->join('sumber','inventaris_kendaraan.id_sumber = sumber.id_sumber');
		$this->db->join('status','inventaris_kendaraan.id_status = status.id_status');
		$this->db->join('jenis_aset','inventaris_kendaraan.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('bidang','inventaris_kendaraan.id_bidang = bidang.id_bidang');
		$query=$this->db->get();
   		return $query->result();	

	}

	public function get_kendaraanid($id_kendaraan){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->join('status','inventaris_kendaraan.id_status = status.id_status');
		$this->db->join('jenis_aset','inventaris_kendaraan.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('bidang','inventaris_kendaraan.id_bidang = bidang.id_bidang');
		$this->db->where(array('id_kendaraan' => $id_kendaraan));
		$query=$this->db->get();
   		return $query->result();

	}

	public function get_jenis_aset(){
		$query = $this->db->query('SELECT * FROM jenis_aset');
		return $query->result();

	}

	public function update_inventaris_kendaraan($where, $data,$table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_hiskendaraan(){
		$query = $this->db->query('SELECT * FROM inventaris_kendaraan_history');
		return $query->result();

	}

	//TANAH

	public function all_inventaris_tanah(){
		$this->db->select('*');
		$this->db->from('inventaris_tanah');
		$this->db->join('sumber','inventaris_tanah.id_sumber = sumber.id_sumber');
		$this->db->join('status','inventaris_tanah.id_status = status.id_status');
		$this->db->join('kategori','inventaris_tanah.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->join('bidang','inventaris_tanah.id_bidang = bidang.id_bidang');
		$query=$this->db->get();
   		return $query->result();	
	}

	public function inventaris_tanah(){
		$this->db->select('*');
		$this->db->from('inventaris_tanah');
		$this->db->join('sumber','inventaris_tanah.id_sumber = sumber.id_sumber');
		$this->db->join('status','inventaris_tanah.id_status = status.id_status');
		$this->db->join('kategori','inventaris_tanah.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->join('bidang','inventaris_tanah.id_bidang = bidang.id_bidang');
		$query=$this->db->get();
   		return $query->result();	

	}

	
	
	public function get_tanahid($id_tanah){
		$this->db->select('*');
		$this->db->from('inventaris_tanah');
		$this->db->join('sumber','inventaris_tanah.id_sumber = sumber.id_sumber');
		$this->db->join('status','inventaris_tanah.id_status = status.id_status');
		$this->db->join('kategori','inventaris_tanah.id_kategoriaset = kategori.id_kategoriaset');
		$this->db->join('bidang','inventaris_tanah.id_bidang = bidang.id_bidang');
		$this->db->where(array('id_tanah' => $id_tanah));
		$query=$this->db->get();
   		return $query->result();	
	}

	public function update_inventaris_tanah($where, $data,$table){
	
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function get_histanah(){
		$query = $this->db->query('SELECT * FROM inventaris_tanah_history');
		return $query->result();

	}



	
	




	




	

}
?>