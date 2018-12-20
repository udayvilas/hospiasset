<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Model
{
	public $tbl_name = 'countries';
	public $COUNTRY_ID = 'COUNTRY_ID';
	public $COUNTRY_NAME = 'COUNTRY_NAME';
	public $COUNTRY_CODE = 'COUNTRY_CODE';
	public $ADDED_ON = 'ADDED_ON';
	public $ADDED_BY = 'ADDED_BY';
	public $UPDATED_ON = 'UPDATED_ON';
	public $UPDATED_BY = 'UPDATED_BY';
	public $STATUS = 'STATUS';

	public function get_countries($where="",$select="",$limit="",$offset="")
	{
		$this->db->order_by("COUNTRY_NAME", "ASC");
		$this->db->select($select);
		$result = $this->db->get_where($this->db->dbprefix($this->tbl_name), $where, $limit, $offset);
		return $result->result_array();
	}
}

/* End of file Country.php */
/* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/Country.php */