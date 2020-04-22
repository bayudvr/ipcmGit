<?php defined('BASEPATH') or exit('No direct script allowed');

class Form extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
	}

	public function auth($arr){


		if($arr == 'login'){

			$arr = "'regis'";

			$data = '
			<h3>Login</h3><hr>
			<form id="loginForm" method="POST">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Email..." required>
					</div>
					<div class="form-group">
						<label for="pass">Password</label>
						<input type="password" name="pass" id="pass" class="form-control" placeholder="Password..." required>
					</div>
					<div class="form-group">
						<center>
							<button type="submit" class="btn btn-outline-success btn-lg mt-3">Login <i class="fas fa-fw fa-sign-in-alt"></i></button>
						</center>
					</div>
				</form>
				<p class="pt-3">Belum punya akun? Klik <a onclick="login('.$arr.');" href="#" style="color:blue;">Di sini</a> untuk mendaftar</p>
			';
		}else if($arr == 'regis'){

			$arr = "'regis'";

			$data='
			<h3>Registrasi</h3><hr>
		<form id="regisForm" method="POST">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="Email..." required>
				</div>
				<div class="form-group">
					<label for="pass">Password</label>
					<input type="password" name="pass" id="pass" class="form-control" placeholder="Password..." required>
				</div>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" required>
					<div id="infoPass"></div>
				</div>
				<div class="form-group">
					<center>
						<button type="submit" class="btn btn-outline-info btn-lg mt-1">Daftar <i class="fas fa-fw fa-sign-in-alt"></i></button>
					</center>
				</div>
			</form>
			<p class="pt-1">Sudah punya akun? Klik <a onclick="daftar('.$arr.');" href="#" style="color:blue;">Di sini</a> untuk login</p>
		';
		}

		echo json_encode($data);
	}

	public function editProfil($id){

		$q = $this->m->where('user',array('id'=>$id));
		$wilayah = $this->m->getData('tb_wilayah');

		$data='';

		foreach($q as $d){

			$data.= '<center>
				<h3>Edit Profil</h3><hr>
			</center>
			<form id="loginForm" method="POST">
				<input type="hidden" name="id" id="id" value="'.$d->id.'" required>
				<div class="form-group">
					<img src="'.base_url().'assets/upload/fotoDiri/'.$d->pas_foto.'" alt="Foto Diri" width="100" height="100" class="mr-2">
					<img src="'.base_url().'assets/upload/fotoKlinik/'.$d->foto_klinik.'" alt="Foto Klinik" width="100" height="100">
				</div>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap..." value="'.$d->nama_lengkap.'" required>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="Email..." value="'.$d->email.'" readonly>
				</div>
				<div class="form-group">
					<label for="pass">Password</label>
					<input type="text" name="pass" id="pass" class="form-control" placeholder="Password..." value="'.$d->password_md5.'" readonly>
				</div>
				<div class="form-group">
					<label for="jk">Jenis Kelamin</label>
					<select name="jk" id="jk" class="form-control" required>';
	if($d->jenis_kelamin == "Laki-laki"){
		$data.= '<option value="">=PILIH=</option>
						<option value="Laki-laki" selected>Laki-laki</option>
						<option value="Perempuan">Perempuan</option>';
	}else if($d->jenis_kelamin == "Perempuan"){
		$data.= '<option value="">=PILIH=</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan" selected>Perempuan</option>';
	}else{

		$data.= '<option value="">=PILIH=</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>';
	}
	$data.=			'</select>
				</div>
				<div class="form-group">
					<label for="wilayah">Wilayah Asal</label>
					<div class="row">
						<select name="wilayah" id="wilayah" class="col-md-3 mr-5 form-control" onchange="getKotkab();">
							<option value="">=PILIH=</option>';
	foreach($wilayah as $w){
		if($d->wilayah == $w->id_wilayah){
			$data.='<option value="'.$w->id_wilayah.'" selected>'.$w->nama_wilayah.'</option>';
		}else{
			$data.='<option value="'.$w->id_wilayah.'">'.$w->nama_wilayah.'</option>';
		}
	}
	$data.=					'</select>
						<select name="kotkab" id="kotkab" class="col-md-3 mr-5 form-control">
							<option value="">PILIH</option>
						</select>
						<select name="kecamatan" id="kecamatan" class="col-md-3 form-control">
							<option value="">PILIH</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="pendidikan">Pendidikan Terakhir</label>
					<input type="text" name="pendidikan" id="pendidikan" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="institusi">Institusi</label>
					<input type="text" name="institusi" id="institusi" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="alamat_institusi">Alamat Institusi</label>
					<textarea name="alamat_institusi" id="alamat_institusi" class="form-control" rows="5" required></textarea>
				</div>
				<div class="form-group">
					<label for="telp">No. Telepon</label>
					<input type="number" name="telp" id="telp" pattern="^[0–9]$" class="form-control">
				</div>
				<div class="form-group">
					<label for="hp">No. Handphone</label>
					<input type="number" name="hp" id="hp" pattern="^[0–9]$" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="kontribusi">Kontribusi</label>
					<select name="kontribusi">
						<option value="">PILIH</option>
					</select>
				</div>
				<div class="form-group">
					<label for="level">Level</label>
					<select name="level" id="level">
						<option value=""></option>
						<option value="1">ADMIN</option>
						<option value="2">MEMBER</option>
					</select>
				</div>
				<div class="form-group">
					<center>
						<button type="submit" class="btn btn-outline-success btn-lg mt-3">Edit <i class="fas fa-fw fa-edit"></i></button>
					</center>
				</div>
			</form>';
		}

		echo json_encode($data);
	}

	public function profilEdit($id){

		$q = $this->m->where('user',array('id'=>$id));
		$wilayah = $this->m->getData('tb_wilayah');
		$kontribusi = $this->m->getData('kontribusi');

		$data='';

		foreach($q as $d){

			$data.= '<center>
				<h3>Edit Profil</h3><hr>
			</center>
			<button type="button" onclick="loadProfil();" class="btn btn-outline-primary mb-4"><i class="fas fa-fw fa-chevron-left"></i> Back</button>
			<form id="editForm" method="POST">
				<div class="form-group">
					<label for="nama">Nama Lengkap</label>
					<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap..." value="'.$d->nama_lengkap.'" required>
				</div>
				<div class="form-group">
					<label for="nama_klinik">Nama Klinik</label>
					<input type="text" name="nama_klinik" id="nama_klinik" class="form-control" placeholder="Nama Klinik..." value="'.$d->nama_klinik.'" required>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control" placeholder="Email..." value="'.$d->email.'" readonly>
				</div>
				<div class="form-group">
					<label for="pass">Password</label>
					<input type="text" name="pass" id="pass" class="form-control" placeholder="Password..." value="'.$d->password_md5.'" readonly>
				</div>
				<div class="form-group">
					<label for="alamat_tinggal">Alamat Tinggal</label>
					<textarea name="alamat_tinggal" id="alamat_tinggal" class="form-control" rows="5" placeholder="Alamat..." required>'.$d->alamat_tinggal.'</textarea>
				</div>
				<div class="form-group">
					<label for="jk">Jenis Kelamin</label>
					<select name="jk" id="jk" class="form-control" required>';
	if($d->jenis_kelamin == "Laki-laki"){
		$data.= '<option value="">=PILIH=</option>
						<option value="Laki-laki" selected>Laki-laki</option>
						<option value="Perempuan">Perempuan</option>';
	}else if($d->jenis_kelamin == "Perempuan"){
		$data.= '<option value="">=PILIH=</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan" selected>Perempuan</option>';
	}else{

		$data.= '<option value="">=PILIH=</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>';
	}
	$data.=			'</select>
				</div>
				<div class="form-group">
					<label for="wilayah">Wilayah Asal</label>
					<div class="row">
						<select name="wilayah" id="wilayah" class="col-md-3 mr-5 form-control" onchange="getKotkab();">
							<option value="">=PILIH=</option>';
	foreach($wilayah as $w){
		if($d->wilayah == $w->id_wilayah){
			$data.='<option value="'.$w->id_wilayah.'" selected>'.$w->nama_wilayah.'</option>';
		}else{
			$data.='<option value="'.$w->id_wilayah.'">'.$w->nama_wilayah.'</option>';
		}
	}
	$data.=					'</select>
						<select name="kotkab" id="kotkab" class="col-md-3 mr-5 form-control" onchange="getKec();">
							<option value="">PILIH</option>
						</select>
						<select name="kecamatan" id="kecamatan" class="col-md-3 form-control">
							<option value="">PILIH</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="pendidikan">Pendidikan Terakhir</label>
					<input type="text" name="pendidikan" placeholder="Isi..." id="pendidikan" class="form-control" value="'.$d->pendidikan_terakhir.'" required>
				</div>
				<div class="form-group">
					<label for="institusi">Institusi</label>
					<input type="text" name="institusi" id="institusi" class="form-control" placeholder="Institusi..." value="'.$d->institusi.'" required>
				</div>
				<div class="form-group">
					<label for="alamat_institusi">Alamat Institusi</label>
					<textarea name="alamat_institusi" id="alamat_institusi" class="form-control" rows="5" placeholder="Alamat..." required>'.$d->alamat_institusi.'</textarea>
				</div>
				<div class="form-group">
					<label for="telp">No. Telepon</label>
					<input type="number" placeholder="xxxxxxxxxxxx" name="telp" id="telp" pattern="^[0–9]$" value="'.$d->no_telp.'" class="form-control">
				</div>
				<div class="form-group">
					<label for="hp">No. Handphone</label>
					<input type="number" placeholder="xxxxxxxxxxxx" name="hp" id="hp" pattern="^[0–9]$" class="form-control" value="'.$d->no_hp.'" required>
				</div>
				<div class="form-group">
					<center>
						<button type="submit" class="btn btn-outline-success btn-lg mt-3">Edit <i class="fas fa-fw fa-edit"></i></button>
					</center>
				</div>
			</form>';
		}

		echo json_encode($data);
	}

	public function pasFoto(){

		$id = $this->session->userdata('id');

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){

			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
			<form id="pasFoto" method="POST" enctype="multipart/form-data">
				<center>
					<div class="form-group">';
					if($d->pas_foto != ''){
						$data.='<img src="'.base_url().'assets/upload/fotoDiri/'.$d->pas_foto.'" alt="Pas Foto" width="100" height="100">';
					}else{
						$data.='<h2>Belum Mengupload Foto</h2>';
					}
					$data.='</div>
					<div class="form-group mt-5">
					<p>Masukkan File Foto</p>
					<input type="file" name="foto" onchange="cekFoto();" id="foto" class="form-control" required>
					</div>
					<div class="form-group mt-3">
						<button type="submit" class="btn btn-outline-success">Upload <i class="fas fa-fw fa-upload"></i></button>
					</div>
				</center>
			</form>';
		}

		echo json_encode($data);
	}

	public function formLogo(){

		$id = $this->session->userdata('id');

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){

			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
			<form id="logoKlinik" method="POST" enctype="multipart/form-data">
				<center>
					<div class="form-group">';
					if($d->foto_klinik != ''){
						$data.='<img src="'.base_url().'assets/upload/logoKlinik/'.$d->foto_klinik.'" alt="logoKlinik" width="100" height="100">';
					}else{
						$data.='<h2>Belum Mengupload Logo Klinik</h2>';
					}
					$data.='</div>
					<div class="form-group mt-5">
					<p>Masukkan File Foto</p>
					<input type="file" onchange="cekFoto();" name="foto" id="foto" class="form-control" required>
					</div>
					<div class="form-group mt-3">
						<button type="submit" class="btn btn-outline-success">Upload <i class="fas fa-fw fa-upload"></i></button>
					</div>
				</center>
			</form>';
		}

		echo json_encode($data);
	}

	public function penolakan($id){

		$q = $this->m->where('user',array('id'=>$id));

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
			<form id="penolakan" method="POST">
				<center>
					<div class="form-group mt-5">
					<p>Masukkan Alasan penolakan untuk user ['.$d->nama_lengkap.']</p>
					<input type="hidden" name="id" id="id" value="'.$d->id.'" readonly>
					<textarea class="form-control" rows="5" name="alasan" id="alasan" placeholder="Alasan penolakan..." required></textarea>
					</div>
					<div class="form-group mt-3">
						<button type="submit" class="btn btn-outline-success">Kirim <i class="fas fa-fw fa-paper-plane"></i></button>
					</div>
				</center>
			</form>';
		}

		echo json_encode($data);
	}

	public function formKontribusi(){

		$id = $this->session->userdata('id');

		$q = $this->m->where('user',array('id'=>$id));

		$kon = $this->m->getData('kontribusi');

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="formKontribusi" method="POST" class="mt-5">
					<center>
						<div class="form-group row">
							<label for="kontribusi" class="label-control col-md-3">Kontribusi</label>
							<select class="form-control col-md-9" name="kontribusi" id="kontribusi" required>
								<option value="">PILIH</option>';
				
			foreach($kon as $k){
				if($d->kontribusi == $k->id){
					$data.='<option value="'.$k->id.'" selected>Rp. '.number_format($k->jumlah,0,",",".").'</option>';
				}else{
					$data.='<option value="'.$k->id.'">Rp. '.number_format($k->jumlah,0,",",".").'</option>';
				}
			}
			$data.=			'</select>
						</div>
						<div class="form-group mt-3">
							<button type="submit" class="btn btn-outline-success">Ubah <i class="fas fa-fw fa-edit"></i></button>
						</div>
					</center>
				</form>';
		}

		echo json_encode($data);
	}
	
	/*Market*/
	
	public function editMarket($id){
				
		$q = $this->m->where('marketing_tools',array('id'=>$id));
		
		foreach($q as $d){
		    
		    $data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
    				<form id="editForm" enctype="multipart/form-data" method="POST" class="mt-5">
    				<input type="hidden" name="id" id="id" value="'.$id.'">
    				    <center>
    				        <div class="form-group">
    				            <label class="label-control col-md-3"for="nama">Nama</label>
    				            <input type="text" placeholder="Nama marketing tool" name="nama" id="nama" value="'.$d->nama.'" class="form-control col-md-9" />
    				        </div>
    				        <div class="form-group">
    				            <label class="label-control col-md-3">Deskripsi</label>
    				            <textarea class="form-control" placeholder="Penejelasan marketing tools" name="desc" id="desc">'.$d->descr.'</textarea>
    				        </div>
    				        <div class="form-group">
    				            <button class="btn btn-outline-success" type="submit"><i class="fas fa-fw fa-save"></i> Simpan</button>
    				        </div>
    				    </center>
    				</form>';
		}
		echo json_encode($data);
	}
	
	public function newMarket(){
	    
	    $data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
				    <center>
				        <div class="form-group">
				            <label class="label-control col-md-3"for="nama">Nama</label>
				            <input type="text" placeholder="Nama marketing tool" name="nama" id="nama" class="form-control col-md-9" />
				        </div>
				        <div class="form-group">
				            <label class="label-control col-md-3">Deskripsi</label>
				            <textarea class="form-control" placeholder="Penejelasan marketing tools" name="desc" id="desc"></textarea>
				        </div>
				        <div class="form-group">
				            <label class="label-control col-md-3">Banner</label>
				            <input type="file" name="banner" id="banner" class="form-control col-md-9" required/>
				        </div>
				        <div class="form-group">
				            <label class="label-control col-md-3">Attachment</label>
				            <input name="attach" id="attach" type="file" class="form-control col-md-9" required/>
				        </div>
				        <div class="form-group">
				            <button class="btn btn-outline-success" type="submit"><i class="fas fa-fw fa-save"></i> Simpan</button>
				        </div>
				    </center>
				</form>';
				
		echo json_encode($data);
	}

	public function attachEdit($id){

		$q = $this->m->where('marketing_tools',array('id'=>$id));

		foreach($q as $d){
			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
    				<form id="editAttach" enctype="multipart/form-data" method="POST" class="mt-5">
    				<input type="hidden" name="id" id="id" value="'.$id.'">
    				    <center>
    				    	<div class="form-group">
    				    		<h2 clas="label-control">'.$d->file.'</h2>
    				    	</div>
    				        <div class="form-group">
    				            <label class="label-control col-md-3"for="attach">Attachment</label>
    				            <input type="file" placeholder="Nama marketing tool" name="attach" onchange="cekAttach();" id="attach" class="form-control col-md-9" />
    				        </div>
    				        <div class="form-group">
    				            <button class="btn btn-outline-success" type="submit" id="savebtn" disabled><i class="fas fa-fw fa-save"></i> Simpan</button>
    				        </div>
    				    </center>
    				</form>';
		}

		echo json_encode($data);
	}

	public function bannerEdit($id){

		$q = $this->m->where('marketing_tools',array('id'=>$id));

		foreach($q as $d){
			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
    				<form id="editBanner" enctype="multipart/form-data" method="POST" class="mt-5">
    				<input type="hidden" name="id" id="id" value="'.$id.'">
    				    <center>
    				    	<div class="form-group">
    				    		<img src="'.base_url().'assets/upload/banner/'.$d->banner.'" width="100" height="100" />
    				    	</div>
    				        <div class="form-group">
    				            <label class="label-control col-md-3"for="banner">Banner</label>
    				            <input type="file" placeholder="Nama marketing tool" name="banner" onchange="cekBanner();" id="banner" class="form-control col-md-9" />
    				        </div>
    				        <div class="form-group">
    				            <button class="btn btn-outline-success" type="submit" id="savebtn" disabled><i class="fas fa-fw fa-save"></i> Simpan</button>
    				        </div>
    				    </center>
    				</form>';
		}
		echo json_encode($data);
	}
	
	/*Slider*/

	public function newSlider(){

		$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<center>
						<div class="form-group row">
							<label for="foto"class="label-control col-md-3">Foto</label>
							<input type="file" id="foto" name="foto" class="form-control col-md-9" onchange="cekFoto();" />
						</div>
						<div class="form-group row">
							<label for="judul"class="label-control col-md-3">Judul</label>
							<input type="text" id="judul" name="judul" class="form-control col-md-9" placeholder="Judul foto..." />
						</div>
						<div class="form-group row">
							<label for="desc"class="label-control col-md-3">Deskripsi</label>
							<textarea name="desc" id="desc" class="form-control col-md-9" rows="5" placeholder="Deskripsi Foto"></textarea>
						</div>
						<div class="form-group row">
							<label for="link"class="label-control col-md-3">Link</label>
							<input type="text" id="link" name="link" class="form-control col-md-9" placeholder="cth: facebuk.com" />
						</div>
						<div class="form-group mt-3">
							<button type="submit" id="submitBtn" class="btn btn-outline-success">Upload <i class="fas fa-fw fa-upload"></i></button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
	}

	public function sliderImg($id){

		$q = $this->m->where('slider',array('id'=>$id));

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
					<form id="imgForm" enctype="multipart/form-data" method="POST" class="mt-5">
						<input type="hidden" name="id" id="id" value="'.$d->id.'" readonly>
						<center>
							<div class="form-group row">
								<label for="foto"class="label-control col-md-3">Foto</label>
								<img src="'.base_url().'assets/upload/slider/'.$d->foto.'" width="300" height="150" alt="">
								<input type="file" id="foto" name="foto" class="form-control col-md-9" onchange="cekFoto();" />
							</div>
							<div class="form-group mt-3">
								<button type="submit" id="submitBtn" class="btn btn-outline-success">Simpan <i class="fas fa-fw fa-save"></i></button>
							</div>
						</center>
					</form>';
		}

		echo json_encode($data);
	}

	public function sliderEdit($id){

		$q = $this->m->where('slider',array('id'=>$id));

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="editForm" method="POST" class="mt-5">
					<input type="hidden" name="id" id="id" value="'.$d->id.'" readonly>
					<center>
						<div class="form-group row">
							<label for="judul"class="label-control col-md-3">Judul</label>
							<input type="text" id="judul" name="judul" class="form-control col-md-9" placeholder="Judul foto..." value="'.$d->judul.'" />
						</div>
						<div class="form-group row">
							<label for="desc"class="label-control col-md-3">Deskripsi</label>
							<textarea name="desc" id="desc" class="form-control col-md-9" rows="5" placeholder="Deskripsi Foto">'.$d->desc.'</textarea>
						</div>
						<div class="form-group row">
							<label for="link"class="label-control col-md-3">Link</label>
							<input type="text" id="link" name="link" class="form-control col-md-9" placeholder="cth: facebuk.com" value="'.$d->link.'" />
						</div>
						<div class="form-group mt-3">
							<button type="submit" id="submitBtn" class="btn btn-outline-success">Simpan <i class="fas fa-fw fa-save"></i></button>
						</div>
					</center>
				</form>';
		}

		echo json_encode($data);
	}

	public function newAbout(){

		$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<center>
						<div class="form-group">
							<label for="konten"class="label-control">Teks Konten</label>
							<textarea name="konten" id="konten" class="form-control" rows="10" placeholder="Teks Konten..."></textarea>
						</div>
						<div class="form-group mt-3">
							<button type="submit" id="submitBtn" class="btn btn-outline-success">Upload <i class="fas fa-fw fa-upload"></i></button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
	}

	public function aboutEdit($id){

		$q = $this->m->where('about',array('id'=>$id));

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="editForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<input type="hidden" name="id" id="id" value="'.$d->id.'">
					<center>
						<div class="form-group">
							<label for="konten"class="label-control">Teks Konten</label>
							<textarea name="konten" id="konten" class="form-control" rows="10" placeholder="Teks Konten...">'.$d->konten.'</textarea>
						</div>
						<div class="form-group mt-3">
							<button type="submit" id="submitBtn" class="btn btn-outline-success">Simpan <i class="fas fa-fw fa-save"></i></button>
						</div>
					</center>
				</form>';
		}

		echo json_encode($data);
	}

	public function newProduk(){

		$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<center>
						<div class="form-group row">
							<label for="nama" class="label-control col-md-3">Nama Produk</label>
							<input type="text" name="nama" id="nama" placeholder="Nama produk..." class="form-control col-md-9">
						</div>
						<div class="form-group row">
							<label for="harga" class="label-control col-md-3">Harga</label>
							<input type="number" name="harga" id="harga" placeholder="Rp.00000" class="form-control number-separator col-md-9">
						</div>
						<div class="form-group">
							<label for="deskripsi" class="label-control">Deskripsi Produk</label>
							<textarea name="desc" id="desc" class="form-control" rows="10"></textarea>
						</div>
						<div class="form-group row">
							<label class="label-control col-md-3">Foto Produk</label>
							<input type="file" name="foto" id="foto" class="form-control col-md-9">
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
	}

	public function produkEdit($id){

		$q = $this->m->where('produk',array('kode_produk'=>$id));

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="editForm" enctype="multipart/form-data" method="POST" class="mt-5">
				<input type="hidden" name="kode" id="kode"  value="'.$d->kode_produk.'">
					<center>
						<div class="form-group row">
							<label for="nama" class="label-control col-md-3">Nama Produk</label>
							<input type="text" name="nama" id="nama" placeholder="Nama produk..." class="form-control col-md-9" value="'.$d->nama_produk.'">
						</div>
						<div class="form-group row">
							<label for="harga" class="label-control col-md-3">Harga</label>
							<input type="number" name="harga" id="harga" placeholder="Rp.00000" class="form-control number-separator col-md-9" value="'.$d->harga.'">
						</div>
						<div class="form-group">
							<label for="deskripsi" class="label-control">Deskripsi Produk</label>
							<textarea name="desc" id="desc" class="form-control" rows="10">'.$d->desc.'</textarea>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';			
		}

		echo json_encode($data);
	}

	public function newPlus(){

		$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<center>
						<div class="form-group">
							<label for="deskripsi" class="label-control">Isi Konten</label>
							<textarea name="desc" id="desc" class="form-control" rows="10"></textarea>
						</div>
						<div class="form-group">
							<label for="link" class="label-control">Link Konten</label>
							<input type="text" name="link" id="link" class="form-control" placeholder="Tempel link disini"></input>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
	}

	public function plusEdit($id){

		$q = $this->m->where('keunggulan',array('id'=>$id));

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
					<form id="editForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<input type="hidden" name="id" id="id" value="'.$d->id.'">
						<center>
							<div class="form-group">
								<label for="deskripsi" class="label-control">Isi Konten</label>
								<textarea name="desc" id="desc" class="form-control" rows="10">'.$d->konten.'</textarea>
							</div>
							<div class="form-group">
								<label for="link" class="label-control">Link Konten</label>
								<input type="text" name="link" id="link" class="form-control" placeholder="Tempel link disini" value="'.$d->link.'"></input>
							</div>
							<div class="form-group mt-5">
								<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
							</div>
						</center>
					</form>';
		}

		echo json_encode($data);
	}

	public function newGaleri(){

		$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<center>
						<div class="form-group">
							<label for="foto" class="label-control">Link Konten</label>
							<input type="file" name="foto" id="foto" class="form-control" onchange="cekFoto()"></input>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
	}

	public function galeriEdit($id){

		$q = $this->m->where('galeri',array('id'=>$id));

		foreach($q as $d){

			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="editForm" enctype="multipart/form-data" method="POST" class="mt-5">
				<input type="hidden" name="id" id="id" value="'.$id.'">
					<center>
						<img src="'.base_url().'assets/upload/galeri/'.$d->foto.'" width="100" height="100" alt="">
						<div class="form-group">
							<label for="foto" class="label-control">Link Konten</label>
							<input type="file" name="foto" id="foto" class="form-control" onchange="cekFoto()"></input>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
		}
	}
	
	/*Testimonial*/
	
	public function newTesti(){
	    
	    $data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<center>
						<div class="form-group row">
							<label for="nama" class="label-control col-md-3">Nama Jejaring</label>
							<input type="text" name="nama" id="nama" placeholder="Nama testimon..." class="form-control col-md-9">
						</div>
						<div class="form-group">
							<label for="deskripsi" class="label-control">Deksripsi Jejaring</label>
							<textarea name="desc" id="desc" class="form-control" rows="10"></textarea>
						</div>
						<div class="form-group row">
							<label for="nama" class="label-control col-md-3">Nomor WA Jejaring</label>
							<input type="text" name="kontak" id="kontak" placeholder="628xxx" value="" class="form-control col-md-9">
						</div>
						<div class="form-group row">
							<label class="label-control col-md-3">Foto Testimon</label>
							<input type="file" name="foto" id="foto" class="form-control col-md-9">
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
	}
	
	public function editTesti($id){
	    
	    $q = $this->m->where('testimoni',array('id'=>$id));
	    
    	   foreach($q as $d){
    	       
    	       $data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
    				<form id="formEdit" enctype="multipart/form-data" method="POST" class="mt-5">
    					<center>
    					    <input type="hidden" name="id" id="id" value="'.$d->id.'">
    						<div class="form-group row">
    							<label for="nama" class="label-control col-md-3">Nama Jejaring</label>
    							<input type="text" name="nama" id="nama" placeholder="Nama jejaring..." value="'.$d->nama.'" class="form-control col-md-9">
    						</div>
    						<div class="form-group row">
    							<label for="nama" class="label-control col-md-3">Nomor WA Jejaring</label>
    							<input type="text" name="kontak" id="kontak" placeholder="628xxx" value="'.$d->kontak.'" class="form-control col-md-9">
    						</div>
    						<div class="form-group">
    							<label for="deskripsi" class="label-control">Deskripsi Produk</label>
    							<textarea name="desc" id="desc" class="form-control" rows="10">'.$d->testi.'</textarea>
    						</div>
    						<div class="form-group mt-5">
    							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
    						</div>
    					</center>
    				</form>';
    	   }

		echo json_encode($data);
	}
	
	public function jejaringImg($id){
	    
	    $q = $this->m->where('testimoni',array('id'=>$id));

		foreach($q as $d){

			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="imgEdit" enctype="multipart/form-data" method="POST" class="mt-5">
				<input type="hidden" name="id" id="id" value="'.$id.'">
					<center>
						<img src="'.base_url().'assets/upload/jejaring/'.$d->foto.'" width="100" height="100" alt="">
						<div class="form-group">
							<label for="foto" class="label-control">Gambar</label>
							<input type="file" name="foto" id="foto" class="form-control"></input>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';

		echo json_encode($data);
		}
	}

	// Tim

	public function newTim(){

		$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
			<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
				<center>
					<div class="form-group">
						<label for="nama" class="label-control col-md-3">Nama Lengkap</label>
						<input type="text" name="nama" value="" placeholder="Masukkan Nama Lengkap" class="form-control col-md-9" required>
					</div>
					<div class="form-group">
						<label for="jabatan">Jabatan</label>
						<input type="text" name="jabatan" id="jabatan" value="" placeholder="Masukkan jabatan" class="form-control col-md-9" required>
					</div>
					<div class="form-group">
						<label for="fb">Facebook</label>
						<input type="text" name="fb" id="fb" value="" placeholder="Nama Facebook" class="form-control col-md-9">
					</div>
					<div class="form-group">
						<label for="ig">Instagram</label>
						<input type="text" name="ig" id="ig" value="" placeholder="Nama akun Instagram (tanpa @)" class="form-control col-md-9">
					</div>
					<div class="form-group">
						<label for="link">Linked</label>
						<input type="text" name="link" id="link" value="" placeholder="Masukkan akun Linked In" class="form-control col-md-9">
					</div>
					<div class="form-group">
						<label for="foto" class="label-control">Gambar</label>
						<input type="file" onchange="cekFoto();" name="foto" id="foto" class="form-control col-md-9" required></input>
					</div>
					<div class="form-group mt-5">
						<button type="submit" id="savebtn" class="btn btn-outline-success btn-lg" disabled><i class="fas fa-fw fa-save"></i> Simpan</button>
					</div>
				</center>
			</form>';

		echo json_encode($data);
	}

	public function editTim($id){

		$q = $this->m->where('tim',array('id'=>$id));

		foreach($q as $d){

			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="formEdit" enctype="multipart/form-data" method="POST" class="mt-5">
				<input type="hidden" name="id" id="id" value="'.$d->id.'">
					<center>
						<div class="form-group">
							<label for="nama" class="label-control col-md-3">Nama Lengkap</label>
							<input type="text" name="nama" value="'.$d->nama.'" placeholder="Masukkan Nama Lengkap" class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="jabatan">Jabatan</label>
							<input type="text" name="jabatan" id="jabatan" value="'.$d->jabatan.'" placeholder="Masukkan jabatan" class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="fb">Facebook</label>
							<input type="text" name="fb" id="fb" value="'.$d->fb.'" placeholder="Nama Facebook" class="form-control col-md-9">
						</div>
						<div class="form-group">
							<label for="ig">Instagram</label>
							<input type="text" name="ig" id="ig" value="'.$d->ig.'" placeholder="Nama akun Instagram (tanpa @)" class="form-control col-md-9">
						</div>
						<div class="form-group">
							<label for="link">Linked</label>
							<input type="text" name="link" id="link" value="'.$d->link.'" placeholder="Masukkan akun Linked In" class="form-control col-md-9">
						</div>
						<div class="form-group mt-5">
							<button type="submit" id="savebtn" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';			
		}

		echo json_encode($data);
	}

	public function ubahFotoTim($id){

		$q = $this->m->where('tim',array('id'=>$id));

		foreach($q as $d){

			$data = '<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
			<form id="editFotoTim" enctype="multipart/form-data" method="POST" class="mt-5">
				<input type="hidden" name="id" id="id" value="'.$id.'">
				<center>
					<img src="'.base_url().'assets/upload/fotoTim/'.$d->foto.'" alt="" width="100" height="100">
					<div class="form-group">
						<label for="foto" class="label-control">Gambar</label>
						<input type="file" onchange="cekFoto();" name="foto" id="foto" class="form-control col-md-9" required></input>
					</div>
					<div class="form-group mt-5">
						<button type="submit" id="savebtn" class="btn btn-outline-success btn-lg" disabled><i class="fas fa-fw fa-save"></i> Simpan</button>
					</div>
				</center>
			</form>';
		}

		echo json_encode($data);
	}

	/*Artikel*/

	public function newBlog(){

		$data = '<button type="button" class="close ml-auto" onclick="tutupForm();">X</button><hr>
			<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
				<center>
					<div class="form-group">
						<label for="tanggal">Tanggal</label>
						<input type="date" name="tanggal" id="tanggal" value="" placeholder="" class="form-control col-md-9" required>
					</div>
					<div class="form-group">
						<label for="judul" class="label-control col-md-3">Judul</label>
						<input type="text" name="judul" value="" placeholder="Judul Artikel..." id="judul" class="form-control col-md-9" required>
					</div>
					<div class="form-group">
						<label for="desc" class="label-control col-md-3">Isi</label>
						<textarea class="form-control" placeholder="Isi artikel" name="desc" id="desc"></textarea>
					</div>
					<div class="form-group mt-5">
						<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
					</div>
				</center>
			</form><hr>';

		echo json_encode($data);
	}

	public function blogEdit($id){

		$q = $this->m->where('artikel',array('id'=>$id));

		foreach($q as $d){

			$data = '<button type="button" class="close ml-auto" onclick="tutupForm();">X</button><hr>
				<form id="editBlog" enctype="multipart/form-data" method="POST" class="mt-5">
				<input type="hidden" name="id" id="d" value="'.$d->id.'">
					<center>
						<div class="form-group">
							<label for="tanggal">Tanggal</label>
							<input type="date" name="tanggal" id="tanggal" value="'.$d->tanggal.'" placeholder="" class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="judul" class="label-control col-md-3">Judul</label>
							<input type="text" name="judul" value="'.$d->judul.'" placeholder="Judul Artikel..." id="judul" class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="desc" class="label-control col-md-3">Isi</label>
							<textarea class="form-control" placeholder="Isi artikel" name="desc" id="desc">'.$d->desc.'</textarea>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form><hr>';
		}

		echo json_encode($data);
	}

	public function editFotoArtikel($id)
	{
		$q = $this->m->where('artikel',array('id'=>$id));

		foreach($q as $d){

			$data='<button type="button" class="close ml-auto" data-dismiss="modal" data-target="#form">X</button>
				<form id="editFotoBlog" enctype="multipart/form-data" method="POST" class="mt-5">
				<input type="hidden" name="id" id="d" value="'.$d->id.'">
					<center>
						<div class="form-group">
							<img src="'.base_url().'assets/upload/artikel/'.$d->foto.'" width="100" height="100" alt="">
						</div>
						<div class="form-group">
							<label for="Foto">Gambar</label>
							<input type="file" name="foto" id="foto" value="" placeholder="" required>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form>';
		}

		echo json_encode($data);
	}

	public function newPelatihan()
	{
		$data='<button type="button" class="close ml-auto" onclick="tutupForm();">X</button><hr>
				<form id="myForm" enctype="multipart/form-data" method="POST" class="mt-5">
					<center>
						<div class="form-group">
							<label for="nama" class="label-control col-md-3">Nama Peatihan</label>
							<input type="text" name="nama" id="nama" value="" placeholder="Nama Pelatihan..." class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="lokasi" class="label-control col-md-3">Lokasi Pelatihan</label>
							<input type="text" name="lokasi" id="lokasi" value="" placeholder="Lokasi Pelatihan..." class="col-md-9 fomr-control" required>
						</div>
						<div class="form-group">
							<label for="waktu" class="label-control col-md-3">Waktu Pelatihan</label>
							<input type="date" name="waktu" id="waktu" value="" placeholder="" class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="harga" class="label-control col-md-3">Harga</label>
							<input type="number" name="harga" id="harga" value="" placeholder="" class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="kuota">Kuota</label>
							<input type="number" name="kuota" id="kuota" value="" placeholder="" class="form-control col-md-9" required>
						</div>
						<div class="form-group">
							<label for="desc">Keterangan</label>
							<textarea name="desc" id="desc" cols="30" rows="10" class="form-control col-md-9"></textarea>
						</div>
						<div class="form-group">
							<label for="foto">Image</label>
							<input type="file" name="foto" id="foto" value="" placeholder="" class="form-control col-md-9" required>
						</div>
						<div class="form-group mt-5">
							<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
						</div>
					</center>
				</form><hr>';

		echo json_encode($data);
	}

	public function editPelatihan($id)
	{
		$q = $this->m->where('pelatihan',array('id',$id));

		foreach($q as $d)
		{
			$data='<button type="button" class="close ml-auto" onclick="tutupForm();">X</button><hr>
					<form id="editPelatihan" enctype="multipart/form-data" method="POST" class="mt-5">
					<input type="hidden" name="id" id="id" value="'.$d->id.'">
						<center>
							<div class="form-group">
								<label for="nama" class="label-control col-md-3">Nama Peatihan</label>
								<input type="text" name="nama" id="nama" value="'.$d->nama.'" placeholder="Nama Pelatihan..." class="form-control col-md-9" required>
							</div>
							<div class="form-group">
								<label for="lokasi" class="label-control col-md-3">Lokasi Pelatihan</label>
								<input type="text" name="lokasi" id="lokasi" value="'.$d->lokasi.'" placeholder="Lokasi Pelatihan..." class="col-md-9 fomr-control" required>
							</div>
							<div class="form-group">
								<label for="waktu" class="label-control col-md-3">Waktu Pelatihan</label>
								<input type="date" name="waktu" id="waktu" value="'.$d->waktu.'" placeholder="" class="form-control col-md-9" required>
							</div>
							<div class="form-group">
								<label for="harga" class="label-control col-md-3">Harga</label>
								<input type="number" name="harga" id="harga" value="'.$d->harga.'" placeholder="" class="form-control col-md-9" required>
							</div>
							<div class="form-group">
								<label for="kuota">Kuota</label>
								<input type="number" name="kuota" id="kuota" value="'.$d->kuota.'" placeholder="" class="form-control col-md-9" required>
							</div>
							<div class="form-group">
								<label for="desc">Keterangan</label>
								<textarea name="desc" id="desc" cols="30" rows="10" class="form-control col-md-9">'.$d->desc.'</textarea>
							</div>
							<div class="form-group mt-5">
								<button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-fw fa-save"></i> Simpan</button>
							</div>
						</center>
					</form><hr>';
		}

		echo json_encode($data);
	}
}
?>