<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends CI_Model
{

	private static $data = [
		'status' 	=> true,
		'message' 	=> null,
	];

	public function __construct()
	{
		parent::__construct();
		Self::$data['csrf_data'] 	= $this->security->get_csrf_hash();
	}

	function do_login()
	{
		$do_login = $this->ion_auth->login(post('authentication_id'), post('authentication_password'), true);
		if (!$do_login) {
			Self::$data['status']  = false;
			Self::$data['message'] = $this->ion_auth->errors();
		}

		$this->form_validation->set_rules('authentication_id', 'Username', 'required');
		$this->form_validation->set_rules('authentication_password', 'Password', 'required');
		if ($this->form_validation->run() == false) {
			Self::$data['status']  = false;
			Self::$data['message'] = validation_errors(' ', '<br/>');
		}

		if (!$this->input->post()) {
			Self::$data['status']  = false;
			Self::$data['message'] = 'Method not allowed';
		}

		if (Self::$data['status']) {

			// Ambil data user yang baru login
			$user = $this->ion_auth->user()->row();

			// Jika admin, buatkan session admin_userid
			$user_group = $this->ion_auth->get_users_groups()->row();
			if ($user_group->name == 'admin') {
				$array = array(
					'admin_userid' => userid()
				);
				$this->session->set_userdata($array);
			}

			// Kirim status user untuk dipakai redirect
			// Pastikan field user_status ada di tabel tb_users
			Self::$data['user_status'] = $user->user_status;

			Self::$data['message']  = 'You have successfully logged in. Click OK to continue';
			Self::$data['heading']  = 'Success';
			Self::$data['type']     = 'success';
		} else {

			Self::$data['heading'] = 'Fail';
			Self::$data['type']    = 'error';
		}

		return Self::$data;
	}

	function login_back_admin()
	{

		Self::$data['heading'] 		= 'Login Admin Berhasil';
		Self::$data['type']	 		= 'success';

		if (!$this->session->userdata('admin_userid')) {
			Self::$data['status'] 		= false;
			Self::$data['message'] 		= 'Not allowed';
		}

		if (Self::$data['status']) {

			//update status
			$array = array(
				'user_id' => $this->session->userdata('admin_userid')
			);
			$this->session->set_userdata($array);
			Self::$data['message']	= 'Berhasil login kembali menjadi menjadi Admin';
		} else {

			Self::$data['heading'] 		= 'Failed';
			Self::$data['type']	 		= 'error';
		}

		return Self::$data;
	}
	function do_register()
	{
		/*============================================
    =     VALIDASI INPUT AGAR TIDAK KOSONG       =
    ============================================*/
		$this->form_validation->set_rules('user_username', 'Username', 'trim|required|min_length[4]|is_unique[tb_users.username]', array(
			'is_unique' => 'Username Sudah Digunakan, Gunakan Username Lain.'
		));
		$this->form_validation->set_rules('user_fullname', 'Nama Lengkap', 'required');
		// $this->form_validation->set_rules('user_nisn', 'NISN', 'required|is_unique[tb_users.user_nisn]', array(
		// 	'is_unique' => 'NISN Sudah Terdaftar.'
		// ));
		$this->form_validation->set_rules('user_email', 'Alamat Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('user_phone', 'No. WhatsApp', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[6]');

		if (!$this->form_validation->run()) {
			Self::$data['status']  = false;
			Self::$data['message'] = validation_errors(' ', '<br/>');
			Self::$data['heading'] = "Gagal";
			Self::$data['type']    = "error";
			return Self::$data;
		}

		/*============================================
    =              PROSES UPLOAD CV              =
    ============================================*/
		$cv_filename = null;

		if (!empty($_FILES['user_cv']['name'])) {

			$config['upload_path']   = './assets/cv/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['max_size']      = 9999; // 2MB
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('user_cv')) {
				$uploadData   = $this->upload->data();
				$cv_filename  = $uploadData['file_name']; // Save filename
			} else {
				Self::$data['status']  = false;
				Self::$data['heading'] = "Upload CV Gagal";
				Self::$data['message'] = $this->upload->display_errors('', '');
				Self::$data['type']    = "error";
				return Self::$data;
			}
		}

		/*============================================
    =               INPUT USER BARU              =
    ============================================*/
		$random_string = strtolower(random_string('alnum', 64));

		$additional_data = array(
			'user_username'   => $this->input->post('user_username'),
			'user_fullname'   => $this->input->post('user_fullname'),
			'user_phone'      => $this->input->post('user_phone'),
			'email'      	=> $this->input->post('user_email'),
			// 'user_nisn'       => $this->input->post('user_nisn'),
			'user_code'       => $random_string,
			'user_passtext'   => $this->input->post('user_password'),
			'user_cv'         => $cv_filename,   // ← SIMPAN CV DI DATABASE
		);

		$this->ion_auth->register(
			$this->input->post('user_username'),
			$this->input->post('user_password'),
			str_replace(' ', '', $this->input->post('user_email')),
			$additional_data,
			array(2) // role = member
		);

		/*============================================
    =          RESPONSE JIKA BERHASIL            =
    ============================================*/
		Self::$data['status']  = true;
		Self::$data['heading'] = 'Berhasil';
		Self::$data['message'] = 'Selamat Pendaftaran Anda Berhasil. Silahkan Login';
		Self::$data['pass']    = $this->input->post('user_password');
		Self::$data['type']    = 'success';

		return Self::$data;
	}
}
