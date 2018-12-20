<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller
{

	public function index()
	{
        $this->load->view('login-register');
	}
	public function main_home() /* For Client Login */
	{
		$this->load->view('main-sidenav');
	}
	public function ma_admin_home() /* Hospital Admin */
	{
		$this->load->view('main-sidenav-hadmin');
	}
	public function files($dir_name)
	{
		$dir = DEVICE_UPLOAD_PATH.$dir_name;
		if (is_dir($dir))
		{
			if ($dh = opendir($dir))
			{
				while (($file = readdir($dh)) !== false)
				{
					if($file!="." OR $file!="..")
					echo "<li> <a href='".base_url().$dir."/".$file."'>".$file."</li>";
				}
				closedir($dh);
			}
		}
	}
	public function callgeneration()
	{
		$this->load->view('generate_call_all');
	}

	public function coming_soon()
	{
		$this->load->view('cmgsoon');
	}
	public function cg($days,$format)
	{
		$day = date("Y-m-d", strtotime(date('Y-m-d'))) . " + ".$days." ".$format;
		echo date('Y-m-d',strtotime($day));
	}

	public function error_resp()
	{
		$data=array("response"=>"error","call_back"=>"Invalid Request");
		echo json_encode($data);
		return false;
	}	public function hello($val='',$val3='',$val2='')	{		echo "Hi ".$val.$val2.$val3;		$this->load->view('cmgsoon');	}
}