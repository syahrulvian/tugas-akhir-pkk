<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userlist extends CI_Model
{

	private static $data = [
		'status' 	=> true,
		'message' 	=> null,
	];


	public function __construct()
	{
		parent::__construct();
		Self::$data['csrf_data'] 	= $this->security->get_csrf_hash();
	}

	function add_staff()
	{


		$this->form_validation->set_rules('staff_username', 'Username', 'trim|required|min_length[4]|is_unique[tb_users.username]', array(
			'is_unique'    => 'Username Sudah Digunakan, Gunakan Username Lain.'
		));
		$this->form_validation->set_rules('staff_fullname', 'Nama Lengkap', 'required');
		// $this->form_validation->set_rules('staff_company', 'Nama Perusahaan', 'required');
		$this->form_validation->set_rules('staff_phone', 'No. WhatsApp', 'required|numeric');
		$this->form_validation->set_rules('staff_email', 'Email', 'required');
		$this->form_validation->set_rules('staff_password', 'Password', 'trim|required|min_length[6]');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		/*============================================
		=           JIKA STATUS TRUE / BENAR         =
		============================================*/
		if (Self::$data['status']) {
			$random_string 	= strtolower(random_string('alnum', 64));

			$new_username   = post('staff_username');
			/*============================================
			=            INPUT DATA PENDAFTAR            =
			============================================*/
			$additional_data 	= array(
				'username'				=> $new_username,
				'user_fullname'			=> $this->input->post('staff_fullname'),
				'user_phone'			=> $this->input->post('staff_phone'),
				// 'user_company'			=> $this->input->post('staff_company'),
				'user_code'				=> $random_string,
				'user_passtext'			=> $this->input->post('staff_password'),
				'user_status'			=> 'staff',
			);

			$this->ion_auth->register($new_username, $this->input->post('staff_password'), str_replace(' ', '', $this->input->post('staff_email')), $additional_data, array(1));

			$last_user 		= userdata(array('user_code' => $random_string));

			/*============================================
			=              MEMBUAT WALLET               =
			============================================*/
			// $this->db->insert(
			// 	'tb_users_wallet',
			// 	[
			// 		'wallet_user_id'  	=> $last_user->id,
			// 		'wallet_address'  	=> generateWallet(),
			// 		'wallet_type'  		=> 'withdrawal',
			// 		'wallet_date_added' => sekarang()
			// 	]
			// );

			/*============================================
			=          Notif WA           =
			============================================*/

			// $nomor_hp = $this->input->post('staff_phone');
			// $pattern = "/^62/";
			// $replacement = "0";
			// $nomor_hp_baru = preg_replace($pattern, $replacement, $nomor_hp);

			// $username = $new_username;
			// $pw = $this->input->post('staff_password');
			// $pesan = "Selamat Bergabung, Berikut detail akun anda:\n\nUsername: $username\nPassword: $pw\n\nSilahkan login melalui \n\n " . site_url('login') . "\n\nPesan Otomatis mohon tidak membalas pesan ini";
			// $this->usermodel->notifWA("$nomor_hp", $pesan);

			Self::$data['heading'] 	= 'Berhasil';
			Self::$data['message'] 	= 'Selamat Pendaftaran Staff Berhasil Silahkan Login';
			Self::$data['type'] 	= 'success';
		} else {

			Self::$data['heading'] 	= 'Gagal';
			Self::$data['type'] 	= 'error';
		}

		return Self::$data;
	}

	function update_staff()
	{
		$this->db->where('user_code', $this->input->post('code'));
		$cekkkkkk = $this->db->get('tb_users');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "USER DATA INVALID";
		}

		$this->form_validation->set_rules('staff_fullname', 'Nama Lengkap', 'required');
		// $this->form_validation->set_rules('staff_company', 'Nama Perusahaan', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('staff_phone', 'Nomor Telepon', 'required|numeric');
		$this->form_validation->set_rules('code', 'CODE', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userdataaa = $cekkkkkk->row();

			$this->db->update(
				'tb_users',
				[
					'user_fullname'			=> post('staff_fullname'),
					// 'user_company'			=> post('staff_company'),
					'email'					=> post('email'),
					'user_phone' 			=> post('staff_phone'),
				],
				[
					'id'					=> $userdataaa->id,
				]
			);

			Self::$data['message'] 	= 'Staff Berhasil Diperbarui';
			Self::$data['heading'] 	= 'Success';
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function update_password_staff()
	{
		$this->db->where('user_code', post('code'));
		$cekuser = $this->db->get('tb_users');
		if ($cekuser->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = "User Data Not Found";
		}

		$this->form_validation->set_rules('code', 'User Code', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}


		if (Self::$data['status']) {
			$userdata = $cekuser->row();
			$this->ion_auth->update($userdata->id, [
				'password'	=> post('password'),
				'user_passtext'	=> post('password')
			]);

			$msg = 'Halo ' . $userdata->user_fullname . ",\n\nPassword akun Anda telah berhasil direset. Berikut password baru Anda: " . post('password') . "\n\nSilakan login menggunakan password baru tersebut. Demi keamanan, segera ganti password setelah login.";
			$phone = indo_phone_format($userdata->user_phone);
			$this->usermodel->sendNotifWA($msg, $phone);

			Self::$data['heading']           = 'Success';
			Self::$data['message']           = 'Member Password Updated Successfully';
			Self::$data['type']              = 'success';
		} else {

			Self::$data['heading']           = 'Error';
			Self::$data['type']              = 'error';
		}

		return Self::$data;
	}


	function update_member()
	{
		$this->db->where('user_code', $this->input->post('code'));
		$cekkkkkk = $this->db->get('tb_users');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "USER DATA INVALID";
		}

		$this->form_validation->set_rules('user_fullname', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('user_phone', 'Nomor Telepon', 'required');
		$this->form_validation->set_rules('code', 'CODE', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userdataaa = $cekkkkkk->row();

			$this->db->update(
				'tb_users',
				[
					'user_fullname'			=> post('user_fullname'),
					'user_nickname'			=> post('user_nickname'),
					'email'					=> post('email'),
					'user_phone' 			=> post('user_phone'),
					'user_provinsi'			=> post('user_provinsi'),
					'user_kota'				=> post('user_kota'),
					'user_kec'				=> post('user_kec'),
					'user_alamat'			=> post('user_alamat'),
					'user_kodepos'			=> post('user_kodepos'),
					'user_agama'			=> post('user_agama'),
					'user_ahliwaris'		=> post('user_ahliwaris'),
					'user_hubungan'			=> post('user_hubungan'),
					'user_nik'				=> post('user_nik'),
					'user_ttl'				=> post('user_ttl'),
					'user_bank_name'				=> post('user_bank_name'),
					'user_bank_account'				=> post('user_bank_account'),
					'user_bank_number'				=> post('user_bank_number'),
				],
				[
					'id'					=> $userdataaa->id,
				]
			);

			Self::$data['message'] 	= 'Member Profile Updated Successfully';
			Self::$data['heading'] 	= 'Success';
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function update_status_member()
	{
		$this->db->where('user_code', $this->input->post('code'));
		$cekkkkkk = $this->db->get('tb_users');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "USER DATA INVALID";
		}

		$this->form_validation->set_rules('code', 'CODE', 'required');
		$this->form_validation->set_rules('user_status', 'STATUS', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_users',
				[
					'user_status'	=> $this->input->post('user_status')
				],
				[
					'user_code'	=> $this->input->post('code')
				]
			);

			Self::$data['message'] 	= 'Status User Telah Diperbarui';
			Self::$data['heading'] 	= 'Berhasil';
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function update_wallet_address()
	{
		$this->db->where('user_code', $this->input->post('code'));
		$cekkkkkk = $this->db->get('tb_users');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "USER DATA INVALID";
		}

		$this->form_validation->set_rules('user_address', 'Wallet Address', 'required');
		$this->form_validation->set_rules('code', 'CODE', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userdataaa = $cekkkkkk->row();

			$this->db->update(
				'tb_users',
				[
					'user_address'			=> post('user_address'),
				],
				[
					'id'					=> $userdataaa->id,
				]
			);

			Self::$data['message'] 	= 'Wallet Address Updated Successfully';
			Self::$data['heading'] 	= 'Success';
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function update_password_member()
	{
		$this->db->where('user_code', post('code'));
		$cekuser = $this->db->get('tb_users');
		if ($cekuser->num_rows() == 0) {
			Self::$data['status']     = false;
			Self::$data['message']     = "User Data Not Found";
		}

		$this->form_validation->set_rules('code', 'User Code', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status']     = false;
			Self::$data['message']     = validation_errors(' ', '<br/>');
		}


		if (Self::$data['status']) {
			$userdata = $cekuser->row();
			$this->ion_auth->update($userdata->id, [
				'password'	=> post('password'),
				'user_passtext'	=> post('password')
			]);

			$msg = 'Halo ' . $userdata->user_fullname . ",\n\nPassword akun Anda telah berhasil direset. Berikut password baru Anda: " . post('password') . "\n\nSilakan login menggunakan password baru tersebut. Demi keamanan, segera ganti password setelah login.";
			$phone = indo_phone_format($userdata->user_phone);
			$this->usermodel->sendNotifWA($msg, $phone);

			Self::$data['heading']           = 'Success';
			Self::$data['message']           = 'Member Password Updated Successfully';
			Self::$data['type']              = 'success';
		} else {

			Self::$data['heading']           = 'Error';
			Self::$data['type']              = 'error';
		}

		return Self::$data;
	}

	function updatedatanik()
	{
		$this->db->where('user_code', $this->input->post('code'));
		$cekkkkkk = $this->db->get('tb_users');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "USER DATA INVALID";
		}

		$this->form_validation->set_rules('user_nik', 'NIK', 'required');
		$this->form_validation->set_rules('code', 'CODE', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userdataaa = $cekkkkkk->row();

			$this->db->update(
				'tb_users',
				[
					'user_nik'				=> post('user_nik'),
				],
				[
					'id'					=> $userdataaa->id,
				]
			);

			Self::$data['message'] 	= 'Member NIK Data Successfully Updated';
			Self::$data['heading'] 	= 'Success';
			Self::$data['type'] 	= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function approvetransaksi()
	{
		$this->db->where('transaksi_code', $this->input->post('code'));
		$this->db->where('transaksi_status', 'pending');
		$cekkkkkk = $this->db->get('tb_transaksi');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Invalid or Confirmed Transaction Data";
		}

		$this->form_validation->set_rules('code', 'CODE', 'required');
		if ($this->form_validation->run() == FALSE) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_transaksi',
				[
					'transaksi_status'			=> 'success'
				],
				[
					'transaksi_code'			=> $this->input->post('code')
				]
			);


			Self::$data['message']      = 'Purchase Transaction Confirmed Successfully';
			Self::$data['heading']      = 'Success';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Error';
			Self::$data['type']     	= 'error';
		}
		return Self::$data;
	}

	function approvebonus()
	{
		$this->db->where('bonus_code', $this->input->post('code'));
		$this->db->where('bonus_status', 'pending');
		$cekkkkkk = $this->db->get('tb_bonus');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Invalid or Confirmed Bonus Data";
		}

		$this->form_validation->set_rules('code', 'CODE', 'required');
		if ($this->form_validation->run() == FALSE) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_bonus',
				[
					'bonus_status'			=> 'success'
				],
				[
					'bonus_code'			=> $this->input->post('code')
				]
			);


			Self::$data['message']      = 'Bonus Confirmation Successful, Bonus Status Updated';
			Self::$data['heading']      = 'Success';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Error';
			Self::$data['type']     	= 'error';
		}
		return Self::$data;
	}

	function kirimsaldo()
	{
		$cekpassword 	= $this->ion_auth->hash_password_db(userid(), post('saldo_password'));
		if (!$cekpassword) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Confirm that the password you entered is incorrect';
		}
		$wallet_withdrawal              = $this->usermodel->userWallet('withdrawal')->wallet_address;
		$info_walletwd                  = $this->walletmodel->walletAddressBalance($wallet_withdrawal);
		if ($info_walletwd < str_replace('.', '', $this->input->post('saldo_total'))) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Your Balance Is Not Enough';
		}

		$this->db->where('username', str_replace(' ', '', $this->input->post('saldo_username')));
		$cekusername = $this->db->get('tb_users');
		if ($cekusername->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'Invalid Destination Username';
		}

		$this->form_validation->set_rules('saldo_username', 'Username Tujuan', 'required');
		$this->form_validation->set_rules('saldo_total', 'Total Saldo', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('saldo_password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userpengirim = userdata();
			$userpenerima = $cekusername->row();

			// UNTUK PENGIRIM
			$this->db->insert(
				'tb_sendsaldo',
				[
					'sendsaldo_userid'		=> $userpenerima->id,
					'sendsaldo_amount'		=> str_replace('.', '', $this->input->post('saldo_total')),
					'sendsaldo_date'		=> sekarang(),
					'sendsaldo_code'		=> strtolower(random_string('alnum', 64)),
				]
			);

			$wallettttt     = $this->usermodel->userWallet('withdrawal', $userpenerima->id);
			$this->db->insert(
				'tb_wallet_balance',
				[
					'w_balance_wallet_id'       => $wallettttt->wallet_id,
					'w_balance_amount'          => str_replace('.', '', $this->input->post('saldo_total')),
					'w_balance_type'            => 'credit',
					'w_balance_desc'            => 'Receive Balance from Administrator',
					'w_balance_date_add'        => sekarang(),
					'w_balance_txid'            => strtolower(random_string('alnum', 64))
				]
			);
			$this->db->insert(
				'tb_userlog',
				[
					'userlog_userid'	=> $userpenerima->id,
					'userlog_desc'		=> 'Berhasil Mendaftar Stokis ',
					'userlog_date'		=> sekarang(),
				]
			);

			Self::$data['message']      = 'Balance Sent Successfully';
			Self::$data['heading']      = 'Success';
			Self::$data['type']         = 'success';
		} else {
			Self::$data['heading']     	= 'Error';
			Self::$data['type']     	= 'error';
		}
		return Self::$data;
	}

	function approvestokis()
	{

		$this->db->where('stokis_status', 'pending');
		$this->db->where('stokis_code', post('code'));
		$this->db->join('tb_users_invoice', 'tb_users_invoice.invoice_code = tb_stokis.stokis_code');
		$cekdata = $this->db->get('tb_stokis');
		if ($cekdata->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Invalid data";
		}

		$this->form_validation->set_rules('code', 'Code Member', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$stokisdata = $cekdata->row();

			$this->db->update(
				'tb_users',
				[
					'user_stokis'		=> 'yes'
				],
				[
					'id'				=> $stokisdata->stokis_userid
				]
			);

			$this->db->update(
				'tb_stokis',
				[
					'stokis_status'		=> 'active'
				],
				[
					'stokis_code'			=> post('code')
				]
			);
			/*============================================
            =            UPDATE STATUS INVOICE           =
            ============================================*/
			$this->db->update('tb_users_invoice', array('invoice_status' => 'success'), array('invoice_code' => $stokisdata->stokis_code));
			$this->db->update('tb_users_pembayaran', array('pembayaran_status' => 'approve'), array('pembayaran_code' => $stokisdata->stokis_code));

			$this->db->insert(
				'tb_userlog',
				[
					'userlog_userid'	=> $stokisdata->stokis_userid,
					'userlog_desc'		=> 'Resmi Menjadi Stokis',
					'userlog_date'		=> sekarang(),
				]
			);
			// kirim 500 pin silver
			$this->pinmodel->kirimpinadmin($stokisdata->invoice_qty, $stokisdata->stokis_userid, userid(), $stokisdata->invoice_package_id);

			Self::$data['heading']	= 'Success';
			Self::$data['message']	= 'Member Telah Menjadi Stokis';
			Self::$data['type']		= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}
	function rejectstokis()
	{

		$this->db->where('stokis_status', 'pending');
		$this->db->where('stokis_code', post('code'));
		$cekdata = $this->db->get('tb_stokis');
		if ($cekdata->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Invalid data";
		}

		$this->form_validation->set_rules('code', 'Code Member', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$stokisdata = $cekdata->row();


			$this->db->insert(
				'tb_userlog',
				[
					'userlog_userid'	=> $stokisdata->stokis_userid,
					'userlog_desc'		=> 'Daftar Stokis Ditolak Administrator',
					'userlog_date'		=> sekarang(),
				]
			);
			/*============================================
				=            UPDATE STATUS INVOICE           =
				============================================*/

			$this->db->where('stokis_code', post('code'));
			$this->db->delete('tb_stokis');
			$this->db->where('invoice_code', post('code'));
			$this->db->delete('tb_users_invoice');
			$this->db->where('pembayaran_code', post('code'));
			$this->db->delete('tb_users_pembayaran');


			Self::$data['heading']	= 'Success';
			Self::$data['message']	= 'Member Telah Menjadi Stokis';
			Self::$data['type']		= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function login_as_user()
	{
		Self::$data['status'] 		= true;
		Self::$data['heading'] 		= 'Successfully Login as a Member';
		Self::$data['type']	 		= 'success';


		if (!$this->session->userdata('admin_userid')) {
			Self::$data['status'] 		= false;
			Self::$data['heading'] 		= 'Cannot Login.<br>Please ReLogin Admin';
		}


		if (Self::$data['status']) {

			//update status
			$array = array(
				'user_id' => post('user_id')
			);

			$this->session->set_userdata($array);

			Self::$data['message']	= 'Login Successfully, Click OK to Continue';
		}

		return Self::$data;
	}

	function change_user_password()
	{

		Self::$data['message'] 	= 'Password updated successfully';
		Self::$data['heading'] 	= 'Success';
		Self::$data['type'] 	= 'success';

		$this->ion_auth->update(post('id'), array('password' => post('new_password')));

		return Self::$data;
	}

	public function change_user_data()
	{

		Self::$data['message'] 	= 'Data updated successfully';
		Self::$data['heading'] 	= 'Success';
		Self::$data['type'] 	= 'success';

		$this->db->where('id', post('id'));
		$this->db->where('user_code', post('user_code'));
		$this->db->update('tb_users', [
			'username'  		=> post('username'),
			'email'  			=> post('email'),
			'user_fullname'  	=> post('user_fullname'),
			'user_phone'  	=> post('user_phone'),
		]);

		return Self::$data;
	}

	function inject_activation()
	{

		Self::$data['heading'] 		= 'Failed';
		Self::$data['type'] 		= 'error';

		//validate packages
		$this->db->where('package_id', post('package_id'));
		$get_packages 			= $this->db->get('tb_packages');
		if ($get_packages->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'The package you selected is not available';
		}

		if ($this->usermodel->is_active(post('userid'))) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= 'This user was previously active';
		}


		if (Self::$data['status']) {

			$packages 			= $get_packages->row();
			$date_now 			= sekarang();

			//update lock prefit
			$this->ion_auth->update(post('userid'), array('lock_profit' => 'true', 'leader' => 'true'));


			$this->db->insert('tb_lending', [
				'lending_userid' 		=> post('userid'),
				'lending_amount' 		=> exchange('IDR', COIN_EXT, $packages->package_range_start),
				'lending_package' 		=> $packages->package_name,
				'lending_package_id' 	=> $packages->package_id,
				'lending_datestart' 	=> $date_now,
				'lending_dateend' 		=> date('Y-m-d', strtotime('+12 month', now())),
			]);


			Self::$data['heading'] 		= 'Success';
			Self::$data['message'] 		= 'User leader activation was successful';
			Self::$data['type'] 		= 'success';
		}

		return Self::$data;
	}

	function approvever()
	{
		$this->db->where('verification_status', 'pending');
		$this->db->where('verification_code', post('code'));
		$cekdata = $this->db->get('tb_verification');
		if ($cekdata->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Invalid data";
		}

		$this->form_validation->set_rules('code', 'Code Member', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userdata = $cekdata->row();

			$this->db->update(
				'tb_users',
				[
					'user_ktp'				   => $userdata->verification_nik,
					'user_verification'			=> '1'
				],
				[
					'id'						=> $userdata->verification_userid
				]
			);

			$this->db->update(
				'tb_verification',
				[
					'verification_status'		=> 'success'
				],
				[
					'verification_code'			=> post('code')
				]
			);



			Self::$data['heading']	= 'Success';
			Self::$data['message']	= 'Member Confirmed';
			Self::$data['type']		= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function rejectsver()
	{
		$this->db->where('verification_status', 'pending');
		$this->db->where('verification_code', post('code'));
		$cekdata = $this->db->get('tb_verification');
		if ($cekdata->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "Invalid data";
		}

		$this->form_validation->set_rules('code', 'Code Member', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {

			$this->db->update(
				'tb_verification',
				[
					'verification_status'		=> 'rejected'
				],
				[
					'verification_code'			=> post('code')
				]
			);



			Self::$data['heading']	= 'Success';
			Self::$data['message']	= 'Member Has Been Rejected';
			Self::$data['type']		= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}

	function send_notif()
	{

		$this->db->where('user_code', $this->input->post('code'));
		$cekkkkkk = $this->db->get('tb_users');
		if ($cekkkkkk->num_rows() == 0) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= "USER DATA INVALID";
		}

		$this->form_validation->set_rules('code', 'CODE', 'required');
		if (!$this->form_validation->run()) {
			Self::$data['status'] 	= false;
			Self::$data['message'] 	= validation_errors(' ', '<br/>');
		}

		if (Self::$data['status']) {
			$userdata = $cekkkkkk->row();
			$msg = "Selamat bergabung Bapak/Ibu " . $userdata->user_fullname . " di Keluarga Besar LaQueen International dengan:\nID Login: " . $userdata->username . "\nPassword: " . $userdata->user_passtext . "\n\nSalam Sukses bersama LaQueen International.\nGrow Together\n" . base_url();
			$phone = indo_phone_format($userdata->user_phone);
			$this->usermodel->sendNotifWA($msg, $phone);


			Self::$data['heading']	= 'Success';
			Self::$data['message']	= 'Notifikasi Berhasil Dikirim Ulang';
			Self::$data['type']		= 'success';
		} else {
			Self::$data['heading'] 	= 'Failed';
			Self::$data['type'] 	= 'error';
		}
		return Self::$data;
	}
}

/* End of file Userlist.php */
/* Location: ./application/modules/postdata/models/admin_post/Userlist.php */
