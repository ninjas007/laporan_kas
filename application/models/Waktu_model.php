<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Waktu_model extends CI_Model {


	public function get()
	{
		
		$this->db->select('*');
		$this->db->from('tbl_updatedata');
		
		$result = $this->db->get();

		if ($result->row() !== NULL) {
			return $result->result();
		}else {
			$this->db->insert('tbl_updatedata', ['waktu_update' => gmdate('Y-m-d H:i:s', time()+60*60*7)]);
		}
	}

	public function update()
	{
		$this->db->select('*');
		$this->db->from('tbl_updatedata');
		$get = $this->db->get();

		if ($get->row() == NULL) {
			$this->db->insert('tbl_updatedata', ['waktu_update' => gmdate('Y-m-d H:i:s', time()+60*60*7)]);
			return $this->db->affected_rows();
		}

		$time = $get->result();
		$time_old = end($time)->waktu_update;

		$this->db->where('waktu_update', $time_old);
		$this->db->update('tbl_updatedata', ['waktu_update' => gmdate('Y-m-d H:i:s', time()+60*60*7)]);
	}
}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */