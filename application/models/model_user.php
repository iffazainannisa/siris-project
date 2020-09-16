<?php

class Model_user extends CI_Model{

	// Profile
	public function get_userdetails($id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('bidang','user.id_bidang = bidang.id_bidang');
		$this->db->where(array('user.id_user' => $id));
		return $this->db->get();
	}

	public function update_profile($where,$data){
		$this->db->where($where);
		$this->db->update('user',$data);
	}

	public function is_ada_user($username){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where(array('username' => $username));
		$query=$this->db->get();
   		return $query->result();
	}

	// Tambah Barang

	public function get_sumber(){
   		$query = $this->db->query('SELECT * FROM sumber');
   		return $query->result();
	}

	public function get_status(){
   		$query = $this->db->query('SELECT * FROM status');
   		return $query->result();
	}

	public function get_jenis(){
   		$query = $this->db->query('SELECT * FROM jenis_aset WHERE id_kategoriaset="1"');
   		return $query->result();
	}

	public function insert_barang($data){
		$this->db->insert('barang',$data);
	}

	public function has_same_barang($nama_barang, $tahun, $bidang){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where(array('id_bidang' => $bidang));
		$this->db->where(array('nama_barang' => $nama_barang));
		$this->db->where(array('tahun_perolehan' => $tahun));
  		$query=$this->db->get();
   		return $query->result();
	}

	// Letakkan Barang

	public function get_barang($bidang){
   		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('jenis_aset','barang.id_jenisaset=jenis_aset.id_jenisaset');
		$this->db->where(array('id_bidang' => $bidang));
		$this->db->where(array('id_kategoriaset' => 1));
  		$query=$this->db->get();
   		return $query->result();
	}

	public function get_idruang($id){
   		$this->db->select('nama_ruang');
		$this->db->from('ruang');
		$this->db->where(array('id_ruang' => $id));
		return $this->db->get()->row()->nama_ruang;	}

