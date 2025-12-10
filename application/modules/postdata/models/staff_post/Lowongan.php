<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lowongan extends CI_Model
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

    // ==============================
    // HAPUS DATA PAKET
    // ==============================
    function hapuslowongan()
    {
        $this->db->where('lowongan_code', post('code'));
        $cekdata = $this->db->get('tb_lowongan');
        if ($cekdata->num_rows() == 0) {
            Self::$data['status'] = false;
            Self::$data['message'] = 'LOWONGAN TIDAK DITEMUKAN';
        }

        if (Self::$data['status']) {
            $lowongan = $cekdata->row();

            if (!empty($lowongan->lowongan_img)) {
                if (file_exists(FCPATH . '/assets/lowongan/' . $lowongan->lowongan_img)) {
                    unlink(FCPATH . '/assets/lowongan/' . $lowongan->lowongan_img);
                }
            }

            $this->db->where('lowongan_code', post('code'));
            $this->db->delete('tb_lowongan');

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Data Paket Berhasil Dihapus !!';
            Self::$data['type'] = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type'] = 'error';
        }
        return Self::$data;
    }

    // ==============================
    // TAMBAH DATA PAKET BARU
    // ==============================	

    // function saveackage()
    // {
    //     // $config['upload_path'] = './assets/lowongan/';
    //     // $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     // $config['max_size'] = '9999';
    //     // $config['encrypt_name'] = TRUE;
    //     // $this->load->library('upload', $config);
    //     // $this->upload->initialize($config);

    //     // if (!$this->upload->do_upload('lowongan_img')) {
    //     //     Self::$data['status'] = false;
    //     //     Self::$data['message'] = $this->upload->display_errors();
    //     // }


    //     $config['upload_path'] = './assets/lowongan/';
    //     $config['allowed_types'] = 'jpg|png|jpeg';
    //     $config['max_size'] = '10000';
    //     $config['max_width'] = '99999999';
    //     $config['max_height'] = '99999999';
    //     $config['remove_spaces'] = TRUE;
    //     $config['encrypt_name'] = TRUE;

    //     $this->load->library('upload', $config);
    //     $this->load->library('image_lib');


    //     $random_code = strtolower(random_string('alnum', 16));
    //     $data_insert = [
    //         'lowongan_nama'       => post('lowongan_nama'),
    //         'lowongan_categori'   => post('lowongan_categori'),
    //         'lowongan_desc'       => post('lowongan_desc'),
    //         'lowongan_lokasi'     => post('lowongan_lokasi'),
    //         'lowongan_lamapjl'    => post('lowongan_lamapjl'),
    //         'lowongan_harga'      => post('lowongan_harga'),
    //         'lowongan_local'      => post('lowongan_local'),
    //         'lowongan_fasilitas'  => post('lowongan_fasilitas'),
    //         'lowongan_img'       => null,
    //         'lowongan_code'       => $random_code,
    //         'lowongan_alias'      => url_title(post('lowongan_nama')),
    //         'lowongan_date'       => date('Y-m-d H:i:s'),
    //     ];

    //     $foto_data = [];

    //     // Upload multi gambar
    //     if (!empty($_FILES['lowongan_imgs']['name'][0])) {
    //         $fotos = $_FILES['lowongan_imgs'];


    //         for ($i = 0; $i < count($fotos['name']); $i++) {
    //             $_FILES['file'] = [
    //                 'name' => $fotos['name'][$i],
    //                 'type' => $fotos['type'][$i],
    //                 'tmp_name' => $fotos['tmp_name'][$i],
    //                 'error' => $fotos['error'][$i],
    //                 'size' => $fotos['size'][$i]
    //             ];

    //             if ($this->upload->do_upload('file')) {
    //                 $upload_data = $this->upload->data();
    //                 $file_path = $upload_data['full_path'];
    //                 $file_name = $upload_data['file_name'];

    //                 // Konfigurasi resize ke folder thumbnail
    //                 $resize_config['image_library'] = 'gd2';
    //                 $resize_config['source_image'] = $file_path;
    //                 $resize_config['new_image'] = './assets/lowongan/thumbnail/' . $file_name;
    //                 $resize_config['maintain_ratio'] = TRUE;
    //                 $resize_config['width'] = 800;
    //                 $resize_config['height'] = 800;
    //                 $resize_config['quality'] = '85%';

    //                 $this->image_lib->initialize($resize_config);
    //                 if (!$this->image_lib->resize()) {
    //                     log_message('error', 'Resize gagal: ' . $this->image_lib->display_errors());
    //                     self::$data['status']  = false;
    //                     self::$data['message'] = 'Resize gagal: ' . $this->image_lib->display_errors();
    //                 }

    //                 $this->image_lib->clear();

    //                 $foto_data[] = $file_name;
    //             } else {
    //                 self::$data['status'] = false;
    //                 self::$data['message'] = $this->upload->display_errors();
    //             }
    //         }

    //         if (!empty($foto_data)) {
    //             $data_insert['lowongan_img'] = json_encode($foto_data);
    //         }
    //     }

    //     $this->form_validation->set_rules('lowongan_nama', 'Nama Paket', 'required');
    //     $this->form_validation->set_rules('lowongan_categori', 'Kategori Paket', 'required');
    //     $this->form_validation->set_rules('lowongan_desc', 'Deskripsi', 'required');
    //     $this->form_validation->set_rules('lowongan_lokasi', 'Lokasi', 'required');
    //     $this->form_validation->set_rules('lowongan_lamapjl', 'Lama Perjalanan', 'required');
    //     $this->form_validation->set_rules('lowongan_harga', 'Harga', 'required');
    //     $this->form_validation->set_rules('lowongan_local', 'Harga Lokal', 'required');
    //     $this->form_validation->set_rules('lowongan_fasilitas', 'Fasilitas', 'required');
    //     if (!$this->form_validation->run()) {
    //         Self::$data['status'] = false;
    //         Self::$data['message'] = validation_errors(' ', '<br/>');
    //     }

    //     if (Self::$data['status']) {

    //         $this->db->insert('tb_lowongan', $data_insert);

    //         Self::$data['heading'] = 'Berhasil';
    //         Self::$data['message'] = 'Data Paket Berhasil Ditambahkan';
    //         Self::$data['type'] = 'success';
    //     } else {
    //         Self::$data['heading'] = 'Gagal';
    //         Self::$data['type'] = 'error';
    //     }

    //     return Self::$data;
    // }
    public function addlowongan()
    {
        $config['upload_path']   = './assets/lowongan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '9999';
        $config['max_width']     = '9999';
        $config['max_height']    = '9999';
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('cover_lowongan')) {
            Self::$data['status']  = false;
            Self::$data['message'] = $this->upload->display_errors();
        }

        // ================= FORM VALIDATION =================
        $this->form_validation->set_rules('lowongan_judul', 'Judul Lowongan', 'required');
        $this->form_validation->set_rules('lowongan_jurusan', 'Kategori Keahlian', 'required');
        $this->form_validation->set_rules('lowongan_alamat', 'Alamat Lowongan', 'required');
        $this->form_validation->set_rules('lowongan_nomor', 'No telepon/WA', 'required');
        $this->form_validation->set_rules('lowongan_start', 'Tanggal Dimulai', 'required');
        $this->form_validation->set_rules('lowongan_end', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('lowongan_perusahaan', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('lowongan_desc', 'Deskripsi Lowongan', 'required');
        $this->form_validation->set_rules('lowongan_tipe_kerja', 'Tipe Kerja', 'required');

        if (!$this->form_validation->run()) {
            Self::$data['status']  = false;
            Self::$data['message'] = validation_errors(' ', '<br/>');
        }

        // ================= URL ALIAS =================
        $urllowongan = url_title($this->input->post('lowongan_judul'), '-', true);
        $this->db->where('lowongan_alias', $urllowongan);
        $cek = $this->db->get('tb_lowongan');

        if ($cek->num_rows() > 0) {
            $random = random_string('numeric', 2);
            $urlfix = url_title($this->input->post('lowongan_judul') . '-' . $random, '-', true);
        } else {
            $urlfix = $urllowongan;
        }

        // ================= INSERT =================
        if (Self::$data['status']) {
            $random_string = strtolower(random_string('alnum', 64));
            $uploaded      = $this->upload->data();

            $this->db->insert('tb_lowongan', [
                'lowongan_judul'      => $this->input->post('lowongan_judul'),
                'kategori_id'         => $this->input->post('lowongan_jurusan'), // ✅ ID kategori
                'kategori_tipe'       => $this->input->post('lowongan_tipe_kerja'),
                'lowongan_alamat'     => $this->input->post('lowongan_alamat'),
                'lowongan_perusahaan' => $this->input->post('lowongan_perusahaan'),
                'lowongan_desc'       => $this->input->post('lowongan_desc'),
                'lowongan_nomor'       => $this->input->post('lowongan_nomor'),
                'lowongan_start'      => $this->input->post('lowongan_start'),
                'lowongan_end'        => $this->input->post('lowongan_end'),
                'lowongan_img'        => $uploaded['file_name'],
                'lowongan_date'       => sekarang(),
                'lowongan_alias'      => $urlfix,
                'lowongan_code'       => $random_string,
                'lowongan_userid'     => userid(),

            ]);

            // ================= RESIZE IMAGE =================
            $configg['image_library']  = 'gd2';
            $configg['source_image']   = './assets/lowongan/' . $uploaded['file_name'];
            $configg['create_thumb']   = FALSE;
            $configg['maintain_ratio'] = FALSE;
            $configg['quality']        = '75%';
            $configg['width']          = 670;
            $configg['height']         = 400;
            $configg['new_image']      = './assets/lowongan/thumbnail/' . $uploaded['file_name'];

            $this->load->library('image_lib', $configg);
            $this->image_lib->resize();

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Data lowongan Berhasil Ditambahkan';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }




    // ==============================
    // UPDATE DATA PAKET
    // ==============================

    public function updatelowongan()
    {
        $lowongan_code = post('lowongan_code');
        $this->db->where('lowongan_code', $lowongan_code);
        $cek = $this->db->get('tb_lowongan');

        if ($cek->num_rows() == 0) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = 'Lowongan Tidak Ditemukan';
            Self::$data['type']    = 'error';
            return Self::$data;
        }

        // === Validasi form ===
        $this->form_validation->set_rules('lowongan_judul', 'Judul Lowongan', 'required');
        $this->form_validation->set_rules('kategori_id', 'Keahlian', 'required|numeric');
        $this->form_validation->set_rules('kategori_tipe', 'Tipe Kerja', 'required|numeric');
        $this->form_validation->set_rules('lowongan_perusahaan', 'Perusahaan', 'required');
        $this->form_validation->set_rules('lowongan_alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('lowongan_nomor', 'No telepon/WA', 'required');
        $this->form_validation->set_rules('lowongan_desc', 'Deskripsi', 'required');

        if ($this->form_validation->run() == false) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = validation_errors();
            Self::$data['type']    = 'error';
            return Self::$data;
        }

        // === Konfigurasi upload ===
        $config['upload_path']   = './assets/lowongan/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name']  = TRUE;
        $config['max_size']      = 10000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // === Ambil data lama ===
        $old_data = $cek->row_array();
        $old_img = $old_data['lowongan_img'] ?? null;

        // === Upload gambar baru jika ada ===
        $new_img = $old_img;
        if (!empty($_FILES['lowongan_img']['name'])) {
            if ($this->upload->do_upload('lowongan_img')) {
                $uploaded = $this->upload->data();
                $new_img = $uploaded['file_name'];

                // === Hapus file lama ===
                if (!empty($old_img) && file_exists(FCPATH . 'assets/lowongan/' . $old_img)) {
                    @unlink(FCPATH . 'assets/lowongan/' . $old_img);
                }
                if (!empty($old_img) && file_exists(FCPATH . 'assets/lowongan/thumbnail/' . $old_img)) {
                    @unlink(FCPATH . 'assets/lowongan/thumbnail/' . $old_img);
                }

                // === Resize gambar ===
                $resize_config['image_library']  = 'gd2';
                $resize_config['source_image']   = $uploaded['full_path'];
                $resize_config['new_image']      = FCPATH . 'assets/lowongan/thumbnail/' . $new_img;
                $resize_config['maintain_ratio'] = TRUE;
                $resize_config['width']          = 800;
                $resize_config['height']         = 800;
                $resize_config['quality']        = '85%';

                $this->load->library('image_lib', $resize_config);
                if (!$this->image_lib->resize()) {
                    Self::$data['status']  = false;
                    Self::$data['heading'] = 'Gagal';
                    Self::$data['message'] = 'Gagal resize gambar';
                    Self::$data['type']    = 'error';
                    return Self::$data;
                }
                $this->image_lib->clear();
            }
        }

        // === Data update ===
        $data = [
            'lowongan_judul'      => post('lowongan_judul'),
            'kategori_id'         => post('kategori_id'),
            'kategori_tipe'       => post('kategori_tipe'),
            'lowongan_perusahaan' => post('lowongan_perusahaan'),
            'lowongan_alamat'     => post('lowongan_alamat'),
            'lowongan_desc'       => post('lowongan_desc'),
            'lowongan_nomor'      => post('lowongan_nomor'),
            'lowongan_start'      => post('lowongan_start'),
            'lowongan_end'        => post('lowongan_end'),
            'lowongan_img'        => $new_img,
            'lowongan_date'       => sekarang(),
            'lowongan_userid'     => userid(),

        ];

        // === Update database ===
        $this->db->where('lowongan_code', $lowongan_code);
        $this->db->update('tb_lowongan', $data);

        Self::$data['status']  = true;
        Self::$data['heading'] = 'Berhasil';
        Self::$data['message'] = 'Data Lowongan Berhasil Diperbarui';
        Self::$data['type']    = 'success';

        return Self::$data;
    }





    //  function updatelowongan()
    //    {
    //     $this->db->where('lowongan_code', post('lowongan_code'));
    //     $cek = $this->db->get('tb_lowongan');

    //     if ($cek->num_rows() == 0) {
    //         Self::$data['status'] = false;
    //         Self::$data['message'] = 'Paket Tidak Ditemukan';
    //     }

    //     $this->form_validation->set_rules('lowongan_nama', 'Nama Paket', 'required');
    //     $this->form_validation->set_rules('lowongan_desc', 'Deskripsi', 'required');
    //     $this->form_validation->set_rules('lowongan_lokasi', 'Lokasi', 'required');
    //     $this->form_validation->set_rules('lowongan_lamapjl', 'Lama Perjalanan', 'required');
    //     $this->form_validation->set_rules('lowongan_harga', 'Harga', 'required');
    //     $this->form_validation->set_rules('lowongan_fasilitas', 'Fasilitas', 'required');

    //     $config['upload_path'] = './assets/lowongan/';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //     $config['encrypt_name'] = TRUE;
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);

    //     if (Self::$data['status']) {
    //         $data = [
    //             'lowongan_nama'      => post('lowongan_nama'),
    //             'lowongan_desc'      => post('lowongan_desc'),
    //             'lowongan_lokasi'    => post('lowongan_lokasi'),
    //             'lowongan_lamapjl'   => post('lowongan_lamapjl'),
    //             'lowongan_harga'     => post('lowongan_harga'),
    //             'lowongan_fasilitas' => post('lowongan_fasilitas'),
    //             'lowongan_date'      => date('Y-m-d H:i:s')
    //         ];

    //         if ($this->upload->do_upload('lowongan_img')) {
    //             $uploaded = $this->upload->data();
    //             $data['lowongan_img'] = $uploaded['file_name'];

    //             $old = $cek->row();
    //             if (!empty($old->lowongan_img) && file_exists('./assets/lowongan/' . $old->lowongan_img)) {
    //                 unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/lowongan/' . $old->lowongan_img);
    //             }
    //         }

    //         $this->db->update('tb_lowongan', $data, ['lowongan_code' => post('lowongan_code')]);

    //         Self::$data['heading'] = 'Berhasil';
    //         Self::$data['message'] = 'Data Paket Berhasil Diperbarui';
    //         Self::$data['type'] = 'success';
    //     } else {
    //         Self::$data['heading'] = 'Gagal';
    //         Self::$data['type'] = 'error';
    //     }

    //     return Self::$data;
    // }


    public function deletelowonganimage()
    {
        self::$data['status']  = true;
        self::$data['message'] = null;
        $code = $this->input->post('lowongan_code') ?: $this->input->post('code');
        // Ambil data lowongan
        $this->db->where('lowongan_code', $code);
        $lowongan = $this->db->get('tb_lowongan')->row();
        if (!$lowongan) {
            self::$data['status']  = false;
            self::$data['message'] = 'Data lowongan tidak ditemukan.';
        }

        $filename = $this->input->post('filename', TRUE);
        // Ambil dan decode daftar gambar
        $images = json_decode($lowongan->lowongan_img, true) ?? [];
        // Pastikan gambar ada di daftar
        $key = array_search($filename, $images);
        if ($key === false) {
            self::$data['status']  = false;
            self::$data['message'] = 'Gambar tidak ditemukan di lowongan.';
        }

        // Validasi input
        $this->form_validation->set_rules('lowongan_code', 'Kode lowongan', 'required');
        $this->form_validation->set_rules('filename', 'Nama File', 'required');
        // $this->form_validation->set_rules('lowongan_description', 'lowongan Deskripsi', 'required');
        if (!$this->form_validation->run()) {
            self::$data['status']  = false;
            self::$data['message'] = validation_errors(' ', '<br/>');
        }

        if (self::$data['status']) {

            // Hapus file fisik
            $file_path = FCPATH . 'assets/lowongan/' . $filename;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
            $thumb_path = FCPATH . 'assets/lowongan/thumbnail/' . $filename;
            if (file_exists($thumb_path)) {
                @unlink($thumb_path);
            }

            // Hapus dari array dan update database
            unset($images[$key]);
            $this->db->where('lowongan_code', $code);
            $this->db->update('tb_lowongan', [
                'lowongan_img' => json_encode(array_values($images))
            ]);

            self::$data['message'] = 'Gambar berhasil dihapus dari lowongan.';
            self::$data['heading'] = 'Berhasil';
            self::$data['type']    = 'success';
        } else {
            self::$data['heading'] = 'Error';
            self::$data['type']    = 'error';
        }

        return self::$data;
    }

    public function savenewcategory()
    {
        // Validasi input
        $this->form_validation->set_rules('katpkg_name', 'Nama Paket', 'required');
        $this->form_validation->set_rules('katpkg_desc', 'Decription', 'required');

        // Jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
            Self::$data['message'] = validation_errors(' ', '<br/>');
            return Self::$data;
        }

        // Jika validasi sukses
        $random_code = strtolower(random_string('alnum', 16));

        $data_insert = [
            'katpkg_name'       => post('katpkg_name'),
            'katpkg_desc'       => post('katpkg_desc'),
            'katpkg_code'      => $random_code,
            'katpkg_alias'      => strtolower(url_title(post('katpkg_name'))),
            'katpkg_date'      => date('Y-m-d H:i:s'),
        ];

        if ($this->db->insert('tb_kategori_pkg', $data_insert)) {
            Self::$data['status']  = true;
            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Category Berhasil Ditambahkan';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = 'Terjadi kesalahan saat menyimpan ke database.';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }

    public function updatecategory()
    {

        $katpkg_code = post('katpkg_code');
        $this->db->where('katpkg_code', $katpkg_code);
        $cek = $this->db->get('tb_kategori_pkg');

        if ($cek->num_rows() == 0) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = 'Paket Tidak Ditemukan';
            Self::$data['type']    = 'error';
            return Self::$data;
        }

        // Validasi input
        $this->form_validation->set_rules('katpkg_name', 'Nama Paket', 'required');
        $this->form_validation->set_rules('katpkg_desc', 'Decription', 'required');

        // Jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
            Self::$data['message'] = validation_errors(' ', '<br/>');
            return Self::$data;
        }

        // Jika validasi sukses
        $random_code = strtolower(random_string('alnum', 16));

        $data_insert = [
            'katpkg_name'       => post('katpkg_name'),
            'katpkg_desc'       => post('katpkg_desc'),
            'katpkg_alias'      => strtolower(url_title(post('katpkg_name'))),
            'katpkg_date'       => date('Y-m-d H:i:s'),
        ];

        $this->db->where('katpkg_code', $katpkg_code);
        if ($this->db->update('tb_kategori_pkg', $data_insert)) {
            Self::$data['status']  = true;
            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Category Berhasil Ditambahkan';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = 'Terjadi kesalahan saat menyimpan ke database.';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }

    function hapuscategory()
    {
        $this->db->where('katpkg_code', post('code'));
        $cekkkatt = $this->db->get('tb_kategori_pkg');

        if ($cekkkatt->num_rows() == 0) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = 'KATEGORI TIDAK DITEMUKAN';
            Self::$data['type']    = 'error';
            return Self::$data;
        }

        // Validasi input
        $this->form_validation->set_rules('code', 'CODE KATEGORI', 'required');

        if (!$this->form_validation->run()) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
            Self::$data['message'] = validation_errors(' ', '<br/>');
            return Self::$data;
        }

        // Jika semua valid
        Self::$data['status'] = true;

        if (Self::$data['status']) {
            $this->db->where('katpkg_code', post('code'));
            $this->db->delete('tb_kategori_pkg');

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Data Kategori Berhasil Dihapus';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }










    public function addKategori()
    {
        // ===============================
        // DEFAULT RESPONSE
        // ===============================
        Self::$data['status'] = true;

        // ===============================
        // VALIDASI FORM
        // ===============================
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('jenis_kategori', 'Jenis Kategori', 'required|in_list[keahlian,tipe_kerja]');

        if (!$this->form_validation->run()) {
            Self::$data['status']  = false;
            Self::$data['message'] = validation_errors(' ', '<br/>');
        }

        // ===============================
        // GENERATE SLUG
        // ===============================
        $slug = url_title($this->input->post('nama_kategori'), '-', true);

        // CEK DUPLIKASI
        $this->db->where('nama_kategori', $this->input->post('nama_kategori'));
        $this->db->where('jenis_kategori', $this->input->post('jenis_kategori'));
        $cek = $this->db->get('tb_kategori');

        if ($cek->num_rows() > 0) {
            Self::$data['status']  = false;
            Self::$data['message'] = 'Kategori sudah tersedia';
        }

        // ===============================
        // PROSES INSERT
        // ===============================
        if (Self::$data['status']) {
            $this->db->insert('tb_kategori', [
                'nama_kategori'  => $this->input->post('nama_kategori'),
                'jenis_kategori' => $this->input->post('jenis_kategori'),
                'slug'           => $slug,
                'status'         => 1,
                'created_at'     => sekarang()
            ]);

            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Kategori berhasil ditambahkan';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }



    public function hapusKategori()
    {
        $id = $this->input->post('id');
        $cek = $this->db->get_where('tb_kategori', ['id_kategori' => $id]);

        if ($cek->num_rows() == 0) {
            $data = [
                'status' => false,
                'heading' => 'Gagal',
                'message' => 'Kategori tidak ditemukan',
                'type' => 'error',
                'csrf_data' => $this->security->get_csrf_hash()
            ];
        } else {
            $this->db->where('id_kategori', $id)->delete('tb_kategori');
            $data = [
                'status' => true,
                'heading' => 'Berhasil',
                'message' => 'Data kategori berhasil dihapus',
                'type' => 'success',
                'csrf_data' => $this->security->get_csrf_hash()
            ];
        }

        echo json_encode($data);
    }
}
