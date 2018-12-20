<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Model
{
    public $tbl_name = "cities";

    public $CITY_ID  	= "CITY_ID";
    public $CITY_NAME  	= "CITY_NAME";
    public $CITY_CODE	= "CITY_CODE";
    public $STATE_CODE  = "STATE_CODE";		public $COUNTRY_CODE = "COUNTRY_CODE";
    public $ADDED_ON 	= "ADDED_ON";
    public $ADDED_BY  	= "ADDED_BY";
    public $UPDATED_ON 	= "UPDATED_ON";
    public $UPDATED_BY 	= "UPDATED_BY";
    public $STATUS  	= "STATUS";
}
/* End of file Cities.php */
/* Location: ./application/models/Cities.php */