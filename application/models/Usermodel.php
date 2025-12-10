<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->init();
	}

	function qualifiedevel($level = 1, $user_id = null)
	{
		$userid = ($user_id == null) ? userid() : $user_id;
		$return = false;

		$this->db->where('referral_id', $userid);
		$gettuser = $this->db->get('tb_users');

		$arrrrray = array(
			array(
				'level'		   => 1,
				'qualified'	 	=> 4,
			),
			array(
				'level'		   => 2,
				'qualified'	 	=> 8,
			),
			array(
				'level'		   => 3,
				'qualified'	 	=> 8,
			),
			array(
				'level'		   => 4,
				'qualified'	 	=> 16,
			),
			array(
				'level'		   => 4,
				'qualified'	 	=> 16,
			),
		);

		foreach ($arrrrray as $syarattt) {
			if ($level == $syarattt['level'] && $gettuser->num_rows() >= $syarattt['qualified']) {
				$return = true;
			}
		}

		return $return;
	}

	function saveFotoprofile()
	{
		$data['status'] 	= true;

		$config['upload_path'] 		= './assets/images/user/';
		$config['allowed_types'] 	= 'jpg|png|jpeg';
		$config['max_size']  		= '90000';
		$config['max_width']  		= '90000';
		$config['max_height']  		= '90000';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('fotoprofile')) {
			$data['status'] 	= false;
			$data['message'] 	= alerts($this->upload->display_errors(), 'danger');
			$data['heading'] 	= 'Failed';
			$data['type'] 		= 'error';
		}

		if ($data['status']) {

			$uploaded 						= $this->upload->data();

			$config['image_library']		=	'gd2';
			$config['source_image']			=	'./assets/images/user/' . $uploaded['file_name'];
			$config['create_thumb']			=	FALSE;
			$config['maintain_ratio']		=	FALSE;
			$config['quality']				=	'100%';
			$config['width']				=	100;
			$config['height']				=	100;
			$config['new_image']			=	'./assets/images/user/' . $uploaded['file_name'];

			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			$userdata = userdata();

			if ($userdata->user_picture != 'avatar-2.png') {
				unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/images/user/' . $userdata->user_picture);
			}

			//update user avatar
			$this->ion_auth->update(userid(), array('user_picture' => $uploaded['file_name']));

			$data['message'] 	= alerts('Upload user image Successfully !');
			$data['heading'] 	= 'Success';
			$data['type'] 		= 'success';
		}

		$this->session->set_flashdata('user_picture', $data['message']);
		return $data;
	}

	private function init()
	{

		/*========================================================
		=            CREATE REFERRAL SYSTEM DETECTION            =
		========================================================*/

		if ($this->input->get('ref')) {

			//clear referral sebelumnya
			$this->session->unset_userdata(['referralID', 'referralMessage']);

			$default_referral 			= 'ux001yz';
			$status 					= true;
			$set['referralMessage'] 	= null;

			$userdata 	= userdata([
				'user_referral_code'	=> $this->input->get('ref')
			]);

			if (!$userdata) {
				$status 					= false;
				$set['referralMessage'] 	= alerts('Kode Referral Anda tidak valid !', 'danger');
			}

			if ($status) {
				$set['referralID'] 			=  $userdata->user_referral_code;
			} else {
				$set['referralID'] 			=  $default_referral;
			}

			$this->session->set_userdata($set);
		}
	}

	public function userWallet($wallet_type = 'register', $userid = null)
	{

		$return 	= false;
		$userid 	= ($userid == null) ? userid() : $userid;

		$this->db->where('wallet_type', $wallet_type);
		$this->db->where('wallet_user_id', $userid);
		$get 		= $this->db->get('tb_users_wallet');
		if ($get->num_rows() == 1) {
			$return 	= $get->row();
		}

		return $return;
	}

	public function is_active($userid = null)
	{

		$status_active 				= false;
		$userid = ($userid == null) ? userid() : $userid;

		$get 	= $this->lendingmodel->get(array(
			'lending_userid' 		=> $userid,
			'lending_dateend >=' 	=> sekarang()
		));

		if ($get != false) {
			$status_active 				= true;
		}

		return $status_active;
	}

	public function getRandomUplineIDRight($userid = 1, $position = null)
	{

		// $result	= array();

		$jumlah_kaki_kanan	= $this->getFoot($userid, 'right');
		$jumlah_kaki_kiri	= $this->getFoot($userid, 'left');
		if ($jumlah_kaki_kiri <= $jumlah_kaki_kanan) {
			$position 		= 'left';
		} else {
			$position 		= 'right';
		}

		//get bawahnya pass sesuai dengan posisi
		$this->db->where('upline_id', $userid);
		$this->db->where('position', $position);


		$get_bawahnya_pass	 	= $this->db->get('tb_users');
		if ($get_bawahnya_pass->num_rows() == 0) {

			$userid_dipakai 	= $userid;
			// $position 			= $position; // validate ulang posisi bawahnya yang kosong

		} else {

			$get_data_bawahnya 	= $get_bawahnya_pass->row();
			$do_function 		= $this->getRandomUplineIDRight($get_data_bawahnya->id, $position);

			$userid_dipakai 	= $do_function['userid'];
			$position 			= $do_function['position'];
		}


		$result['userid'] 		= $userid_dipakai;
		$result['position'] 	= $position;
		return $result;
	}
	public function getFoot($userid = '1', $position = 'right')
	{
		$user 		= $this->get_jaringan($userid, ' WHERE upline_id="' . $userid . '" and position = "' . $position . '" ');


		$totalkaki  = 0;

		foreach ($user as $value) {
			$get = $this->get_jaringan($value->id);
			foreach ($get as $value2) {
				$totalkaki++;
			}
			$totalkaki++;
		}

		return $totalkaki;
	}


	public function totalFoot($userid = '1', $position = 'left')
	{
		$user 		= $this->get_jaringan($userid, ' WHERE upline_id="' . $userid . '" and position = "' . $position . '" ');
		$totalomset  = 0;

		foreach ($user as $value) {
			$get 			= $this->get_jaringan($value->id);
			$this->db->join('tb_users', 'tb_users.id = tb_lending.lending_userid', 'left');
			$this->db->where('tb_users.leader', 'false');
			$this->db->where('lending_userid', $value->id);
			$getlending 	= $this->db->get('tb_lending');

			if ($getlending->num_rows() > 0) {
				foreach ($getlending->result() as $key) {
					$totalomset = $totalomset + $key->lending_amount;
				}
			}
			foreach ($get as $value2) {

				$this->db->join('tb_users', 'tb_users.id = tb_lending.lending_userid', 'left');
				$this->db->where('tb_users.leader', 'false');
				$this->db->where('lending_userid', $value2->id);
				$getlending2 	= $this->db->get('tb_lending');

				if ($getlending2->num_rows() > 0) {
					foreach ($getlending2->result() as $key) {
						$totalomset = $totalomset + $key->lending_amount;
					}
				}
			}
		}
		return $totalomset;
	}



	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function get_jaringan($user_id = null, $where = null)
	{

		$userid = ($user_id == null) ? userid() : $user_id;

		$get = $this->db->query('
			SELECT  `id`,
			        `username`,
			        `upline_id`,
			        `position`
			from    (select * from tb_users ' . $where . ' 
			         order by `upline_id`, `id`) tb_users_sorted,
			        (select @pv := ' . $userid . ') initialisation
			where   find_in_set(`upline_id`, @pv) > 0
			and     @pv := concat(@pv, ",", `id`)
			ORDER BY upline_id DESC
		');

		// JARINGAN DENGAN REFERRAL
		/*$get = $this->db->query('
			SELECT  `id`,
			        `username`,
			        `referral_id` 
			from    (select * from tb_users
			         order by `referral_id`, `id`) tb_users_sorted,
			        (select @pv := '.$userid.') initialisation
			where   find_in_set(`referral_id`, @pv) > 0
			and     @pv := concat(@pv, ",", `id`)
		');*/

		return $get->result();
	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad R
	 **/
	public function cek_jaringan($current_user = 'null', $userid_banding = 'null')
	{

		$this->db->order_by('id', 'desc');
		$all_member 	= $this->ion_auth->users();
		$no 			= 1;
		foreach ($all_member->result() as $member) {

			if ($member->id <= $userid_banding) {

				if ($userid_banding != $member->idreferensi) {

					echo  $no++ . '' . $member->username . '<br>';
				}

				// echo 'lalal <br>';

			}
		}
	}


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Ayatulloh Ahad R
	 **/
	public function get_user_position($refid = 'null', $position = 'null')
	{


		$userdata 			= new stdClass;
		/*$this->db->join('tb_lending', 'lending_userid = id', 'left');
		$this->db->join('tb_packages', 'package_id = lending_package_id', 'left');*/
		$query = $this->db->get_where('tb_users', array('upline_id' => $refid, 'position' => $position));
		if ($query->num_rows() == 1) {

			$userdata 			= $query->row();
			$userdata->result 	= 1;
		} else {

			$userdata->result 	= 0;

			//tidak ada data sehingga tombol register disable
			$fields 		= $this->db->list_fields('tb_users');
			foreach ($fields as $field) {

				$userdata->$field 	= null;
			}


			/* CHECKING REFERENSI DATA */
			/*$this->db->join('tb_lending', 'lending_userid = id', 'left');
			$this->db->join('tb_packages', 'package_id = lending_package_id', 'left');*/
			$this->db->select('id, upline_id, user_code');
			$this->db->where('id', $refid);
			$ref_data 		= $this->db->get('tb_users');
			if ($ref_data->num_rows() == 1) {

				// ada data referensi sehingga membuat tombol link registrasi member baru
				$user_data				= $ref_data->row();
				$userdata->referral_id 	= $user_data->id;
				$userdata->user_code	= $user_data->user_code;
				$userdata->position 	= $position;
				$userdata->result 		= 2;
			}
		}

		$current_userdata 				= userdata();
		$userdata->my_reff_code 		= $current_userdata->user_referral_code;
		$userdata->my_reff_username 	= $current_userdata->username;

		return $userdata;
	}


	/**
	 * params:
	 * - type 	= url / html
	 * - userid = jika null maka user yang login yang di pakai
	 *
	 * @return void
	 * @author Ayatulloh Ahad Robanie [ayatulloh@idprogrammer.com]
	 **/
	public function avatar($type = 'url', $userid = null)
	{

		$base_path 	= 'uploads/users/';

		$userid 	= ($userid == null) ? userid() : $userid;
		$get 		= userdata(['id' => $userid]);

		if ($type == 'url') {
			$result 	= base_url($base_path . $get->user_picture);
		} else {
			$result 	= img([
				'src'	=> $base_path . $get->user_picture
			]);
		}

		return $result;
	}


	function networkpoinreward($userid = null, $position = 'left', $paketid = 1)
	{
		$return 		= 0;
		$poin_masuk 	= $poin_keluar = 0;

		$this->db->select_sum('poinnetwork_total');
		$this->db->where('poinnetwork_userid', $userid);
		$this->db->where('poinnetwork_position', $position);
		$this->db->where('poinnetwork_paketid', $paketid);
		$this->db->where('poinnetwork_tipe', 'credit');
		$getcredit 			= $this->db->get('tb_poinnetwork');
		$get_poin_masuk 	= $getcredit->row()->poinnetwork_total;
		if (!empty($get_poin_masuk)) {
			$poin_masuk 	= $get_poin_masuk;
		}

		$this->db->select_sum('poinnetwork_total');
		$this->db->where('poinnetwork_userid', $userid);
		$this->db->where('poinnetwork_position', $position);
		$this->db->where('poinnetwork_paketid', $paketid);
		$this->db->where('poinnetwork_tipe', 'debit');
		$getdebit 			= $this->db->get('tb_poinnetwork');
		$get_poin_keluar 	= $getdebit->row()->poinnetwork_total;
		if (!empty($get_poin_keluar)) {
			$poin_keluar 	= $get_poin_keluar;
		}

		$return 			= $poin_masuk - $poin_keluar;

		return $return;
	}

	function poinRW($userid = null, $position = 'left', $tipe = 'RO')
	{
		$return 		= 0;
		$poin_masuk 	= $poin_keluar = 0;

		$this->db->select_sum('poinrw_amount');
		$this->db->where('poinrw_userid', $userid);
		$this->db->where('poinrw_ket', $tipe);
		$this->db->where('poinrw_position', $position);
		$this->db->where('poinrw_type', 'credit');
		$getcredit 			= $this->db->get('tb_poinrw');
		$get_poin_masuk 	= $getcredit->row()->poinrw_amount;
		if (!empty($get_poin_masuk)) {
			$poin_masuk 	= $get_poin_masuk;
		}

		$this->db->select_sum('poinrw_amount');
		$this->db->where('poinrw_userid', $userid);
		$this->db->where('poinrw_ket', $tipe);
		$this->db->where('poinrw_position', $position);
		$this->db->where('poinrw_type', 'debit');
		$getdebit 			= $this->db->get('tb_poinrw');
		$get_poin_keluar 	= $getdebit->row()->poinrw_amount;
		if (!empty($get_poin_keluar)) {
			$poin_keluar 	= $get_poin_keluar;
		}

		$return 			= $poin_masuk - $poin_keluar;

		return $return;
	}

	function poinprofit($userid = null, $position = 'left')
	{
		$return 		= 0;
		$poin_masuk 	= $poin_keluar = 0;

		$startbulanini       = date('Y-m-01 00:00:00', strtotime('-1 month', now()));
		$endbulanini         = date('Y-m-t 23:59:59', strtotime('-1 month', now()));

		$this->db->select_sum('poinprofit_amount');
		$this->db->where('poinprofit_userid', $userid);
		$this->db->where('poinprofit_position', $position);
		$this->db->where('poinprofit_date BETWEEN "' . $startbulanini . '" AND "' . $endbulanini . '"');
		$this->db->where('poinprofit_tipe', 'credit');
		$getcredit 			= $this->db->get('tb_poinprofit');
		$get_poin_masuk 	= $getcredit->row()->poinprofit_amount;
		if (!empty($get_poin_masuk)) {
			$poin_masuk 	= $get_poin_masuk;
		}

		$this->db->select_sum('poinprofit_amount');
		$this->db->where('poinprofit_userid', $userid);
		$this->db->where('poinprofit_position', $position);
		$this->db->where('poinprofit_date BETWEEN "' . $startbulanini . '" AND "' . $endbulanini . '"');
		$this->db->where('poinprofit_tipe', 'debit');
		$getdebit 			= $this->db->get('tb_poinprofit');
		$get_poin_keluar 	= $getdebit->row()->poinprofit_amount;
		if (!empty($get_poin_keluar)) {
			$poin_keluar 	= $get_poin_keluar;
		}

		$return 			= $poin_masuk - $poin_keluar;

		return $return;
	}

	function poinrewardstockist($userid = null)
	{
		$return 		= 0;
		$poin_masuk 	= $poin_keluar = 0;

		// $this->db->where('poinstockistrw_status', $status);
		$this->db->select_sum('poinstockistrw_amount');
		$this->db->where('poinstockistrw_userid', $userid);
		$this->db->where('poinstockistrw_type', 'credit');
		$getcredit 			= $this->db->get('tb_poinstockistrw');
		$get_poin_masuk 	= $getcredit->row()->poinstockistrw_amount;
		if (!empty($get_poin_masuk)) {
			$poin_masuk 	= $get_poin_masuk;
		}

		// $this->db->where('poinstockistrw_status', $status);
		$this->db->select_sum('poinstockistrw_amount');
		$this->db->where('poinstockistrw_userid', $userid);
		$this->db->where('poinstockistrw_type', 'debit');
		$getdebit 			= $this->db->get('tb_poinstockistrw');
		$get_poin_keluar 	= $getdebit->row()->poinstockistrw_amount;
		if (!empty($get_poin_keluar)) {
			$poin_keluar 	= $get_poin_keluar;
		}

		$return 			= $poin_masuk - $poin_keluar;

		return $return;
	}


	public function getPaket($userid = '1', $position = 'left', $package = null)
	{
		// $user 		= $this->get_jaringann($userid, ' WHERE upline_id="' . $userid . '" and user_package = "' . $package . '" ');
		$user 		= $this->get_jaringann($userid, ' WHERE upline_id="' . $userid . '" and position = "' . $position . '" and user_package="' . $package . '"');
		// $user 		= $this->get_jaringann($userid, ' WHERE upline_id="' . $userid . '" and position = "' . $position . '", and user_package = "' . $package . '"');
		$totalkaki  = 0;

		foreach ($user as $value) {
			$get = $this->get_jaringann($value->id);
			foreach ($get as $value2) {
				$totalkaki++;
			}
			$totalkaki++;
		}
		return $totalkaki;
	}

	function getterluar($userid = '1', $position = 'left')
	{
		$user 		= $this->get_jaringann($userid, ' WHERE upline_id="' . $userid . '" and position = "' . $position . '"');
		$userid  	= 1;
		if ($user) {
			foreach ($user as $show) {
				$this->getterluar($show->id, $position);
			}
		} else {
			$userid = $user;
		}

		return $userid;
	}


	public function get_jaringann($user_id = null, $where = null)
	{

		$userid = ($user_id == null) ? userid() : $user_id;

		$get = $this->db->query('
			SELECT  `id`,
			        `username`,
			        `upline_id`,
					`position`
			from    (select * from tb_users ' . $where . '
			         order by `upline_id`, `id`) tb_users_sorted,
			        (select @pv := ' . $userid . ') initialisation
			where   find_in_set(`upline_id`, @pv) > 0
			and     @pv := concat(@pv, ",", `id`)
			ORDER BY upline_id DESC
		');


		// echo $this->db->last_query();

		return $get->result();
	}


	function validreff($kode1 = null, $kode2 = null, $kode3 = null)
	{

		$param1	= $kode1;
		$param2	= $kode2;
		$param3	= $kode3;

		$kodereff = $param1 . $param2 . $param3;

		$this->db->where('user_referral_code', $kodereff);
		$cekdata 	= $this->db->get('tb_users');
		if ($cekdata->num_rows() != 0) {

			$newparam2 		= random_string('alnum', 6);

			$result = $this->validreff($param1, $newparam2, $param3);
		} else {
			$result['refcode'] 	= $kodereff;
		}

		return $result;
	}

	function getrank($userid = null)
	{
		$return 		= 0;
		$poin 			= 0;
		$paket			= "No Package";

		$this->db->select_sum('poinrank_amount');
		if ($userid != null) {
			$this->db->where('poinrank_userid', $userid);
		} else {
			$this->db->where('poinrank_userid', userid());
		}
		$this->db->join('tb_users', 'poinrank_userid = id');
		$get 			= $this->db->get('tb_poinrank');
		$get_point 	= $get->row()->poinrank_amount;

		if (!empty($get_point)) {
			$poin 	= $get_point;
		}
		$this->db->where('package_poinmin <=', $poin);
		$this->db->where('package_poinmax >=', $poin);
		$getpaket = $this->db->get('tb_packages');
		if ($getpaket->num_rows() != 0) {
			$paket = $getpaket->row()->package_name;
		}
		return  $paket;
	}

	function cekbonuspairingtitikgen($userid = null)
	{
		$paketid = userdata(['id' => $userid])->user_pktid;
		$this->db->where('package_id', $paketid);
		$getpaket = $this->db->get('tb_packages')->row();
		$totlvl = count(json_decode($getpaket->package_matching));
		$bonusPerLevel = [];
		for ($i = 1; $i <= $totlvl; $i++) {
			$this->db->where('titikgen_level', $i);
			$this->db->where('titikgen_userid', $userid);
			$cektitik = $this->db->get('tb_titikgen')->result();
			$saldo = 0;
			foreach ($cektitik as $value) {
				$wallet = $this->usermodel->userWallet('withdrawal', $value->titikgen_downlineid);
				$date_start = date('Y-m-01 00:00:00');
				$date_end = date('Y-m-t 23:59:59');
				$this->db->select_sum('w_balance_amount');
				$this->db->where('w_balance_ket', 'pasangan');
				$this->db->where('wallet_address', $wallet->wallet_address);
				$this->db->where('w_balance_date_add BETWEEN "' . $date_start . '" AND "' . $date_end . '"');
				$this->db->join('tb_users_wallet', 'wallet_id = w_balance_wallet_id', 'left');

				$get = $this->db->get('tb_wallet_balance');
				$get_saldo_masuk = $get->row()->w_balance_amount ?? 0;

				$saldo += $get_saldo_masuk * (json_decode($getpaket->package_matching)[$i - 1] / 100);
			}

			$bonusPerLevel[$i] = $saldo;
		}

		return $bonusPerLevel;
	}

	function getpasanganbulanlalu($userid = null)
	{
		$wallet = $this->usermodel->userWallet('withdrawal', $userid);
		$date_start = date('Y-m-01 00:00:00', strtotime('first day of last month'));
		$date_end = date('Y-m-t 23:59:59', strtotime('last day of last month'));
		$this->db->select_sum('w_balance_amount');
		if (($date_start != null) && ($date_end != null)) {
			$this->db->where('w_balance_date_add BETWEEN "' . $date_start . '" AND "' . $date_end . '"');
		}
		$this->db->select_sum('w_balance_amount');
		$this->db->where('w_balance_ket', 'pasangan');
		$this->db->join('tb_users_wallet', 'wallet_id = w_balance_wallet_id', 'left');
		$this->db->where('wallet_address', $wallet->wallet_address);
		$get 			 = $this->db->get('tb_wallet_balance');
		$get_saldo_masuk = $get->row()->w_balance_amount;
		return $get_saldo_masuk ?? 0;
	}
	function getgenerations($id = null, $level = 1, &$result = [])
	{
		$this->db->where_in('referral_id', $id);
		$getusers = $this->db->get('tb_users');
		$currentGeneration = array_column($getusers->result_array(), 'id');

		if (!empty($currentGeneration)) {
			$result[$level] = $currentGeneration;
			$this->getgenerations($currentGeneration, $level + 1, $result);
		}

		return $result;
	}
	function cekbonuspairingrekursif($userid = null)
	{
		$paketid = userdata(['id' => $userid])->user_pktid;
		$this->db->where('package_id', $paketid);
		$getpaket = $this->db->get('tb_packages')->row();

		$totlvl = count(json_decode($getpaket->package_matching));
		$bonusPerLevel = [];

		$generations = $this->getgenerations($userid);

		for ($i = 1; $i <= $totlvl; $i++) {
			$saldo = 0;

			if (isset($generations[$i])) {
				foreach ($generations[$i] as $downlineId) {
					$wallet = $this->usermodel->userWallet('withdrawal', $downlineId);
					$date_start = date('Y-m-01 00:00:00');
					$date_end = date('Y-m-t 23:59:59');
					$this->db->select_sum('w_balance_amount');
					$this->db->where('w_balance_ket', 'pasangan');
					$this->db->where('wallet_address', $wallet->wallet_address);
					$this->db->where('w_balance_date_add BETWEEN "' . $date_start . '" AND "' . $date_end . '"');
					$this->db->join('tb_users_wallet', 'wallet_id = w_balance_wallet_id', 'left');
					$get = $this->db->get('tb_wallet_balance');
					$get_saldo_masuk = $get->row()->w_balance_amount ?? 0;
					$saldo += $get_saldo_masuk * (json_decode($getpaket->package_matching)[$i - 1] / 100);
				}
			}

			$bonusPerLevel[$i] = $saldo;
		}

		return $bonusPerLevel;
	}

	function wilayah($kode = null)
	{
		$this->db->where('kode', $kode);
		$get = $this->db->get('wilayah')->row();

		return $get->nama;
	}

	function cektotalpin($userid = null, $packageid = null)
	{

		$this->db->where('pin_userid', $userid);
		$this->db->where('pin_package_id', $packageid);
		return $this->db->get('tb_users_pin')->num_rows() ?? 0;
	}

	function Kirimpin($totalpin, $penerima, $pengirim, $paketid)
	{
		if ($totalpin != 0) {

			$this->db->limit($totalpin);
			$this->db->where('pin_userid', userid());
			$this->db->where('pin_package_id', $paketid);
			$this->db->join('tb_packages', 'pin_package_id = package_id');
			$cekpinserial = $this->db->get('tb_users_pin');
			foreach ($cekpinserial->result() as $show) {
				$this->db->update(
					'tb_users_pin',
					[
						'pin_userid'        =>  $penerima,
						'pin_date_add'        => sekarang(),
					],
					[
						'pin_code'          => $show->pin_code,
					]
				);
			}
			$this->db->insert(
				'tb_reportpin',
				[
					'reportpin_userid'              => $pengirim,
					'reportpin_desc'         => 'Kirim ' . $totalpin . ' PIN Paket ' .  $cekpinserial->row()->package_name . ' ke Username: ' . userdata(['id' => $penerima])->username,
					'reportpin_date'        => sekarang(),
					'reportpin_code '            => strtolower(random_string('alnum', 64)),
					'reportpin_pengguna '            => userdata(['id' => $penerima])->id,
					'reportpin_tipe '            => 'kirim',
				]
			);
			$this->db->insert(
				'tb_reportpin',
				[
					'reportpin_userid'      => $penerima,
					'reportpin_desc'        =>  'Terima ' . $totalpin . ' PIN Paket ' . $cekpinserial->row()->package_name . ' dari Username: ' .  userdata(['id' => userid()])->username,
					'reportpin_date'        => sekarang(),
					'reportpin_code'        => strtolower(random_string('alnum', 64)),
					'reportpin_pengguna '   =>  userdata(['id' => $penerima])->id,
					'reportpin_tipe '       => 'terima',


				]
			);
		}
	}
	function caridownline($root, $side)
	{
		// cari anak langsung sesuai posisi
		$child = $this->db->get_where('tb_users', [
			'upline_id' => $root,
			'position'  => $side
		])->row();
		$result = [];
		if ($child) {
			// level‑1
			$result[1][] = $child->id;
			// rekursif untuk semua
			$this->caridownlinelvl2($child->id, 2, $result);
		}

		return $result;
	}

	function caridownlinelvl2($parentId, $level, &$map)
	{
		$kids = $this->db->get_where('tb_users', ['upline_id' => $parentId])->result();

		foreach ($kids as $k) {
			$map[$level][] = $k->id;
			$this->caridownlinelvl2($k->id, $level + 1, $map);
		}
	}

	function jaringansaya($userid = null)
	{ 
		$positions = ['left', 'right'];
		$arraymember = [];

		foreach ($positions as $position) {
			$this->db->where('upline_id', $userid);
			$this->db->where('position', $position);
			$downline = $this->db->get('tb_users')->row();

			if ($downline) {
				$arraymember = array_merge($arraymember, $this->getsemuamemberdijaringan($downline->id));
				$arraymember[] = $downline->id;
			}
		}

		if (empty($arraymember)) {
			$arraymember[] = $userid;
		}

		return $arraymember;
	}
	public function getsemuamemberdijaringan($upline_id)
	{
		$result = [];

		// Ambil semua member dengan upline_id yang sesuai
		$this->db->where('upline_id', $upline_id);
		// $this->db->where('position', 'left');
		$query = $this->db->get('tb_users'); // Sesuaikan dengan nama tabel Anda

		foreach ($query->result() as $row) {
			$result[] = $row->id; // Tambahkan ID ke hasil

			// Rekursif untuk mencari downline dari member ini
			$result = array_merge($result, $this->getsemuamemberdijaringan($row->id));
		}

		return $result;
	}
	function levelpalingdekat($userid)
	{
		$queue = [[$userid, 0]];
		while (!empty($queue)) {
			list($currentId, $level) = array_shift($queue);
			$children = $this->db->get_where('tb_users', ['upline_id' => $currentId])->result();
			$hasLeft = false;
			$hasRight = false;
			foreach ($children as $child) {
				if ($child->position == 'left') {
					$hasLeft = true;
				} elseif ($child->position == 'right') {
					$hasRight = true;
				}
				$queue[] = [$child->id, $level + 1];
			}
			if (!$hasLeft || !$hasRight) {
				return $this->db->get_where('tb_users', ['id' => $currentId])->row();
			}
		}

		return null;
	}
	function carilevelterdekat($userid)
	{
		// Step 1: Ambil semua subtree kiri dan kanan
		$leftTree  = $this->caridownline($userid, 'left');
		$rightTree = $this->caridownline($userid, 'right');

		// Ambil level terakhir dari masing-masing sisi
		$maxKiri = !empty($leftTree) ? max(array_keys($leftTree)) : 0;
		$maxKanan = !empty($rightTree) ? max(array_keys($rightTree)) : 0;

		// Bandingkan dan ambil array dari sisi yang level terakhirnya lebih pendek
		if ($maxKanan > 0 && $maxKiri > 0) {
			if ($maxKiri <= $maxKanan) {
				$data = [
					$leftTree[$maxKiri]
				];
			} else {
				$data =  [
					$rightTree[$maxKanan]
				];
			}
			$userdata = userdata(['id' => end($data[0])]);
		} else {
			$data = [$userid];
			$userdata = userdata(['id' => $userid]);
		}

		return $userdata;
	}

		function sendNotifWA($msg = NULL, $phone = NULL) // async
	{
		
		$return = array();
		$dataSending = array();
		
		$dataSending["api_key"] = option('apikey')['option_desc1'];
		$dataSending["number_key"] = option('numberkey')['option_desc1'];
		$dataSending["phone_no"] = $phone;
		$dataSending["message"] = $msg;
		$dataSending["wait_until_send"] = "1";
	
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
			CURLOPT_RETURNTRANSFER => true, // Tidak menunggu respons
			CURLOPT_FRESH_CONNECT => true, // Selalu buat koneksi baru
			CURLOPT_NOSIGNAL => 1, // Supaya tidak terpengaruh oleh signal timeout
			CURLOPT_TIMEOUT => 3, 
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($dataSending),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));
	
		$response = curl_exec($curl);
		curl_close($curl);
	
		return $response;
	}
	// 	function sendNotifWA($msg = NULL, $phone = NULL)
	// {
	// 	$return = array();
	// 	$dataSending = array();
	// 	$dataSending["api_key"] = option('apikey')['option_desc1'];
	// 	$dataSending["number_key"] = option('numberkey')['option_desc1'];
	// 	$dataSending["phone_no"] = $phone;
	// 	$dataSending["message"] = $msg;
	// 	$dataSending["wait_until_send"] = "1";
	// 	$curl = curl_init();
	// 	curl_setopt_array($curl, array(
	// 		CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => '',
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 0,
	// 		CURLOPT_FOLLOWLOCATION => true,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => 'POST',
	// 		CURLOPT_POSTFIELDS => json_encode($dataSending),
	// 		CURLOPT_HTTPHEADER => array(
	// 			'Content-Type: application/json'
	// 		),
	// 	));
	// 	$response = curl_exec($curl);
	// 	curl_close($curl);
	// 	// echo $response;
	// 	return $response;
	// }


}

/* End of file Usermodel.php */
/* Location: ./application/models/Usermodel.php */