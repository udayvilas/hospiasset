<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hbuser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('hbuser/home');
    }
    public function generate_call()
    {
        $this->load->view('generate_call');
    }
    public function training_feedback()
    {
        $this->load->view('training_feedback');
    }
}