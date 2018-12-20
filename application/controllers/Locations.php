<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("city");
		$this->load->model("country");
		$this->load->model("state");
	}

	public function index()
	{
		echo "<h1>Access Forbidden</h1>";
	}

	public function get_all_countries()
	{
		$where = array();
		$where['STATUS']= ACTIVESTS;
		$select = 'COUNTRY_NAME,COUNTRY_CODE';
		$limit="";
		$offset="";
		$data['countries'] = $this->country->get_countries($where,$select,$limit,$offset);
		if(!empty($data['countries']))
		{
			$data['response'] = SUCCESSDATA;
		}
		else
		{
			$data['response'] = FAILEDATA;
		}
		$jdata = json_encode($data);
		echo $jdata;
	}

	public function get_states()
	{
		$jodata = json_decode($this->security->xss_clean($this->input->raw_input_stream));
		$action = $jodata->action;
		$where = array();
		if($action=="get_states_by_country")
		{
			$where['COUNTRY_CODE']=$jodata->contry_code;
			$where['STATUS']= ACTIVESTS;
			$select = 'STATE_NAME,STATE_CODE';
			$limit="";
			$offset="";
			$data['states'] = $this->state->get_states($where,$select,$limit,$offset);
			if(!empty($data['states']))
			{
				$data['response'] = SUCCESSDATA;
			}
			else
			{
				$data['response'] = FAILEDATA;
			}
		}
		$jdata = json_encode($data);
		echo $jdata;
	}

	public function get_cities()
	{
		$jodata = json_decode($this->security->xss_clean($this->input->raw_input_stream));
		$action = $jodata->action;
		$where = array();
		if($action=="get_cities_by_state")
		{
			$where['STATE_CODE']=$jodata->state_code;
			$where['STATUS']= ACTIVESTS;
			$select = 'CITY_NAME,CITY_CODE';
			$limit="";
			$offset="";
			$data['cities'] = $this->city->get_cities($where,$select,$limit,$offset);
			if(!empty($data['cities']))
			{
				$data['response'] = SUCCESSDATA;
			}
			else
			{
				$data['response'] = FAILEDATA;
			}
		}
		$jdata = json_encode($data);
		echo $jdata;
	}
}

/* End of file Locations.php */
/* Location: ./application/controllers/Locations.php */