<?php defined('BASEPATH') or exit('No dircet path allowed');

class Login extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
	}

	public function index(){

		$this->load->view('login');
	}

	public function auth(){

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		$pass_md5 = md5($pass);

		$q = $this->m->single('SELECT * FROM user WHERE email = "'.$email.'" and password = "'.$pass.'" and password_md5 = "'.$pass_md5.'" and acc_stat="Registered" or email = "'.$email.'" and password = "'.$pass.'" and password_md5 = "'.$pass_md5.'" and acc_stat != "Hidden"');
		$msg = 'fail';
		if(count($q) > 0){

			foreach($q as $d){

				$data_sess=array(
					'id'=>$d->id,
					'email'=>$d->email
				);

				$this->session->set_userdata($data_sess);
			}

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function verifikasi(){

		$id = $this->session->userdata('id');

		$q = $this->m->where('user',array('id'=>$id));

		$qt = $this->m->single('select now() as log');

		foreach($q as $d){

			$level = $d->level;
		}

		foreach($qt as $dt){

			$log = $dt->log;
		}

		if($level == 1){

			$this->m->update('user',array('last_login'=>$log),array('id'=>$id));

			redirect('admin');
		}else if($level == 2){

			$this->m->update('user',array('last_login'=>$log),array('id'=>$id));

			redirect('user');
		}else{

			redirect();
		}
	}

	public function verified(){

		$this->load->view('verified');
	}

	public function done(){

		$id = $this->session->userdata('id');

		$qt = $this->m->single('select now() as log');

		foreach($qt as $dt){

			$log = $dt->log;
		}

		$this->m->update('user',array('last_logout'=>$log),array('id'=>$id));

		$this->session->sess_destroy();

		redirect();
	}
}

?>