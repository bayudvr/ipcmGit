<?php defined('BASEPATH') or exit('No direct path allowed');

class Pelatihan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_model','m',true);
    }

    
}
?>