<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
    }
    public function accessories()
    {
        $this->load->view('accessories');
    }
    public function add_accessor()
    {
        $this->load->view('add_accessore');
    }
    public function edit_accessor()
    {
        $this->load->view('dialogs/edit_accessor');
    }
    public function critical_spares()
    {
        $this->load->view('critical_spares');
    }
    public function classifications()
    {
        $this->load->view('classifications');
    }
    public function add_critical_spare()
    {
        $this->load->view('add_critical_spare');
    }
    public function edit_critical_spare()
    {
        $this->load->view('dialogs/edit_critical_spare');
    }
    public function add_classification()
    {
        $this->load->view('add_classification');
    }
    public function edit_classification()
    {
        $this->load->view('dialogs/edit_classification');
    }
    public function equipment_types()
    {
        $this->load->view('equipment_types');
    }
    public function add_equipment_type()
    {
        $this->load->view('add_equipment_type');
    }
    public function edit_equp_type()
    {
        $this->load->view('dialogs/edit_equp_type');
    }
    public function view_devies()
    {
        $this->load->view('depart-devices');
    }
    public function view_devies_dialog()
    {
        $this->load->view('dialogs/show_eup_details_dialog');
    }
    public function view_nscr_dialog()
    {
        $this->load->view('dialogs/show_nsc_details_dialog');
    }
    public function view_departments()
    {
        $this->load->view('department_list');
    }
    public function add_departments()
    {
        $this->load->view('add_departments');
    }
    public function reasons()
    {
        $this->load->view('reasons_list');
    }
    public function add_reasons()
    {
        $this->load->view('add_reasons');
    }
	 public function add_non_scheduled_reasons()
    {
        $this->load->view('add_nonscheduledreason');
    }
	public function non_scheduled_reasons()
    {
        $this->load->view('non_scheduled_reasons');
    }
    public function levels()
    {
        $this->load->view('levels_list');
    }
    public function add_levels()
    {
        $this->load->view('add_levels');
    }
    public function escalation()
    {
        $this->load->view('escalation_list');
    }
    public function add_escalation()
    {
        $this->load->view('add_escalations');
    }
    public function escalations()
    {
        $this->load->view('escalations_list');
    }
    public function add_escalations1()
    {
        $this->load->view('add_escalations1');
    }
    public function incident_type()
    {
        $this->load->view('incident_type_list');
    }
    public function add_incident_type()
    {
        $this->load->view('add_incident_type');
    }
    public function view_incident()
    {
        $this->load->view('incidents');
    }
    public function view_observations()
    {
        $this->load->view('adverse_incident');
    }
    public function maintain_contracts()
    {
        $this->load->view('maintance_contracts');
    }
    public function add_maintain_contracts()
    {
        $this->load->view('add_maintain_contracts');
    }
    public function edit_device()
    {
        $this->load->view('edit-device');
    }
    public function transfer_within_unit()
    {
        $this->load->view('with_in_unit');
    }
    public function other_unit_request()
    {
        $this->load->view('other_unit_request');
    }
    public function other_unit_approval()
    {
        $this->load->view('other_unit_approval');
    }
    public function other_unit_transfer()
    {
        $this->load->view('other_unit_transfer');
    }
    public function condemnation()
    {
        $this->load->view('condemnation');
    }
    public function condemnation_request()
    {
        $this->load->view('condemination_request');
    }
    public function transfer()
    {
        $this->load->view('transfer');
    }
    public function condemnation_reason()
    {
        $this->load->view('condemnationsreasons_list');
    }
	public function org_create_form()
	{
		$this->load->view('org_create_form');
	}
	public function add_org_create_form()
	{
		$this->load->view('add_org_create_form');
	}
    public function add_condemnation()
    {
        $this->load->view('add_condemnation_reasons');
    }
    public function admin_condemnation()
    {
        $this->load->view('admin_condemnation');
    }
	public function change_password()
    {
        $this->load->view('change_password');
    }
    public function condmnation_resold_values()
    {
        $this->load->view('condmnation_resold_values');
    }
    public function add_condmnation_resold_values()
    {
        $this->load->view('add_reusablepart');
    }
    public function transfer_save_and_deploy()
    {
        $this->load->view('transfer_deployment_id_creation');
    }
    public function adverse_reports()
    {
        $this->load->view('adverse_report');
    }
    public function viability_report()
    {
        $this->load->view('viability_report');
    }
    public function deployment()
    {
        $this->load->view('deployment_report');
    }
    public function deployment_report()
    {
        $this->load->view('depolyment_report_pdf');
    }
    public function redeployment_report()
    {
        $this->load->view('redeployment_report');
    }
    public function view_monthly_performance_report()
    {
        $this->load->view('view_monthly_performance_report');
    }
    public function dummy_pdf()
    {
        $this->load->view('dummy_pdf');
    }
    public function cms_report()
    {
        $this->load->view('cms_report');
    }
    public function condemnation_report()
    {
        $this->load->view('condemnation_report');
    }
    public function add_multiple_contracts()
    {
        $this->load->view('add_multiple_contracts');
    }
    public function pms_report()
    {
        $this->load->view('pms_report');
    }
    public function qc_report()
    {
        $this->load->view('qc_report');
    }
    public function equipment_summary()
    {
        $this->load->view('equipment_summary');
    }
    public function services_report()
    {
        $this->load->view('services_report');
    }
    public function transfer_calls()
    {
        $this->load->view('transfer_calls');
    }
    public function condemnation_calls()
    {
        $this->load->view('condemnation_calls');
    }
    public function rounds_calls()
    {
        $this->load->view('rounds_calls');
    }
    public function adverse_calls()
    {
        $this->load->view('adverse_calls');
    }
    public function call_log_reports()
    {
        $this->load->view('call_log_reports');
    }
    public function gatepass()
    {
        $this->load->view('gate_pass');
    }
    public function cear()
    {
        $this->load->view('cear');
    }
    public function indent_equipment()
    {
        $this->load->view('indent_equipment');
    }
    public function cear_request()
    {
        $this->load->view('cear_request');
    }
    public function indent_equipment_request()
    {
        $this->load->view('indent_equipment_request');
    }
    public function cear_category()
    {
        $this->load->view('cear_category');
    }
    public function add_cear_category()
    {
        $this->load->view('add_cear_category');
    }
    public function rindent()
    {
        $this->load->view('rindent');
    }
    public function rcear()
    {
        $this->load->view('rcear');
    }
    public function gate_pass_new()
    {
        $this->load->view('gate_pass_new');
    }
    public function gate_pass_request()
    {
        $this->load->view('gate_pass_request');
    }
    public function graphs()
    {
        $this->load->view('graphs');
    }public function about_product()
{
    $this->load->view('about_product');
}
    public function equp_down_time()
    {
        $this->load->view('equp_down_time');
    }
    public function monthly_performance_graph()
    {
        $this->load->view('monthly_performance_graph');
    }
    public function asset_management_other_activites()
    {
        $this->load->view('asset_management_other_activites');
    }
    public function equp_history_card()
    {
        $this->load->view('equp_history_card');
    }
    public function mail_fun()
    {
        $this->load->view('mailing');
    }
	 public function view_depreciation_dialog()
    {
        $this->load->view('dialogs/show_depreciation_details_dialog');
    }

    public function edit_equp_cond_label_dialog()
    {
        $this->load->view('madmin/dialogs/edit_equp_cond_label_dialog');
    }
    public function reports()
    {
        $this->load->view('reports');
    }
    public function rnscreport()
    {
        $this->load->view('non_scheduled_calls_report');
    }
    public function rscreport()
    {
        $this->load->view('scheduled_calls_report');
    }
    public function replace_device()
    {
        $this->load->view('replace-device');
    }
    public function view_scr_dialog()
    {
        $this->load->view('dialogs/show_scr_details_dialog');
    }
    public function viability()
    {
        $this->load->view('viability');
    }
    public function add_viabilty()
    {
        $this->load->view('viability_request');
    }
    public function stock()
    {
        $this->load->view('stock');
    }
    public function stock_report()
    {
        $this->load->view('stock_report');
    }
    public function org_roles()
    {
        $this->load->view('org_roles');
    }
    public function add_org_roles()
    {
        $this->load->view('add_org_roles');
    }
    public function edit_org_roles()
    {
        $this->load->view('edit_org_roles');
    }
    public function my_transitions()
    {
        $this->load->view('my_transitions');
    }
    public function condemination_new()
    {
        $this->load->view('condemnation_new');
    }
    public function adverse_call_new()
    {
        $this->load->view('adverse_calls_new');
    }
    public function gate_pass_new_mytransion()
    {
        $this->load->view('gate_pass_new_myTransitions');
    }
    public function viability_new()
    {
        $this->load->view('viability_new');
    }
    public function transfer_new()
    {
        $this->load->view('transfer_new');
    }
    public function cear_new()
    {
        $this->load->view('cear_new');
    }
    public function indent_new()
    {
        $this->load->view('indent_new');
    }
    public function rounds_new()
    {
        $this->load->view('rounds_new');
    }
    public function maintance_contracts_new()
    {
        $this->load->view('maintance_contracts_new');
    }
    public function instalation_new()
    {
        $this->load->view('instalations_new');
    }
    public function scheduled_calls_new()
    {
        $this->load->view('scheduled_calls_new');
    }
    public function non_scheduled_calls_new()
    {
        $this->load->view('non_scheduled_calls_new');
    }
    public function generated_calls_new()
    {
        $this->load->view('generated_calls_new');
    }
    public function edit_vequipment()
    {
        $this->load->view('edit-vdevice');
    }
    public function transfer_device()
    {
        $this->load->view('view_transfer_device');
    }
	 public function vendor_pending_pms()
    {
        $this->load->view('vendor_assign_pmscall');
    }
	 public function test(){
        $this->load->view('test');
    }
}