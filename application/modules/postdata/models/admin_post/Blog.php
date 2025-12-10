<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Model
{

	private static $data = [
		'status'     => true,
		'message'     => null,
	];

	public function __construct()
	{
		parent::__construct();
		Self::$data['csrf_data']     = $this->security->get_csrf_hash();
	}

	function hapusblog()
	{
		$this->db->where('blog_code', post('code'));
		$cekdata = $this->db->get('tb_blog');
		if ($cekdata->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = 'blog TIDAK DITEMUKAN';
		}

		if (Self::$data['status']) {

			$blog                 = $cekdata->row();
			// REMOVE FILE IMAGE
			if (!empty($blog->blog_img)) {
				if (file_exists('./assets/blog/' . $blog->blog_img)) {
					unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/blog/' . $blog->blog_img);
				}

				if (file_exists('./assets/blog/thumbnail/' . $blog->blog_img)) {
					unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/blog/thumbnail/' . $blog->blog_img);
				}
			}

			$this->db->where('blog_code', post('code'));
			$this->db->delete('tb_blog');

			Self::$data['heading']    = 'Berhasil';
			Self::$data['message']    = 'Data blog Berhasil Dihapus !!';
			Self::$data['type']       = 'success';
		} else {
			Self::$data['heading']    = 'Gagal';
			Self::$data['type']       = 'error';
		}
		return Self::$data;
	}

	function blogupdate()
	{
		$this->db->where('blog_code', post('codes'));
		$Cekblog = $this->db->get('tb_blog');
		if ($Cekblog->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = 'blog TIDAK DITEMUKAN';
		}

		$this->form_validation->set_rules('codes', 'CODE', 'required');
		$this->form_validation->set_rules('jdul_blog', 'JUDUL blog', 'required');
		$this->form_validation->set_rules('desc_blog', 'DESKRIPSI blog', 'required|max_length[500]');
		$this->form_validation->set_rules('content_blog', 'CONTENT blog', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (post('jdul_blog')) {
			$urlblogl =  url_title(post('jdul_blog'), '-', true);
			$this->db->where('blog_alias', $urlblogl);
			$this->db->where('blog_code !=', post('codes'));
			$Cekkkk = $this->db->get('tb_blog');
			if ($Cekkkk->num_rows() == 1) {
				Self::$data['status']     = false;
				Self::$data['message']     = "URL TIDAK TERSEDIA ATAU SUDAH DIGUNAKAN";
			} else {
				$urlfix =  url_title(post('blog_alias'), '-', true);
			}
		} else {
			$urlblog =  url_title(post('jdul_blog'), '-', true);
			$this->db->where('blog_alias', $urlblog);
			$Cekkk = $this->db->get('tb_blog');
			if ($Cekkk->num_rows() == 1) {
				$random = random_string('numeric', 2);
				$urlfix =  url_title(post('jdul_blog') . $random, '-', true);
			} else {
				$urlfix =  url_title(post('jdul_blog'), '-', true);
			}
		}

		$config['upload_path']          = './assets/blog/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '9000';
		$config['max_width']            = '9000';
		$config['max_height']           = '9000';
		$config['remove_spaces']        = TRUE;
		$config['encrypt_name']         = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);


		if (Self::$data['status']) {
			$blog = $Cekblog->row();

			if ($blog->blog_judul != $this->input->post('jdul_blog')) {

				$urlblog =  url_title(post('jdul_blog'), '-', true);
				$this->db->where('blog_alias', $urlblog);
				$Cekkk = $this->db->get('tb_blog');
				if ($Cekkk->num_rows() == 1) {
					$random = random_string('numeric', 2);
					$urlfix =  url_title(post('jdul_blog') . $random, '-', true);
				} else {
					$urlfix =  url_title(post('jdul_blog'), '-', true);
				}
			} else {
				$urlfix     = $blog->blog_alias;
			}
			// JIKA GAMBAR TIDAK DIGANTI
			if (!$this->upload->do_upload('file_blog')) {

				$this->db->update(
					'tb_blog',
					[
						'blog_judul'                => post('jdul_blog'),
						'blog_desc'                 => post('desc_blog'),
						'blog_content'              => post('content_blog'),
						'blog_alias'                => $urlfix,
					],
					[
						'blog_code'                  => post('codes')
					]
				);
			} else {
				if (!empty($blog->blog_img)) {
					$main_img = FCPATH . 'assets/blog/' . $blog->blog_img;
					$thumb_img = FCPATH . 'assets/blog/thumbnail/' . $blog->blog_img;

					if (file_exists($main_img)) {
						unlink($main_img);
					}

					if (file_exists($thumb_img)) {
						unlink($thumb_img);
					}
				}

				$uploaded    = $this->upload->data();

				$this->db->update(
					'tb_blog',
					[
						'blog_judul'                => post('jdul_blog'),
						'blog_desc'                 => post('desc_blog'),
						'blog_content'              => post('content_blog'),
						'blog_img'                 => $uploaded['file_name'],
						'blog_alias'                => $urlfix,
					],
					[
						'blog_code'                 => post('codes')
					]
				);

				//PROSES RESIZE GAMBAR
				$configg['image_library']    =   'gd2';
				$configg['source_image']     =   './assets/blog/' . $uploaded['file_name'];
				$configg['create_thumb']     =   FALSE;
				$configg['maintain_ratio']   =   FALSE;
				$configg['quality']          =   '75%';
				$configg['width']            =   670;
				$configg['height']           =   400;
				$configg['new_image']        =   './assets/blog/thumbnail/' . $uploaded['file_name'];
				$this->load->library('image_lib', $configg);
				$this->image_lib->resize();

				// $confige['image_library']    = 'gd2';
				// $confige['source_image']     = './assets/blog/thumbnail/' . $uploaded['file_name'];
				// $confige['wm_type']          = 'overlay';
				// $confige['wm_overlay_path']  = './assets/wm01.png';
				// $confige['wm_opacity']       = 0;
				// $confige['wm_vrt_alignment'] = 'middle';
				// $confige['wm_hor_alignment'] = 'center';
				// $this->image_lib->initialize($confige);
				// $this->image_lib->watermark();
			}

			Self::$data['heading']    = 'Berhasil';
			Self::$data['message']    = 'Data blog Berhasil Di Perbarui';
			Self::$data['type']       = 'success';
		} else {
			Self::$data['heading']    = 'Gagal';
			Self::$data['type']       = 'error';
		}
		return Self::$data;
	}

	function savenewblog()
	{

		$config['upload_path']          = './assets/blog/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = '9999';
		$config['max_width']            = '9999';
		$config['max_height']           = '9999';
		$config['remove_spaces']        = TRUE;
		$config['encrypt_name']         = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('cover_blog')) {
			Self::$data['status']     = false;
			Self::$data['message']     = $this->upload->display_errors();
		}

		$this->form_validation->set_rules('judul_blog', 'JUDUL blog', 'required');
		$this->form_validation->set_rules('desc_blog', 'DESKRIPSI blog', 'required');
		$this->form_validation->set_rules('content_blog', 'CONTENT blog', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		// URL
		$urlblog =  url_title(post('judul_blog'), '-', true);
		$this->db->where('blog_judul', $urlblog);
		$Cekkk = $this->db->get('tb_blog');
		if ($Cekkk->num_rows() == 1) {
			$random = random_string('numeric', 2);
			$urlfix =  url_title(post('judul_blog') . $random, '-', true);
		} else {
			$urlfix =  url_title(post('judul_blog'), '-', true);
		}


		if (Self::$data['status']) {
			$random_string         = strtolower(random_string('alnum', 64));
			$uploaded              = $this->upload->data();

			$this->db->insert('tb_blog', [
				'blog_judul'                => post('judul_blog'),
				'blog_desc'                 => post('desc_blog'),
				'blog_content'              => post('content_blog'),
				'blog_img '                => $uploaded['file_name'],
				'blog_date'                 => sekarang(),
				'blog_alias'                => $urlfix,
				'blog_code'                 => $random_string,
			]);

			//PROSES RESIZE GAMBAR
			$configg['image_library']    =   'gd2';
			$configg['source_image']     =   './assets/blog/' . $uploaded['file_name'];
			$configg['create_thumb']     =   FALSE;
			$configg['maintain_ratio']   =   FALSE;
			$configg['quality']          =   '75%';
			$configg['width']            =   670;
			$configg['height']           =   400;
			$configg['new_image']        =   './assets/blog/thumbnail/' . $uploaded['file_name'];
			$this->load->library('image_lib', $configg);
			$this->image_lib->resize();

			Self::$data['heading']          = 'Berhasil';
			Self::$data['message']          = 'Data blog Berhasil Ditambahkan';
			Self::$data['type']             = 'success';
		} else {

			Self::$data['heading']          = 'Gagal';
			Self::$data['type']             = 'error';
		}

		return Self::$data;
	}

	function newkategori()
	{
		$this->form_validation->set_rules('kat_name', 'NAMA KATEGORI', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$urlblog =  url_title(post('kat_name'), '-', true);
			$this->db->where('kategori_nama', $urlblog);
			$Cekkk = $this->db->get('tb_kategori');
			if ($Cekkk->num_rows() == 1) {
				$random = random_string('numeric', 2);
				$urlfix =  url_title(post('kat_name') . $random, '-', true);
			} else {
				$urlfix =  url_title(post('kat_name'), '-', true);
			}

			$this->db->insert(
				'tb_kategori',
				[
					'kategori_nama'             => post('kat_name'),
					'kategori_alias'            => $urlfix,
					'kategori_code'             => strtolower(random_string('alnum', 64))
				]
			);

			Self::$data['heading']          = 'Berhasil';
			Self::$data['message']          = 'Data Kategori Berhasil Ditambahkan';
			Self::$data['type']             = 'success';
		} else {

			Self::$data['heading']          = 'Gagal';
			Self::$data['type']             = 'error';
		}

		return Self::$data;
	}

	function updkategori()
	{
		$this->db->where('kategori_code', post('code_kat'));
		$cekkategori = $this->db->get('tb_kategori');
		if ($cekkategori->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = 'KATEGORI TIDAK DITEMUKAN';
		}

		$this->form_validation->set_rules('code_kat', 'CODE KATEGORI', 'required');
		$this->form_validation->set_rules('kat_name', 'NAMA KATEGORI', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$urlblog =  url_title(post('kat_name'), '-', true);
			$this->db->where('kategori_nama', $urlblog);
			$Cekkk = $this->db->get('tb_kategori');
			if ($Cekkk->num_rows() == 1) {
				$random = random_string('numeric', 2);
				$urlfix =  url_title(post('kat_name') . $random, '-', true);
			} else {
				$urlfix =  url_title(post('kat_name'), '-', true);
			}

			$this->db->update(
				'tb_kategori',
				[
					'kategori_nama'         => post('kat_name'),
					'kategori_alias'        => $urlfix,
				],
				[
					'kategori_code'         => post('code_kat')
				]
			);

			Self::$data['heading']          = 'Berhasil';
			Self::$data['message']          = 'Data Kategori Berhasil Diubah';
			Self::$data['type']             = 'success';
		} else {

			Self::$data['heading']          = 'Gagal';
			Self::$data['type']             = 'error';
		}

		return Self::$data;
	}

	function hapuskategori()
	{
		$this->db->where('kategori_code', post('code'));
		$cekkkatt = $this->db->get('tb_kategori');
		if ($cekkkatt->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = 'KATEGORI TIDAK DITEMUKAN';
		}

		$this->form_validation->set_rules('code', 'CODE KATEGORI', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->where('kategori_code', post('code'));
			$this->db->delete('tb_kategori');

			Self::$data['heading']          = 'Berhasil';
			Self::$data['message']          = 'Data Kategori Berhasil Dihapus';
			Self::$data['type']             = 'success';
		} else {

			Self::$data['heading']          = 'Gagal';
			Self::$data['type']             = 'error';
		}

		return Self::$data;
	}
}
