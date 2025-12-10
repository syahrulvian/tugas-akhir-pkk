<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Model
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

	function seContact()
	{
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('email', 'Alamat Email', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update('tb_options', [
				'option_desc1'	=> post('alamat'),
			], [
				'option_name'	=> 'alamat',
			]);

			$this->db->update('tb_options', [
				'option_desc1'	=> post('telp'),
			], [
				'option_name'	=> 'telp',
			]);

			$this->db->update('tb_options', [
				'option_desc1'	=> post('email'),
			], [
				'option_name'	=> 'email',
			]);


			Self::$data['heading']    = 'Berhasil';
			Self::$data['message']    = 'Data Kontak Berhasil Diubah';
			Self::$data['type']       = 'success';
		} else {
			Self::$data['heading']    = 'Gagal';
			Self::$data['type']       = 'error';
		}
		return Self::$data;
	}
}
