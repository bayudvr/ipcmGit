<?php defined('BASEPATH') or exit('No direct script allowed');

class Crud extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
	}

	public function cek_akun(){

		$id = $this->session->userdata('id');

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){

			$stat = $d->acc_stat;
		}

		$msg = 'fail';

		if($stat == 'Approved'){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function regis(){
		
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		$pass_md5 = md5($pass);
		$msg = 'fail';

		$qm = $this->m->where('user',array('email'=>$email));
		$q = null;

		$this->load->library('email');

		$config = array(
			'mailtype'=>"html",
		);


		$this->email->initialize($config);
		$this->email->from('no-reply@imaniprimarycare.co.id','Imani Primary Care');
		$this->email->to($email);
		$this->email->subject('(no-reply) Verifikasi Akun');
		$this->email->message("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	      <html xmlns='http://www.w3.org/1999/xhtml'>
	      <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	        
	            <meta name='viewport' content='width=device-width, initial-scale=1' />
	      </head>
	      <body style='background: #D8D8D8'>
					<table align='center' cellpadding='0' cellspacing='0' width='800' style='padding-top:50px; padding-bottom:50px;''>
	          <tr>
	            <td align='center' style='background: linear-gradient(to right, #3e5151, #decba4);'>
	                <center><img src='".base_url()."assets/img/logo.png' width='100' height='100' /></center>
	            </td>
	          </tr>
	          <tr>
			            <td align='center' bgcolor='#ffffff' style='padding: 40px 30px 40px 30px; color:black;'>
			                <h2>Halo, ".$this->input->post('nama').". Silahkan Klik Tombol Di Bawah Untuk Melakukan Verifikasi.</h2>
			                <a href='".base_url()."crud/verifikasi?key=".base64_encode($email)."' type='button' style=' background: linear-gradient(to right, #f12711, #f5af19); padding: 5px 5px 5px 5px; display:block; color:white; width:40%; border-radius: 25px;'><h2>Verifikasi</h2></a>
			            </td>
			        </tr>
				    <hr>
				    <tr>
				    	<td align='center' style='padding: 40px 30px 40px 30px; color:white;' bgcolor='#272727'>
				    		Jalan Brentwood 1 No. 21 Blok RC, Bekasi, Jawa Barat.
				    	</td>
				    </tr>
			    </table>
		    </body>
		    </html>");

		if(count($qm) > 0){

			$msg = 'email';
		}else if(strlen($pass) < 8){

			$msg = 'pass';
		}else{

			$data = array(
				'email'=>$email,
				'password'=>$pass,
				'password_md5'=>$pass_md5,
				'nama_lengkap'=>$this->input->post('nama'),
				'level'=>2,
				'acc_stat'=>'Registered'
			);

			$q = $this->m->insert('user',$data);

			if($q == true){
				if($this->email->send()){
					$msg='done';
				}else{
					return $msg;
				}
			}else{

				return $msg;
			}
		}

		echo json_encode($msg);
	}

	public function verifikasi(){

		$email = base64_decode($_GET['key']);

		$q = $this->m->update('user',array('acc_stat'=>'Active'),array('email'=>$email));

		if($q == true){

			redirect('login/verified');
		}else{

			echo 'Ada kesalahan';
		}
	}

	public function profilEdit(){

		$id = $this->session->userdata('id');

		$data = array(
			'nama_lengkap'=>$this->input->post('nama'),
			'nama_klinik'=>$this->input->post('nama_klinik'),
			'alamat_tinggal'=>$this->input->post('alamat_tinggal'),
			'jenis_kelamin'=>$this->input->post('jk'),
			'wilayah'=>$this->input->post('wilayah'),
			'kotkab'=>$this->input->post('kotkab'),
			'kecamatan'=>$this->input->post('kecamatan'),
			'pendidikan_terakhir'=>$this->input->post('pendidikan'),
			'institusi'=>$this->input->post('institusi'),
			'alamat_institusi'=>$this->input->post('alamat_institusi'),
			'no_telp'=>$this->input->post('telp'),
			'no_hp'=>$this->input->post('hp'),
			'acc_stat'=>'Active'
		);

		$q = $this->m->update('user',$data,array('id'=>$id));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function uploadFoto(){

		$id = $this->session->userdata('id');

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/fotoDiri/'.$new_name;

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){
			$path = './assets/upload/fotoDiri/'.$d->pas_foto;
		}

		if(is_file($path)){
			unlink($path);
		}

		move_uploaded_file($_FILES['foto']['tmp_name'], $des);

		$this->resizeImg($new_name,'./assets/upload/fotoDiri/');

		$q = $this->m->update('user',array('pas_foto'=>$new_name),array('id'=>$id));

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function uploadLogo(){

		$id = $this->session->userdata('id');

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/fotoKlinik/'.$new_name;

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){
			$path = './assets/upload/fotoKlinik/'.$d->pas_foto;
		}

		if(is_file($path)){
			unlink($path);
		}

		move_uploaded_file($_FILES['foto']['tmp_name'], $des);

		$this->resizeImg($new_name,'./assets/upload/fotoKlinik/');
		$q = $this->m->update('user',array('foto_klinik'=>$new_name),array('id'=>$id));

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);

	}

	public function editKontribusi(){

		$id = $this->session->userdata('id');

		$q = $this->m->update('user',array('kontribusi'=>$this->input->post('kontribusi')),array('id'=>$id));

		$user = $this->m->where('user',array('id'=>$id));

		$kon = $this->m->getData('kontribusi');

		$this->load->library('email');

		$config = array(
			'mailtype'=>"html",
		);

		foreach($user as $u){

			$nama = $u->nama_lengkap;
			$email = $u->email;
		}

		$jumlah=null;

		foreach($kon as $k){

			if($this->input->post('kontribusi') == $k->id){

				$biaya = $k->jumlah;

				$jumlah = 'Rp. '.number_format($k->jumlah,0,',','.');

			}
		}

		$msg = 'fail';

		$invoice = null;$qn=null;$kode=$this->kodeInvoice();$exp=$this->exp_date();
		if($q == true){

			$invoice = array(
				'id'=>$kode,
				'id_payee'=>$id,
				'nama_payee'=>$nama,
				'jumlah'=>$biaya,
				'exp_date'=>$exp,
				'stat'=>'Pending'
			);

			$qn = $this->m->insert('invoice',$invoice);

			if($qn == true){

				$this->email->initialize($config);
				$this->email->from('no-reply@imaniprimarycare.co.id','Imani Primary Care');
				$this->email->to($email);
				$this->email->subject('(no-reply) Konfirmasi Pembayaran');
				$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						
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
						            <h2>Halo, '.$nama.'. Berikut adalah keterangan invoice kamu mengenai kontribusi yang kamu masukkan di profil</h2>
						            <center>
						            	<table>
						            		<tr>
						            			<td>Nama Lengkap</td>
						            			<td>:</td>
						            			<td>'.$nama.'</td>
						            		</tr>
						            		<tr>
						            			<td>Email</td>
						            			<td>:</td>
						            			<td>'.$email.'</td>
						            		</tr>
						            		<tr>
						            			<td>Jumlah yang harus dibayarkan</td>
						            			<td>:</td>
						            			<td>'.$jumlah.'</td>
						            		</tr>
						            	</table>
						            </center>
						            <h4>Silahkan lakukan pembayaran<br>Nomor Rekening 999001337 Bank BNI SYARIAH A/N PT IMANI PERSADA CEMERLANG</h4>
						            <h5>Link pembayaran dibawah hanya berlaku hingga  tanggal '.$exp.'</h5>
						            <a href="'.base_url().'verifikasi/payment/'.base64_encode($kode).'" type="button" style="background: linear-gradient(to right, #f12711, #f5af19); padding: 5px 5px 5px 5px; display:block; color:white; width:40%; border-radius: 25px;"><h2>Konfirmasi Pembayaran</h2></a>
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

				if($this->email->send()){

					$msg='done';
				}else{

					return $msg;
				}

			}else{

				return $msg;
			}
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function exp_date(){

		$q = $this->m->single('SELECT DATE_ADD(CURDATE(),INTERVAL 3 DAY) AS exp');

		foreach($q as $d){

			$exp = $d->exp;
		}

		return $exp;
	}

	public function kodeInvoice(){

		$kode1 = 'IPCM';

		$q = $this->m->single('SELECT CURDATE()+0 as tanggal');

		$kode2 = rand(100,999);

		foreach($q as $d){

			$now = $d->tanggal;
		}

		$invoice = $kode1.$now.$kode2;

		return $invoice;

	}

	public function invoice(){

		$kode = $this->input->post('kode');

		$foto = $this->uploadBukti($kode);

		$q = $this->m->update('invoice',array('foto'=>$foto),array('id'=>$kode));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function uploadBukti($kode){

		$q = $this->m->where('invoice',array('id'=>$kode));

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/pembayaran/'.$new_name;

		foreach($q as $d){

			$path = './assets/upload/pembayaran/'.$d->foto;
		}

		if(is_file($path)){
			unlink($path);
		}

		move_uploaded_file($_FILES['foto']['tmp_name'], $des);

		$this->resizeImg($new_name,'./assets/upload/pembayaran/');

		return $new_name;
	}

	public function alasanTolak(){

		$id = $this->input->post('id');
		$alasan = $this->input->post('alasan');

		$this->load->library('email');

		$config = array(
			'mailtype'=>"html",
		);

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){

			$email = $d->email;
			$nama = $d->nama_lengkap;
		}

		$this->email->initialize($config);
		$this->email->from('no-reply@imaniprimarycare.co.id','Imani Primary Care');
		$this->email->to($email);
		$this->email->subject('(no-reply) Penolakan Biodata');
		$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						
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
						            <h2>Halo, '.$nama.'. Berikut adalah keterangan invoice kamu mengenai kontribusi yang kamu masukkan di profil</h2>
						            <center>
						            	<h3>'.$alasan.'</h3>
						            </center>
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

		$msg = 'fail';

		if($this->email->send()){

			$qu = $this->m->update('user',array('acc_stat'=>'Denied'),array('id'=>$id));

			if($qu == true){

				$msg = 'done';
			}else{

				return $msg;
			}
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function approve($id){

		$q = $this->m->where('user',array('id'=>$id));

		$kode = $this->nomor_anggota($id);

		$data = array(
			'no_anggota'=>$kode,
			'acc_stat'=>'Approved'
		);

		$ubah = $this->m->update('user',$data,array('id'=>$id));
		$msg = 'fail';
		if($ubah == true){

			$kirim = $this->emailVC($id);

			if($kirim == true){

				$msg = 'done';
			}else{
				return $msg;
			}
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function nomor_anggota($id){

		$q = $this->m->where('user',array('id'=>$id));

		$no = $this->m->single('SELECT count(id) as jumlah from user where no_anggota != ""');

		$nombre = null;

		foreach($q as $d){

			$wilayah = $d->wilayah.'-';
		}

		foreach($no as $n){

			$nomor = $n->jumlah + 1;
		}

		$kode = 'IPC-';

		if($nomor > 0 && $nomor < 10){

			$nombre = '000'.$nomor;
		}else if($nomor > 9 && $nomor < 100){

			$nombre = '00'.$nomor;
		}else if($nomor > 99 && $nomor < 1000){

			$nombre = '0'.$nomor;
		}else if($nomor > 999){

			$nombre = $nomor;
		}

		$id = $kode.$wilayah.$nombre;

		return $id;
	}

	public function emailVC($id){

		$q = $this->m->where('user',array('id'=>$id));

		$this->load->library('email');

		$config = array(
			'mailtype'=>"html",
		);

		foreach($q as $d){

			$nama = $d->nama_lengkap;
			$email = $d->email;
		}

		$this->email->initialize($config);
		$this->email->from('no-reply@imaniprimarycare.co.id','Imani Primary Care');
		$this->email->to($email);
		$this->email->subject('(no-reply) Biodata Diterima');

		$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					
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
					            <h2>Halo, '.$nama.'. Biodata mu sudah di verifikasi oleh admin. Kartu Anggotamu sudah dapat di download pada halaman Virtual Card ^^.</h2>
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

		if($this->email->send()){

			return 'done';
		}else{

			return 'fail';
		}
	}

	public function sembunyikan($id){

		$q = $this->m->update('user',array('acc_stat'=>'Hidden'),array('id'=>$id));

		if($q == true){

			echo json_encode('done');
		}else{

			echo json_encode('fail');
		}
	}

	public function memberStat($id,$arr){

		$msg = "fail";

		$level = 1;
		if($arr == 'User'){

			$level = 2;
		}

		$q = $this->m->update('user',array('level'=>$level),array('id'=>$id));

		if($q == true){

			$msg = "done";
		}

		echo json_encode($msg);
	}

	/*Front End Data*/

	public function newSlider(){

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/slider/'.$new_name;

		move_uploaded_file($_FILES['foto']['tmp_name'], $des);

		$this->resizeImg($new_name,'./assets/upload/slider/');

		$data = array(
			'foto'=>$new_name,
			'judul'=>$this->input->post('judul'),
			'desc'=>$this->input->post('desc'),
			'link'=>$this->input->post('link')
		);

		$msg = 'fail';

		$q = $this->m->insert('slider',$data);

		if($q == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function editSliderImg(){

		$id = $this->input->post('id');

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/slider/'.$new_name;

		$q = $this->m->where('slider',array('id'=>$id));

		$msg = 'fail';

		foreach($q as $d){
			$path = './assets/upload/slider/'.$d->foto;
		}

		if(is_file($path)){
			unlink($path);
		}

		move_uploaded_file($_FILES['foto']['tmp_name'], $des);

		$this->resizeImg($new_name,'./assets/upload/slider/');

		$qu = $this->m->update('slider',array('foto'=>$new_name),array('id'=>$id));

		if($qu == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function editSliderInfo(){

		$id = $this->input->post('id');

		$q = $this->m->update('slider',array('judul'=>$this->input->post('judul'),'desc'=>$this->input->post('desc'),'link'=>$this->input->post('link')),array('id'=>$id));

		$msg = 'fail';


		if($q == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);

	}

	public function sliderstat($arr,$id){

		$msg = 'fail';

		$q = $this->m->update('slider',array('stat'=>$arr),array('id'=>$id));

		if($q == true){

			$msg = 'done';
		}else{

			return $msg;
		}

		echo json_encode($msg);
	}

	public function newAbout(){

		$q = $this->m->insert('about',array('konten'=>$this->input->post('konten')));
		$msg = 'fail';
		if($q == true){
			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function editAbout(){

		$q = $this->m->update('about',array('konten'=>$this->input->post('konten')),array('id'=>$this->input->post('id')));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function aboutStat($arr,$id){

		$msg = 'fail';$q = null;$cek = null;

		if($arr == 'Hidden'){

			$q = $this->m->update('about',array('stat'=>$arr),array('id'=>$id));

			if($q == true){

				$msg = 'done';
			}
		}else{

			$cek = $this->m->where('about',array('stat'=>$arr));

			if(count($cek) > 0){

				$this->m->update('about',array('stat'=>'Hidden'),array('stat'=>$arr));
			}

			$q = $this->m->update('about',array('stat'=>$arr),array('id'=>$id));

			if($q == true){

				$msg = 'done';
			}
		}

		echo json_encode($msg);
	}

	public function newProduk(){

		$kode = $this->kode_produk();

		$data = array(
			'kode_produk'=>$kode,
			'nama_produk'=>$this->input->post('nama'),
			'harga'=>$this->input->post('harga'),
			'desc'=>$this->input->post('desc')
		);

		$q = $this->m->insert('produk',$data);

		$msg = 'fail';

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/produk/'.$new_name;

		if($q == true){

			move_uploaded_file($_FILES['foto']['tmp_name'], $des);

			$this->resizeImg($new_name,'./assets/upload/produk/');

			$q = $this->m->insert('galeri_produk',array('kode_produk'=>$kode,'foto'=>$new_name));

			if($q == true){

				$msg = 'done';

			}
		}

		echo json_encode($msg);
	}

	public function kode_produk(){

		$cek = $this->m->single('SELECT count(id) as jumlah from produk');

		foreach($cek as $c){

			$jml = $c->jumlah + 1;

			$norut = null;
		}

		if($jml > 0 && $jml < 10){

			$norut = "P000".$jml;
		}else if($jml > 9 && $jml < 100){

			$norut = "P00".$jml;
		}else if($jml > 99 && $jml < 1000){

			$norut = "P0".$jml;
		}else if($jml > 999){

			$norut = "P".$jml;
		}

		return $norut;
	}

	public function produkEdit(){

		$q = $this->m->update('produk',array('nama_produk'=>$this->input->post('nama'),'harga'=>$this->input->post('harga'),'desc'=>$this->input->post('desc')),array('kode_produk'=>$this->input->post('kode')));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function produkStat($arr,$id){

		$q = $this->m->update('produk',array('stat'=>$arr),array('kode_produk'=>$id));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function newPlus(){

		$q = $this->m->insert('keunggulan',array('konten'=>$this->input->post('desc')));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function plusEdit(){

		$q = $this->m->update('keunggulan',array('konten'=>$this->input->post('desc'),'link'=>$this->input->post('link')),array('id'=>$this->input->post('id')));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function plusStat($arr,$id){

		if($arr == 'Show'){

			$cek = $this->m->where('keunggulan',array('stat'=>$arr));

			if(count($cek) > 0){

				$this->m->update('keunggulan',array('stat'=>'Hidden'),array('stat'=>$arr));
			}
		}

		$q = $this->m->update('keunggulan',array('stat'=>$arr),array('id'=>$id));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function newGaleri(){

		$data = array(
			'foto'=>$this->uploadGaleri(),
			'stat'=>'Unset'
		);

		$q = $this->m->insert('galeri',$data);
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function galeriEdit(){

		$id = $this->input->post('id');

		$cek = $this->m->where('galeri',array('id'=>$id));

		foreach($cek as $c){
			$path = './assets/upload/galeri/'.$c->foto;
		}

		if(is_file($path)){

			unlink($path);
		}

		$data = array(
			'foto'=>$this->uploadGaleri()
		);

		$q = $this->m->update('galeri',$data,array('id'=>$id));
		$msg = 'fail';
		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function galeriStat($id,$arr){

		$msg = 'fail';

		$q = $this->m->update('galeri',array('stat'=>$arr),array('id'=>$id));

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function uploadGaleri(){

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/galeri/'.$new_name;

		move_uploaded_file($_FILES['foto']['tmp_name'],$des);

		$this->resizeImg($new_name,'./assets/upload/galeri/');

		return $new_name;
	}
	
	public function newTesti(){
	    
	    $foto = $this->uploadTesti();
	    
	    $data = array(
	        'foto'=>$foto,
	        'nama'=>$this->input->post('nama'),
			'testi'=>$this->input->post('desc'),
			'kontak'=>$this->input->post('kontak'),
	        'stat'=>'Unset'
	    );
	    
	    $q = $this->m->insert('testimoni',$data);
	    $msg = 'fail';
	    if($q == true){
	        
	        $msg = 'done';
	    }
	    
	    echo json_encode($msg);
	}
	
	public function editTesti(){
	    
	    $id = $this->input->post('id');
	    
	    $data = array(
	        'nama'=>$this->input->post('nama'),
	        'testi'=>$this->input->post('desc'),
	        'kontak'=>$this->input->post('kontak')
	        );
	    
	    $q = $this->m->update('testimoni',$data,array('id'=>$id));
	    
	    $msg = 'fail';
	    
	    if($q == true){
	        
	        $msg = 'done';
	    }
	    
	    echo json_encode($msg);
	}
	
    public function editTestiImg(){
        
        $id = $this->input->post('id');
        
        $cek = $this->m->where('testimoni',array('id'=>$id));
        
        foreach($cek as $c){
			$path = './assets/upload/jejaring/'.$c->foto;
		}

		if(is_file($path)){

			unlink($path);
		}
		
		$foto = $this->uploadTesti();
		
		$q = $this->m->update('testimoni',array('foto'=>$foto),array('id'=>$id));
		
		$msg = 'fail';
		
		if($q == true){
		    
		    $msg = 'done';
		}
		
		echo json_encode($msg);
    }
    
    public function jejaringStat($arr,$id){
        
        $msg = 'fail';
        
        $q = $this->m->update('testimoni',array('stat'=>$arr),array('id'=>$id));
        
        if($q == true){
            
            $msg = 'done';
        }
        
        echo json_encode($msg);
    }
	
	public function uploadTesti(){
	    
	    $new_name= $_FILES['foto']['name'];
		$des = './assets/upload/jejaring/'.$new_name;

		move_uploaded_file($_FILES['foto']['tmp_name'],$des);

		$this->resizeImg($new_name,'./assets/upload/jejaring/');

		return $new_name;
	}
	
	/*Marketting*/
	
	public function newMarket(){
	    
	    $msg = 'fail';
	    
	    $data = array(
	        'banner'=>$this->upload_banner(),
	        'nama'=>$this->input->post('nama'),
	        'descr'=>$this->input->post('desc'),
	        'file'=>$this->upload_attach(),
	        'stat'=>'Unset'
	        );
	        
	   $q = $this->m->insert('marketing_tools',$data);
	   
	   if($q == true){
	       
	       $msg = 'done';
	   }
	   
	   echo json_encode($msg);
	}

	public function editBanner(){

		$id = $this->input->post('id');

		$cek = $this->m->where('marketing_tools',array('id'=>$id));

		foreach($cek as $c){

			$path = './assets/upload/banner/'.$c->banner;
		}

		if(is_file($path)){

			unlink($path);
		}

		$banner = $this->upload_banner();

		$q = $this->m->update('marketing_tools',array('banner'=>$banner),array('id'=>$id));

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}
	
	public function upload_banner(){
	    
	    $new_name= $_FILES['banner']['name'];
		$des = './assets/upload/banner/'.$new_name;

		move_uploaded_file($_FILES['banner']['tmp_name'],$des);

		$this->resizeImg($new_name,'./assets/upload/banner/');

		return $new_name;
	}


	public function editAttach(){

		$id = $this->input->post('id');

		$cek = $this->m->where('marketing_tools',array('id'=>$id));

		foreach($cek as $c){

			$path = './assets/upload/attach/'.$c->file;
		}

		if(is_file($path)){

			unlink($path);
		}

		$filee = $this->upload_attach();

		$q = $this->m->update('marketing_tools',array('file'=>$filee),array('id'=>$id));

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}
	
	public function upload_attach(){
	    
	    $new_name= $_FILES['attach']['name'];
		$des = './assets/upload/attach/'.$new_name;

		move_uploaded_file($_FILES['attach']['tmp_name'],$des);

		return $new_name;
	}

	public function marketingStat($arr,$id){

		$msg = 'fail';

		$q = $this->m->update('marketing_tools',array('stat'=>$arr),array('id'=>$id));

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function editMarket(){

		$id = $this->input->post('id');

		$data = array(
			'nama'=>$this->input->post('nama'),
			'descr'=>$this->input->post('desc')
		);

		$msg = 'fail';

		$q = $this->m->update('marketing_tools',$data,array('id'=>$id));

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	// Tim
	
	public function newTim(){

		$data = array(
			'nama'=>$this->input->post('nama'),
			'jabatan'=>$this->input->post('jabatan'),
			'fb'=>$this->input->post('fb'),
			'link'=>$this->input->post('link'),
			'ig'=>$this->input->post('ig'),
			'foto'=>$this->upload_fotoTim()
		);

		$q = $this->m->insert('tim',$data);

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function editTim(){

		$data = array(
			'nama'=>$this->input->post('nama'),
			'jabatan'=>$this->input->post('jabatan'),
			'fb'=>$this->input->post('fb'),
			'link'=>$this->input->post('link'),
			'ig'=>$this->input->post('ig')
		);

		$q = $this->m->update('tim',$data,array('id'=>$this->input->post('id')));

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function editFotoTim(){

		$cek = $this->m->where('tim',array('id'=>$this->input->post('id')));

		foreach($cek as $c){

			$path = './assets/upload/fotoTim/'.$c->foto;
		}

		if(is_file($path)){

			unlink($path);
		}

		$filee = $this->upload_fotoTim();

		$q = $this->m->update('tim',array('foto'=>$filee),array('id'=>$this->input->post('id')));
		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function upload_fotoTim(){

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/fotoTim/'.$new_name;

		move_uploaded_file($_FILES['foto']['tmp_name'],$des);

		$this->resizeImg($new_name,'./assets/upload/fotoTim/');

		return $new_name;
	}

	public function timStat($id,$arr){

		$msg = 'fail';

		$q = $this->m->update('tim',array('stat'=>$arr),array('id'=>$id));

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	/*Artikel*/

	public function newBlog(){

		$data = array(
			'judul'=>$this->input->post('judul'),
			'desc'=>$this->input->post('desc'),
			'tanggal'=>$this->input->post('tanggal')
		);

		$q = $this->m->insert('artikel',$data);

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function editBlog(){

		$data = array(
			'judul'=>$this->input->post('judul'),
			'desc'=>$this->input->post('desc'),
			'tanggal'=>$this->input->post('tanggal')
		);

		$id = $this->input->post('id');

		$q = $this->m->update('artikel',$data,array('id'=>$id));

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function editFotoArtikel(){

		$id = $this->input->post('id');

		$q = $this->m->where('artikel',array('id'=>$id));

		foreach($q as $d){

			$path = './assets/upload/artikel/'.$d->foto;
		}

		if(is_file($path))
		{
			unlink($path);
		}

		$newFoto = $this->upload_artikel();

		$qu = $this->m->update('artikel',array('foto'=>$newFoto),array('id'=>$id));

		$msg = 'fail';

		if($qu == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function upload_artikel(){

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/artikel/'.$new_name;

		move_uploaded_file($_FILES['foto']['tmp_name'],$des);

		$this->resizeImg($new_name,'./assets/upload/artikel/');

		return $new_name;
	}

	public function blogStat($arr,$id){

		$msg = 'fail';

		$q = $this->m->update('artikel',array('stat'=>$arr),array('id'=>$id));

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	// Artikel
	
	public function newPelatihan()
	{
		$id = $this->idPelatihan();
		$data = array(
			'id_pelatihan'=>$id,
			'nama'=>$this->input->post('nama'),
			'lokasi'=>$this->input->post('lokasi'),
			'waktu'=>$this->input->post('waktu'),
			'harga'=>$this->input->post('harga'),
			'kuota'=>$this->input->post('kuota'),
			'desc'=>$this->input->post('desc'),
			'foto'=>$this->uploadPelatihan()
		);

		$q = $this->m->insert('pelatihan',$data);

		$msg = 'fail';

		if($q =- true){
			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function editPelatihan()
	{
		$id = $this->input->post('id');

		$data = array(
			'nama'=>$this->input->post('nama'),
			'lokasi'=>$this->input->post('lokasi'),
			'waktu'=>$this->input->post('waktu'),
			'harga'=>$this->input->post('harga'),
			'kuota'=>$this->input->post('kuota'),
			'desc'=>$this->input->post('desc')
		);

		$q = $this->m->update('pelatihan',$data,array('id'=>$id));

		$msg = 'fail';

		if($q =- true){
			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function idPelatihan(){

		$cek = $this->m->single('SELECT count(id) as jml from pelatihan');

		foreach($cek as $c){

			$norut = $c->jml+1;
		}

		$kode = null;

		if($norut < 10){

			$kode = 'T000'.$norut;
		}else if($norut > 9 & $no < 100){

			$kode = 'T00'.$norut;
		}else if($norut > 100 && $no < 999){

			$kode = 'T0'.$norut;
		}else if($norut > 1000){
			$kode = 'T'.$norut;
		}

		return $kode;
	}

	public function uploadPelatihan(){

		$new_name= $_FILES['foto']['name'];
		$des = './assets/upload/pelatihan/'.$new_name;

		move_uploaded_file($_FILES['foto']['tmp_name'],$des);

		$this->resizeImg($new_name,'./assets/upload/pelatihan/');

		return $new_name;
	}

	public function pelatihanStat($arr,$id){

		$q = $this->m->update('pelatihan',array('stat'=>$arr),array('id'=>$id));

		$msg = 'fail';

		if($q == true){

			$msg = 'done';
		}

		echo json_encode($msg);
	}

	public function resizeImg($file,$path){

		$sp = $path.$file;
		$config = array(
			"image_library" => "gd2",
			"source_image" => $sp,
			"new_image" => $path,
			"maintain_ratio" => TRUE,
			"width" => "500"
		);

		$this->load->library('image_lib');

		$this->image_lib->initialize($config);

		$this->image_lib->resize();

		$this->image_lib->clear();
	}
}

?>