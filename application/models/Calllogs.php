<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CallLogs extends CI_Model
{
	public $tbl_name = "call_logs";

	public $ID   		= "ID";
	public $BRANCH_ID   = "BRANCH_ID";
	public $ORG_ID   	= "ORG_ID";
	public $USERNAME  	= "USERNAME";
	public $DESCRIPTION	= "DESCRIPTION";
	public $ENTRY  		= "ENTRY";
	public $DATE  		= "DATE";
	public $TIME  		= "TIME";
	public $STATUS  	= "STATUS";
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */