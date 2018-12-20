<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainings extends CI_Model
{
	public $tbl_name = "trainings";

	public $ID 		 	= "ID";
	public $ORG_ID	 	= "ORG_ID";
	public $BRANCH_ID 	= "BRANCH_ID";
	public $DEPT_ID 	= "DEPT_ID";
	public $T_COUNT 	= "T_COUNT";
	public $USERNAME	= "USERNAME";
	public $TR_TYPE 	= "TR_TYPE";
	public $SUBJECT 	= "SUBJECT";
	public $TR_DATE 	= "TR_DATE";
	public $TR_TIME		= "TR_TIME";
	public $TR_TO 		= "TR_TO";
	public $REMARKS 	= "REMARKS";
	public $FEEDBACK 	= "FEEDBACK";
	public $TR_COMP 	= "TR_COMP";
	public $TR_BY 		= "TR_BY";
	public $STATUS 		= "STATUS";
}

/* End of file Trainings.php */
/* Location: ./application/models/Trainings.php */