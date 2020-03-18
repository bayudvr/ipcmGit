<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email
{
	protected $ci;
	protected $config;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://sispadu.com',
               'smtp_user' => 'no_reply@sispadu.com',
               'smtp_pass' => 'I$(0rF&n;S})',
               'smtp_port' => 465,
               'crlf'      => "\r\n",
               'newline'   => "\r\n"
        ];
	}

	public function send($arr)
	{
		$data['token'] = $arr['v_token'];
		$data['kode'] = $arr['v_code'];
		$msg = $this->ci->load->view('email_temp/email_confirm_v.php', $data, TRUE);
		$config = $this->config;

		$this->ci->load->library('email', $config);
		$this->ci->email->initialize($config);
		$this->ci->email->from('no_reply@sispadu.com', 'PLATINUM');
		$this->ci->email->to($arr['v_email']);
		// $this->ci->email->cc('another@example.com');
		// $this->ci->email->bcc('and@another.com');
		$this->ci->email->subject('Pendaftaran Member PLATINUM');
		$this->ci->email->message($msg);
		$this->ci->email->send();
	}

	// $data = [
	// 	'title' => 'Title',
	// 	'header' => 'Header',
	// 	'msg' => 'Isi pesan',
	// 	'button' => [
	// 		'text' => 'button text',
	// 		'link' => 'button link'
	// 	]
	// ];
	public function send_alert($arr=[])
	{
		$data['title'] = $arr['title'];
		$data['header'] = $arr['header'];
		$data['msg'] = $arr['msg'];
		$data['button'] = $arr['button'];
		$msg = $this->ci->load->view('email_temp/alert_v', $data, TRUE);
		$config = $this->config;
		$this->ci->load->library('email', $config);
		$this->ci->email->initialize($config);
		$this->ci->email->from('no_reply@sispadu.com', 'PLATINUM');
		$this->ci->email->to($arr['email_to']);
		if ($arr['attach'] !== '') {
			foreach($arr['attach']['filename'] as $file_name){   
				$this->ci->email->attach($arr['attach']['path'].$file_name);  
				// $this->ci->email->attach($arr['attach']);
			}
		}
		// $this->ci->email->cc('another@example.com');
		// $this->ci->email->bcc('and@another.com');
		$this->ci->email->subject($arr['title']);
		$this->ci->email->message($msg);
		$this->ci->email->send();
	}


	

}

/* End of file Send_email.php */
/* Location: ./application/libraries/Send_email.php */
