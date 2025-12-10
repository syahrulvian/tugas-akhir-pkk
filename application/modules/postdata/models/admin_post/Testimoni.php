<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni extends CI_Model
{
    private static $data = [
        'status'  => true,
        'message' => null,
    ];

    public function __construct()
    {
        parent::__construct();
        Self::$data['csrf_data'] = $this->security->get_csrf_hash();
    }

    // HAPUS TESTIMONI
    function hapusTestimoni()
    {
        $this->db->where('testimoni_code', post('code'));
        $cekdata = $this->db->get('tb_testimoni');
        if ($cekdata->num_rows() == 0) {
            Self::$data['status']  = false;
            Self::$data['message'] = 'Testimoni tidak ditemukan';
        }

        if (Self::$data['status']) {
            $testimoni = $cekdata->row();

            if (!empty($testimoni->testimoni_img)) {
                if (file_exists('./assets/testimoni/' . $testimoni->testimoni_img)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/testimoni/' . $testimoni->testimoni_img);
                }
                if (file_exists('./assets/testimoni/thumbnail/' . $testimoni->testimoni_img)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/testimoni/thumbnail/' . $testimoni->testimoni_img);
                }
            }

            $this->db->where('testimoni_code', post('code'));
            $this->db->delete('tb_testimoni');

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Data testimoni berhasil dihapus!';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }

    // SIMPAN TESTIMONI BARU
function savenewtestimoni()
{

	$config['upload_path']          = './assets/testimoni/';
	$config['allowed_types']        = 'gif|jpg|png|jpeg';
	$config['max_size']             = '9999';
	$config['max_width']            = '9999';
	$config['max_height']           = '9999';
	$config['remove_spaces']        = TRUE;
	$config['encrypt_name']         = TRUE;
	$this->load->library('upload', $config);
	$this->upload->initialize($config);
	if (!$this->upload->do_upload('testimoni_img')) {
		Self::$data['status']     = false;
		Self::$data['message']     = $this->upload->display_errors();
	}

	$this->form_validation->set_rules('testimoni_name', 'NAMA', 'required');
	$this->form_validation->set_rules('testimoni_profesi', 'PROFESI', 'required');
	$this->form_validation->set_rules('testimoni_judul', 'JUDUL', 'required');
	$this->form_validation->set_rules('testimoni_desc', 'DESKRIPSI', 'required');
	if (!$this->form_validation->run()) {
		Self::$data['status']     = false;
		Self::$data['message']     = validation_errors(' ', '<br/>');
	}

	if (Self::$data['status']) {
		$random_string         = strtolower(random_string('alnum', 64));
		$uploaded              = $this->upload->data();

		$this->db->insert('tb_testimoni', [
			'testimoni_name'       => post('testimoni_name'),
			'testimoni_profesi'    => post('testimoni_profesi'),
			'testimoni_judul'      => post('testimoni_judul'),
			'testimoni_desc'       => post('testimoni_desc'),
			'testimoni_img'        => $uploaded['file_name'],
			'testimoni_date'       => sekarang(),
			'testimoni_code'       => $random_string,
		]);

		//PROSES RESIZE GAMBAR
		$configg['image_library']    =   'gd2';
		$configg['source_image']     =   './assets/testimoni/' . $uploaded['file_name'];
		$configg['create_thumb']     =   FALSE;
		$configg['maintain_ratio']   =   FALSE;
		$configg['quality']          =   '75%';
		$configg['width']            =   400;
		$configg['height']           =   400;
		$configg['new_image']        =   './assets/testimoni/thumbnail/' . $uploaded['file_name'];
		$this->load->library('image_lib', $configg);
		$this->image_lib->resize();

		Self::$data['heading']          = 'Berhasil';
		Self::$data['message']          = 'Data testimoni Berhasil Ditambahkan';
		Self::$data['type']             = 'success';
	} else {

		Self::$data['heading']          = 'Gagal';
		Self::$data['type']             = 'error';
	}

	return Self::$data;
}

    // UPDATE TESTIMONI
    function testimoniupdate()
    {
        $this->db->where('testimoni_code', post('codes'));
        $cek = $this->db->get('tb_testimoni');
        if ($cek->num_rows() == 0) {
            Self::$data['status']  = false;
            Self::$data['message'] = 'Testimoni tidak ditemukan';
        }

        $this->form_validation->set_rules('testimoni_name', 'Nama', 'required');
        $this->form_validation->set_rules('testimoni_profesi', 'Profesi', 'required');
        $this->form_validation->set_rules('testimoni_judul', 'Judul', 'required');
        $this->form_validation->set_rules('testimoni_desc', 'Deskripsi', 'required');

        $config = [
            'upload_path'   => './assets/testimoni/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size'      => '9999',
            'encrypt_name'  => TRUE,
            'remove_spaces' => TRUE
        ];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (Self::$data['status']) {
            $row = $cek->row();

            if (!$this->upload->do_upload('testimoni_img')) {
                // jika gambar tidak diganti
                $this->db->update(
                    'tb_testimoni',
                    [
                        'testimoni_name'    => post('testimoni_name'),
                        'testimoni_profesi' => post('testimoni_profesi'),
                        'testimoni_judul'   => post('testimoni_judul'),
                        'testimoni_desc'    => post('testimoni_desc'),
                    ],
                    ['testimoni_code' => post('codes')]
                );
            } else {
                // hapus gambar lama
                if (!empty($row->testimoni_img)) {
                    @unlink('./assets/testimoni/' . $row->testimoni_img);
                    @unlink('./assets/testimoni/thumbnail/' . $row->testimoni_img);
                }

                $uploaded = $this->upload->data();
                $this->db->update(
                    'tb_testimoni',
                    [
                        'testimoni_name'    => post('testimoni_name'),
                        'testimoni_profesi' => post('testimoni_profesi'),
                        'testimoni_judul'   => post('testimoni_judul'),
                        'testimoni_desc'    => post('testimoni_desc'),
                        'testimoni_img'     => $uploaded['file_name'],
                    ],
                    ['testimoni_code' => post('codes')]
                );

                // Resize gambar
                $configg['image_library']  = 'gd2';
                $configg['source_image']   = './assets/testimoni/' . $uploaded['file_name'];
                $configg['maintain_ratio'] = FALSE;
                $configg['quality']        = '75%';
                $configg['width']          = 500;
                $configg['height']         = 500;
                $configg['new_image']      = './assets/testimoni/thumbnail/' . $uploaded['file_name'];
                $this->load->library('image_lib', $configg);
                $this->image_lib->resize();
            }

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Data testimoni berhasil diperbarui';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }
}
