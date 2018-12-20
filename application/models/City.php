<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Model
{
	private $tbl_name = 'hsp_tbl_cities';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_cities($where="",$select="",$limit="",$offset="")
	{
		$this->db->order_by("CITY_NAME", "ASC");
		$this->db->select($select);
		$result = $this->db->get_where($this->tbl_name, $where, $limit, $offset);
		return $result->result_array();
	}

}

/* End of file City.php */
/* Location: ./application/models/City.php */