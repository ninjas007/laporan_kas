<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model {

	public function getData($id_kecamatan)
	{

		if ($id_kecamatan == NULL) {

			$this->db->select('*');
			$this->db->from('tbl_anggota');
			$this->db->join('tbl_status', 'tbl_anggota.status_id = tbl_status.id_status', 'inner');
			$this->db->join('tbl_kecamatan', 'tbl_anggota.kecamatan_id = tbl_kecamatan.id_kecamatan', 'inner');
			$result = $this->db->get()->result();

			$hariIni = date('Y-m-d');
			
			foreach ($result as $value) {
				

				// update valid ketika anggota sudah register selama 30 hari 
				if ($value->tgl_valid == $hariIni && $value->status_id == 1) {
					$this->db->where('tgl_valid', $hariIni);
					$this->db->where('perpanjang = ', 0);
					$this->db->update('tbl_anggota', ['status_id' => 2]);
				}

				// Update Invalild ketika masa berlaku udah habis dan tidak diperpanjang
				if ($value->masa_berlaku_1 == $hariIni && $value->status_id == 2) {
					$this->db->where('masa_berlaku_1', $hariIni);
					$this->db->where('perpanjang = ', 0);
					$this->db->update('tbl_anggota', ['status_id' => 3]);
				}

				// update Valid ketika masa berlaku habis dan anggota sudah register perpanjang
				if ($hariIni == $value->masa_berlaku_1 && $value->status_id == 4) {
					$this->db->where('masa_berlaku_1', $hariIni);
					$this->db->where('perpanjang =', 1);
					$this->db->update('tbl_anggota', ['status_id' => 2, 'masa_berlaku' => date('Y-m-d', strtotime($hariIni) + 60*60*24*1095), 'masa_berlaku_1' => date('Y-m-d', strtotime($hariIni) + 60*60*24*1096), 'perpanjang' => 0 ]);
				}

				// delete anggota jika tidak di perpanjang selama setahun
				if ($hariIni == date('Y-m-d', strtotime($value->masa_berlaku) + 60*60*24*366) && $value->status_id == 3) {
					$this->db->where('masa_berlaku', date('Y-m-d', strtotime($hariIni) - 60*60*24*366));
					$this->db->where('perpanjang =', 0);
					$this->db->delete('tbl_anggota');
				}

			}

			return $result;

		} else {

			$this->db->select('*');
			$this->db->from('tbl_anggota');
			$this->db->join('tbl_status', 'tbl_anggota.status_id = tbl_status.id_status', 'inner');
			$this->db->join('tbl_kecamatan', 'tbl_anggota.kecamatan_id = tbl_kecamatan.id_kecamatan', 'inner');
			$this->db->where('kecamatan_id', $id_kecamatan);

			return $this->db->get()->result();
			
		}


	}

	public function detailData($post)
	{
		// var_dump($post);
		$this->db->select('*');
		$this->db->from('tbl_anggota');
		$this->db->join('tbl_status', 'tbl_anggota.status_id = tbl_status.id_status', 'inner');
		$this->db->join('tbl_kecamatan', 'tbl_anggota.kecamatan_id = tbl_kecamatan.id_kecamatan', 'inner');

		if(array_keys($post)[0] == 'id_user') {
			$this->db->where('id_anggota', $post['id_user']);
			return $this->db->get()->result();
		}
		if(array_keys($post)[0] == 'callsign') {
			$this->db->where('callsign', $post['callsign']);
			return $this->db->get()->result();
		}

	}

	public function addData($data)
	{
		$this->db->select('*');
		$this->db->from('tbl_anggota');
		$this->db->where('callsign', $data['callsign']);
		$result = $this->db->get();

		if ($result->row() !== NULL ) {
			return FALSE;
		}

		$this->db->insert('tbl_anggota', $data);

		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$row = $this->db->where('id_anggota', $id)->get('tbl_anggota')->row();

		if ($row !== NULL) {
			unlink('assets/image/'.$row->foto);
		}

		$this->db->where('id_anggota', $id);
		$this->db->delete('tbl_anggota');

		return $this->db->affected_rows();
	}


	public function edit($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_anggota');
		$this->db->join('tbl_status', 'tbl_anggota.status_id = tbl_status.id_status', 'inner');
		$this->db->join('tbl_kecamatan', 'tbl_anggota.kecamatan_id = tbl_kecamatan.id_kecamatan', 'inner');
		$this->db->where('id_anggota', $id);
		
		return $this->db->get()->row();
	}

	public function updateData($data)
	{
		$row = $this->db->where('id_anggota', $data['id_anggota'])->get('tbl_anggota')->row();

		if ($data['foto'] !== $row->foto) {
			unlink('assets/image/'.$row->foto);
		}

		$this->db->where('id_anggota', $data['id_anggota']);
		$this->db->update('tbl_anggota', $data);

		return $this->db->affected_rows();
	}

	public function totalData()
	{
		// $this->db->select('*');
		$this->db->select('COUNT(status_id) AS total_data');
		$this->db->select('SUM(status_id = 1) AS baru');
		$this->db->select('SUM(status_id = 2) AS valid');
		$this->db->select('SUM(status_id = 3) AS invalid');
		$this->db->select('SUM(status_id = 4) AS perpanjang');
		$this->db->select('SUM(status_id = 5) AS seumur_hidup');
		$this->db->from('tbl_anggota');

		return $this->db->get()->row();
	}
}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */