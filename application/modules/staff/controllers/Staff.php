<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		if (!userdata()) {
			redirect('logout', 'refresh');
		}
	}

	function index($filename = 'dashboard')
	{
		$data = array();

		if (!file_exists(APPPATH . 'modules/staff/views/' . $filename . '.php')) {
			show_404();
			exit;
		}
		$data['userdata'] = userdata();
		$data['data_group']     = $this->ion_auth->get_users_groups()->row();
		$this->template->content->view('staff/' . $filename, $data);
		$this->template->publish('administrator/template');
	}

	function editindexxx($param = null)
	{
		$data = array();
		$filename = 'edit-lowongan';

		$this->db->where('tb_lowongan.lowongan_code', $param);
		$CEKKKKK = $this->db->get('tb_lowongan');

		if ($CEKKKKK->num_rows() == 0) {
			show_404();
			exit;
		} elseif (!file_exists(APPPATH . 'modules/staff/views/' . $filename . '.php')) {
			show_404();
			exit;
		}
		$data['userdata'] = userdata();
		$data['lowongan'] = $CEKKKKK->row();
		$data['data_group']     = $this->ion_auth->get_users_groups()->row();
		$data['jurusan_list'] = $this->db->where('jenis_kategori', 'keahlian')->get('tb_kategori')->result();
		$data['tipe_kerja_list'] = $this->db->where('jenis_kategori', 'tipe_kerja')->get('tb_kategori')->result();
		$this->template->content->view('staff/' . $filename, $data);
		$this->template->publish('template');
	}
}

/* End of file Staff.php */
/* Location: ./application/controllers/Staff.php */