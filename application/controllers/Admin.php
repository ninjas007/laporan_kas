<?php 
 
class Admin extends CI_Controller{
 
	public function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index(){
		redirect('tambah');
	}

	public function dataKecamatan()
	{
		$this->load->model('kecamatan_model');

		if (isset($_POST['submit'])) {
			$nama_kecamatan = html_escape(strtoupper($this->input->post('nama_kecamatan')));
			$this->db->insert('tbl_kecamatan', ['nama_kecamatan' => $nama_kecamatan]);
			$result = $this->db->affected_rows();

			if ($result > 0) {
				$this->session->set_flashdata('success', 'Berhasil Menambah Kecamatan');
				redirect(base_url('Data_Kecamatan'));
			}
		}

		$data['kecamatan'] = $this->kecamatan_model->countAnggotaKecamatan();

		$this->load->view('include/header');
		$this->load->view('data_kecamatan', $data);
	}

	public function hapus()
	{
		$this->load->model('kecamatan_model');

		$kecamatan = $this->input->post('data');

		$this->db->where('nama_kecamatan', $kecamatan);
		$this->db->delete('tbl_kecamatan');

		$result = $this->db->affected_rows();

		$this->output->set_content_type('application/json')->set_output(json_encode($result));


	}
}