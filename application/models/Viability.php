<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viability extends CI_Model
{
	public $tbl_name = "viability";

	public $ID						= "ID";
	public $VID						= "VID";
	public $ORG_ID					= "ORG_ID";
	public $BRANCH_ID				= "BRANCH_ID";
	public $DEPT_ID					= "DEPT_ID";
	public $E_ID					= "E_ID";
	public $COST_OF_CONSUMABLES		= "COST_OF_CONSUMABLES";
	public $NUM_OPER_PER_YEAR		= "NUM_OPER_PER_YEAR";
	public $DISPOSABLE_COST			= "DISPOSABLE_COST";
	public $NO_CASES_DONE_DAILY		= "NO_CASES_DONE_DAILY";
	public $CHRGS_PER_OPE			= "CHRGS_PER_OPE";
	public $REV_PER_YEAR			= "REV_PER_YEAR";
	public $PROFIT_PER_YEAR			= "PROFIT_PER_YEAR";
	public $PROFIT_THREE_YEARS		= "PROFIT_THREE_YEARS";
	public $CODE_OPERATION			= "CODE_OPERATION";
	public $JUSTIFICATION			= "JUSTIFICATION";
	public $ADVANTAGES				= "ADVANTAGES";
	public $TECH_SPECF_EQ_PURC		= "TECH_SPECF_EQ_PURC";
	public $ADDED_ON				= "ADDED_ON";
	public $ADDED_BY				= "ADDED_BY";
	public $UPDATED_ON				= "UPDATED_ON";
	public $UPDATED_BY				= "UPDATED_BY";

}

/* End of file Viability.php */
/* Location: application/models/Viability.php */