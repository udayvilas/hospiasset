<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Hbbme extends CI_Controller
 {   
    function __construct()   
 {       
   parent::__construct();    
   date_default_timezone_set('Asia/Kolkata');    
   $this->load->model('basemodel');   
   include APPPATH.'libraries/simplexlsx_class.php';  
 }  
 public function index()    
 {    
 $this->load->view('hbbme/home');   
 }    
 public function show_equp_names()  
 {      
 $this->load->view('equp_names_list');   
 }   
 public function add_equp_name()   
 {       
 $this->load->view('add_equp_name');  
 }  
 public function addAsset()  
 {      
 $this->load->view('add-device'); 
 }   
 public function editAsset() 
 {      
 $this->load->view('edit-device'); 
 }  
 public function importAsset() 
 {      
 $this->load->view('import-assetlist');  
 }   
 public function labelPrint()   
 {     
 $this->load->view('print-labels');   
 }   
 public function labelPrintPmsQc()   
 {        
 $this->load->view('print-labels-pms-cal');  
 }   
 public function search()  
 {     
 $this->load->view('search');  
 }  
 public function EquipmentSummary()   
 {     
 $this->load->view('equp_summary');   
 }  
 public function QC()  
 {    
 $this->load->view('pending_pms'); 
 }  
 public function PMS()  
 {     
 $this->load->view('pending_pms'); 
 }  
 public function generateCalls()   
 {      
 //$this->load->view('call_gearation_type');    
 $this->load->view('genarate_calls_categories');   
 }	
 public function incidentCalls()  
 {       
 $this->load->view('incident_category');  
 }  
 public function transferCalls()  
 {       
 $this->load->view('transfer_category');  
 }   
 public function condemnCalls()  
 {       
 $this->load->view('condemn_category');  
 }	
 public function NonScheduleCalls()   
 {     
 $this->load->view('non_scheduled_call'); 
 }   
 public function generateCallType()  
 {    
 $this->load->view('generate_call'); 
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
 public function scheduled_calls()   
 {      
 $this->load->view('includes/scheduled_calls'); 
 }   
 public function Pending_pms()  
 {      
 $this->load->view('pendingpms');  
 }   
 public function Pending_qc()  
 {       
 $this->load->view('pendingqc');  
 }  
 public function Completed_pms()  
 {    
 $this->load->view('completedpms');  
 }  
 public function Completed_qc()    
 {    
 $this->load->view('completedqcs');  
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
 $this->load->view('rounds_assign');   
 }   
 public function rounds_assigned()   
 {       
 $this->load->view('rounds_assigned'); 
 }    
 public function users() 
 {     
 $this->load->view('hbbme/users');   
 }   
 public function add_user()   
 {        
 $this->load->view('hbbme/add-user');  
 }   
 public function contract_types_list()  
 {      
 $this->load->view('contract_types');  
 }    
 public function add_contract_type()  
 {     
 $this->load->view('add_contract_type'); 
 }  
 public function status_list()   
 {    
 $this->load->view('status_list');   
 }    
 public function add_status() 
 {      
 $this->load->view('add_status');   
 }   
 public function equipment_condition()  
 {    
 $this->load->view('equp_condition');  
 }   
 public function add_equp_condition()    
 {       
 $this->load->view('add_equp_cond');  
 }   
 public function equipment_class() 
 {    
 $this->load->view('equipment_class');  
 }  
 public function add_equipment_class() 
 {     
 $this->load->view('add_equp_class');  
 }    
 public function utlization_value() 
 {    
 $this->load->view('utlization_value');  
 }   
 public function add_utlization_value() 
 {     
 $this->load->view('add_utill_values');  
 }   
 public function training_type()  
 {     
 $this->load->view('training_type_list');   
 } 
 public function add_training_type()
 {      
 $this->load->view('add_training_type');  
 }   
 public function add_maintain_contracts()    
 {     
 $this->load->view('add_maintain_contracts'); 
 }   
 public function Pagination()  
 {    
 $this->load->view('dummy');   
 }
 }
 /* End of file Hbadmin.php *//* Location: .//C/Users/Renown/AppData/Local/Temp/fz3temp-1/Hbadmin.php */
 
 
 
 