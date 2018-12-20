<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Model
  {	

    public $tbl_name = "cms";	
    public $ID   	= "ID";
	public $ORG_ID  = "ORG_ID";
	public $BRANCH_ID	= "BRANCH_ID";
	public $CALLER_ID  = "CALLER_ID";
	public $CDATE  = "CDATE";	
	public $CTIME  = "CTIME";
	public $TO_ADVERSE  = "TO_ADVERSE";
	public $CALLER_DEPT  = "CALLER_DEPT";	
	public $CALLER_NAME  = "CALLER_NAME";
	public $CALLER_MOBILE  = "CALLER_MOBILE";	
	public $CEMP_ID 	 = "CEMP_ID";	
	public $NATURE_OF_COMP  = "NATURE_OF_COMP";
	public $EID  = "EID";	
	public $TYPE  = "TYPE";	
	public $ATTENDED_BY  = "ATTENDED_BY";	
	public $RESPONDED_BY  = "RESPONDED_BY";	
	public $COMPLETED_BY  = "COMPLETED_BY";	
	public $RESPONDED_DATE  = "RESPONDED_DATE";
	public $RESPONDED_TIME  = "RESPONDED_TIME";
	public $ATTENDED_DATE  = "ATTENDED_DATE";	
	public $ATTENDED_TIME  = "ATTENDED_TIME";	
	public $ACTION_TAKEN  = "ACTION_TAKEN";	
	public $JOBCOMPLETED_DATE  = "JOBCOMPLETED_DATE";	
	public $JOBCOMPLETED_TIME  = "JOBCOMPLETED_TIME";	
	public $PARTS_CHANGE  = "PARTS_CHANGE";	
	public $DOWN_TIME  = "DOWN_TIME";	
	public $REMARKS  = "REMARKS";
	public $REASON   = "REASON";
	public $RESPONSE_TIME  = "RESPONSE_TIME";
	public $TIME_TO_REPAIR  = "TIME_TO_REPAIR";
	public $PENDING_REASON  = "PENDING_REASON";
	public $PENDING_DATE  = "PENDING_DATE";	
	public $PART_TYPE  = "PART_TYPE";	
	public $PART_NAME  = "PART_NAME";	
	public $PO_NUMBER  = "PO_NUMBER";	
	public $PO_DATE  = "PO_DATE";	
	public $DELIVERY_DATE  = "DELIVERY_DATE";	
	public $APPROVAL  = "APPROVAL";
	public $APPROVAL_NAME  = "APPROVAL_NAME";	
	public $ASSIGNED_TO  = "ASSIGNED_TO";	
	public $ASSIGNED_BY  = "ASSIGNED_BY";	
	public $ASSIGNED_ON  = "ASSIGNED_ON";	
	public $ASSIGNED_STATUS = "ASSIGNED_STATUS";
	public $COST  = "COST";	
	public $SPENT_COST  = "SPENT_COST";	
	public $SAVINGS_COST  = "SAVINGS_COST";	
	public $SAVINGS_APPROVE  = "SAVINGS_APPROVE";	
	public $RESPONSE_DELAY_REASON  = "RESPONSE_DELAY_REASON";	
	public $REPAIR_DELAY_REASON  = "REPAIR_DELAY_REASON";
	public $PREVIOUS_CALL_DETAILS  = "PREVIOUS_CALL_DETAILS";
	public $PRIORITY  = "PRIORITY";
	public $STATUS  = "STATUS";
	}
	/* End of file Cms.php *//* Location: ./application/models/Cms.php */