<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
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
    private function resizeImage($image_data)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->library('image_lib');

        if (!empty($image_data['file_name'])) {
            $configg['image_library']   = 'gd2';
            $configg['source_image']    = './assets/upload/' . $image_data['file_name'];
            $configg['create_thumb']    = FALSE;
            $configg['maintain_ratio']  = TRUE;
            $configg['quality']         = '50%'; // Compress the image
            $configg['new_image']       = './assets/upload/images/' . $image_data['file_name'];
            $this->image_lib->initialize($configg);
            if (!$this->image_lib->resize()) {
                Self::$data['status'] = false;
                Self::$data['message'] = $this->image_lib->display_errors();
            }
            $this->image_lib->clear();
        }
        // if (file_exists('./assets/upload/' . $image_data['file_name'])) {
        //     unlink('./assets/upload/' . $image_data['file_name']);
        // }
        return $image_data['file_name'];
    }

    function addartikel()
    {
        $config['upload_path']          = './assets/upload/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = '10000';
        $config['max_width']            = '99999999';
        $config['max_height']           = '99999999';
        $config['remove_spaces']        = TRUE;
        $config['encrypt_name']         = TRUE;

        // Load library upload
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('artikel_img')) {
            Self::$data['status']     = false;
            Self::$data['message']    = $this->upload->display_errors();
        } else {
            $upload_data = $this->upload->data();
            $resizeimg = $this->resizeImage($upload_data);
        }
        $this->form_validation->set_rules('artikel_title', 'Judul Artikel', 'required');
        $this->form_validation->set_rules('artikel_konten', 'konten Artikel', 'required');
        $this->form_validation->set_rules('artikel_kategori', 'Kategori Artikel', 'required');
        if (!$this->form_validation->run()) {
            Self::$data['status']     = false;
            Self::$data['message']     = validation_errors(' ', '<br/>');
        }
        $urlartikel =  url_title(post('artikel_title'), '-', true);
        $this->db->where('artikel_title', $urlartikel);
        $Cekkk = $this->db->get('tb_artikel');
        if ($Cekkk->num_rows() == 1) {
            $random = random_string('numeric', 2);
            $urlfix =  url_title(post('artikel_title') . $random, '-', true);
        } else {
            $urlfix =  url_title(post('artikel_title'), '-', true);
        }

        $random_string = strtolower(random_string('alnum', 64));
        $data_update = [
            'artikel_title' => $this->input->post('artikel_title'),
            'artikel_desc' => $this->input->post('artikel_desc'),
            'artikel_link' => $this->input->post('artikel_link'),
            'artikel_alias' => $urlfix,
            'artikel_kategori' => $this->input->post('artikel_kategori'),
            'artikel_konten' => $this->input->post('artikel_konten'),
            'artikel_img' => $resizeimg,
            'artikel_date' => sekarang(),
            'artikel_code' => $random_string,
            'artikel_type' => $this->input->post('artikel_type'),
            'artikel_userid' => userid(),
        ];
        // **Upload Gambar (Multiple)**
        if (!empty($_FILES['artikel_galeri']['name'][0])) {
            $fotos = $_FILES['artikel_galeri'];
            $foto_data = [];

            for ($i = 0; $i < count($fotos['name']); $i++) {
                $_FILES['file'] = [
                    'name'     => $fotos['name'][$i],
                    'type'     => $fotos['type'][$i],
                    'tmp_name' => $fotos['tmp_name'][$i],
                    'error'    => $fotos['error'][$i],
                    'size'     => $fotos['size'][$i]
                ];

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $foto_data[] = $this->resizeImage($upload_data);
                }
                // else {
                //     Self::$data['status']  = false;
                //     Self::$data['message'] = $this->upload->display_errors();
                // }
            }
            $data_update['artikel_galeri'] = json_encode($foto_data);
        }
        if (Self::$data['status']) {

            $this->db->insert('tb_artikel', $data_update);


            Self::$data['message']      = 'Artikel Berhasil Ditambahkan';
            Self::$data['heading']      = 'Berhasil';
            Self::$data['type']         = 'success';
        } else {
            Self::$data['heading']      = 'Error';
            Self::$data['type']         = 'error';
        }
        return Self::$data;
    }

    function updateartikel()
    {

        $config['upload_path']          = './assets/upload/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = '10000';
        $config['max_width']            = '99999999';
        $config['max_height']           = '99999999';
        $config['remove_spaces']        = TRUE;
        $config['encrypt_name']         = TRUE;

        // Load library upload
        $this->form_validation->set_rules('artikel_title', 'Judul Artikel', 'required');
        $this->form_validation->set_rules('artikel_konten', 'konten Artikel', 'required');
        $this->form_validation->set_rules('artikel_kategori', 'Kategori Artikel', 'required');
        if (!$this->form_validation->run()) {
            Self::$data['status']     = false;
            Self::$data['message']     = validation_errors(' ', '<br/>');
        }
        $urlartikel =  url_title(post('artikel_title'), '-', true);
        $this->db->where('artikel_title', $urlartikel);
        $Cekkk = $this->db->get('tb_artikel');
        if ($Cekkk->num_rows() == 1) {
            $random = random_string('numeric', 2);
            $urlfix =  url_title(post('artikel_title') . $random, '-', true);
        } else {
            $urlfix =  url_title(post('artikel_title'), '-', true);
        }
        $data = [
            'artikel_title' => $this->input->post('artikel_title'),
            'artikel_desc' => $this->input->post('artikel_desc'),
                        'artikel_link' => $this->input->post('artikel_link'),
            'artikel_alias' => $urlfix,
            'artikel_kategori' => $this->input->post('artikel_kategori'),
            'artikel_konten' => $this->input->post('artikel_konten'),
            'artikel_userid' => userid(),
        ];
        if (!empty($this->input->post('artikel_type'))) {
            $data['artikel_type'] = $this->input->post('artikel_type');
        }
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('artikel_img')) {
            $upload_data = $this->upload->data();
            $resizeimg = $this->resizeImage($upload_data);
            $data['artikel_img'] = $resizeimg;
        }
        // **Upload Gambar (Multiple)**
        if (!empty($_FILES['artikel_galeri']['name'][0])) {
            $fotos = $_FILES['artikel_galeri'];
            $foto_data = [];

            for ($i = 0; $i < count($fotos['name']); $i++) {
                $_FILES['file'] = [
                    'name'     => $fotos['name'][$i],
                    'type'     => $fotos['type'][$i],
                    'tmp_name' => $fotos['tmp_name'][$i],
                    'error'    => $fotos['error'][$i],
                    'size'     => $fotos['size'][$i]
                ];

                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $foto_data[] = $this->resizeImage($upload_data);
                }
                // else {
                //     Self::$data['status']  = false;
                //     Self::$data['message'] = $this->upload->display_errors();
                // }
            }
            $data['artikel_galeri'] = json_encode($foto_data);
        }
        if (Self::$data['status']) {
            $this->db->where('artikel_code', $this->input->post('code'));
            $this->db->update('tb_artikel', $data);

            Self::$data['message']      = 'Artikel Berhasil Diedit';
            Self::$data['heading']      = 'Berhasil';
            Self::$data['type']         = 'success';
        } else {
            Self::$data['heading']      = 'Error';
            Self::$data['type']         = 'error';
        }
        return Self::$data;
    }



    function deleteartikel()
    {
        $code = $this->input->post('code');
        $cekblog = $this->db->get_where('tb_artikel', ['artikel_code' => $code]);

        if ($cekblog->num_rows() == 0) {
            Self::$data['status'] = false;
            Self::$data['message'] = 'Blog Tidak Ditemukan';
        }

        $artikel = $cekblog->row();

        if (Self::$data['status']) {
            $this->db->where('artikel_code', $code);
            if ($this->db->delete('tb_artikel')) {
                $files = $artikel->artikel_img;
                if (!empty($files)) {
                    $file_path = './assets/upload/images/' . $files;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }

                Self::$data['heading'] = 'Berhasil';
                Self::$data['message'] = 'Artikel berhasil dihapus.';
                Self::$data['type'] = 'success';
            } else {
                Self::$data['heading'] = 'Error';
                Self::$data['type'] = 'error';
            }
        }

        return Self::$data;
    }
















