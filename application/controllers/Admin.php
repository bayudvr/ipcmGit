<?php defined('BASEPATH') or exit('No direct script allowed');

class Admin extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);

		$id = $this->session->userdata('id');

		$q = $this->m->where('user',array('id'=>$id));

		if(count($q) < 1){

			redirect();
		}

	}

	public function index(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));
		$data['total'] = $this->m->single('SELECT count(id) as jumlah from user where acc_stat = "Active" or acc_stat = "Approved"');
		$data['anggota'] = $this->m->single('SELECT count(id) as jumlah from user where acc_stat = "Active"');
		$data['member'] = $this->m->single('SELECT count(id) as jumlah from user where acc_stat = "Approved"');

		$this->load->view('admin/dashboard',$data);
	}

	public function anggota(){


		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/anggota',$data);

	}

	public function member(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/member',$data);
	}

	/*Front End Data*/

	public function slider(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/slider',$data);
	}

	public function about(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/about',$data);
	}

	public function produk(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/produk',$data);	
	}

	public function keunggulan(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/keunggulan',$data);
	}

	public function slider_plus(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/slider_plus',$data);
	}

	public function galeri(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/galeri',$data);
	}
	
	public function jejaring(){
	    
	    $id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/testimonial',$data);
	}
	
	public function profil(){
	    
	     $id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/profile',$data);
	}

	public function tim(){

		 $id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/tim',$data);
	}
	
	
	public function marketing_tools(){
	    
	    $id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/marketing',$data);
	}

	public function artikel(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/artikel',$data);	
	}

	public function pelatihan()
	{
		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('admin/pelatihan',$data);
	}
}
?>