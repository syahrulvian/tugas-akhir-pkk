<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Model
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

    /**
     * Hapus Kategori berdasarkan id_kategori
     */
    function hapusKategori()
    {
        $id = post('id');

        // Cek apakah kategori ada
        $this->db->where('id_kategori', $id);
        $cek_kategori = $this->db->get('tb_kategori');

        if ($cek_kategori->num_rows() == 0) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = 'Kategori tidak ditemukan';
            Self::$data['type']    = 'error';
            return Self::$data;
        }

        // Validasi input
        $this->form_validation->set_rules('id', 'ID Kategori', 'required|numeric');

        if (!$this->form_validation->run()) {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['type']    = 'error';
            Self::$data['message'] = validation_errors(' ', '<br/>');
            return Self::$data;
        }

        // Hapus kategori
        $this->db->where('id_kategori', $id);
        $delete = $this->db->delete('tb_kategori');

        if ($delete) {
            Self::$data['status']  = true;
            Self::$data['heading'] = 'Berhasil';
            Self::$data['message'] = 'Kategori berhasil dihapus';
            Self::$data['type']    = 'success';
        } else {
            Self::$data['status']  = false;
            Self::$data['heading'] = 'Gagal';
            Self::$data['message'] = 'Gagal menghapus kategori dari database';
            Self::$data['type']    = 'error';
        }

        return Self::$data;
    }
}
