<?php defined('BASEPATH') or exit('No direct path allowed');

class Home extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
		
		$this->load->helper(array('string','text'));
	}

	public function index(){

		$this->visit();

		$data['slider'] = $this->m->where('slider',array('stat'=>'Show'));
		$data['slider1'] = $this->m->single('SELECT * from slider where stat = "Show" LIMIT 1');
		$data['c_slider'] = $this->m->single('SELECT count(id) as jumlah from slider where stat ="Show"');
		$data['about'] = $this->m->where('about',array('stat'=>'Show'));
		$data['produk'] = $this->m->where('produk',array('stat'=>'Ready'));
		$data['galeri_produk'] = $this->m->getData('galeri_produk');
		$data['plus'] = $this->m->where('keunggulan',array('stat'=>'Show'));
		$data['galeri'] = $this->m->where('galeri',array('stat'=>'Show'));
		$data['jejaring']  = $this->m->single('SELECT * FROM testimoni where stat = "Show" limit 3');
		$data['tim'] = $this->m->where('tim',array('stat'=>'Show'));
		$data['blog'] = $this->m->single('SELECT * FROM artikel where stat = "Show" order by tanggal DESC limit 4');
		$data['artikel'] = $this->m->single('SELECT * FROM artikel where stat = "Show" order by tanggal desc limit 3');
		$tanggal = $this->m->single('select curdate() as tgl');
		foreach($tanggal as $t){ $tgl = $t->tgl; }
		$data['visit'] = $this->m->where('visit',array('tanggal'=>$tgl));

		$this->load->view('home',$data);
	}

	public function visit()
	{
		$now = $this->m->single('SELECT curdate() as now');

		foreach($now as $d)
		{
			$waktu = $d->now;
		}

		$cek = $this->m->where('visit',array('tanggal'=>$waktu));

		if(count($cek) != 0)
		{
			foreach($cek as $c)
			{
				$jumlah = $c->qty+1;
			}

			$this->m->update('visit',array('qty'=>$jumlah),array('tanggal'=>$waktu));
		}else
		{
			$this->m->insert('visit',array('qty'=>1,'tanggal'=>$waktu));
		}
	}
}

?>