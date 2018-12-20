<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Model
{
	public $tbl_name = "departments";

	public $DEPT_AID   	= "DEPT_AID";
	public $DEPT_ID  = "DEPT_ID";
	public $DEPT_CODE	= "DEPT_CODE";		public $ORG_MODULE = "ORG_MODULE";
	public $DEPT_NAME  = "DEPT_NAME";
	public $ORGANIZATION  = "ORGANIZATION";
	public $BRANCH  = "BRANCH";
	public $ADDED_ON  = "ADDED_ON";
	public $ADDED_BY  = "ADDED_BY";
	public $UPDATED_ON  = "UPDATED_ON";
	public $UPDATED_BY  = "UPDATED_BY";
	public $STATUS  = "STATUS";
}

/* End of file Departments.php */
/* Location: ./application/models/Departments.php */