<?php defined('BASEPATH') or exit('No direct path allowed');

class Pelatihan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_model','m',true);
    }

    public function index()
    {
        $nama = urldecode($_GET['k']);

		$data['produk'] = $this->m->where('produk',array('stat'=>'Ready'));
		$data['pelatihan'] = $this->m->where('pelatihan',array('nama'=>urldecode($nama)));
		$data['artikel'] = $this->m->single('SELECT * FROM artikel where stat = "Show" order by tanggal desc limit 3');
		
		$this->load->view('pelatihan_single',$data);
    }
}
?>