<?php defined('BASEPATH') or exit('No direct script allowed');

class User extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('M_model','m',true);
	}

	public function index(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('user/home',$data);
	}

	public function profile(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('user/profile',$data);
	}

	public function virtual_card(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('user/virtual_card',$data);
	}

	public function marketing_tools(){

		$id = $this->session->userdata('id');

		$data['user'] = $this->m->where('user',array('id'=>$id));

		$this->load->view('user/marketing_tools',$data);
	}
}

?>