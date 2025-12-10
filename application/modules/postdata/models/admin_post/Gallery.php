<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends CI_Model
{
	private static $data = [
		'status' => true,
		'message' => null,
	];

	public function __construct()
	{
		parent::__construct();
		self::$data['csrf_data'] = $this->security->get_csrf_hash();
	}

	public function addgalery()
	{
		$config['upload_path'] = './assets/gallery/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '10000';
		$config['max_width'] = '99999999';
		$config['max_height'] = '99999999';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		$this->load->library('image_lib');

		$random_string = strtolower(random_string('alnum', 64));

		$data_insert = [
			'gallery_code' 		  => $random_string,
			'gallery_title' 	  => $this->input->post('galeri_title'),
			'gallery_description' => $this->input->post('galeri_description'),
			'gallery_image' 	  => null,
			'gallery_created_at'  => date('Y-m-d H:i:s'),
			'gallery_updated_at'  => date('Y-m-d H:i:s'),
		];

		$foto_data = [];

		// Upload multi gambar
		if (!empty($_FILES['galeri_images']['name'][0])) {
			$fotos = $_FILES['galeri_images'];


			for ($i = 0; $i < count($fotos['name']); $i++) {
				$_FILES['file'] = [
					'name' => $fotos['name'][$i],
					'type' => $fotos['type'][$i],
					'tmp_name' => $fotos['tmp_name'][$i],
					'error' => $fotos['error'][$i],
					'size' => $fotos['size'][$i]
				];

				if ($this->upload->do_upload('file')) {
					$upload_data = $this->upload->data();
					$file_path = $upload_data['full_path'];
					$file_name = $upload_data['file_name'];

					// Konfigurasi resize ke folder thumbnail
					$resize_config['image_library'] = 'gd2';
					$resize_config['source_image'] = $file_path;
					$resize_config['new_image'] = './assets/gallery/thumbnail/' . $file_name;
					$resize_config['maintain_ratio'] = TRUE;
					$resize_config['width'] = 800;
					$resize_config['height'] = 800;
					$resize_config['quality'] = '85%';

					$this->image_lib->initialize($resize_config);
					if (!$this->image_lib->resize()) {
						log_message('error', 'Resize gagal: ' . $this->image_lib->display_errors());
						self::$data['status']  = false;
						self::$data['message'] = 'Resize gagal: ' . $this->image_lib->display_errors();
					}

					$this->image_lib->clear();

					$foto_data[] = $file_name;
				} else {
					self::$data['status'] = false;
					self::$data['message'] = $this->upload->display_errors();
				}
			}

			if (!empty($foto_data)) {
				$data_insert['gallery_image'] = json_encode($foto_data);
			}
		}

		$this->form_validation->set_rules('galeri_title', 'Judul Galeri', 'required');
		$this->form_validation->set_rules('galeri_description', 'Deskripsi Galeri', 'required');
		if (!$this->form_validation->run()) {
			self::$data['status'] = false;
			self::$data['message'] = validation_errors(' ', '<br/>');
		}

		if (self::$data['status']) {

			$this->db->insert('tb_gallery', $data_insert);

			self::$data['message'] = 'Galeri berhasil ditambahkan.';
			self::$data['heading'] = 'Berhasil';
			self::$data['type']    = 'success';
		} else {
			self::$data['heading'] = 'Error';
			self::$data['type']    = 'error';
		}

		return self::$data;
	}

	public function updategalery()
	{

		$config['upload_path'] = './assets/gallery/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '10000';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		$gallery_code = $this->input->post('gallery_code');
		// Ambil data lama
		$this->db->where('gallery_code', $gallery_code);
		$old_data = $this->db->get('tb_gallery')->row_array();
		if (!$old_data) {
			self::$data['status'] = false;
			self::$data['message'] = 'Data galeri tidak ditemukan.';
		}

		// Data lama decode dari JSON
		$old_images = !empty($old_data['gallery_image']) ? json_decode($old_data['gallery_image'], true) : [];

		// Tangkap gambar yang dihapus dari form hidden input
		$deleted_images = json_decode($this->input->post('deleted_images'), true);
		if (!is_array($deleted_images)) $deleted_images = [];

		// Hapus file fisik gambar yang dihapus
		if (!empty($deleted_images)) {
			foreach ($deleted_images as $img) {
				$path_main = FCPATH . 'assets/gallery/' . $img;
				$path_thumb = FCPATH . 'assets/gallery/thumbnail/' . $img;
				if (file_exists($path_main)) unlink($path_main);
				if (file_exists($path_thumb)) unlink($path_thumb);
			}
			// Hapus dari array lama
			$old_images = array_values(array_diff($old_images, $deleted_images));
		}

		// Upload gambar baru
		$new_images = [];
		if (!empty($_FILES['galeri_images']['name'][0])) {
			$fotos = $_FILES['galeri_images'];

			for ($i = 0; $i < count($fotos['name']); $i++) {
				$_FILES['file'] = [
					'name' => $fotos['name'][$i],
					'type' => $fotos['type'][$i],
					'tmp_name' => $fotos['tmp_name'][$i],
					'error' => $fotos['error'][$i],
					'size' => $fotos['size'][$i]
				];

				if ($this->upload->do_upload('file')) {
					$upload_data = $this->upload->data();

					// Panggil fungsi resize seperti sebelumnya
					if (method_exists($this, 'resizeImage')) {
						$new_images[] = $this->resizeImage($upload_data);
					} else {
						$new_images[] = $upload_data['file_name'];
					}
				} else {
					self::$data['status'] = false;
					self::$data['message'] = $this->upload->display_errors();
				}
			}
		}

		// Validasi form
		$this->form_validation->set_rules('galeri_title', 'Judul Galeri', 'required');
		$this->form_validation->set_rules('galeri_description', 'Deskripsi Galeri', 'required');
		$this->form_validation->set_rules('gallery_code', 'Kode Galeri', 'required');
		if (!$this->form_validation->run()) {
			self::$data['status'] = false;
			self::$data['message'] = validation_errors(' ', '<br/>');
		}

		if (self::$data['status']) {

			// Gabungkan gambar lama yang masih ada + gambar baru
			$final_images = array_merge($old_images, $new_images);

			// Update data galeri
			$data_update = [
				'gallery_title' 	 => $this->input->post('galeri_title'),
				'gallery_description'=> $this->input->post('galeri_description'),
				'gallery_image' 	 => json_encode($final_images),
				'gallery_updated_at' => date('Y-m-d H:i:s'),
			];

			$this->db->where('gallery_code', $gallery_code);	
			$this->db->update('tb_gallery', $data_update);

			self::$data['message'] = 'Galeri berhasil diperbarui.';
			self::$data['heading'] = 'Berhasil';
			self::$data['type']    = 'success';
		} else {
			self::$data['heading'] = 'Error';
			self::$data['type']    = 'error';
		}

		return self::$data;
	}

	function resizeImage($upload_data)
	{
		$this->load->library('image_lib');

		$source_path = $upload_data['full_path'];
		$target_path = './assets/gallery/thumbnail/';

		$config['image_library'] = 'gd2';
		$config['source_image']  = $source_path;
		$config['new_image'] 	 = $target_path . $upload_data['file_name'];
		$config['maintain_ratio']= TRUE;
		$config['width'] = 800;
		$config['height'] = 800;

		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();

		return $upload_data['file_name'];
	}




	public function deletegalleryimage()
	{

		$code     = $this->input->post('gallery_code');
		// Ambil data galeri
		$this->db->where('gallery_code', $code);
		$gallery = $this->db->get('tb_gallery')->row();
		if (!$gallery) {
			self::$data['status']  = false;
			self::$data['message'] = 'Data galeri tidak ditemukan.';
		}

		$filename = $this->input->post('filename', TRUE);
		// Ambil dan decode daftar gambar
		$images = json_decode($gallery->gallery_image, true) ?? [];
		// Pastikan gambar ada di daftar
		$key = array_search($filename, $images);
		if ($key === false) {
			self::$data['status']  = false;
			self::$data['message'] = 'Gambar tidak ditemukan di galeri.';
		}

		// Validasi input
		$this->form_validation->set_rules('gallery_code', 'Kode Galeri', 'required');
		$this->form_validation->set_rules('filename', 'Nama File', 'required');
		// $this->form_validation->set_rules('galeri_description', 'Galeri Deskripsi', 'required');
		if (!$this->form_validation->run()) {
			self::$data['status']  = false;
			self::$data['message'] = validation_errors(' ', '<br/>');
		}

		if (self::$data['status']) {

			// Hapus file fisik
			$file_path = FCPATH . 'assets/gallery/' . $filename;
			if (file_exists($file_path)) {
				@unlink($file_path);
			}

			// Hapus dari array dan update database
			unset($images[$key]);
			$this->db->where('gallery_code', $code);
			$this->db->update('tb_gallery', [
				'gallery_image' => json_encode(array_values($images))
			]);

			self::$data['message'] = 'Gambar berhasil dihapus dari galeri.';
			self::$data['heading'] = 'Berhasil';
			self::$data['type']    = 'success';
		} else {
			self::$data['heading'] = 'Error';
			self::$data['type']    = 'error';
		}

		return self::$data;
	}





	public function deletegallery()
	{
		// Inisialisasi data respon
		self::$data['status'] = true;
		self::$data['heading'] = '';
		self::$data['message'] = '';
		self::$data['type'] = '';

		// Validasi input
		$this->form_validation->set_rules('code', 'Kode Galeri', 'required');
		if (!$this->form_validation->run()) {
			self::$data['status'] = false;
			self::$data['message'] = validation_errors(' ', '<br/>');
			return self::$data;
		}

		// Ambil data galeri berdasarkan kode unik
		$this->db->where('gallery_code', $this->input->post('code'));
		$cekgaleri = $this->db->get('tb_gallery');

		if ($cekgaleri->num_rows() == 0) {
			self::$data['status'] = false;
			self::$data['message'] = 'Data galeri tidak ditemukan.';
			self::$data['heading'] = 'Gagal';
			self::$data['type'] = 'error';
			return self::$data;
		}

		$galeri = $cekgaleri->row();

		// Hapus file gambar dari folder (jika ada)
		$gallery_images = $galeri->gallery_image ? json_decode($galeri->gallery_image, true) : [];
		if (is_array($gallery_images)) {
			foreach ($gallery_images as $image) {
				$file_path = './assets/gallery/' . $image;
				if (file_exists($file_path)) {
					unlink($file_path);
				}
			}
		} elseif (!empty($galeri->gallery_image)) {
			// Kalau hanya 1 gambar (bukan JSON array)
			$file_path = './assets/gallery/' . $galeri->gallery_image;
			if (file_exists($file_path)) {
				unlink($file_path);
			}
		}

		// Hapus data dari database
		$this->db->where('gallery_code', $this->input->post('code'));
		$this->db->delete('tb_gallery');

		// Respons berhasil
		self::$data['message'] = 'Galeri berhasil dihapus.';
		self::$data['heading'] = 'Berhasil';
		self::$data['type'] = 'success';
		self::$data['status'] = true;

		return self::$data;
	}





}
