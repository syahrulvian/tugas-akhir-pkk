<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class InstallController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('download');
    }

    public function index() {
        $apkFilePath = FCPATH . 'assets/apps/GtrustSystem.apk';

        $apkFileName = 'GtrustSystem.apk';

        force_download($apkFileName, file_get_contents($apkFilePath));
    }
}
