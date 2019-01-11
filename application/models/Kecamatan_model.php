<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_model extends CI_Model {

	public function dataKecamatan()
	{
		$this->db->select('*');
		$this->db->from('tbl_kecamatan');
		
		return $this->db->get()->result();
	}

	public function countAnggotaKecamatan()
	{	
		$this->db->select('nama_kecamatan, kecamatan_id');
		$this->db->from('tbl_kecamatan');
		$this->db->join('tbl_anggota', 'tbl_kecamatan.id_kecamatan = tbl_anggota.kecamatan_id', 'left');
		$this->db->select('count(kecamatan_id) AS count');
		$this->db->group_by('nama_kecamatan');
		$this->db->order_by('nama_kecamatan', 'asc');

		$result = $this->db->get()->result();

		return $result;
	}


}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */