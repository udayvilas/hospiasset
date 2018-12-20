<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QcDetails extends CI_Model
{
	public $tbl_name = "qc_details";

	public $ID				= "ID";
	public $JOB_ID			= "JOB_ID";
	public $ORG_ID			= "ORG_ID";
	public $BRANCH_ID		= "BRANCH_ID";
	public $EID				= "EID";
	public $QC_COUNT		= "QC_COUNT";
	public $QC_COUNT_TYPE	= "QC_COUNT_TYPE";
	public $QC_DONE 		= "QC_DONE";
	public $QC_DUE			= "QC_DUE";
	public $ASSIGNED_BY 	= "ASSIGNED_BY";
	public $ASSIGNED_TO		= "ASSIGNED_TO";
	public $ASSIGNED_ON		= "ASSIGNED_ON";
	public $COMPLETED_BY	= "COMPLETED_BY";
	public $TD 				= "TD";
	public $COST			= "COST";
	public $PRE_QC_DETAILS	= "PRE_QC_DETAILS";
	public $QC_DONE_COUNT	= "QC_DONE_COUNT";
	public $QC_ACTL_DONE	= "QC_ACTL_DONE";
	public $COMPLETED_REMARKS= "COMPLETED_REMARKS";
	public $ASSIGN_REMARKS	= "ASSIGN_REMARKS";
}

/* End of file QcDetails.php */
/* Location: ./application/models/QcDetails.php */