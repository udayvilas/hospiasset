<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserStatus extends CI_Model
{
	public $tbl_name = "user_status";
	
	public $SNO			= "SNO";
	public $ORG_ID		= "ORG_ID";
	public $BRANCH_ID	= "BRANCH_ID";
	public $DEPT_ID		= "DEPT_ID";
	public $USER_NAME	= "USER_NAME";
	public $ON_DUTY 	= "ON_DUTY";
	public $ON_DUTY_TD	= "ON_DUTY_TD";
	public $OF_DUTY 	= "OF_DUTY";
	public $OF_DUTY_TD	= "OF_DUTY_TD";
	public $LEAVES 		= "LEAVES";
	public $LEAVES_TD	= "LEAVES_TD";
}

/* End of file UserStatus.php */
/* Location: ./application/models/UserStatus.php */