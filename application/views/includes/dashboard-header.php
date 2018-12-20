<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-toolbar class="md-whiteframe-z1" md-theme="hospiclr">
    <div class="md-toolbar-tools" style="background-color:#194783">
        <!--<md-button class="md-icon-button" aria-label="Menu Button" hide-gt-sm ng-click="onClickMenu();">
            <md-icon md-font-set="material-icons" flex>menu</md-icon>
        </md-button>-->
        <div style="background: #FFFFFF;margin: 3px 0px;">
            <a ui-sref="{{user_path}}">
                <img src="<?= base_url()?>assets/images/ha_logo_main1.png?<?= time();?>" width="100" height="80">
                <!--	<img src="<?/*= base_url()*/?>assets/images/ha1.png?<?/*= time();*/?>">HospiAsset-->
            </a>
        </div>


        <span flex></span>
        <div  layout="row">
            <?php
          /*  if($this->session->role_code==VENDOR)
            { ?>
                <md-input-container class="no-margin-padding-md-input" flex="50" flex-xs="100">
                        <label style="color: #ffffff">Hospitals *</label>
                        <md-select ng-model="user_org" name="org_id" style="color: #ffffff"   aria-label="user_org">
                            <md-option ng-repeat="hospital in hospitals_vendor" ng-value="hospital.ORG_ID">
                                {{hospital.ORG_NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
       <?php     }  */ ?>
            <?php
            if($this->session->role_code==HBHOD || $this->session->role_code==VENDOR)
            {?>
                <md-input-container  style="color: #ffffff;" class="no-margin-padding-md-input" flex="50" flex-xs="100">
                    <label style="color: #ffffff;">Select Branch</label>
                    <md-select ng-model="user_branch" name="branch_id" style="color: #ffffff;" aria-label="user_branch" ng-change="branch_all_loading(user_branch)">
                        <md-option ng-value="branch.BRANCH_ID"    ng-selected="branch.BRANCH_ID == user_branch" ng-repeat="branch in branchs">{{branch.BRANCH_NAME}}</md-option>
                    </md-select>
                </md-input-container>
                <span style="color:#FFFFFF;font-size:14px;">Welcome {{user_name}} ({{user_erole_code}})<?php
                    if($this->session->role_code==HBHOD)
                    {
                        //echo ",".$this->session->branch_name;
                    }
                    ?></span>
                <?php
            }else
            { ?>
                <span style="color:#FFFFFF;font-size:14px;">Welcome {{user_name}} ({{user_erole_code}})</span>
                <?php
            }
            ?>
        </div>

        <md-menu-bar>
            <md-menu ng-hide="user_role_code==HA_ADMIN" ng-repeat="my_menu in user_main_menus" ng-if="my_menu.selected==true">
                <button class="md-raised" aria-label="my_menu_{{$index}}" ng-click="$mdOpenMenu($event)">
                    <span class="{{my_menu.icon}}"></span>
                    <span class="menu-name">{{my_menu.name}}</span>
                </button>
                <md-menu-content width="4" style="max-height:400px;overflow:auto">
                    <!---<md-menu-item ng-show="org_type==Vendor" ng-hide="user_role_code==HBHOD" >
                        <md-button  ui-sref="home.hbbme_add_asset">Add Equipment</md-button>
                    </md-menu-item>--->
					
                    <md-menu-item  ng-repeat="submenu in my_menu.subfeatures" ng-if="submenu.selected==true" style="padding: 16px;">
                        <md-button  ui-sref="{{submenu.state}}">{{submenu.name}}</md-button>
                    </md-menu-item>
					

                </md-menu-content>
            </md-menu>
            <md-menu ng-show="user_role_code==HA_ADMIN">
                <button class="md-raised" aria-label="my_menu_home" ui-sref="home.mahospitals">
                    <span class="icon-office"></span>
                    <span class="menu-name">Hospitals</span>
                </button>
            </md-menu>
            <md-menu ng-show="user_role_code==HA_ADMIN">
                <button class="md-raised" aria-label="my_menu_home" ui-sref="home.madmin_home">
                    <span class="icon-home2"></span>
                    <span class="menu-name">Home</span>
                </button>
            </md-menu>
            <!--<md-menu  ng-show="user_role_code==HA_ADMIN">
                <button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
                    <span class="icon-calendar2"></span>
                    <span class="menu-name">Appointments</span>
                </button>
                <md-menu-content width="3">
                    <md-menu-item >
                        <md-button ui-sref="home.appointment_organizations">Organizations</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.appointment_hospitals">Appointments</md-button>
                    </md-menu-item>
                </md-menu-content>
            </md-menu>-->
            <!--<md-menu ng-hide="user_role_code==HA_ADMIN || user_role_code==HMADMIN">
                <button class="md-raised" aria-label="my_menu_home" ui-sref="home.reports">
                    <span class="icon-file-presentation2"></span>
                    <span class="menu-name">Reports</span>
                </button>
            </md-menu>--->

            <!--<md-menu ng-hide="user_role_code==HA_ADMIN || user_role_code==HBUSER">
                <button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
                    <span class="icon-file-presentation2"></span>
                    <span class="menu-name">Reports</span>
                </button>
                <md-menu-content width="3">
                    <md-menu-item ng-if="user_role_code!=PURCHASE">
                        <md-menu>
                            <md-button ng-click="$mdOpenMenu()">Equipment Details</md-button>
                            <md-menu-content width="3">
                                <md-menu-item>
                                    <md-button ui-sref="home.requipment_summary">Equipment Summary</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.equp_down_time">Equipment Down Time</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.equp_history_card">Equipment History </md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.rservices">Service</md-button>
                                </md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </md-menu-item>

                    <md-menu-item ng-if="user_role_code!=PURCHASE">
                        <md-menu>
                            <md-button ng-click="$mdOpenMenu()">Equipment Basics</md-button>
                            <md-menu-content width="3">
                                <md-menu-item>
                                    <md-button ui-sref="home.rviability">Viability</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.rindent">Indent</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.rcear">CEAR</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.gatepass">GatePass</md-button>
                                </md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </md-menu-item>

                    <md-menu-item ng-if="user_role_code!=PURCHASE">
                        <md-menu>
                            <md-button ng-click="$mdOpenMenu()">Scheduled Calls</md-button>
                            <md-menu-content width="3">
                                <md-menu-item>
                                    <md-button ui-sref="home.rcall_log">Call Log</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.cms_report">CMS</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.rpms">PMS</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.rqc">Calibration</md-button>
                                </md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </md-menu-item>

                    <md-menu-item ng-if="user_role_code!=PURCHASE">
                        <md-menu>
                            <md-button ng-click="$mdOpenMenu()">Other Calls</md-button>
                            <md-menu-content width="3">
                                <md-menu-item>
                                    <md-button ui-sref="home.radverse">Adverse</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.deployment_report">Deployment</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.rredeployment">Replacement</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.rcondemnation">Condemnation</md-button>
                                </md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </md-menu-item>
                       
                    <md-menu-item ng-if="user_role_code!=PURCHASE">
                        <md-button ui-sref="home.monthly_performance_report">Monthly Performance Report</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.stock_report">Stock Report</md-button>
                    </md-menu-item>
                    <md-menu-item ng-if="user_role_code!=PURCHASE">
                        <md-menu>
                            <md-button ng-click="$mdOpenMenu()">Graphs</md-button>
                            <md-menu-content width="3">
                                <md-menu-item>
                                    <md-button ui-sref="home.graphs">All Graphs</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.monthly_performance_graph">Monthly Performance Graph</md-button>
                                </md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.overview">Overview</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.call">Calls</md-button>
                    </md-menu-item>

                </md-menu-content>
            </md-menu>
            </md-menu>


            <!--	<md-menu ng-show="user_role_code==HA_ADMIN"  ng-repeat="my_menu in user_main_menus">
                    <button class="md-raised" aria-label="my_menu_{{$index}}">
                        <span class="{{my_menu.icon}}"></span>
                        <h5 class="menu-name"  ng-show="user_role_code==HA_ADMIN"  ui-sref="{{my_menu.state}}">{{my_menu.name}}</h5>
                    </button>
                </md-menu>-->

            <!--<md-menu ng-hide="user_role_code==HA_ADMIN || user_role_code==PURCHASE || user_role_code==HBUSER">
                <button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
                    <span class="icon-plus3"></span>
                    <span class="menu-name">Setup</span>
                </button>
                <md-menu-content width="3">
                    <md-menu-item ng-show="user_role_code==HMADMIN || user_role_code==VENDOR" >
                        <md-button ui-sref="home.hmadmin_branches">Branches</md-button>
                    </md-menu-item>
                   <!-- <md-menu-item ng-show="user_role_code==VENDOR">
                        <md-button ui-sref="home.vendor_branches">Branches</md-button>
                    </md-menu-item>

                    <md-menu-item ng-hide="org_type==Vendor">
                        <md-button ui-sref="home.hbhod_vendors">Vendors</md-button>
                    </md-menu-item>                          				   
                    <md-menu-item ng-show="org_type==Vendor">
                        <md-button ui-sref="home.add_hospitals">Hospitals</md-button>
                    </md-menu-item>
                    <md-menu-item ng-show="user_role_code!=HBBME">
                        <md-button ui-sref="home.{{user_role_code | lowercase}}_users">Users</md-button>
                    </md-menu-item>

                    <md-menu-item ng-show="user_role_code==HMADMIN || user_role_code==VENDOR">
                        <md-button ui-sref="home.org_roles">Roles</md-button>
                    </md-menu-item>

                    <md-menu-item ng-show="user_role_code==HMADMIN || user_role_code==HA_ADMIN || user_role_code==VENDOR">
                        <md-button  ui-sref="home.hmadmin_cities">Cities</md-button>
                    </md-menu-item>
                    <md-menu-item ng-show="user_role_code==HMADMIN || user_role_code==HA_ADMIN">
                        <md-button ui-sref="home.escalations">Escalation</md-button>
                    </md-menu-item>
                    <md-menu-item ng-show="user_role_code==HMADMIN">
                        <md-button ui-sref="home.levels">Escalation Levels</md-button>
                    </md-menu-item ng-show="user_role_code==HMADMIN">
                    <md-menu-item ng-if="user_role_code==HMADMIN">
                        <md-button ui-sref="home.escalation">Escalation Types</md-button>
                    </md-menu-item>
                    <md-menu-item ng-show="user_role_code==HMADMIN">
                        <md-button ui-sref="home.cearcategory">Cear Category</md-button>
                    </md-menu-item>
                    <md-menu-item ng-show="user_role_code==HMADMIN">
                        <md-button ui-sref="home.hbbme_training_type">Training Types</md-button>
                    </md-menu-item>
                    <md-menu-item ng-if="user_role_code==HBHOD">
                        <md-button ui-sref="home.{{user_role_code | lowercase}}_rounds_assign">Assign Round</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-menu>
                            <md-button ng-click="$mdOpenMenu()">Equipment</md-button>
                            <md-menu-content width="3">
                                <md-menu-item ng-hide="user_role_code==HBBME">
                                    <md-button ui-sref="home.hbbme_contract_type">Contract Types</md-button>
                                </md-menu-item>
                                <md-menu-item ng-hide="user_role_code==HBBME">
                                    <md-button ui-sref="home.reasons">Reasons</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.departments">Departments</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.hbbme_equipment_names">Categories</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.hbbme_deployment">Deployment</md-button>
                                </md-menu-item>

                                <md-menu-item ng-if="user_role_code==HMADMIN">
                                    <md-button ui-sref="home.hbbme_equipment_condition">Conditions</md-button>
                                </md-menu-item>

                                <md-menu-item ng-if="user_role_code==HMADMIN">
                                    <md-button ui-sref="home.hbbme_equipment_class">Classes</md-button>

                                </md-menu-item>

                                <md-menu-item ng-if="user_role_code==HMADMIN">
                                    <md-button ui-sref="home.hbbme_utlization_value">Utilizations</md-button>
                                </md-menu-item>

                                <md-menu-item ng-if="user_role_code==HMADMIN">
                                    <md-button ui-sref="home.hbbme_status">Status</md-button>
                                </md-menu-item>

                                <md-menu-item ng-if="user_role_code==HMADMIN">
                                    <md-button ui-sref="home.classifications">Classifications</md-button>
                                </md-menu-item>

                                <md-menu-item ng-if="user_role_code==HMADMIN">
                                    <md-button ui-sref="home.equipment_types">Equipment Types</md-button>
                                </md-menu-item>

                                <md-menu-item ng-if="user_role_code==HMADMIN">
                                    <md-button ui-sref="home.incident_type">Incident Type</md-button>
                                </md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </md-menu-item>

                </md-menu-content>
            </md-menu>-->

            <!-- setup for renown admin begin -->
			<!-- Generate call for hod begin 
			<md-menu ng-hide="user_role_code==HBHOD">
                <button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
                    <span class="icon-profile"></span>
                    <span class="menu-name">Generate Call</span>
                </button>
                <md-menu-content width="3">
                    <md-menu-item>
                        <md-button ui-sref="home.hbbme_incident_call">Incident Generate Call</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.hbbme_tranfer_call">Transfer Generate Call</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.hbbme_non_scheduled_call">Non Scheduled Call</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.hbbme_condemn_call">Condemn Generate Call</md-button>
                    </md-menu-item>
                </md-menu-content>
            </md-menu> -->

        <!-- setup for renown admin end -->
            <md-menu ng-show="user_role_code==HA_ADMIN" >
                <button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
                    <span class="icon-plus3"></span>
                    <span class="menu-name">Setup</span>
                </button>
                <md-menu-content width="3" style="padding:4px;max-height:417px;overflow:auto;" >
                    <!--<md-menu-item>
                        <md-button ui-sref="home.haadmin_vendors">Vendors</md-button>
                    </md-menu-item>-->
                   <md-menu-item>                        
				   <md-button ui-sref="home.haadmin_modules">Modules</md-button>             
				   </md-menu-item>
				   <md-menu-item>
                    <md-button ui-sref="home.ha_master_table">Master Tables</md-button>
                </md-menu-item>
				<md-menu-item>
                    <md-button ui-sref="home.hadmin_item_master">Form Create</md-button>
                </md-menu-item>
				   <!--<md-menu-item>
				   <md-button ui-sref="home.org_create_form">Form Create</md-button>
				   </md-menu-item>
                   <!--<md-menu-item>
                        <md-button ui-sref="home.haadmin_countries">Countries</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_states">States</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button  ui-sref="home.hmadmin_cities">Cities</md-button>
                    </md-menu-item>
				    <md-menu-item>
                    <md-button ui-sref="home.get_table_name">TabelS ORG</md-button>
                </md-menu-item>-->
                </md-menu-content>
            </md-menu>
			 <!-- labels for renown admin -->
			<!---<md-menu ng-show="user_role_code==HA_ADMIN" >
                <button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
                    <span class="icon-plus3"></span>
                    <span class="menu-name">Labels</span>
                </button>
				<md-menu-content width="3" style="padding:0px;max-height:524px;overflow:auto;" >
				<md-menu-item>
                        <md-button ui-sref="home.haadmin_equpcondlabels">Equp Cond Labels</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_roles">Role Types</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_equp_types_labels">Equp Types Labels</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_countris_label">Countries Labels</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_states_label">States Labels</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button  ui-sref="home.haadmin_cities_label">Cities Labels</md-button>
                    </md-menu-item>
                      <md-menu-item>
                        <md-button ui-sref="home.haadmin_user_label">User Labels</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_dept_label"> Department Labels</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_devicenames_label">Devicenames Labels</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_branch_label">Branches Labels</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_contracttype_labels">Contracttypes Labels</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_incidenttype_labels">Incidenttype Labels</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_escalation_label">Escalation Labels</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_escalationlevel_label">Escalation Level Labels</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_esctype_label">Escalation Types Labels</md-button>
                    </md-menu-item>

                    <md-menu-item>
                        <md-button ui-sref="home.haadmin_role_labels">Role  Labels</md-button>
                    </md-menu-item>
                <md-menu-item>
                    <md-button ui-sref="home.haadmin_vendor_label">Vendor Labels</md-button>
                </md-menu-item>
				<md-menu-item>
                    <md-button ui-sref="home.haadmin_status_label">Status Labels</md-button>
                </md-menu-item>
				<md-menu-item>
                    <md-button ui-sref="home.haadmin_depreciation_label">Depreciation Labels</md-button>
                </md-menu-item>
				  <md-menu-item>
                    <md-button ui-sref="home.haadmin_util_label">Utilization Labels</md-button>
                </md-menu-item>
				 <md-menu-item>
                    <md-button ui-sref="home.haadmin_device_label">Device Labels</md-button>
                </md-menu-item>
				<md-menu-item>
                    <md-button ui-sref="home.get_table_name">Tabel Labels</md-button>
                </md-menu-item>
				<md-menu-item>
                    <md-button ui-sref="home.ha_master_table">Master Tables</md-button>
                </md-menu-item>
				<md-menu-item>
                    <md-button ui-sref="home.hadmin_item_master">Item Labels</md-button>
                </md-menu-item>
				
                  <md-menu-content>
				  </md-menu>--->
            

            <md-menu ng-hide="user_role_code==HA_ADMIN">
                <button class="md-raised" aria-label="my_menu_home" ui-sref="{{user_path}}">
                    <span class="icon-home2"></span>
                    <span class="menu-name">Home</span>
                </button>
            </md-menu>
            <md-menu>
                <button class="md-accent md-raised" ng-click="$mdOpenMenu($event)" aria-label="user name">
                    <span class="icon-info3"></span>
                    <span class="menu-name">About</span>
                </button>
                <md-menu-content width="3">
                    <md-menu-item>
                        <md-button ui-sref="home.about_product">About Product</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.mail_fun">Mail Function</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ui-sref="home.scheduled_calls_new">My Transitions</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-menu>
                            <md-button ng-click="$mdOpenMenu()">User Manuals</md-button>
                            <md-menu-content width="3">
                                <md-menu-item>
                                    <md-button ui-sref="home.web_application">Web Application</md-button>
                                </md-menu-item>
                                <md-menu-item>
                                    <md-button ui-sref="home.mobile_app">Mobile App</md-button>
                                </md-menu-item>
                            </md-menu-content>
                        </md-menu>
                    </md-menu-item>

                </md-menu-content>
            </md-menu>
            <md-menu>
                <button ng-click="$mdOpenMenu($event)" aria-label="user name" style="color:#fff;">
                    <span class="icon-user-tie"></span>
                    <span class="menu-name">Profile</span>
                </button>
                <md-menu-content width="60">
                    <md-menu-item>
                        <md-button ng-click="showProfile($event,user_id)">Profile</md-button>
                    </md-menu-item>
                    <md-menu-item>
                        <md-button ng-click="logout();">Logout</md-button>
                    </md-menu-item>
                </md-menu-content>
            </md-menu>
        </md-menu-bar>
    </div>
</md-toolbar>

