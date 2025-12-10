<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends CI_Model
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



    public function add_mitra()
    {
        $config['upload_path'] = './assets/mitra/';
        $config['allowed_types'] = 'jpg|jpeg|png|svg';
        $config['max_size'] = '5000';
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        // kode unik
        $random_string = strtolower(random_string('alnum', 64));

        // Default data insert
        $data_insert = [
            'mitra_code' => $random_string,
            'mitra_nama' => $this->input->post('mitra_nama'),
            'mitra_deskripsi' => $this->input->post('mitra_deskripsi'),
            'kategori_mitra_id' => $this->input->post('kategori_mitra_id'),
            'mitra_logo' => null,
            'mitra_status' => $this->input->post('mitra_status') ?? 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Default response structure
        self::$data['status'] = true;
        self::$data['heading'] = '';
        self::$data['message'] = '';
        self::$data['type'] = '';

        // === UPLOAD LOGO ===
        if (!empty($_FILES['mitra_logo']['name'])) {
            if ($this->upload->do_upload('mitra_logo')) {
                $upload_data = $this->upload->data();
                $data_insert['mitra_logo'] = $upload_data['file_name'];
            } else {
                self::$data['status'] = false;
                self::$data['message'] = $this->upload->display_errors();
            }
        }

        // === VALIDASI ===
        $this->form_validation->set_rules('mitra_nama', 'Nama Mitra', 'required');
        $this->form_validation->set_rules('kategori_mitra_id', 'Kategori Mitra', 'required');

        if (!$this->form_validation->run()) {
            self::$data['status'] = false;
            self::$data['message'] = validation_errors(' ', '<br/>');
        }

        // === INSERT DATABASE ===
        if (self::$data['status']) {

            $this->db->insert('tb_mitra', $data_insert);

            self::$data['heading'] = 'Berhasil';
            self::$data['message'] = 'Mitra berhasil ditambahkan';
            self::$data['type'] = 'success';

        } else {

            self::$data['heading'] = 'Error';
            self::$data['type'] = 'error';
        }

        return self::$data;
    }

public function update_mitra()
{
    $mitra_code = $this->input->post('mitra_code');

    // Ambil data lama
    $old = $this->db->get_where('tb_mitra', ['mitra_code' => $mitra_code])->row();

    if (!$old) {
        return [
            'status' => false,
            'heading' => 'Error',
            'message' => 'Data mitra tidak ditemukan!',
            'type' => 'error'
        ];
    }

    // Konfigurasi Upload
    $config['upload_path'] = './assets/mitra/';
    $config['allowed_types'] = 'jpg|jpeg|png|svg';
    $config['max_size'] = '5000';
    $config['remove_spaces'] = TRUE;
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    // Default response
    self::$data['status'] = true;
    self::$data['heading'] = '';
    self::$data['message'] = '';
    self::$data['type'] = '';

    // === VALIDASI ===
    $this->form_validation->set_rules('mitra_nama', 'Nama Mitra', 'required');
    $this->form_validation->set_rules('kategori_mitra_id', 'Kategori Mitra', 'required');

    if (!$this->form_validation->run()) {
        self::$data['status'] = false;
        self::$data['message'] = validation_errors(' ', '<br/>');
    }

    // === UPDATE DATA ===
    $data_update = [
        'mitra_nama'        => $this->input->post('mitra_nama'),
        'mitra_deskripsi'   => $this->input->post('mitra_deskripsi'),
        'kategori_mitra_id' => $this->input->post('kategori_mitra_id'),
        'mitra_status'      => $this->input->post('mitra_status'),
        'updated_at'        => date('Y-m-d H:i:s'),
    ];

    // === UPLOAD LOGO BARU ===
    if (self::$data['status'] && !empty($_FILES['mitra_logo']['name'])) {
        if ($this->upload->do_upload('mitra_logo')) {
            $upload_data = $this->upload->data();
            $data_update['mitra_logo'] = $upload_data['file_name'];

            // hapus logo lama jika ada
            if (!empty($old->mitra_logo) && file_exists('./assets/mitra/' . $old->mitra_logo)) {
                unlink('./assets/mitra/' . $old->mitra_logo);
            }
        } else {
            self::$data['status'] = false;
            self::$data['message'] = $this->upload->display_errors('', '');
        }
    }

    // === PROSES UPDATE ===
    if (self::$data['status']) {
        $this->db->update('tb_mitra', $data_update, ['mitra_code' => $mitra_code]);

        self::$data['heading'] = 'Berhasil';
        self::$data['message'] = 'Data mitra berhasil diperbarui';
        self::$data['type'] = 'success';

    } else {
        self::$data['heading'] = 'Error';
        self::$data['type'] = 'error';
    }

    return self::$data;
}


public function delete_mitra()
{
    // RESPON DEFAULT
    self::$data['status']  = true;
    self::$data['heading'] = '';
    self::$data['message'] = '';
    self::$data['type']    = '';

    // VALIDASI INPUT
    $this->form_validation->set_rules('code', 'Kode Mitra', 'required');
    if (!$this->form_validation->run()) {
        self::$data['status']  = false;
        self::$data['heading'] = 'Error';
        self::$data['message'] = validation_errors(' ', '<br/>');
        self::$data['type']    = 'error';
        return self::$data;
    }

    // AMBIL DATA
    $code = $this->input->post('code');
    $get = $this->db->get_where('tb_mitra', ['mitra_code' => $code]);

    // CEK DATA ADA ATAU TIDAK
    if ($get->num_rows() == 0) {
        self::$data['status']  = false;
        self::$data['heading'] = 'Gagal';
        self::$data['message'] = 'Data mitra tidak ditemukan.';
        self::$data['type']    = 'error';
        return self::$data;
    }

    $data = $get->row();

    // HAPUS FILE JIKA ADA
    if (!empty($data->mitra_logo)) {
        $file = './assets/mitra/' . $data->mitra_logo;
        if (file_exists($file)) {
            unlink($file);
        }
    }

    // HAPUS DATA DI DATABASE
    $this->db->where('mitra_code', $code);
    $this->db->delete('tb_mitra');

    // RESPON SUKSES
    self::$data['status']  = true;
    self::$data['heading'] = 'Berhasil';
    self::$data['message'] = 'Data mitra berhasil dihapus.';
    self::$data['type']    = 'success';

    return self::$data;
}








}
