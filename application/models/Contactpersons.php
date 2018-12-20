<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactpersons extends CI_Model
{
	public $tbl_name = "contact_persons";

	public $ID   		= "ID";
	public $BRANCH_ID	= "BRANCH_ID";
	public $ORG_ID   	= "ORG_ID";
	public $VENDOR_ID	= "VENDOR_ID";
	public $CP_NAME  	= "CP_NAME";
	public $CP_NUMBER  	= "CP_NUMBER";
	public $CP_EMAIL  	= "CP_EMAIL";
	public $CP_ADDRESS  = "CP_ADDRESS";
	public $CPS_DETAILS  = "CPS_DETAILS";
}

/* End of file Contactpersons.php */
/* Location: ./application/models/Contactpersons.php */