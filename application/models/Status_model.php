<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	public function dataStatus()
	{
		$this->db->select('*');
		$this->db->from('tbl_status');
		
		return $this->db->get()->result();
	}


}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */