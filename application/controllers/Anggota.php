<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('anggota_model');
		$this->load->model('kecamatan_model');
		$this->load->model('status_model');
		$this->load->model('waktu_model');
		$this->load->helper(array('form', 'url'));
		//Do your magic here
	}

	public function index()
	{
			
			
		$result = $this->waktu_model->get();
		$data['waktu_update'] = end($result);

		$data['kecamatan'] = $this->kecamatan_model->dataKecamatan();

		if (isset($_POST['cari_kecamatan'])) {
			$id_kecamatan = $this->input->post('kecamatan');
		} else {
			$id_kecamatan = NULL;
		}

		$data['anggota'] = $this->anggota_model->getData($id_kecamatan);
		$data['total_data'] = $this->anggota_model->totalData();

		$this->load->view('include/header');
		$this->load->view('list_anggota_v', $data);
		$this->load->view('include/footer');
	}

	public function detail()
	{
		$idUser = $this->input->post('id');
		$result = $this->anggota_model->detailData(['id_user' => $idUser]);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function callsign()
	{
		$callsign = $this->input->post('callsign');
		$data = $this->anggota_model->detailData(['callsign' => $callsign]);

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function tambah()
	{
		if (!$this->session->has_userdata('email')) {
			redirect(base_url());
		}

		if (isset($_POST['submit'])) {

			$upload = $this->upload();

			if ($upload['result'] == 'gagal')
			{
				$image = $upload['upload_data'];

				if ( $image['is_image'] == FALSE ) 
				{
					$this->session->set_flashdata('error', 'Upload gambar harus jpg, png, jpeg | Gambar diset default');
				}
				else
				{
					if (intval($image['file_size']) > 2000)
					{
						$this->session->set_flashdata('error', 'File gambar harus kurang dari 2Mb | Gambar diset default');
					}
				}
				
				$foto = NULL;
			} 
			else
			{
				$foto = $upload['upload_data']['file_name'];
			}

			$masa_berlaku = date('Y-m-d', strtotime($this->input->post('berlaku')));
			$masa_berlaku_1 = date('Y-m-d', strtotime($masa_berlaku) + (60 * 60 * 24));

			if ($masa_berlaku == "1970-01-01") {
				$masa_berlaku = date('Y-m-d', time() + (60 * 60 * 24 * (365 * 3)));
				$masa_berlaku_1 = date('Y-m-d', time() + (60 * 60 * 24 * 1096));
			}

			$data = [
				'callsign' 		=> html_escape(strtoupper($this->input->post('callsign'))),
				'nama' 			=> html_escape(strtoupper($this->input->post('nama'))),
				'alamat' 		=> html_escape($this->input->post('alamat')),
				'kecamatan_id' 		=> $this->input->post('kecamatan'),
				'nia' 			=> html_escape(strtoupper($this->input->post('nia'))),
				'pengurus' 		=> html_escape($this->input->post('pengurus')),
				'jabatan' 		=> html_escape($this->input->post('jabatan')),
				'pekerjaan' 		=> html_escape(strtoupper($this->input->post('pekerjaan'))),
				'tgl_buat' 		=> date('Y-m-d'),
				'tgl_valid' 		=> date('Y-m-d', time() + (60 * 60 * 24 * 30)),
				'masa_berlaku' 		=> $masa_berlaku,
				'masa_berlaku_1'	=> $masa_berlaku_1,
				'perpanjang' 		=> 0,
				'email' 		=> $this->input->post('email'),
				'agama' 		=> html_escape(strtoupper($this->input->post('agama'))),
				'no_hp' 		=> $this->input->post('no_hp'),
				'tgl_lahir' 		=> $this->input->post('tgl_lahir'),
				'status_id' 		=> $this->input->post('status'),
				'foto' 			=> $foto
			];


			$result = $this->anggota_model->addData($data);

			if ($result > 0) {
			    $this->session->set_flashdata('success', 'Berhasil Menambah Data');
			    redirect(base_url());
			} else {
				$this->session->set_flashdata('error', 'Ada Kesalahan, Gagal Menambah Data');
				if ($result == FALSE) {
					$this->session->set_flashdata('error', 'Call Sign Sudah digunakan');
				}
				redirect(base_url());
			}
			
		}

		$data['kecamatan'] = $this->kecamatan_model->dataKecamatan();
		$data['status'] = $this->status_model->dataStatus();
		
		$this->waktu_model->update();

		$this->load->view('include/header');
		$this->load->view('tambah_anggota', $data);
		// $this->load->view('include/footer');
	}

	public function edit($id)
	{
		if (!isset($_POST['submit'])) {

			$cekId = $this->db->where('id_anggota', $id)->get('tbl_anggota')->row();

			if ($cekId == NULL) {
				redirect(base_url());
			}

		} else {

			$id = $this->input->post('id');

			$upload = $this->upload();

			if ($upload['result'] == 'gagal')
			{
				$image = $upload['upload_data'];

				if ( $image['is_image'] == FALSE ) 
				{
					$this->session->set_flashdata('error', 'Upload gambar harus jpg, png, jpeg | Gambar tidak diubah');
				}
				else
				{
					if (intval($image['file_size']) > 2000)
					{
						$this->session->set_flashdata('error', 'File gambar harus kurang dari 2Mb | Gambar tidak diubah');
					}
				}
				
				$tbl_anggota = $this->db->where('id_anggota', $id)->get('tbl_anggota')->row();
				$foto = $tbl_anggota->foto;
			} 
			else
			{
				$foto = $upload['upload_data']['file_name'];
			}

			$status_id = $this->input->post('status');
			$masa_berlaku = date('Y-m-d', strtotime($this->input->post('berlaku')));
			$masa_berlaku_1 = date('Y-m-d', strtotime($masa_berlaku) + (60 * 60 * 24));
 			
			if ($status_id == 4) {
				$perpanjang = 1;
			}else{
				$perpanjang = 0;
			}

			$data = [
				'id_anggota' 	=> $id,
				'nama' 			=> html_escape(strtoupper($this->input->post('nama'))),
				'alamat' 		=> html_escape($this->input->post('alamat')),
				'kecamatan_id' 	=> $this->input->post('kecamatan'),
				'nia' 			=> html_escape(strtoupper($this->input->post('nia'))),
				'pengurus' 		=> html_escape($this->input->post('pengurus')),
				'jabatan' 		=> html_escape($this->input->post('jabatan')),
				'pekerjaan' 	=> html_escape(strtoupper($this->input->post('pekerjaan'))),
				'masa_berlaku' 	=> $masa_berlaku,
				'masa_berlaku_1'=> $masa_berlaku_1,
				'email' 		=> html_escape($this->input->post('email')),
				'perpanjang' 	=> $perpanjang,
				'agama' 		=> html_escape(strtoupper($this->input->post('agama'))),
				'no_hp' 		=> $this->input->post('no_hp'),
				'tgl_lahir' 	=> $this->input->post('tgl_lahir'),
				'status_id' 	=> $status_id,
				'foto' 			=> $foto
			];

			$result = $this->anggota_model->updateData($data);

			if ($result > 0) {
				$this->waktu_model->update();
				$this->session->set_flashdata('success', 'Berhasil Mengubah Data');
				redirect(base_url());
			} else {
				$this->waktu_model->update();
				$this->session->set_flashdata('error', 'Gagal Mengubah Data');
				redirect(base_url());
			}

		}

		$data['data'] = $this->anggota_model->edit($id);
		$data['kecamatan'] = $this->kecamatan_model->dataKecamatan();
		$data['status'] = $this->status_model->dataStatus();
			
		$this->waktu_model->update();

		$this->load->view('include/header');
		$this->load->view('edit_anggota', $data);
		
		
	}

	public function delete($id)
	{
		$result = $this->anggota_model->delete($id);

		if ($result > 0) {
			$this->session->set_flashdata('success', 'Berhasil Menghapus Data');
		} else {
			$this->session->set_flashdata('error', 'Gagal Menghapus Data');
		}

		$this->waktu_model->update();
		redirect(base_url());
	}

	public function upload()
	{
		$config['upload_path'] = './assets/image/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']  = '2000';
		// $config['file_name'] = date('YmdHis').'logo';
		
		$this->load->library('upload', $config);

		
		if ( ! $this->upload->do_upload('foto')){
			$error = array('result' => 'gagal', 'upload_data' => $this->upload->data());
			return $error;
		} else {
			$data = array('result' => 'berhasil', 'upload_data' => $this->upload->data());
			return $data;
		}
	}

}
