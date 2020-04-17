<?php defined('BASEPATH') or exit('No direct script allowed');

class Data extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);

		$this->load->helper(array('string','text','date'));
	}

	/*Admin Data*/

	public function anggota(){

		$id = $this->session->userdata('id');

		$q = $this->m->single('SELECT * FROM user where id != "'.$id.'" and acc_stat ="Active"');

		$data = '<table id="tdata" class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Foto</th>
												<th>Logo Klinik</th>
												<th>Email</th>
												<th>Nama Lengkap</th>
												<th>Nama Klinik</th>
												<th>Password</th>
												<th>Level</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>';
		$no = 1;
		foreach($q as $m){

			$id = "'".$m->id."'";
			$nama = "'".$m->nama_lengkap."'";

			$data .= '<tr>
												<td>'.$no++.'</td>
												<td>
													<img src="'.base_url().'assets/upload/fotoDiri/'.$m->pas_foto.'" width="50" height="50"/>
												</td>
												<td>
													<img src="'.base_url().'assets/upload/fotoKlinik/'.$m->foto_klinik.'" width="50" height="50"/>
												</td>
												<td>'.$m->email.'</td>
												<td>'.$m->nama_lengkap.'</td>
												<td>'.$m->nama_klinik.'</td>
												<td>'.$m->password_md5.'</td>
												<td>';
													if($m->level == 1){
			$data.='								<p class="badge badge-danger">Admin</p>';
													}else if($m->level == 2){
			$data.='								<p class="badge badge-success">User</p>';
													}
			$data.='							</td>
												<td>
													<a href="#" type="button" class="badge badge-primary" onclick="infoProfil('.$id.')"><i class="fas fa-fw fa-eye"></i></a>
													<a href="#" type="button" class="badge badge-success" onclick="terima('.$id.','.$nama.')"><i class="fas fa-fw fa-check"></i></a>
													<a href="#" type="button" class="badge badge-danger" onclick="tolak('.$id.')"><i class="fas fa-fw fa-minus-circle"></i></a>
													<a href="#" type="button" class="badge badge-success" onclick="sembunyikan('.$id.','.$nama.')"><i class="fas fa-fw fa-eye-slash"></i></a>
												</td>
											</tr>';
		}

		$data.= '</tbody>
									</table>';

		echo json_encode($data);
	}

	public function member(){

		$id = $this->session->userdata('id');

		$q = $this->m->single('SELECT * FROM user where id != "'.$id.'" and acc_stat ="Approved"');

		$data = '<table id="tdata" class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Foto</th>
												<th>Logo Klinik</th>
												<th>Email</th>
												<th>Nama Lengkap</th>
												<th>Nama Klinik</th>
												<th>Password</th>
												<th>Level</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>';
		$no = 1;
		foreach($q as $m){

			$id = "'".$m->id."'";
			$nama = "'".$m->nama_lengkap."'";
			$lvl1 = "'User'";
			$lvl2 = "'Admin'";

			$data .= '<tr>
												<td>'.$no++.'</td>
												<td>
													<img src="'.base_url().'assets/upload/fotoDiri/'.$m->pas_foto.'" width="50" height="50"/>
												</td>
												<td>
													<img src="'.base_url().'assets/upload/fotoKlinik/'.$m->foto_klinik.'" width="50" height="50"/>
												</td>
												<td>'.$m->email.'</td>
												<td>'.$m->nama_lengkap.'</td>
												<td>'.$m->nama_klinik.'</td>
												<td>'.$m->password_md5.'</td>
												<td>';
													if($m->level == 1){
			$data.='								<p class="badge badge-danger">Admin</p> <a type="button" href="#" onclick="levelUser('.$id.','.$nama.','.$lvl1.')" class="badge badge-success"><i class="fas fa-fs fa-edit"></i> Ubah ke User</a>';
													}else if($m->level == 2){
			$data.='								<p class="badge badge-info">User</p> <a type="button" href="#" onclick="levelUser('.$id.','.$nama.','.$lvl2.')" class="badge badge-danger"><i class="fas fa-fs fa-edit"></i> Ubah ke Admin</a>';
													}
			$data.='							</td>
												<td>
													<a href="#" type="button" class="badge badge-primary" onclick="infoProfil('.$id.')"><i class="fas fa-fw fa-eye"></i></a>
													<a href="#" type="button" class="badge badge-success" onclick="sembunyikan('.$id.','.$nama.')"><i class="fas fa-fw fa-eye-slash"></i></a>
												</td>
											</tr>';
		}

		$data.= '</tbody>
									</table>';

		echo json_encode($data);
	}

	public function profil($id){

		$q = $this->m->where('user',array('id'=>$id));

		$wilayah = $this->m->getData('tb_wilayah');
		$kotkab = $this->m->getData('tb_kotkab');
		$kec = $this->m->getData('tb_kec');
		$kontribusi = $this->m->getData('kontribusi');
		$invoice = $this->m->single('SELECT * FROM invoice WHERE id_payee = '.$id.' order by exp_date desc limit 1');
		$wil=null;$kot=null;$kecak=null;$kon=null;

		foreach($q as $d){

			foreach($wilayah as $w){
				if($d->wilayah == $w->id_wilayah){
					$wil = $w->nama_wilayah;
				}
			}

			foreach($kotkab as $k1){
				if($d->kotkab == $k1->id_kotkab){
					$kot = $k1->nama_kotkab.', ';
				}
			}

			foreach($kec as $k2){
				if($d->kecamatan == $k2->id_kec){

					$kecak = $k2->nama_kec.', ';
				}
			}

			foreach($kontribusi as $k3){
				if($d->kontribusi == $k3->id){
					$kon ="Rp. ".number_format($k3->jumlah,0,',','.');
				}
			}

			$data = '<table style="width:100%;">
										<tr>
											<td>Nomor Anggota</td>
											<td>:</td>';
										if($d->no_anggota != ''){

											$data.='<td>'.$d->no_anggota.'</td>';
										}else{
											$data.='<td>(Menunggu Verifikasi)</td>';
										}
										$data.='</tr>
										<tr>
											<td>Nama Lengkap</td>
											<td>:</td>
											<td>'.$d->nama_lengkap.'</td>
										</tr>
										<tr>
											<td>Nama Klinik</td>
											<td>:</td>
											<td>'.$d->nama_klinik.'</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>:</td>
											<td>'.$d->email.'</td>
										</tr>
										<tr>
											<td>Alamat Tinggal</td>
											<td>:</td>
											<td>'.$d->alamat_tinggal.'</td>
										</tr>
										<tr>
											<td>Wilayah Asal</td>
											<td>:</td>
										<td>'.$kecak.$kot.$wil.'</td>
											</tr>
										<tr>
											<td>Pendidikan</td>
											<td>:</td>
											<td>'.$d->pendidikan_terakhir.' ('.$d->institusi.', '.$d->alamat_institusi.')</td>
										</tr>
										<tr>
											<td>Nomor Kontak</td>
											<td>:</td>
											<td>Telp. '.$d->no_telp.'| HP. '.$d->no_hp.'</td>
										</tr>
										<tr>
											<td>Kontribusi</td>
											<td>:</td>';
			if(count($invoice) > 0){

				foreach($invoice as $i){ $bayar = $i->stat; }

				if($bayar != "Payed"){
					$data.='				<td>'.$kon.' <p class="badge badge-info">Belum terbayar</p></td>';
				}else{
					$data.='				<td>'.$kon.' <p class="badge badge-success">Terbayar</p></td>';
				}
			}else{

				$data.='				<td>'.$kon.' <p class="badge badge-info">Belum ada transaksi</p></td>';
			}
											$data.='<td>
											<button type="button" class="btn btn-success" onclick="kontribusi();"><i class="fas fa-fw fa-edit"></i></button>
											</td>
										</tr>
										<tr>
											<td>Foto</td>
											<td>:</td>
											<td class="pr-3">';
											if($d->pas_foto != ''){
												$data.='<img src="'.base_url().'assets/upload/fotoDiri/'.$d->pas_foto.'" alt="Pas Foto" width="100" height="100">';
											}else{
												$data.='Belum Ada Foto';
											}
											$data.='</td>
											<td>
												<button type="button" class="btn btn-success" onclick="formFoto();"><i class="fas fa-fw fa-edit"></i></button>
											</td>
										</tr>
										<tr>
											<td>Logo Klinik</td>
											<td>:</td>
											<td>';
												if($d->foto_klinik != ''){
													$data.='<img src="'.base_url().'assets/upload/fotoKlinik/'.$d->foto_klinik.'" alt="Logo Klinik" width="100" height="100">';
												}else{
													$data.='Belum Ada Foto';
												}
											$data.='</td>
											<td>
												<button type="button" class="btn btn-success" onclick="formLogo();"><i class="fas fa-fw fa-edit"></i></button>
											</td>
										</tr>
									</table>
									<center>
										<button type="button" class="btn btn-outline-danger mt-3" onclick="editProfil();">Edit <i class="fas fa-fw fa-edit"></i></button>
									</center>';
		}

		echo json_encode($data);
	}

	public function profil1($id){

		$q = $this->m->where('user',array('id'=>$id));

		$wilayah = $this->m->getData('tb_wilayah');
		$kotkab = $this->m->getData('tb_kotkab');
		$kec = $this->m->getData('tb_kec');
		$kontribusi = $this->m->getData('kontribusi');
		$invoice = $this->m->single('SELECT * FROM invoice WHERE id_payee = '.$id.' order by exp_date desc limit 1');
		$wil=null;$kot=null;$kecak=null;$kon=null;

		foreach($q as $d){

			foreach($wilayah as $w){
				if($d->wilayah == $w->id_wilayah){
					$wil = $w->nama_wilayah;
				}
			}

			foreach($kotkab as $k1){
				if($d->kotkab == $k1->id_kotkab){
					$kot = $k1->nama_kotkab.', ';
				}
			}

			foreach($kec as $k2){
				if($d->kecamatan == $k2->id_kec){

					$kecak = $k2->nama_kec.', ';
				}
			}

			foreach($kontribusi as $k3){
				if($d->kontribusi == $k3->id){
					$kon ="Rp. ".number_format($k3->jumlah,0,',','.');
				}
			}

			$data = '<table style="width:100%;">
										<tr>
											<td>Nama Lengkap</td>
											<td>:</td>
											<td>'.$d->nama_lengkap.'</td>
										</tr>
										<tr>
											<td>Nama Klinik</td>
											<td>:</td>
											<td>'.$d->nama_klinik.'</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>:</td>
											<td>'.$d->email.'</td>
										</tr>
										<tr>
											<td>Alamat Tinggal</td>
											<td>:</td>
											<td>'.$d->alamat_tinggal.'</td>
										</tr>
										<tr>
											<td>Wilayah Asal</td>
											<td>:</td>
										<td>'.$kecak.$kot.$wil.'</td>
											</tr>
										<tr>
											<td>Pendidikan</td>
											<td>:</td>
											<td>'.$d->pendidikan_terakhir.'</td>
										</tr>
										<tr>
											<td>Nomor Kontak</td>
											<td>:</td>
											<td>Telp. '.$d->no_telp.'| HP. '.$d->no_hp.'</td>
										</tr>
										<tr>
											<td>Kontribusi</td>
											<td>:</td>
											<td>'.$kon.'</td>';
			foreach($invoice as $i){

				if($i->stat == "Pending"){
					$data.='				<td class="badge badge-info">Belum terbayar</td>';
				}else if($i->stat == "Payed"){
					$data.='				<td class="badge badge-success">Terbayar</td>';
				}else if($i->stat == "Expired"){
					$data.='				<td class="badge badge-danger">Expired</td>';
				}
			}
			$data.='					</tr>
										<tr>
											<td>Foto</td>
											<td>:</td>
											<td class="pr-3">';
											if($d->pas_foto != ''){
												$data.='<img src="'.base_url().'assets/upload/fotoDiri/'.$d->pas_foto.'" alt="Pas Foto" width="100" height="100">';
											}else{
												$data.='Belum Ada Foto';
											}
											$data.='</td>
										</tr>
										<tr>
											<td>Logo Klinik</td>
											<td>:</td>
											<td>';
												if($d->foto_klinik != ''){
													$data.='<img src="'.base_url().'assets/upload/fotoKlinik/'.$d->foto_klinik.'" alt="Logo Klinik" width="100" height="100">';
												}else{
													$data.='Belum Ada Foto';
												}
											$data.='</td>
										</tr>
									</table>';
		}

		echo $data;
	}

	public function getKotkab($id){

		$q = $this->m->where('tb_kotkab',array('id_wilayah'=>$id));

		$qu = $this->m->where('user',array('id'=>$this->session->userdata('id')));

		$data='
			<option value="">=PIILIH=</option>
		';

		foreach($q as $d){

			foreach($qu as $du){

				if($du->kotkab == $d->id_kotkab){

					$data.= '<option value="'.$d->id_kotkab.'" selected>'.$d->nama_kotkab.'</option>';
				}else{
					$data.= '<option value="'.$d->id_kotkab.'">'.$d->nama_kotkab.'</option>';
				}
			}
		}

		echo json_encode($data);
	}

	public function getKec($id){

		$q = $this->m->where('tb_kec',array('id_kotkab'=>$id));

		$qu = $this->m->where('user',array('id'=>$this->session->userdata('id')));

		$data='
			<option value="">=PIILIH=</option>
		';

		foreach($q as $d){

			foreach($qu as $du){

				if($du->kecamatan == $d->id_kec){

					$data.= '<option value="'.$d->id_kec.'" selected>'.$d->nama_kec.'</option>';
				}else{
					$data.= '<option value="'.$d->id_kec.'">'.$d->nama_kec.'</option>';
				}
			}
		}

		echo json_encode($data);
	}

	public function qrcode(){

		$id = $this->session->userdata('id');

		$q = $this->m->where('user',array('id'=>$id));

		$this->load->library('Ciqrcode');

		foreach($q as $d){

			QRcode::png(

				$d->no_anggota,
				$outfile = false,
				$level= QR_ECLEVEL_H,
				$size = 3,
				$margin = 1
			);
		}
	}

	/*Marketing*/

	public function user_marketing(){

		$q = $this->m->where('marketing_tools',array('stat'=>'Show'));

		$data = '<div class="row">';

		foreach($q as $d){

			$data .= '
								<div class="card shadow px-2 py-2 mr-2 col-md-3" style="border-radius: 30px;">
									<center>
										<div class="card-body">
											<img src="'.base_url().'assets/upload/banner/'.$d->banner.'" alt="Foto tools" style="width:100%;object-fit: cover; margin-bottom: 20px;">

											<h3>'.$d->nama.'</h3>
										</div>
										<button type="button" onclick="lihat('.$d->id.');" class="btn btn-info"><i class="fas fa-fw fa-eye"></i> Preview</button>
										<a type="button"  target="_blank" href="'.base_url().'assets/upload/attach/'.$d->file.'" class="btn btn-primary"><i class="fas fa-fw fa-download"></i> Download</a>
									</center>
								</div>';
		}

		$data.='</div>';

		echo json_encode($data);
	}

	public function search_marketing($id){

		$q = $this->m->single('SELECT * FROM marketing_tools where nama like "%'.$id.'%" and stat = "Show"');

		$data = '<div class="row">';

		if(count($q) > 0){

			foreach($q as $d){

				$data .= '
									<div class="card shadow px-2 py-2 mr-2 col-md-3" style="border-radius: 30px;">
										<center>
											<div class="card-body">
												<img src="'.base_url().'assets/upload/banner/'.$d->banner.'" alt="Foto tools" style="height: 150px; object-fit: cover; margin-bottom: 20px;">

												<h3>'.$d->nama.'</h3>
											</div>
											<button type="button" onclick="lihat('.$d->id.');" class="btn btn-info"><i class="fas fa-fw fa-eye"></i> Preview</button>
											<a type="button" target="_blank" href="'.base_url().'assets/upload/attach/'.$d->file.'" class="btn btn-primary"><i class="fas fa-fw fa-download"></i> Download</a>
										</center>
									</div>';
			}
		}

		$data.='</div>';

		echo json_encode($data);
	}
	
	public function marketing(){
	    
	    $q = $this->m->getData('marketing_tools');
	    
	    $key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
				<table id="tdata" class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Banner</th>
							<th>Nama</th>
							<th>Desc</th>
							<th>File</th>
							<th>Stat</th>
							<th>OPSI</th>
						</tr>
					</thead>
					<tbody>';
		$no = 1;			
		foreach($q as $d){
			$id = "'".$d->id."'";
			$data.='	<tr>
							<td>'.$no++.'</td>
							<td>
							    <img src="'.base_url().'assets/upload/banner/'.$d->banner.'" width="100" style="object-fit:cover" />
							    <button type="button" class="btn btn-outline-success ml-3 mt-3" onclick="ubahBanner('.$id.')">Ubah</button>
							</td>
							<td>'.$d->nama.'</td>
							<td>'.word_limiter($d->descr,20).'</td>
							<td>'.$d->file.' <a type="button" target="_blank" href="'.base_url().'assets/upload/attach/'.$d->file.'" class="badge badge-info"><i class="fas fa-fw fa-download"></i></a>
								<a href="#" type="button" class="badge badge-success" onclick="ubahAttach('.$id.')"><i class="fas fa-fw fa-edit"></i></a>
							</td>';
			if($d->stat != 'Show'){
				$data.='	<td>
								<i class="badge badge-dark">Non-Aktif</i>
							</td>
							<td>
								<button class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
								<button class="btn btn-outline-info" onclick="show('.$id.');"><i class="fas fa-fw fa-info-circle"></i> Aktifkan</button>
							</td>';
			}else{

				$data.='	<td>
								<i class="badge badge-success">Aktif</i>
							</td>
							<td>
								<button class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
								<button class="btn btn-outline-dark" onclick="ngumpet('.$id.');"><i class="fas fa-fw fa-info-circle"></i> Non-Aktifkan</button>
							</td>';
			}
			$data.='	</tr>';
		}
		$data.=		'</tbody>
				</table>';

		echo json_encode($data);
	}

	/*Front End Data*/

	public function slider(){

		$q = $this->m->getData('slider');

		$key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
				<table id="tdata" class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Foto</th>
												<th>Judul</th>
												<th>Deskripsi</th>
												<th>Link</th>
												<th>Status</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>';
		$no = 1;
			foreach($q as $d){

				$kode = "'".$d->id."'";

				$data.='<tr>
							<td>'.$no++.'</td>
							<td>
								<img src="'.base_url().'assets/upload/slider/'.$d->foto.'" width="100" height="100" alt="">
								<button type="button" onclick="sliderImg('.$kode.')" class="btn btn-outline-success">Ubah</button>
							</td>
							<td>'.$d->judul.'</td>
							<td>'.$d->desc.'</td>
							<td>
								<a href="http://www.'.$d->link.'" target="_blank" title="">'.$d->link.'</a>
							</td>';
				if($d->stat == 'Unset'){

					$data.='<td><i class="badge badge-info">Unset</i></td>
							<td>
								<button type="button" class="btn btn-success" onclick="formCrud('.$kode.');"><i class="fas fa-fw fa-edit"></i>Edit Info</button>
								<button type="button" class="btn btn-info" onclick="show('.$kode.');"><i class="fas fa-fw fa-eye"></i>Tampilkan</button>
							</td>';
				}else if($d->stat == 'Show'){

					$data.='<td><i class="badge badge-success">Ditampilkan</i></td>
							<td>
								<button type="button" class="btn btn-success" onclick="formCrud('.$kode.');"><i class="fas fa-fw fa-edit"></i>Edit Info</button>
								<button type="button" class="btn btn-dark" onclick="ngumpet('.$kode.');"><i class="fas fa-fw fa-eye-slash"></i>Sembunyikan</button>
							</td>';
				}else if($d->stat == 'Hidden'){

					$data.='<td><i class="badge badge-dark">Disembunyikan</i></td>
							<td>
								<button type="button" class="btn btn-success" onclick="formCrud('.$kode.');"><i class="fas fa-fw fa-edit"></i>Edit Info</button>
								<button type="button" class="btn btn-info" onclick="show('.$kode.');"><i class="fas fa-fw fa-eye"></i>Tampilkan</button>
							</td>';
				}
		}


				$data.=	'
				</tr>
			</tbody>
		</table>';		

		echo json_encode($data);
	}

	public function sliderInfo($id){

		$q = $this->m->where('slider',array('id'=>$id));

		foreach($q as $d){

			$data='<center>
						<h5>'.$d->judul.'</h5>
						<img src="'.base_url().'assets/upload/slider/'.$d->foto.'" style="width:300px; object-fit: cover;" class="mb-3" alt="">
						<p>'.$d->desc.'</p>
					</center>';
		}

		echo $data;
	}

	public function about(){

		$q = $this->m->getData('about');

		$key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
				<table id="tdata" class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Konten</th>
							<th>Stat</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>';
		$no = 1;			
		foreach($q as $d){
			$id = "'".$d->id."'";
			$data.='	<tr>
							<td>'.$no++.'</td>
							<td>'.word_limiter($d->konten,25).'</td>';
			if($d->stat != 'Show'){
				$data.='	<td>
								<i class="badge badge-dark">Non-Aktif</i>
							</td>
							<td>
								<button class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
								<button class="btn btn-outline-info" onclick="show('.$id.');"><i class="fas fa-fw fa-info-circle"></i> Aktifkan</button>
							</td>';
			}else{

				$data.='	<td>
								<i class="badge badge-success">Aktif</i>
							</td>
							<td>
								<button class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
								<button class="btn btn-outline-dark" onclick="ngumpet('.$id.');"><i class="fas fa-fw fa-info-circle"></i> Non-Aktifkan</button>
							</td>';
			}
			$data.='	</tr>';
		}
		$data.=		'</tbody>
				</table>';

		echo json_encode($data);
	}

	public function aboutInfo($id){

		$q = $this->m->where('about',array('id'=>$id));

		foreach($q as $d){

			$data = '<center class="mt-5"><p>'.$d->konten.'</p></center>';
		}

		echo $data;
	}

	public function produk(){

		$q = $this->m->getData('produk');

		$no = 1;

		$key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
			<table class="table table-striped" id="tdata">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Harga/Biaya</th>
						<th>Deskripsi</th>
						<th>Foto</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>';

		foreach($q as $d){

		$id = "'".$d->kode_produk."'";

		$data.='		<tr>
							<td>'.$no++.'</td>
							<td>'.$d->kode_produk.'</td>
							<td>'.$d->nama_produk.'</td>
							<td>'.$d->harga.'</td>
							<td>'.word_limiter($d->desc,5).'</td>
							<td>
								<button class="btn btn-outline-primary" onclick="galeri('.$id.');">Buka</button>
							</td>';
		if($d->stat != 'Ready'){
			$data.=' 
							<td><p class="badge badge-dark">'.$d->stat.'</p></td>
							<td>
								<button type="button" class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
								<button type="button" class="btn btn-info" onclick="show('.$id.');"><i class="fas fa-fw fa-info-circle"></i> Tampilkan</button>
							</td>';
		}else{
			$data.=' 
							<td><p class="badge badge-info">'.$d->stat.'</p></td>
							<td>
								<button type="button" class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
								<button type="button" class="btn btn-dark" onclick="show('.$id.');"><i class="fas fa-fw fa-eye-slash"></i> Sembunyikan</button>
							</td>';
		}
		$data.='		</tr>';
		}

		$data.= '
					</tbody>
				</table>';

		echo json_encode($data);
	}

	public function produkInfo($id){

		$q = $this->m->where('produk',array('kode_produk'=>$id));

		foreach($q as $d){

			$data = '<center>
						<h1>'.$d->nama_produk.'</h1>
						<p>Rp.'.number_format($d->harga,0,".",",").'</p>
						<p>'.$d->desc.'</p>
					</center>';
		}

		echo $data;
	}

	public function keunggulan(){

		$q = $this->m->getData('keunggulan');

		$no = 1;

		$key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
			<table class="table table-striped" id="tdata">
				<thead>
					<tr>
						<th>No</th>
						<th>Konten</th>
						<th>Link</th>
						<th>Stat</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>';

		foreach($q as $d){

			$id = $d->id;

			$data.= '
					<tr>
						<td>'.$no++.'</td>
						<td>'.word_limiter($d->konten,25).'</td>
						<td>'.$d->link.'</td>';
			if($d->stat != 'Show'){
				$data.='	<td><p class="badge badge-dark">'.$d->stat.'</p></td>
						<td>
							<button type="button" class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-outline-info" onclick="show('.$id.');"><i class="fas fa-fw fa-info-circle"></i> Tampilkan</button>
						</td>';
			}else{
				$data.='	<td><p class="badge badge-primary">'.$d->stat.'</p></td>
						<td>
							<button type="button" class="btn btn-outline-success" onclick="formCrud('.$id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-outline-dark" onclick="ngumpet('.$id.');"><i class="fas fa-fw fa-eye-slash"></i> Sembunyikan</button>
						</td>';
			}
			$data.='</tr>
			';
		}

		$data.=' </tbody>
		</table>';

		echo json_encode($data);
	}

	public function plusInfo($id){

		$q = $this->m->where('keunggulan',array('id'=>$id));

		foreach($q as $d){

			$data='<p>'.$d->konten.'</p>';
		}

		echo $data;
	}

	public function slider_plus(){

		$q = $this->m->getData('slider_plus');

		$no = 1;

		$key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
			<table class="table table-striped" id="tdata">
				<thead>
					<tr>
						<th>No</th>
						<th>Konten</th>
						<th>Link</th>
						<th>Stat</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>';

		foreach($q as $d){

			$data.-'<tr>
						<td>'.$no++.'</td>
						<td>'.word_limiter($d->konten,5).'</td>
						<td>'.$d->link.'</td>
						<td>'.$d->stat.'</td>
						<td>OPSI</td>
					</tr>';
		}

		$data.='</tbody>
			</table>';

		echo json_encode($data);
	}

	public function galeri(){

		$q = $this->m->getData('galeri');

		$no = 1;

		$key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
			<table class="table table-striped" id="tdata">
				<thead>
					<tr>
						<th>No</th>
						<th>Foto</th>
						<th>Stat</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>';
		foreach($q as $d){

			$data.='<tr>
						<td>'.$no++.'</td>
						<td>
							<img src="'.base_url().'assets/upload/galeri/'.$d->foto.'" alt="" width="100" height="100">
						</td>';
			if($d->stat != 'Show'){

				$data.= '<td><i class="badge badge-dark">'.$d->stat.'</i></td>
						<td>
							<button class="btn btn-success" onclick="formCrud('.$d->id.')"><i class="fas fa-fw fa-edit"></i> Edit</button>
							<button class="btn btn-info" onclick="show('.$d->id.')"><i class="fas fa-fw fa-eye"></i> Tampilkan</button>
						</td>';
			}else{

				$data.= '<td><i class="badge badge-info">'.$d->stat.'</i></td>
						<td>
							<button class="btn btn-success" onclick="formCrud('.$d->id.')"><i class="fas fa-fw fa-edit"></i> Edit</button>
							<button class="btn btn-dark"><i class="fas fa-fw fa-eye-slash"></i> Sembunyikan</button>
						</td>';
			}
			$data.='</tr>';
		}
		$data.= '</tbody>
			</table>';

			echo json_encode($data);
	}
	
	public function testimoni(){
	    
	    $q = $this->m->getData('testimoni');
	    
	    $no = 1;

		$key1 = "'baru'";

		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
			<table class="table table-striped" id="tdata">
				<thead>
					<tr>
						<th>No</th>
						<th>Foto</th>
						<th>Nama</th>
						<th>Deskripsi</th>
						<th>Kontak</th>
						<th>Stat</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>';
		
		foreach($q as $d){
		    
		    $data.='<tr>
		                <td>'.$no++.'</td>
		                <td>
		                    <img src="'.base_url().'assets/upload/jejaring/'.$d->foto.'" width="50" height="50" /><br><br>
		                    <button onclick="editImg('.$d->id.')" class="btn btn-outline-success">Ubah<?button>
		                </td>
		                <td>'.$d->nama.'</td>
		                <td>'.word_limiter($d->testi,10).'</td>
		                <td>+'.$d->kontak.'</td>';
		    if($d->stat != 'Show'){
		        
		        $data.='    <td><i class="badge badge-dark">'.$d->stat.'</i></td>
		                    <td>
		                        <button class="btn btn-success"  onclick="formCrud('.$d->id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
		                        <button class="btn btn-info"  onclick="show('.$d->id.');"><i class="fas fa-fw fa-eye"></i></button>
		                    </td>';
		    }else{
		        
		        $data.='    <td><i class="badge badge-success">'.$d->stat.'</i></td>
		                    <td>
		                        <button class="btn btn-success" onclick="formCrud('.$d->id.');"><i class="fas fa-fw fa-edit"></i> Edit</button>
		                        <button class="btn btn-dark" onclick="ngumpet('.$d->id.');"><i class="fas fa-fw fa-eye-slash"></i></button>
		                    </td>';
		    }
		    $data.='</tr>';
		}
		
		$data.= '</tbody>
		    </table>';
		    
		echo json_encode($data);
	}
	
	public function jejaringInfo($id){
	    
	    $q = $this->m->where('testimoni',array('id'=>$id));
	    
	    foreach($q as $d){
	        
	        $data = '<center>
	                    <h3>'.$d->nama.'</h3>
	                    <img width="100" height="100" src="'.base_url().'assets/upload/jejaring/'.$d->foto.'" /><br><br>
	                    <p>'.$d->testi.'<p>
	                </center>';
	    }
	    
	    echo $data;
	}

	public function tim(){

		$q = $this->m->getData('tim');
		$no = 1;
		$key1 = "'baru'";
		$data = '<button type="button" class="btn btn-primary mb-3" onclick="formCrud('.$key1.');"><i class="fas fa-fw fa-plus"></i> Tambah Data</button>
				<table class="table table-striped" id="tdata">
					<thead>
						<tr>
							<th>No</th>
							<th>Foto</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Sosmed</th>
							<th>Stat</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>';
		foreach($q as $d){

			$id = "'".$d->id."'";
			$nama = "'".$d->nama."'";
			$data .= '<tr>
						<td>'.$no++.'</td>
						<td>
							<img src="'.base_url().'assets/upload/fotoTim/'.$d->foto.'" width="100" height="100"/><br><br>
							<button type="button" onclick="ubahFoto('.$id.')" class="btn btn-outline-success">Ubah</button>
						</td>
						<td>'.$d->nama.'</td>
						<td>'.$d->jabatan.'</td>
						<td>Facebook '.$d->fb.'| Instagram @'.$d->ig.' | Linked In '.$d->link.'</td>';
			if($d->stat != 'Show'){

				$data.= '<td>
							<i class="badge badge-dark">Hidden</i>
						</td>
						<td>
							<button type="button" class="btn btn-outline-success" onclick="formCrud('.$id.')"><i class="fas fa-fw fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-outline-info" onclick="show('.$id.','.$nama.');"><i class="fas fa-fw fa-eye"></i> Tampilkan</button>
						</td>';
			}else{
				$data.= '<td>
							<i class="badge badge-info">Shown</i>
						</td>
						<td>
							<button type="button" class="btn btn-outline-success" onclick="formCrud('.$id.')"><i class="fas fa-fw fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-outline-dark" onclick="ngumpet('.$id.','.$nama.');"><i class="fas fa-fw fa-eye-slash"></i> Sembunyikan</button>
						</td>';
			}
						
			$data.=	'</tr>';
		}
		$data .= '
					</tbody>
				</table>';
		echo json_encode($data);
	}

	public function unduhan($id){

		$q = $this->m->where('marketing_tools',array('id'=>$id));

		foreach($q as $d){

			$path = base_url().'assets/upload/attach/'.$d->file;
		}

		echo json_encode($path);
	}

	public function bannerMarketing($id){

		$q = $this->m->where('marketing_tools',array('id'=>$id));

		foreach($q as $d){

			$data = '<center>
						<img src="'.base_url().'assets/upload/banner/'.$d->banner.'" width="200" height="100" class="mb-5" alt="">
						<div>
							'.$d->descr.'
						</div>
					</center>';
		}

		echo $data;
	}

	public function artikel(){

		$q = $this->m->single('SELECT * FROM artikel order by tanggal DESC');
		$data = ''; $no = 1;
		foreach($q as $d){
			$id = "'".$d->id."'";
			$data.='<tr>
						<td>'.$no++.'</td>
						<td>
							<img src="'.base_url().'assets/upload/artikel/'.$d->foto.'" width="100" height="100" alt=""><br><br>
							<button type="button" onclick="editFoto('.$id.')" class="btn btn-outline-success">Ubah</button>
						</td>
						<td>'.$d->judul.'</td>
						<td>'.word_limiter($d->desc,20).'</td>
						<td>'.$d->tanggal.'</td>';
			if($d->stat != 'Show'){

				$data.='<td><i class="badge badge-dark">'.$d->stat.'</i></td>
						<td>
							<button type="button" onclick="show('.$id.');" class="btn btn-outline-info"><i class="fas fa-fw fa-eye"></i> Tampilkan</button>
							<button type="button" onclick="formCrud('.$id.')" class="btn btn-outline-success"><i class="fas fa-fw fa-edit"></i> Edit</button>
						</td>';
			}else{
				$data.='<td><i class="badge badge-info">'.$d->stat.'</i></td>
						<td>
							<button type="button" onclick="ngumpet('.$id.');" class="btn btn-outline-dark"><i class="fas fa-fw fa-eye"></i> Sembunyikan</button>
							<button type="button" onclick="formCrud('.$id.')" class="btn btn-outline-success"><i class="fas fa-fw fa-edit"></i> Edit</button>
						</td>';
			}
			$data.='</tr>';
		}

		echo json_encode($data);
	}

	/*Pelatihan*/

	public function pelatihan()
	{
		$q = $this->m->getData('pelatihan');

		$no = 1;
		$data = '';
		foreach($q as $d)
		{
			$id = "'".$d->id."'";
			$nama = "'".$d->nama."'";
			$data .= '
											<tr>
												<td>'.$no++.'</td>
												<td>
													<img src="'.base_url().'assets/upload/pelatihan/'.$d->foto.'" width="50" height="50" alt="">
												</td>
												<td>'.$d->id_pelatihan.'</td>
												<td>'.$d->nama.'</td>
												<td>'.$d->lokasi.'</td>
												<td>'.$d->waktu.'</td>
												<td>'.number_format($d->harga,0,",",".").'</td>
												<td>'.$d->booked.'/'.$d->kuota.'</td>
												<td>'.word_limiter($d->desc, 10).'</td>';
			if($d->stat != "Show")
			{
				$data.='<td><i class="badge badge-dark">'.$d->stat.'</i></td>
						<td>
							<button class="btn btn-outline-success" onclick="formCrud('.$id.')"><i class="fas fa-fw fa-edit" ></i></button>
							<button class="btn btn-outline-info" onclick="show('.$id.','.$nama.');"><i class="fas fa-fw fa-eye"></i></button>
						</td>';
			}else
			{
				$data.='<td><i class="badge badge-success">'.$d->stat.'</i></td>
						<td>
							<button class="btn btn-outline-success" onclick="formCrud('.$id.')"><i class="fas fa-fw fa-edit"></i></button>
							<button class="btn btn-outline-dark"  onclick="ngumpet('.$id.','.$nama.');"><i class="fas fa-fw fa-eye-slash"></i></button>
						</td>';
			}
			$data.='								</tr>';
		}

		echo json_encode($data);
	}
}

?>