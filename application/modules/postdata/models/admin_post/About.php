<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Model
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

	function hapus_faq()
	{
		$this->db->where('faq_code', post('code'));
		$getFaq = $this->db->get('tb_faq');
		if ($getFaq->num_rows() == 0) { 
			Self::$data['status']     = false;
			Self::$data['message']    = 'Data Tidak Valid';
		}

		$this->form_validation->set_rules('code', 'Kode', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$faq = $getFaq->row();
			
			$this->db->where('faq_code', $faq->faq_code);
			$this->db->delete('tb_faq');
			
			Self::$data['heading']    = 'Berhasil';
			Self::$data['message']    = 'Data Faq Berhasil Dihapus';
			Self::$data['type']       = 'success';
		} else {
			Self::$data['heading']    = 'Gagal';
			Self::$data['type']       = 'error';
		}
		return Self::$data;
	}

	function edit_faq()
	{
		$this->db->where('faq_code', post('code'));
		$getFaq = $this->db->get('tb_faq');
		if ($getFaq->num_rows() == 0) { 
			Self::$data['status']     = false;
			Self::$data['message']    = 'Data Tidak Valid';
		}

		$this->form_validation->set_rules('code', 'Kode', 'required');
		$this->form_validation->set_rules('faq_quest', 'Question', 'required');
		$this->form_validation->set_rules('faq_answ', 'Answer', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$faq = $getFaq->row();
			
			$this->db->update('tb_faq', [
				'faq_quest'	=> post('faq_quest'),
				'faq_answ'	=> post('faq_answ'),
			],[
				'faq_code'	=> $faq->faq_code,
			]);
			
			Self::$data['heading']    = 'Berhasil';
			Self::$data['message']    = 'Data Faq Berhasil Diubah';
			Self::$data['type']       = 'success';
		} else {
			Self::$data['heading']    = 'Gagal';
			Self::$data['type']       = 'error';
		}
		return Self::$data;
	}

	function add_faq()
	{
		$this->form_validation->set_rules('faq_quest', 'Question', 'required');
		$this->form_validation->set_rules('faq_answ', 'Answer', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			
			$this->db->insert('tb_faq', [
				'faq_quest'	=> post('faq_quest'),
				'faq_answ'	=> post('faq_answ'),
				'faq_date'	=> sekarang(),
				'faq_code'	=> random_string('alnum', 16),
			]);
			
			Self::$data['heading']    = 'Berhasil';
			Self::$data['message']    = 'Data Faq Berhasil Ditambahkan';
			Self::$data['type']       = 'success';
		} else {
			Self::$data['heading']    = 'Gagal';
			Self::$data['type']       = 'error';
		}
		return Self::$data;
	}

    function saveAbout()
	{
		$this->form_validation->set_rules('about_title', 'Title', 'required');
		$this->form_validation->set_rules('about_desc', 'Deskripsi', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			
			$this->db->update('tb_about', [
			'about_title'	=> post('about_title'),
			'about_desc'	=> post('about_desc'),
			'about_date'	=> sekarang(),
			],[
				'about_id'	=> 1
			]);

			Self::$data['heading']    = 'Berhasil';
			Self::$data['message']    = 'Data About Berhasil Di Perbarui';
			Self::$data['type']       = 'success';
		} else {
			Self::$data['heading']    = 'Gagal';
			Self::$data['type']       = 'error';
		}
		return Self::$data;
	}

}