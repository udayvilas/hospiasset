<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model
{
	public $tbl_name = "category";

	public $CATG_ID   	= "CATG_ID";
	public $CATG_CODE  	= "CATG_CODE";
	public $CATG_NAME	= "CATG_NAME";
	public $ADDED_ON  	= "ADDED_ON";
	public $ADDED_BY  	= "ADDED_BY";
	public $UPDATED_ON  = "UPDATED_ON";
	public $UPDATED_BY  = "UPDATED_BY";
	public $STATUS  	= "STATUS";
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */