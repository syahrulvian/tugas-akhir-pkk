<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimoni extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('security');
    }

    public function addTestimoni()
    {
        // Validate CSRF
        if (!$this->security->csrf_verify()) {
            return array(
                'status'   => false,
                'heading'  => 'Error',
                'message'  => 'Invalid CSRF token',
                'type'     => 'error',
                'csrf_data' => $this->_get_csrf_hash()
            );
        }

        // Validate input
        $this->form_validation->set_rules('testimoni_nama', 'Nama', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('testimoni_perusahaan', 'Profesi', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('testimoni_judul', 'Judul', 'required|min_length[5]|max_length[200]');
        $this->form_validation->set_rules('testimoni_isi', 'Deskripsi', 'required|min_length[20]');

        if (!$this->form_validation->run()) {
            return array(
                'status'   => false,
                'heading'  => 'Validation Error',
                'message'  => 'Please check your input: ' . validation_errors(),
                'type'     => 'error',
                'csrf_data' => $this->_get_csrf_hash()
            );
        }

        // Prepare data
        $data = array(
            'testimoni_nama'        => htmlspecialchars($this->input->post('testimoni_nama')),
            'testimoni_perusahaan'  => htmlspecialchars($this->input->post('testimoni_perusahaan')),
            'testimoni_judul'       => htmlspecialchars($this->input->post('testimoni_judul')),
            'testimoni_isi'         => htmlspecialchars($this->input->post('testimoni_isi')),
            'testimoni_rating'      => $this->input->post('testimoni_rating', true) ? intval($this->input->post('testimoni_rating')) : 5,
            'testimoni_email'       => htmlspecialchars($this->input->post('testimoni_email')),
            'testimoni_status'      => 'pending',
            'testimoni_date'        => date('Y-m-d H:i:s'),
            'created_at'            => date('Y-m-d H:i:s')
        );

        // Handle file upload
        if (!empty($_FILES['testimoni_foto']['name'])) {
            $file_name = $this->_uploadFile($_FILES['testimoni_foto']);
            if ($file_name !== false) {
                $data['testimoni_foto'] = $file_name;
            }
        }

        // Insert into database
        $insert = $this->db->insert('tb_testimoni', $data);

        if ($insert) {
            return array(
                'status'   => true,
                'heading'  => 'Sukses!',
                'message'  => 'Testimoni Anda berhasil dikirim. Akan ditampilkan setelah disetujui admin.',
                'type'     => 'success',
                'csrf_data' => $this->_get_csrf_hash()
            );
        } else {
            return array(
                'status'   => false,
                'heading'  => 'Error',
                'message'  => 'Terjadi kesalahan saat menyimpan testimoni',
                'type'     => 'error',
                'csrf_data' => $this->_get_csrf_hash()
            );
        }
    }

    private function _uploadFile($file)
    {
        $config['upload_path']   = './assets/testimoni/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '2048';
        $config['file_name']     = 'testi_' . time();

        // Create directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('testimoni_foto')) {
            $upload_data = $this->upload->data();
            return $upload_data['file_name'];
        } else {
            // Return error but don't stop submission
            log_message('error', 'Upload error: ' . $this->upload->display_errors());
            return false;
        }
    }

    private function _get_csrf_hash()
    {
        return array(
            $this->security->get_csrf_token_name() => $this->security->get_csrf_hash()
        );
    }
}