	public function get_ruang($bidang){
   		$this->db->select('*');
		$this->db->from('ruang');
		$this->db->where(array('id_bidang' => $bidang));
		$this->db->order_by("lantai", "ASC");
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_jumlahtotal($id){
		$this->db->where(array('id_barang' => $id));
		$query = $this->db->get('barang');
		
		if($query->num_rows() >0){
			$ret = $query->row();
			return $ret->jumlah_total;
		}else{
			return 0;
		}
	}

	public function get_kodetahun($id){
		$this->db->where(array('id_barang' => $id));
		$query = $this->db->get('barang');
		$ret = $query->row();
		return $ret->tahun_perolehan;
	}

	public function get_jumlahakumulasi($id){
		$this->db->select('SUM(jumlah_barang) as akumulasi');
		$this->db->from('inventaris_barang');
		$this->db->where(array('id_barang' => $id));
		return $this->db->get()->row()->akumulasi;
	}

	public function get_koderuang($id){
		$this->db->where(array('id_ruang' => $id));
		$query = $this->db->get('ruang');
		$ret = $query->row();
		return $ret->kode_ruang;
	}

	public function get_kodeurutan($id_ruang, $kategori){
		$sql = "SELECT MAX(SUBSTR(no_inventaris,9,3)) AS urutan FROM inventaris_barang JOIN barang ON inventaris_barang.id_barang=barang.id_barang JOIN jenis_aset ON jenis_aset.id_jenisaset=barang.id_jenisaset WHERE inventaris_barang.fix_ruang='$id_ruang' AND jenis_aset.id_kategoriaset='$kategori'";
		$query=$this->db->query($sql);
   		$ret = $query->row();
		return $ret->urutan;
	}



	public function letakkan_barang($data){
		$this->db->insert('inventaris_barang',$data);
	}

	public function has_same_ruang($id_barang, $id_ruang){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->where(array('ruang.id_ruang' => $id_ruang));
		$this->db->where(array('barang.id_barang' => $id_barang));
		$query=$this->db->get();
   		return $query->result();
	}

	public function has_same_ruang_except($id_barang,$id_ruang,$before_ruang){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->where(array('ruang.id_ruang' => $id_ruang));
		$this->db->where(array('barang.id_barang' => $id_barang));
		$this->db->where_not_in('inventaris_barang.id_ruang', $before_ruang);
		$query=$this->db->get();
   		return $query->result();
	}

	// Kelola Barang

	public function get_barangall($bidang){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('sumber','barang.id_sumber = sumber.id_sumber');
		$this->db->join('status','barang.id_status = status.id_status');
		$this->db->join('bidang','barang.id_bidang = bidang.id_bidang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('barang.id_bidang' => $bidang));
		$this->db->where(array('jenis_aset.id_kategoriaset' => 1));
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_barangid($id_barang){
   		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('sumber','barang.id_sumber = sumber.id_sumber');
		$this->db->join('status','barang.id_status = status.id_status');
		$this->db->join('bidang','barang.id_bidang = bidang.id_bidang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('id_barang' => $id_barang));
  		$query=$this->db->get();
   		return $query->result();
	}

	public function update_barang($where,$data){
		$this->db->where($where);
		$this->db->update('barang',$data);
	}

	public function hapus_barang($where){
		$this->db->where($where);
		$this->db->delete('barang');
	}

	public function is_ada_barang($id){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->where(array('id_barang' => $id));
		$query=$this->db->get();
   		return $query->result();
	}

	// Kelola Inventaris Barang
	public function get_semuainventaris($id){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('jenis_aset.id_kategoriaset' => 1));
		$this->db->where(array('barang.id_bidang' => $id));
		$this->db->where_not_in('inventaris_barang.keterangan', 'hapus');
		$this->db->order_by("jenis_aset.id_jenisaset", "ASC");
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_inventarisall($id){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->where(array('barang.id_barang' => $id));
		$this->db->where_not_in('inventaris_barang.keterangan', 'hapus');
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_inventarisid($id_inventaris){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->where(array('inventaris_barang.id_inventaris' => $id_inventaris));
		$query=$this->db->get();
   		return $query->result();
	}

	public function update_inventaris($where,$data){
		$this->db->where($where);
		$this->db->update('inventaris_barang',$data);
	}

	public function get_jumlahbarang($id){
		$this->db->select('jumlah_baik as akumulasi');
		$this->db->from('inventaris_barang');
		$this->db->where(array('id_inventaris' => $id));
		return $this->db->get()->row()->akumulasi;
	}

	// qrcode
	public function get_idinventaris($id){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->where(array('inventaris_barang.id_inventaris' => $id));
		return $this->db->get();
	}

	public function get_allinventaris($id_bidang){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->join('bidang','ruang.id_bidang = bidang.id_bidang');
		$this->db->where(array('bidang.id_bidang' => $id_bidang));
		$this->db->where(array('id_kategoriaset' => 1));
		$this->db->where_not_in('inventaris_barang.keterangan', 'hapus');
		$this->db->order_by("no_inventaris", "ASC");
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_allqrcode(){
		$this->db->select('SUM(jumlah_baik) as akumulasi');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('id_kategoriaset' => '1'));
		return $this->db->get()->row()->akumulasi;
	}

	// Laporan Ruang

	public function get_inventarisruangbaik($first,$last,$ruang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND hist.jumlah_baik!=0 AND r.id_ruang='$ruang' AND j.id_kategoriaset=1 ORDER BY hist.no_inventaris ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	public function get_inventarisruangrusak($first,$last,$ruang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND hist.jumlah_buruk!=0 AND r.id_ruang='$ruang' AND j.id_kategoriaset=1 ORDER BY hist.no_inventaris ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	public function get_bidang($id){
   		$this->db->where(array('id_bidang' => $id));
		$query = $this->db->get('bidang');
		$ret = $query->row();
		return $ret->nama_bidang;
	}

	public function get_ruanginv($id){
   		$this->db->where(array('id_ruang' => $id));
		$query = $this->db->get('ruang');
		$ret = $query->row();
		return $ret;
	}

	// Laporan Baik
	public function get_baranghistmin(){
		$this->db->select('MIN(update_time) as first');
		$this->db->from('inventaris_barang_history');
		return $this->db->get()->row()->first;
	}

	public function get_baranghistall($first,$last,$bidang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND (b.id_bidang='$bidang' AND j.id_kategoriaset=1 AND hist.jumlah_baik!=0) GROUP BY hist.id_barang ORDER BY b.id_barang, b.id_jenisaset ASC";
		$query=$this->db->query($sql);
   		return $query->result();

	}

	public function get_baranghistonruang($first,$last){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND hist.jumlah_baik!=0 ORDER BY b.id_barang ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	public function get_baranghistrusak($first,$last,$bidang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (hist.id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND b.id_bidang='$bidang' AND j.id_kategoriaset=1 AND hist.jumlah_buruk!=0 ORDER BY b.id_barang ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	/****/
	// MESIN ALAT BERAT
	/****/

	//Tambah Mesin

	public function get_jenismesin(){
   		$query = $this->db->query('SELECT * FROM jenis_aset WHERE id_kategoriaset="2"');
   		return $query->result();
	}

	//Letakkan Mesin

	public function get_barangmesin($bidang){
   		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('jenis_aset','barang.id_jenisaset=jenis_aset.id_jenisaset');
		$this->db->where(array('id_bidang' => $bidang));
		$this->db->where(array('id_kategoriaset' => 2));
  		$query=$this->db->get();
   		return $query->result();
	}	

	//Kelola Mesin

	public function get_mesinall($bidang){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('sumber','barang.id_sumber = sumber.id_sumber');
		$this->db->join('status','barang.id_status = status.id_status');
		$this->db->join('bidang','barang.id_bidang = bidang.id_bidang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('barang.id_bidang' => $bidang));
		$this->db->where(array('jenis_aset.id_kategoriaset' => 2));
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_semuainventarismesin($id){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('jenis_aset.id_kategoriaset' => 2));
		$this->db->where_not_in('inventaris_barang.keterangan', 'hapus');
		$this->db->where(array('barang.id_bidang' => $id));
		$this->db->order_by("jenis_aset.id_jenisaset", "ASC");
		$query=$this->db->get();
   		return $query->result();
	}

	//qrcode
	public function get_allinventarismesin($id_bidang){
		$this->db->select('*');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->join('ruang','inventaris_barang.id_ruang = ruang.id_ruang');
		$this->db->join('bidang','ruang.id_bidang = bidang.id_bidang');
		$this->db->where(array('bidang.id_bidang' => $id_bidang));
		$this->db->where(array('jenis_aset.id_kategoriaset' => 2));
		$this->db->where_not_in('inventaris_barang.keterangan', 'hapus');
		$this->db->order_by("no_inventaris", "ASC");
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_allqrcodemesin(){
		$this->db->select('SUM(jumlah_baik) as akumulasi');
		$this->db->from('inventaris_barang');
		$this->db->join('barang','barang.id_barang = inventaris_barang.id_barang');
		$this->db->join('jenis_aset','barang.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('id_kategoriaset' => '2'));
		return $this->db->get()->row()->akumulasi;
	}

	// Laporan Ruang
	public function get_inventarisruangmesinbaik($first,$last,$ruang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND hist.jumlah_baik!=0 AND r.id_ruang='$ruang' AND j.id_kategoriaset=2 ORDER BY hist.no_inventaris ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	public function get_inventarisruangmesinrusak($first,$last,$ruang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND hist.jumlah_buruk!=0 AND r.id_ruang='$ruang' AND j.id_kategoriaset=2 ORDER BY hist.no_inventaris ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	// Laporan Baik
	public function get_baranghistallmesin($first,$last,$bidang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND (b.id_bidang='$bidang' AND j.id_kategoriaset=2 AND hist.jumlah_baik!=0) GROUP BY hist.id_barang ORDER BY b.id_barang, b.id_jenisaset ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	// Laporan Rusak
	public function get_baranghistrusakmesin($first,$last,$bidang){
		$sql = "SELECT * FROM inventaris_barang_history AS hist JOIN barang AS b ON hist.id_barang=b.id_barang JOIN sumber AS s ON s.id_sumber=b.id_sumber JOIN status AS st ON st.id_status=b.id_status JOIN jenis_aset as j ON j.id_jenisaset=b.id_jenisaset JOIN kategori AS k ON j.id_kategoriaset=k.id_kategoriaset JOIN bidang as bd ON b.id_bidang=bd.id_bidang JOIN ruang AS r ON r.id_ruang=hist.id_ruang WHERE (hist.id_track=(SELECT MAX(id_track) FROM inventaris_barang_history WHERE hist.id_inventaris=id_inventaris AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND b.id_bidang='$bidang' AND j.id_kategoriaset=2 AND hist.jumlah_buruk!=0 ORDER BY b.id_barang ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	/****/
	// KENDARAAN
	/****/

	//Tambah Kendaraan

	public function get_jeniskendaraan(){
   		$query = $this->db->query('SELECT * FROM jenis_aset WHERE id_kategoriaset="5"');
   		return $query->result();
	}

	public function has_same_kendaraan($plat){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->where(array('no_plat' => $plat));
  		$query=$this->db->get();
   		return $query->result();
	}

	public function has_same_kendaraan_except($plat, $plat_before){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->where(array('no_plat' => $plat));
		$this->db->where_not_in('no_plat', $plat_before);
  		$query=$this->db->get();
   		return $query->result();
	}

	public function get_kodeurutankendaraan($bidang){
		$this->db->select('COUNT(*) as no');
		$this->db->from('inventaris_kendaraan');
		$this->db->where(array('id_bidang' => $bidang));
		return $this->db->get()->row()->no;
	}

	public function get_kodebidang($id){
		$this->db->select('*');
		$this->db->from('bidang');
		$this->db->where(array('id_bidang' => $id));
  		$query=$this->db->get();
		$ret = $query->row();
		return $ret->kode_bidang;
	}

	public function insert_kendaraan($data){
		$this->db->insert('inventaris_kendaraan',$data);
	}

	//Kelola Kendaraan
	public function get_kendaraanall($bidang){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->join('status','inventaris_kendaraan.id_status = status.id_status');
		$this->db->join('bidang','inventaris_kendaraan.id_bidang = bidang.id_bidang');
		$this->db->join('jenis_aset','inventaris_kendaraan.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('bidang.id_bidang' => $bidang));
		$this->db->where_not_in('inventaris_kendaraan.keterangan', 'hapus');
		$query=$this->db->get();
   		return $query->result();
	}

	public function get_kendaraancode($bidang){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->join('status','inventaris_kendaraan.id_status = status.id_status');
		$this->db->join('bidang','inventaris_kendaraan.id_bidang = bidang.id_bidang');
		$this->db->join('jenis_aset','inventaris_kendaraan.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('bidang.id_bidang' => $bidang));
		$this->db->where(array('inventaris_kendaraan.kondisi' => 'baik'));
		$this->db->where_not_in('inventaris_kendaraan.keterangan', 'hapus');
		$query=$this->db->get();
   		return $query->result();
	}

	public function update_kendaraan($where,$data){
		$this->db->where($where);
		$this->db->update('inventaris_kendaraan',$data);
	}

	public function get_kondisikendaraan($id){
		$this->db->select('kondisi as kd');
		$this->db->from('inventaris_kendaraan');
		$this->db->where(array('id_kendaraan' => $id));
		return $this->db->get()->row()->kd;
	}

	// qrcode
	public function get_idinventariskendaraan($id){
		$this->db->select('*');
		$this->db->from('inventaris_kendaraan');
		$this->db->join('status','inventaris_kendaraan.id_status = status.id_status');
		$this->db->join('bidang','inventaris_kendaraan.id_bidang = bidang.id_bidang');
		$this->db->join('jenis_aset','inventaris_kendaraan.id_jenisaset = jenis_aset.id_jenisaset');
		$this->db->where(array('id_kendaraan' => $id));
		return $this->db->get();
	}

	// Laporan Baik

	public function get_kendaraanhistmin(){
		$this->db->select('MIN(update_time) as first');
		$this->db->from('inventaris_kendaraan_history');
		return $this->db->get()->row()->first;
	}

	public function get_baranghistallkendaraan($first,$last,$bidang,$kondisi){
		$sql = "SELECT *, hist.keterangan, hist.kondisi FROM inventaris_kendaraan_history AS hist JOIN inventaris_kendaraan AS ik ON ik.id_kendaraan=hist.id_kendaraan JOIN status AS st ON st.id_status=ik.id_status JOIN jenis_aset as j ON j.id_jenisaset=ik.id_jenisaset JOIN bidang as bd ON ik.id_bidang=bd.id_bidang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_kendaraan_history WHERE hist.id_kendaraan=id_kendaraan AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND bd.id_bidang='$bidang' AND hist.kondisi='$kondisi' AND hist.keterangan!='hapus' ORDER BY hist.id_kendaraan, ik.id_jenisaset ASC";
		$query=$this->db->query($sql);
   		return $query->result();
	}

	/****/
	// TANAH
	/****/

	//Tambah Tanah
	public function get_kodeurutantanah($bidang){
		$this->db->select('COUNT(*) as no');
		$this->db->from('inventaris_tanah');
		$this->db->where(array('id_bidang' => $bidang));
		return $this->db->get()->row()->no;
	}

	public function insert_tanah($data){
		$this->db->insert('inventaris_tanah',$data);
	}

	// Kelola Tanah
	public function get_tanahall($bidang){
		$this->db->select('*');
		$this->db->from('inventaris_tanah');
		$this->db->join('status','inventaris_tanah.id_status = status.id_status');
		$this->db->join('sumber','inventaris_tanah.id_sumber = sumber.id_sumber');
		$this->db->join('bidang','inventaris_tanah.id_bidang = bidang.id_bidang');
		$this->db->where(array('bidang.id_bidang' => $bidang));
		$this->db->where_not_in('inventaris_tanah.keterangan', 'hapus');
		$query=$this->db->get();
   		return $query->result();
	}

	public function update_tanah($where,$data){
		$this->db->where($where);
		$this->db->update('inventaris_tanah',$data);
	}

	// qrcode
	public function get_idinventaristanah($id){
		$this->db->select('*');
		$this->db->from('inventaris_tanah');
		$this->db->join('status','inventaris_tanah.id_status = status.id_status');
		$this->db->join('sumber','inventaris_tanah.id_sumber = sumber.id_sumber');
		$this->db->join('bidang','inventaris_tanah.id_bidang = bidang.id_bidang');
		$this->db->where(array('id_tanah' => $id));
		return $this->db->get();
	}

	// Laporan Baik

	public function get_tanahhistmin(){
		$this->db->select('MIN(update_time) as first');
		$this->db->from('inventaris_kendaraan_history');
		return $this->db->get()->row()->first;
	}

	public function get_histalltanah($first,$last,$bidang){
		$sql = "SELECT *, hist.luas_tanah, hist.keterangan FROM inventaris_tanah_history AS hist JOIN inventaris_tanah AS ik ON ik.id_tanah=hist.id_tanah JOIN status AS st ON st.id_status=ik.id_status JOIN sumber AS s ON s.id_sumber=ik.id_sumber JOIN bidang as bd ON ik.id_bidang=bd.id_bidang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_tanah_history WHERE hist.id_tanah=id_tanah AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND bd.id_bidang='$bidang' AND hist.keterangan!='hapus'";
		$query=$this->db->query($sql);
   		return $query->result();
	}


	/****/
	// BANGUNAN
	/****/

	//Tambah Bangunan

	public function get_kodeurutanbangunan($bidang){
		$this->db->select('COUNT(*) as no');
		$this->db->from('inventaris_bangunan');
		$this->db->where(array('id_bidang' => $bidang));
		return $this->db->get()->row()->no;
	}

	public function insert_bangunan($data){
		$this->db->insert('inventaris_bangunan',$data);
	}

	//Kelola Bangunan
	public function get_bangunanall($bidang){
		$this->db->select('*');
		$this->db->from('inventaris_bangunan');
		$this->db->join('status','inventaris_bangunan.id_status = status.id_status');
		$this->db->join('sumber','inventaris_bangunan.id_sumber = sumber.id_sumber');
		$this->db->join('bidang','inventaris_bangunan.id_bidang = bidang.id_bidang');
		$this->db->where(array('bidang.id_bidang' => $bidang));
		$this->db->where_not_in('inventaris_bangunan.keterangan', 'hapus');
		$query=$this->db->get();
   		return $query->result();
	}

	public function update_bangunan($where,$data){
		$this->db->where($where);
		$this->db->update('inventaris_bangunan',$data);
	}

	// qrcode
	public function get_idinventarisbangunan($id){
		$this->db->select('*');
		$this->db->from('inventaris_bangunan');
		$this->db->join('status','inventaris_bangunan.id_status = status.id_status');
		$this->db->join('sumber','inventaris_bangunan.id_sumber = sumber.id_sumber');
		$this->db->join('bidang','inventaris_bangunan.id_bidang = bidang.id_bidang');
		$this->db->where(array('id_bangunan' => $id));
		return $this->db->get();
	}

	// Laporan Baik

	public function get_bangunanhistmin(){
		$this->db->select('MIN(update_time) as first');
		$this->db->from('inventaris_bangunan_history');
		return $this->db->get()->row()->first;
	}

	public function get_histallbangunan($first,$last,$bidang){
		$sql = "SELECT *, hist.luas_bangunan, hist.jumlah_lantai, hist.keterangan FROM inventaris_bangunan_history AS hist JOIN inventaris_bangunan AS ik ON ik.id_bangunan=hist.id_bangunan JOIN status AS st ON st.id_status=ik.id_status JOIN sumber AS s ON s.id_sumber=ik.id_sumber JOIN bidang as bd ON ik.id_bidang=bd.id_bidang WHERE (id_track=(SELECT MAX(id_track) FROM inventaris_bangunan_history WHERE hist.id_bangunan=id_bangunan AND (cast(update_time as date) BETWEEN '$first' AND '$last'))) AND bd.id_bidang='$bidang' AND hist.keterangan!='hapus'";
		$query=$this->db->query($sql);
   		return $query->result();
	}

}
?>