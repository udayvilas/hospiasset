<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incedents extends CI_Model
{
    public $tbl_name = "incident";

    public $ID   	        = "ID";
    public $DATE_OCCRANCE 	= "DATE_OCCRANCE";
    public $TIME_OCCRANCE   = "TIME_OCCARANCE";
    public $INCIDENT_TYPE   = "INCIDENT_TYPE";
    public $RESPONSE   	    = "RESPONSE";
    public $COMPLETION      = "COMPLETION";
    public $FEEDBACK        = "FEEDBACK";
    public $DEPT_ID         = "DEPT_ID";
    public $EQUP_ID         = "EQUP_ID";
    public $INCHARGE_COMMENT = "INCHARGE_COMMENT";
    public $OBSERVATIONS    = "OBSERVATIONS";
    public $OCCRANCE_REPORT = "OCCRANCE_REPORT";
    public $SPARES          = "SPARES";
    public $ACCESSORIES     = "ACCESSORIES";
    public $APPROXIMATE_COST = "APPROXIMATE_COST";
    public $TOTAL_COST      = "TOTAL_COST";
    public $ACTION_TACKEN   = "ACTION_TACKEN";
    public $ADDED_ON        = "ADDED_ON";
    public $ADDED_BY        = "ADDED_BY";
    public $ADDED_BY_NAME   = "ADDED_BY_NAME";
    public $UPDATED_ON      = "UPDATED_ON";
    public $UPDATED_BY      = "UPDATED_BY";
    public $STATUS          = "STATUS";
    public $BRANCH_ID       = "BRANCH_ID";
    public $ORG_ID          = "ORG_ID";
    public $COMPLETE_REMARKS = "COMPLETE_REMARKS";
    public $COMPLETED_BY     = "COMPLETED_BY";
    public $COMPLETED_ON     = "COMPLETED_ON";
    public $ASSIGN_REMARKS = "ASSIGN_REMARKS";
    public $APPROVED_BY = "APPROVED_BY";
    public $ASSIGNED_BY    = "ASSIGNED_BY";
    public $ASSIGNED_TO       = "ASSIGNED_TO";
    public $CHIEF_ENG_OBSERV  = "CHIEF_ENG_OBSERV";
    public $OPERATOR_OBSER    = "OPERATOR_OBSER";
    public $CONCLUSION        = "CONCLUSION";
    public $RESTORATION_TIME  = "RESTORATION_TIME";
    public $OPERATOR_NAME     = "OPERATOR_NAME";
    public $NATURE_REPORT     = "NATURE_REPORT";
    public $CAUSE_PROBABILITY = "CAUSE_PROBABILITY";
}

/* End of file Equphistory.php */
/* Location: ./application/models/Equphistory.php */