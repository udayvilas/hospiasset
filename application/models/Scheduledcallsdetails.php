<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Scheduledcallsdetails extends CI_Model

{

    public $tbl_name = "scheduledcallsdetails";



    public $ID				= "ID";

    public $JOB_ID			= "JOB_ID";

    public $ORG_ID			= "ORG_ID";

    public $BRANCH_ID		= "BRANCH_ID";

    public $EID				= "EID";

    public $SCHEDULED_COUNT		= "SCHEDULED_COUNT";

    public $SCHEDULE_TYPE     = "SCHEDULE_TYPE";

    public $SCHEDULED_COUNT_TYPE	= "SCHEDULED_COUNT_TYPE";

    public $SCHEDULED_DONE 		= "SCHEDULED_DONE";

    public $SCHEDULED_DUE			= "SCHEDULED_DUE";

    public $ASSIGNED_BY 	= "ASSIGNED_BY";

    public $ASSIGNED_TO		= "ASSIGNED_TO";

    public $ASSIGNED_ON		= "ASSIGNED_ON";

    public $COMPLETED_BY	= "COMPLETED_BY";

    public $TD 				= "TD";

    public $COST			= "COST";

    public $CALL_TYPE       = "CALL_TYPE";

    public $PRE_SCHEDULED_DETAILS	= "PRE_SCHEDULED_DETAILS";

    public $SCHEDULED_DONE_COUNT	= "SCHEDULED_DONE_COUNT";

    public $SCHEDULED_ACTL_DONE	= "SCHEDULED_ACTL_DONE";

    public $COMPLETED_REMARKS= "COMPLETED_REMARKS";

    public $ASSIGN_REMARKS	= "ASSIGN_REMARKS";

}



/* End of file QcDetails.php */

/* Location: ./application/models/QcDetails.php */