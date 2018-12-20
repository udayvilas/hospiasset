<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<md-content class="mylayout-padding" md-theme="inputs" layout-wrap>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Equipment</h3>
        <div style="margin-bottom: 5px;" layout-gt-sm="row" layout-align="space-between center" layout-xs="column" layout-gt-xs="column" layout="row">
            <div flex-xs="100">
                <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
            </div>
            <div flex-xs="100">
                <span style="font-size:12px "><a style="text-decoration: underline" ui-sref="home.{{user_role_code | lowercase}}_import_asset">Click Here</a> to Import Equipments from Excel Sheet</span>
            </div>
        </div>
        <div class="md-whiteframe-2dp mylayout-padding" style="border-radius:5px;">
            <form name="AddDevice" method="POST">
                <h5 flex class="sub_heading-style-respond">Branch Details:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Select Hospital * </label>
                        <md-select ng-model="add_device.branch_id"  name="branch_id" ng-required="add_device.branch_id != ''" >
                            <md-option ng-value="branch.org_id"  ng-repeat="branch in hospital_branchs"  ng-if="branch.BRANCH_ID !='All'">{{branch.BRANCH_NAME}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space </div>--->
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Select Branch * </label>
                        <md-select ng-model="add_device.branch_id"  name="branch_id" ng-required="add_device.branch_id != ''" >
                            <md-option ng-value="branch.BRANCH_ID"  ng-repeat="branch in branchs"  ng-if="branch.BRANCH_ID !='All'">{{branch.BRANCH_NAME}}</md-option>
                        </md-select>
                    </md-input-container>
                </div>
                <h5 flex class="sub_heading-style-respond">Equipment Basic Details:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap>
                    <md-input-container ng-if="user_general_asset==yesstate" class="md-block" flex-gt-sm flex="20">
                        <label>General Equipment</label>
                        <md-select ng-change="generalEqupChange(add_device.general_asset)" ng-required="user_general_asset==yesstate" ng-model="add_device.general_asset" name="cat" aria-label="cat">
                            <md-option ng-repeat="general_asset in cnf_general_asset" ng-value="general_asset">{{general_asset}}</md-option>
                        </md-select>
                    </md-input-container>
                    <div ng-if="user_general_asset==yesstate" flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Equipment Name</label>
                        <input type="text" required ng-model="add_device.device_name" name="device_name" aria-label="device_name" md-autofocus="autofocus" />
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Equipment Category</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="add_device.cat" name="cat" aria-label="cat">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Category" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="equp_cats1">
                                <md-option ng-repeat="equp_cat in equp_cats | filter:searchTerm" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Company Name (OEM)</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="add_device.company_name" name="company_name" aria-label="company_name">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="oems">
                                <md-option ng-repeat="oem in oems | filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Department</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="add_device.department" name="depts">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Department" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="depts">
                                <md-option ng-repeat="dept in depts | filter:searchTerm" ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}}({{dept.CODE}})
                                </md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>
                    <!--</div>
                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Equipment Model</label>
                        <input type="text" required ng-model="add_device.device_model" name="device_model" aria-label="device_model"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Equipment Cost</label>
                        <input type="text" ng-model="add_device.device_cost" name="device_cost" aria-label="device_cost"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Present Condition *</label>
                        <md-select ng-model="add_device.present_condition" ng-change="removeDates();" name="present_condition" required aria-label="present_condition">
                            <md-option ng-repeat="equp_cond in equp_conds" ng-value="equp_cond.EVAL">{{equp_cond.ECODE}}</md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Utilization *</label>
                        <md-select ng-model="add_device.utilization" name="utlization" required aria-label="utilization">
                            <md-option ng-repeat="util_value in util_values" ng-value="util_value.VALUE">
                                {{util_value.NAME}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <!--</div>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Equipment Class *</label>
                        <md-select placeholder="" ng-model="add_device.device_class" name="device_class" required aria-label="device_class">
                            <md-option ng-repeat="eclas in eclass" ng-value="eclas.EQ_CLASS">
                                {{eclas.EQ_CLASS}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Status *</label>
                        <md-select ng-model="add_device.device_status" name="device_status" required aria-label="device_status">
                            <md-option ng-repeat="estate in estatuss" ng-value="estate.estatus">
                                {{estate.estatus}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Accessories </label>
                        <input type="text" ng-model="add_device.accessories" name="accessories" aria-label="accessories"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Critical Spares</label>
                        <input type="text" ng-model="add_device.critical_spares" name="critical_spares" aria-label="critical_spares" />
                    </md-input-container>
                    <!--</div>

                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container flex="20">
                        <label>Equipment Type *</label>
                        <md-select required ng-model="add_device.equp_type" name="equp_type">
                            <md-option ng-repeat="cg_equp_type in cg_equp_types" ng-value="cg_equp_type.CODE">
                                {{cg_equp_type.TYPE}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Physical Location</label>
                        <input type="text" ng-model="add_device.phy_location" name="phy_location" aria-label="phy_location"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Distributor *</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="add_device.distributor" name="distributor" required aria-label="distributor">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Distributor" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="distrbts">
                                <md-option ng-repeat="distrbt in distrbts" ng-value="distrbt.ID">
                                    {{distrbt.NAME}}
                                </md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Hospital Asset Code</label>
                        <input type="text" ng-model="add_device.asset_code" name="asset_code" aria-label="asset_code"/>
                    </md-input-container>

                    <!--</div>
                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker md-required="true"  mdp-placeholder="Date of Install *" ng-change="setPmsQcDate($event,add_device.date_of_install)" name="date_of_install" required class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="add_device.date_of_install">
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Manufacture Date(MM-YYYY)</label>
                        <input required type="text"  ng-model="add_device.manufacture_date" name="manufacture_date" aria-label="manufacture_date"/>
                        <div ng-messages="AddDevice.manufacture_date.$error">
                            <div ng-message="pattern">Invalid Format</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>End of Life(MM-YYYY)</label>
                        <input type="text" ng-pattern="/^([0-9])-([0-9]{4})$/" ng-model="add_device.end_of_life" name="end_of_life" aria-label="end_of_life"/>
                        <div ng-messages="editDevice.end_of_life.$error">
                            <div ng-message="pattern">Valid Format(MM-YYYY)</div>
                        </div>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>End of Support(MM-YYYY)</label>
                        <input type="text" ng-pattern="/^([0-9]{2})-([0-9]{4})$/"ng-model="add_device.end_of_support" name="end_of_support" aria-label="end_of_support"/>
                        <div ng-messages="editDevice.end_of_support.$error">
                            <div ng-message="pattern">Valid Format(MM-YYYY)</div>
                        </div>
                    </md-input-container>
                    <!--</div>
                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">-->
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Serial Number</label>
                        <input type="text" required ng-model="add_device.serial_number" name="serial_number" aria-label="serial_number"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Remarks</label>
                        <textarea rows="5" ng-model="add_device.device_remarks" name="device_remarks" aria-label="device_remarks" md-select-on-focus></textarea>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Description</label>
                        <textarea rows="5" ng-model="add_device.description" name="description" aria-label="description" md-select-on-focus></textarea>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                </div>
                <h5 class="sub_heading-style-respond">AMC/CMC/Warranty Information:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Contract Type *</label>
                        <md-select ng-model="add_device.contract_type" name="contract_type" required aria-label="contract_type">
                            <md-option ng-repeat="contract_type in contract_types" ng-value="contract_type.CTYPE">
                                {{contract_type.CTYPE}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container ng-if="add_device.contract_type!='Biomedical'" class="md-block"  flex-gt-sm flex="20">
                        <label>Contract Value</label>
                        <input only-digits="only-digits" type="text" ng-required="add_device.contract_type=='Biomedical'" ng-model="add_device.contract_value" name="contract_value" aria-label="contract_value"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <mdp-date-picker ng-if="add_device.contract_type!='Biomedical'" mdp-placeholder="Contract From *" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-required="add_device.contract_type=='Biomedical'" ng-model="add_device.contract_from_date">
                    </mdp-date-picker>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker ng-if="add_device.contract_type!='Biomedical'" mdp-placeholder="Contract To *" class="md-block" flex-gt-sm mdp-format="DD-MM-YYYY" ng-model="add_device.contract_to_date" ng-required="add_device.contract_type=='Biomedical'" mdp-disabled="add_device.contract_from_date==null" mdp-min-date="add_device.contract_from_date">
                    </mdp-date-picker>
                </div>
                <div ng-if="add_device.contract_type!='Biomedical'" layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label style="color:#000000 !important;">Contract Vendor *</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="add_device.vendor" ng-change="getContractVendorDetails(add_device.vendor)" name="vendor" ng-required="add_device.contract_type=='Biomedical'" aria-label="vendor">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Vendor" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="sprt_vendrs">
                                <md-option ng-repeat="sprt_vendr in sprt_vendrs | filter:searchTerm" ng-value="sprt_vendr.ID">
                                    {{sprt_vendr.NAME}}
                                </md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Contact Number</label>
                        <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="add_device.vendor_contact_no" name="vendor_contact_no" aria-label="vcontact_no"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Email ID</label>
                        <input type="email" ng-disabled="true" ng-model="add_device.vemail_id" name="vemail_id" aria-label="vemail_id"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Contact Person</label>
                        <input type="text" ng-disabled="true" ng-model="add_device.vcontact_person" name="vcontact_person" aria-label="vcontact_person"/>
                    </md-input-container>
                </div>

                <div ng-if="add_device.contract_type!='Biomedical'" layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>Contact Person Number</label>
                        <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="add_device.vcontact_person_no" name="vcontact_person_no" aria-label="vcontact_person_no"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Contact Person Email ID</label>
                        <input type="email" ng-disabled="true" ng-model="add_device.vcontact_person_email_id" name="vcontact_person_email_id" aria-label="vcontact_person_email_id"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="45">
                        <label>Vendor Address</label>
                        <textarea rows="5" ng-disabled="true" ng-model="add_device.vendor_address" name="vendor_address" aria-label="vendor_address" md-select-on-focus></textarea>
                    </md-input-container>
                </div>
                <h5 class="sub_heading-style-respond">Equipment Purchase Details:</h5>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>PO NO</label>
                        <input type="text" ng-model="add_device.po_number" name="po_number" aria-label="po_number"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <mdp-date-picker mdp-placeholder="PO Date" name="po_date" md-required="add_device.po_number!=null" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="add_device.po_date">
                    </mdp-date-picker>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>GRN No.</label>
                        <input type="text" ng-model="add_device.grn_no" name="grn_no" aria-label="grn_no"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <mdp-date-picker mdp-placeholder="GRN Date" class="md-block" flex-gt-sm flex="20" mdp-format="DD-MM-YYYY" ng-model="add_device.grn_date">
                    </mdp-date-picker>
                </div>

                <h5 class="sub_heading-style-respond">Maintenance Schedule:</h5>
                <div layout-gt-xs="row">
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>PMS's (Per Year)</label>
                        <md-select ng-model="add_device.no_of_pms" ng-name="no_of_pms" required ng-disabled="add_device.general_asset==yesstate">
                            <md-option ng-repeat="pmscount in pmscounts"  ng-value="pmscount">
                                {{pmscount}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <mdp-date-picker mdp-disabled="add_device.general_asset==yesstate" mdp-placeholder="Last PMS Date" ng-required="user_general_asset!=yesstate" class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" ng-model="add_device.pms_date">
                    </mdp-date-picker>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <md-input-container class="md-block"  flex-gt-sm flex="20">
                        <label>No. of Calibrations</label>
                        <md-select ng-model="add_device.no_of_qcs" name="no_of_qcs" ng-disabled="add_device.general_asset==yesstate" ng-required="user_general_asset!=yesstate" ng-disabled="user_general_asset!=yesstate">
                            <md-option ng-repeat="qcscount in qcscounts" ng-value="qcscount">
                                {{qcscount}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="15">
                        <label>Per Year/Month</label>
                        <md-select ng-model="add_device.no_of_qcs_ym" name="no_of_qcs_ym" ng-disabled="add_device.general_asset==yesstate">
                            <md-option ng-repeat="qcscount_ym in ['Year','Month']" ng-value="qcscount_ym">
                                {{qcscount_ym}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --></div>

                    <mdp-date-picker mdp-disabled="add_device.general_asset==yesstate" mdp-placeholder=" Last Calibration" class="md-block" flex-gt-sm flex="15" mdp-format="DD-MM-YYYY" ng-model="add_device.qc_date">
                    </mdp-date-picker>
                </div>

                <!--<h5 class="sub_heading-style-respond">BreakDown Information:</h5>
                <div layout-gt-xs="row">
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>BreakDown Count</label>
                        <input only-digits="only-digits" type="text" ng-model="add_device.break_down_count" name="break_down_count" aria-label="break_down_count"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --/></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>BreakDown Cost</label>
                        <input type="text" only-digits="only-digits" ng-model="add_device.break_down_cost" name="break_down_cost" aria-label="break_down_cost"/>
                    </md-input-container>

                    <div flex="5" hide-xs hide-sm><!-- Space --/></div>
                    <mdp-date-picker mdp-placeholder="Last Breakdown Date" class="md-block" flex-gt-sm flex="30" mdp-format="DD-MM-YYYY" ng-model="add_device.last_breakdown_date">
                    </mdp-date-picker>
                </div>-->
                <h5 class="sub_heading-style-respond">Upload Documents:</h5>
                <div layout-gt-xs="row">
                    <div layout="column">
                        <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                            <input type="file" file-model="device_manuals" multiple />(Upload Manuals Here)
                        </div>
                        <ul style="margin-top: 15px;">
                            <li ng-repeat="device_manual in device_manuals">{{device_manual.name}}</li>
                        </ul>
                    </div>

                    <div layout="column">
                        <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                            <input type="file" file-model="device_pos" multiple />(Upload POs Here)
                        </div>

                        <ul style="margin-top: 15px;">
                            <li ng-repeat="device_po in device_pos">{{device_po.name}}</li>
                        </ul>
                    </div>

                    <div layout="column">
                        <div style="margin-top: 10px;" class="md-block" flex-gt-sm flex="33">
                            <input type="file" file-model="device_othr_files" multiple />(Other Documents)
                        </div>
                        <ul style="margin-top: 15px;">
                            <li ng-repeat="device_othr_file in device_othr_files">{{device_othr_file.name}}</li>
                        </ul>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <center>
                        <!--    <input type="submit" class="md-button md-raised md-accent" layout-align="center center" ng-disabled="AddDevice.$invalid" ng-click="SaveDevice(add_device,'save_device')" aria-label="button" value="Save">-->
                        <input type="submit" class="md-button md-raised md-accent" layout-align="center center" ng-click="savedevice(add_device,'device_save_deploy')"  aria-label="buttonsd" value="Save">
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>