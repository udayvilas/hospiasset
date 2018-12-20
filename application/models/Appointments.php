<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointments extends CI_Model
{
	public $tbl_name = "appointments";

	public $ID = "ID";
	public $ORG_ID = "ORG_ID";
	public $APT_DATE = "APT_DATE";
	public $APT_TIME = "APT_TIME";
	public $CONTACT_PERSON = "CONTACT_PERSON";
	public $APT_PLACE = "APT_PLACE";
	public $APT_FEEDBACKS = "APT_FEEDBACKS";
	public $APT_CONTACT_TYPE = "APT_CONTACT_TYPE";
	public $APT_STATUS = "APT_STATUS";
	public $PRVS_APT_DATES = "PRVS_APT_DATES";
	public $ADDED_ON = "ADDED_ON";
	public $ADDED_BY = "ADDED_BY";
	public $UPDATED_ON = "UPDATED_ON";
	public $UPDATED_BY = "UPDATED_BY";
	public $STATUS 		= "STATUS";
	public $ORG_NAME 	= "ORG_NAME";
	public $LATITUDE 	= "LATITUDE";
	public $LOGITUDE 	= "LOGITUDE";
}

/* End of file Organizations.php */
/* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/Organizations.php */
