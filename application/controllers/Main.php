<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('main');
    }
    public function add_equp_name()
    {
        $this->load->view('add_equp_name');
    }
    public function show_equp_names()
    {
        $this->load->view('show_equp_names');
    }
}
