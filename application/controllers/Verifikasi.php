<?php defined('BASEPATH') or exit('No direct script allowed');

class Verifikasi extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
	}

	public function payment($key){

		$kode = base64_decode($key);

		$data['invoice'] = $this->m->single('SELECT * FROM user AS a, invoice AS b WHERE a.id=b.id_payee AND b.id = "'.$kode.'"');

		$this->load->view('verifikasi',$data);
	}
}

?>