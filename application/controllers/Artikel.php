<?php
defined('BASEPATH') or exit('No direct path allowed!');

class Artikel extends CI_Controller
{
	public function __construct()
	{

		parent::__construct();

		$this->load->model('M_model','m',true);

		$this->load->helper('date');
	}

	public function read()
	{	
		$topik = urldecode($_GET['k']);
		$this->visit($topik);
		$data['produk'] = $this->m->where('produk',array('stat'=>'Ready'));
		$data['artikel'] = $this->m->where('artikel',array('judul'=>$topik));
		$data['blog'] = $this->m->single('SELECT * FROM artikel where stat = "Show" order by tanggal desc limit 3');

		$this->load->view('artikel_single',$data);

	}

	public function list()
	{
		$this->load->library('pagination');

		$config['base_url'] = site_url('artikel/list');
		$config['total_rows'] = $this->db->where('stat','Show')->from('artikel')->count_all_results();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = 'Selanjutnya';
		$config['prev_link'] = 'Sebelumnya';
		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';


		$this->pagination->initialize($config);

		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['pagination'] = $this->pagination->create_links();
		$data['produk'] = $this->m->where('produk',array('stat'=>'Ready'));
		$data['artikel'] = $this->m->single('SELECT * FROM artikel where stat = "Show" order by tanggal DESC limit '.$config["per_page"].' offset '.$data["page"]);
		$data['blog'] = $this->m->single('SELECT * FROM artikel where stat = "Show" order by tanggal desc limit 3');

		$this->load->view('artikel_all',$data);
	}

	public function visit($topik)
	{
		$cek = $this->m->where('artikel',array('judul'=>$topik));

		foreach($cek as $c)
		{
			$total = $c->visit + 1;
		}

		$this->m->update('artikel',array('visit'=>$total),array('judul'=>$topik));
	}
}

?>