<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function where($table,$data){
		$res = $this->db->get_where($table,$data);
		return $res->result();
	}

	public function getData($table){
		$res=$this->db->get($table)->result();

		return $res;
	}

	public function insert($table,$data){
		$this->db->insert($table,$data);
		
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function delete($table,$data){
		$this->db->delete($table,$data);

		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function update($table,$data,$where){
		
		$this->db->where($where);		
		$this->db->update($table,$data);

		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function single($sql){

		$res = $this->db->query($sql)->result();
		return $res;
	}

}


?>