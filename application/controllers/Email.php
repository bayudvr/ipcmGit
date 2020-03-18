<?php defined('BASEPATH') or exit('No direct script allowed'); 

class Email extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
	}

	public function index(){

		$this->load->library('email');

		$config = array(
			'mailtype'=>"html",
		);


		$this->email->initialize($config);
		$this->email->from('no-reply@imaniprimarycare.co.id','Imani Primary Care');
		$this->email->to('devarabayu@gmail.com');
		$this->email->subject('(no-reply) Verifikasi Akun');
		$this->email->message("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	      <html xmlns='http://www.w3.org/1999/xhtml'>
	      <head>
	        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	            <meta name='viewport' content='width=device-width, initial-scale=1' />
	      </head>
	      <body>
	        <table align='center' cellpadding='0' cellspacing='0' width='800'>
	          <tr>
	            <td align='center' style='background: linear-gradient(to right, #3e5151, #decba4);'>
	                <center><img src='".base_url()."assets/img/logo.png' width='100' height='100' /></center>
	            </td>
	          </tr>
	          <tr>
			            <td align='center' bgcolor='#ffffff' style='padding: 40px 30px 40px 30px; color:black;'>
			                <h2>Halo, devarabayu@gmail.com. Silahkan Klik Tombol Di Bawah Untuk Melakukan Verifikasi.</h2>
			                <a href='#' type='button' style=' background: linear-gradient(to right, #f12711, #f5af19); padding: 5px 5px 5px 5px; display:block; color:white; width:40%; border-radius: 25px;'><h2>Verifikasi</h2></a>
			            </td>
			        </tr>
			    </table>
		    </body>
		    </html>");

		if($this->email->send()){

			echo 'Email Terkirim';
		}else{

			echo $this->email->print_debugger();
		}
	}

	public function test(){

		$this->load->view('test');
	}

	public function angka(){

		echo rand(100,999);
	}
}
?>