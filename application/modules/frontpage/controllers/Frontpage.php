<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontpage extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 'home')
    {
        $viewPath = 'pages/' . $page;

        if (!file_exists(APPPATH . 'modules/frontpage/views/' . $viewPath . '.php')) {
            show_404();
        }

        // Data user jika login
        $data = [];
        if ($this->ion_auth->logged_in()) {
            $data['data_group'] = $this->ion_auth->get_users_groups()->row();
            $data['userdata']   = userdata();
        } else {
            $data['data_group'] = null;
            $data['userdata']   = null;
        }

        // Load template + content
        $this->template->content->view($viewPath, $data);
        $this->template->publish();
    }

    private function baseData()
    {
        if ($this->ion_auth->logged_in()) {
            return [
                'userdata' => userdata(),
                'data_group' => $this->ion_auth->get_users_groups()->row()
            ];
        }

        return [
            'userdata' => null,
            'data_group' => null
        ];
    }

    public function blog()
    {
        $data = $this->baseData();

        $this->template->content->view('pages/blog', $data);
        $this->template->publish();
    }

    public function blog_detail($alias = null)
    {
        if (!$alias)
            show_404();

        $this->db->where('blog_alias', $alias);
        $blog = $this->db->get('tb_blog')->row();
        if (!$blog)
            show_404();

        $data = $this->baseData();
        $data['blog'] = $blog;

        $this->template->content->view('pages/blog-detail', $data);
        $this->template->publish();
    }

    public function karir()
    {
        $data = [];

        // Jika login, ambil user & group
        if ($this->ion_auth->logged_in()) {
            $data['data_group'] = $this->ion_auth->get_users_groups()->row();
            $data['userdata']   = userdata();
        } else {
            $data['data_group'] = null;
            $data['userdata']   = null;
        }

        // === Ambil Kategori Keahlian ===
        $data['kategori_keahlian'] = $this->db
            ->order_by('nama_kategori', 'ASC')
            ->get_where('tb_kategori', ['jenis_kategori' => 'keahlian'])
            ->result();

        // === Ambil Kategori Tipe Kerja ===
        $data['kategori_tipe'] = $this->db
            ->order_by('nama_kategori', 'ASC')
            ->get_where('tb_kategori', ['jenis_kategori' => 'tipe'])
            ->result();

        // === Pagination Lowongan ===
        $limit  = 15;
        $offset = ($this->input->get('page')) ? $this->input->get('page') : 0;

        $this->db->order_by('lowongan_date', 'DESC');
        $data['lowongan'] = $this->db->get('tb_lowongan', $limit, $offset)->result();
        $data['total_lowongan'] = $this->db->get('tb_lowongan')->num_rows();

        // === Load View ===
        $this->template->content->view('pages/karir', $data);
        $this->template->publish();
    }

    public function detail_lowongan($lowongan_code = null)
    {
        if (!$lowongan_code) show_404();

        // Query lowongan berdasarkan code
        $lowongan = $this->db->get_where('tb_lowongan', ['lowongan_code' => $lowongan_code])->row();
        if (!$lowongan) show_404();

        $data = [];
        if ($this->ion_auth->logged_in()) {
            $data['data_group'] = $this->ion_auth->get_users_groups()->row();
            $data['userdata']   = userdata();
        } else {
            $data['data_group'] = null;
            $data['userdata']   = null;
        }

        $data['lowongan'] = $lowongan;

        // === Load View ===
        $this->template->content->view('pages/karir-detail', $data);
        $this->template->publish();
    }
}
