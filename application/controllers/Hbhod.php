<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hbhod extends CI_Controller {  

  function __construct()  
  {     
  parent::__construct();    
  }    
  public function index()  
  {      
  $this->load->view('hbhod/home');   
  }   
  public function users()   
  {     
  $this->load->view('hbhod/users');  
  }   
  public function add_user()   
  {   
  $this->load->view('hbhod/add-user');  
  }    
  public function device_vendor()   
  {     
  $this->load->view('device_vendor'); 
  }  
  public function add_vendor()   
  {     
  $this->load->view('add_vendor'); 
  } 
  public function importAsset()   
  {       
  $this->load->view('import-assetlist');  
  }   
  public function addAsset()   
  {  
  $this->load->view('add-device');   
  }   
  public function search()   
  {       
  $this->load->view('search');  
  }   
  public function labelPrint()  
  {       
  $this->load->view('print-labels'); 
  }  
  public function EquipmentSummary()   
  {       
  $this->load->view('equp_summary');  
  }   
  public function show_equp_names()    
  {      
  $this->load->view('equp_names_list');  
  }   
  public function add_equp_name() 
  {      
  $this->load->view('add_equp_name');  
  }   
  public function generateCall()  
  {      
  $this->load->view('generate_call');  
  }		
  public function generateCalls()  
  {       
  //$this->load->view('call_gearation_type');   
  $this->load->view('genarate_calls_categories'); 
  }	   
  public function today_calls()   
  {      
  $this->load->view('today_calls');  
  }   
  public function responded_calls()   
  {      
  $this->load->view('respondedcalls');  
  }   
  public function attended_calls() 
  {       
  $this->load->view('attendedcalls');  
  }   
  public function propen_calls()   
  {       
  $this->load->view('pendingcalls');  
  }   
  public function completed_calls() 
  {    
  $this->load->view('completedcalls_new');  
  }   
  public function Pending_pms()   
  {       
  $this->load->view('pendingpms');  
  }   
  public function Pending_qc()   
  {      
  $this->load->view('pendingqc'); 
  }   
  public function Schedulled_call()
  {
    $this->load->view('Scheduled_call');
  }
  public function Completed_pms()   
  {       
  $this->load->view('completedpms');  
  }   
  public function Completed_qc()  
  {       
  $this->load->view('completedqcs');  
  }    
  public function rounds_start()    
  {       
  $this->load->view('roud_start'); 
  }   
  public function rounds_complete()   
  {       
  $this->load->view('round_complete');   
  }   
  public function rounds_assign()  
  {      
  $this->load->view('hbhod/hod_assign_rounds');  
  }  
  public function rounds_assigned()  
  {       
  $this->load->view('rounds_assigned');  
  }  
  public function training_create()   
  {      
  $this->load->view('training_create');  
  }  
  public function training_approved()   
  {     
  $this->load->view('training_approved');   
  }  
  public function training_conduct()  
  {    
  $this->load->view('training_conduct');  
  }   
  public function training_feedback()  
  {     
  $this->load->view('training_feedback'); 
  }   
  public function training_request()   
  {      
  $this->load->view('training_request');  
  }   
  public function cities()   
  {      
  $this->load->view('cities');  
  }   
  public function add_city() 
  {  
  $this->load->view('add_city');  
  }
  public function scheduled_calls()
    {
        $this->load->view('hbhod/scheduled_calls');
    }
    public function add_scheduled_call()
    {
        $this->load->view('hbhod/add_scheduled_call');
    }
  }
  /* End of file Hbadmin.php *//* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/Hbadmin.php */