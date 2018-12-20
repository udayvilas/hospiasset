<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends CI_Model
{
	public $tbl_name = 'states';
	public $STATE_ID = 'STATE_ID';
	public $STATE_CODE = 'STATE_CODE';	public $ORG_MODULE  = 'ORG_MODULE';
	public $STATE_NAME = 'STATE_NAME';
	public $COUNTRY_CODE = 'COUNTRY_CODE';
	public $ADDED_ON = 'ADDED_ON';
	public $ADDED_BY  	= "ADDED_BY";
	public $UPDATED_ON 	= "UPDATED_ON";
	public $UPDATED_BY 	= "UPDATED_BY";
	public $STATUS  	= "STATUS";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_states($where="",$select="",$limit="",$offset="")
	{
		$this->db->order_by("STATE_NAME", "ASC");
		$this->db->select($select);
		$result = $this->db->get_where($this->db->dbprefix($this->tbl_name), $where, $limit, $offset);
		return $result->result_array();
	}
}

/* End of file State.php */
/* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/State.php */