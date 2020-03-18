<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class IOFactory extends PHPExcel_IOFactory
{

	public function __construct(){

		parent::__construct();
		require_once('PHPExcel/IOFactory.php');
	}
}


?>