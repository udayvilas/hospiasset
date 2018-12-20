<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PmsDetails extends CI_Model
{
	public $tbl_name 		= "pms_details";

	public $ID				= "ID";
	public $JOB_ID			= "JOB_ID";
	public $EID				= "EID";
	public $ORG_ID			= "ORG_ID";
	public $BRANCH_ID		= "BRANCH_ID";
	public $PMS_COUNT		= "PMS_COUNT";
	public $PMS_DONE		= "PMS_DONE";
	public $PMS_DUE_DATE	= "PMS_DUE_DATE";
	public $PMS_ASSIGNED_BY	= "PMS_ASSIGNED_BY";
	public $ASSIGNED_ON		= "ASSIGNED_ON";
	public $PMS_ASSIGNED_TO	= "PMS_ASSIGNED_TO";
	public $COMPLETED_BY	= "COMPLETED_BY";
	public $SW				= "SW";
	public $ACC				= "ACC";
	public $SPARES			= "SPARES";
	public $CLEAN			= "CLEAN";
	public $TD				= "TD";
	public $PRE_PMS_DETAILS	= "PRE_PMS_DETAILS";
	public $PMS_DONE_COUNT	= "PMS_DONE_COUNT";
	public $PMS_ACTL_DONE	= "PMS_ACTL_DONE";
	public $ASSIGN_REMARKS	= "ASSIGN_REMARKS";
	public $COMPLETED_REMARKS	= "COMPLETED_REMARKS";
}

/* End of file PmsDetails.php */
/* Location: ./application/models/PmsDetails.php */