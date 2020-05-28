<?php defined('BASEPATH') or exit('No direct script allowed');

class Cetak extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
	}

	public function vcm($id){

		$image = $_POST["image"];
		$image = explode(";", $image)[1];
		$image = explode(",", $image)[1];
		$image = str_replace(" ", "+", $image);
		$image = base64_decode($image);
		$foto = rand(1000,9999).'.png';
		$msg = 'fail';

		$kirim = null;

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){

			$foto_kartu = $d->foto_kartu;
		}

		$path = './assets/upload/kartuAnggota/'.$foto_kartu;

		if($foto_kartu != ''){

			if(is_file($path)){
				unlink($path);
			}
		}

			

		$ubah = $this->m->update('user',array('foto_kartu'=>$foto),array('id'=>$id));

		if($ubah != true){

			return $msg;
		}else{

			$kirim = $this->kirimVC($id);

			if($kirim == 'done'){

				$msg = 'done';
			}else{
				return $msg;
			}
		}

		echo json_encode($msg);

	}

	public function kirimVC($id){

		$q = $this->m->where('user',array('id'=>$id));

		$this->load->library('email');

		$config = array(
			'mailtype'=>"html",
		);

		foreach($q as $d){

			$nama = $d->nama_lengkap;
			$email = $d->email;
			$foto = $d->foto_kartu;
		}

		$this->email->initialize($config);
		$this->email->from('no-reply@imaniprimarycare.co.id','Imani Primary Care');
		$this->email->to($email);
		$this->email->subject('(no-reply) Kartu Anggota');

		$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				    <meta name="viewport" content="width=device-width, initial-scale=1" />
				</head>
				<body style="background: #D8D8D8">
					<table align="center" cellpadding="0" cellspacing="0" width="800" style="padding-top:50px; padding-bottom:50px;">
						<tr>
							<td align="center" style="background: linear-gradient(to right, #3e5151, #decba4);">
							    <center><img src="'.base_url().'/assets/img/logo.png" width="100" height="100" /></center>
							</td>
						</tr>
						<tr>
					        <td align="center" bgcolor="#ffffff" style="padding: 40px 30px 40px 30px; color:black;">
					            <h2>Halo, '.$nama.'. Di bawah adalah file kartu anggotamu</h2>
					        </td>
					    </tr>
					    <hr>
					    <tr>
					    	<td align="center" style="padding: 40px 30px 40px 30px; color:white;" bgcolor="#272727">
					    		Jalan Brentwood 1 No. 21 Blok RC, Bekasi, Jawa Barat.
					    	</td>
					    </tr>
					</table>
				</body>
				</html>');

		$this->email->attach(FCPATH.'assets/upload/kartuAnggota/'.$foto);

		if($this->email->send()){

			return 'done';
		}else{

			return 'fail';
		}
	}
}

?>