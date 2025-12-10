<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {

			$this->session->set_flashdata(
				'auth_flash',
				alerts('Anda harus login terlebih dahulu untuk mengakses halaman ini !', 'danger')
			);

			redirect('login', 'refresh');
		}
		if (!userdata()) {
			redirect('logout', 'refresh');
		}
	}


	function view_page($filename = 'dashboard')
	{

		$data = array();
		if (!file_exists(APPPATH . 'modules/dashboard/views/page/' . $filename . '.php')) {
			show_404();
			exit;
		}
		$data['data_group']     = $this->ion_auth->get_users_groups()->row();
		$data['userdata']     	= userdata();

		$this->template->content->view('page/' . $filename, $data);
		$this->template->publish('administrator/template');
	}

	public function downloadsertif($code)
	{
		// Ambil data user berdasarkan user_code
		$this->db->where('user_code', $code);
		$cekuser = $this->db->get('tb_users');

		if ($cekuser->num_rows() == 0) {
			show_404();
			exit;
		}

		$DATACUST = $cekuser->row();

		// File CV user
		$cvFile = $DATACUST->user_cv; // contoh: cv_123.pdf

		if (!$cvFile) {
			show_error('CV tidak ditemukan pada akun ini.');
		}

		// Path file CV
		$filePath = FCPATH . 'assets/cv/' . $cvFile;

		// Cek file benar ada
		if (!file_exists($filePath)) {
			show_error('File CV tidak ditemukan di server.');
		}

		// Download CV
		$this->load->helper('download');
		force_download($filePath, NULL);
	}
}
