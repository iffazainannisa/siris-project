<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class Model_home extends CI_Model{
  	public function countData($bidang){
  		$totalkantor = "SELECT COUNT(*) AS jumlah_kantor FROM barang AS b JOIN jenis_aset AS j ON b.id_jenisaset=j.id_jenisaset WHERE j.id_kategoriaset=1 AND b.id_bidang='$bidang'";
  		$totalkantor = $this->db->query($totalkantor)->row_array();
  		$totalmesin = "SELECT COUNT(*) AS jumlah_mesin FROM barang AS b JOIN jenis_aset AS j ON b.id_jenisaset=j.id_jenisaset WHERE j.id_kategoriaset=2 AND b.id_bidang='$bidang'";
  		$totalmesin = $this->db->query($totalmesin)->row_array();
      $totalkendaraan = "SELECT COUNT(*) AS jumlah_kendaraan FROM inventaris_kendaraan WHERE id_bidang='$bidang' AND keterangan !='hapus'";
      $totalkendaraan = $this->db->query($totalkendaraan)->row_array();
       $totaltanah = "SELECT COUNT(*) AS jumlah_tanah FROM inventaris_tanah WHERE id_bidang='$bidang' AND keterangan !='hapus'";
      $totaltanah = $this->db->query($totaltanah)->row_array();
      $totalbangunan = "SELECT COUNT(*) AS jumlah_bangunan FROM inventaris_bangunan WHERE id_bidang='$bidang' AND keterangan !='hapus'";
      $totalbangunan = $this->db->query($totalbangunan)->row_array();

  		$data['totalkantor']=$totalkantor['jumlah_kantor'];
      $data['totalmesin']=$totalmesin['jumlah_mesin'];
      $data['totalkendaraan']=$totalkendaraan['jumlah_kendaraan'];
      $data['totaltanah']=$totaltanah['jumlah_tanah'];
  		$data['totalbangunan']=$totalbangunan['jumlah_bangunan'];
  		return $data;
  	}

    public function countDataAdmin(){
      $totalbidang = "SELECT COUNT(*) AS jumlah_bidang FROM bidang WHERE nama_bidang <> 'PMI'";
      $totalbidang = $this->db->query($totalbidang)->row_array();
      $totaljenisaset = "SELECT COUNT(*) AS jumlah_jenisaset FROM jenis_aset";
      $totaljenisaset = $this->db->query($totaljenisaset)->row_array();
      $totalruang = "SELECT COUNT(*) AS jumlah_ruang FROM ruang";
      $totalruang = $this->db->query($totalruang)->row_array();
      $totalstatus = "SELECT COUNT(*) AS jumlah_status FROM status";
      $totalstatus = $this->db->query($totalstatus)->row_array();
      $totalsumber = "SELECT COUNT(*) AS jumlah_sumber FROM sumber";
      $totalsumber = $this->db->query($totalsumber)->row_array();
      $totaluser = "SELECT COUNT(*) AS jumlah_user FROM user";
      $totaluser = $this->db->query($totaluser)->row_array();

      $data['totalbidang']=$totalbidang['jumlah_bidang'];
      $data['totaljenisaset']=$totaljenisaset['jumlah_jenisaset'];
      $data['totalruang']=$totalruang['jumlah_ruang'];
      $data['totalstatus']=$totalstatus['jumlah_status'];
      $data['totalsumber']=$totalsumber['jumlah_sumber'];
      $data['totaluser']=$totaluser['jumlah_user'];
      return $data;
    }
  }
?>