public function updateprofile()
{
    // ===============================
    // DEFAULT RESPONSE
    // ===============================
    Self::$data = [
        'status'  => true,
        'message' => null,
    ];

    /* ===============================
       VALIDASI FORM
    =============================== */
    $this->form_validation->set_rules('user_fullname', 'Nama Lengkap', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('user_phone', 'Nomor Telepon', 'required|trim');

    if (!$this->form_validation->run()) {
        Self::$data['status']  = false;
        Self::$data['message'] = validation_errors('<div>', '</div>');
        Self::$data['heading'] = 'Validasi Gagal';
        Self::$data['type']    = 'error';
        return Self::$data; // ⛔ STOP DI SINI
    }

    /* ===============================
       DATA UPDATE (SESUAI DATABASE)
    =============================== */
    $data = [
        'user_fullname' => $this->input->post('user_fullname', true),
        'email'         => $this->input->post('email', true),
        'user_phone'    => $this->input->post('user_phone', true),
    ];

    /* ===============================
       PROSES UPDATE
    =============================== */
    $this->db->where('id', userid());
    $this->db->update('tb_users', $data);

    if ($this->db->affected_rows() >= 0) {

        Self::$data['message'] = 'Profil berhasil diperbarui';
        Self::$data['heading'] = 'Berhasil';
        Self::$data['type']    = 'success';

    } else {

        Self::$data['status']  = false;
        Self::$data['message'] = 'Gagal memperbarui profil';
        Self::$data['heading'] = 'Error';
        Self::$data['type']    = 'error';
    }

    return Self::$data;
}



   function updatepassword()
    {
        /* VALIDASI */
    $this->form_validation->set_rules('old_password', 'Sandi Lama', 'required');
    $this->form_validation->set_rules('new_password', 'Sandi Baru', 'required|min_length[6]');
    $this->form_validation->set_rules(
        'confirm_password',
        'Konfirmasi Sandi',
        'required|matches[new_password]'
    );
        if (!$this->form_validation->run()) {
            Self::$data['status']  = false;
            Self::$data['message'] = validation_errors(' ', '<br/>');
        }

        // Jika semua validasi lolos
        if (Self::$data['status']) {
    $user = userdata();
           

            $this->ion_auth->change_password(
        $user->username,
        $this->input->post('old_password'),
        $this->input->post('new_password'));


        $this->db->where('id', userid());
        $this->db->update('tb_users', [
            'user_passtext' =>   $this->input->post('new_password')
        ]);


            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Password berhasil diperbarui!';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }
  
}
