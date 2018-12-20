<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EqupRelocation extends CI_Model
{
	public $tbl_name = "equp_relocation";

	public $ID   				= "ID";
	public $ORG_ID  			= "ORG_ID";
	public $BRANCH_ID 			= "BRANCH_ID";
	public $DEPT_ID 			= "DEPT_ID";
	public $ORIGINAL_ID 		= "ORIGINAL_ID";
	public $PRESENT_ID 			= "PRESENT_ID";
	public $REC_TD 				= "REC_TD";
	public $REC_BY 				= "REC_BY";
	public $RETURN_ID 			= "RETURN_ID";
	public $RETUTN_TD 			= "RETUTN_TD";
	public $RETURN_RECIVED_BY	= "RETURN_RECIVED_BY";
	public $STATUS  			= "STATUS";
}

/* End of file EqupRelocation.php */
/* Location: ./application/models/EqupRelocation.php */