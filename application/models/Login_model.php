<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function cek_login($input)
	{
		$this->db->where('email', $input['email']);
		$this->db->where('password', $input['password']);
		
		return $this->db->get('tbl_admin')->num_rows();
	}
}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */