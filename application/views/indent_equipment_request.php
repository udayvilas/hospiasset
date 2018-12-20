<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Indent Request</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="indentRequestForm" flex="100" class="md-whiteframe-1dp mylayout-padding">
                <div flex layout="row" layout-align="center center">
                    <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Select Branch * </label>
                        <md-select ng-model="indent_equipment.branch_id" name="branch_id" required>
                            <md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs"  ng-if="branch.BRANCH_ID !='All'">                                {{branch.BRANCH_NAME}}                            </md-option>
                        </md-select>
                        <div ng-messages="indentRequestForm.branch_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container  class="md-block" flex-gt-sm flex="20">
                        <label>Indent Request For</label>
                        <md-select ng-model="aindent_request" name="indent_request" required>
                            <md-option ng-repeat="indent_request in indent_requests"  ng-value="indent_request">                                {{indent_request}}                            </md-option>
                        </md-select>
						<div ng-messages="indentRequestForm.aindent_request.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <h5 flex class="sub_heading-style-respond">{{aindent_request}} Basic Details</h5>
                <div layout="row">
                    <div ng-show="indent_requests[0]==aindent_request" flex="25">
                        <md-input-container class="md-block" flex-gt-sm >
                            <label>Equipment Name</label>
                            <input type="text" ng-required="indent_requests[0]==aindent_request" ng-model="indent_equipment.equp_name" name="equp_name" aria-label="equp_name"/>
                            <div ng-messages="indentRequestForm.equp_name.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div flex="10" ng-show="indent_requests[0]==aindent_request" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <div ng-show="indent_requests[1]==aindent_request" flex="25">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Spares</label>
                            <md-select ng-model="indent_equipment.critical_spare" name="critical_spare">
                                <md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE">                                    {{m_critical_spare.NAME}}                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>
                    <div flex="10" ng-show="indent_requests[1]==aindent_request" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <div ng-show="indent_requests[2]==aindent_request" flex="20">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Accessories</label>
                            <md-select ng-model="indent_equipment.accessories" name="accessorie">
                                <md-option ng-repeat="m_accessorie in m_accessories"  ng-value="m_accessorie.CODE">                                    {{m_accessorie.NAME}}                                </md-option>
                            </md-select>
                        </md-input-container>
                    </div>
                    <div flex="10" ng-show="indent_requests[2]==aindent_request" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <!--<md-input-container ng-show="indent_requests[0]==aindent_request" class="md-block" flex-gt-sm flex="20">
                        <label>Equipment Category</label>
                        <md-select ng-required="indent_requests[2]==aindent_request" ng-model="indent_equipment.cat" name="cat" aria-label="cat">
                            <md-option ng-repeat="equp_cat in equp_cats" ng-value="equp_cat.ID">{{equp_cat.NAME}}</md-option>
                        </md-select>
                    </md-input-container>-->
                    <md-autocomplete flex="20" class="md-block" flex-gt-sm
									 required
									 md-input-name="equipmentname"
                                     ng-show="indent_requests[0]==aindent_request"
                                     md-no-cache="false"
                                     ng-value="indent_equipment.cat=searched.DID"
                                     md-selected-item="searched.DID"
                                     md-search-text="searchEcategory"
                                     md-items="item in searchTextChange(searchEcategory,'Ecategory')"
                                     md-item-text="item.NAME1"
                                     md-min-length="0"
                                     md-floating-label="Search Equipment Category">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.NAME1}}</span>
                        </md-item-template>
						<div ng-messages="indentRequestForm.equipmentname.$error">
							<div ng-message="required">required</div>
						</div>
                        <!--<md-not-found>
                           
                        </md-not-found>--->
                    </md-autocomplete>
                    <span ng-value="indent_equipment.cat = searched.DID.DID"></span>
                    <div flex="10" ng-show="indent_requests[0]==aindent_request" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <!--<md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Department</label>
                        <md-select ng-required="indent_requests[0]==aindent_request" ng-model="indent_equipment.departments" name="depts">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})                            </md-option>
                        </md-select>
                    </md-input-container>-->
                    <md-autocomplete flex="20" class="md-block" flex-gt-sm
									 required
									 md-input-name="equipmentdept"
                                     ng-value="indent_equipment.departments=searched.CODE"
                                     md-no-cache="false"
                                     md-selected-item="searched.CODE"
                                     md-search-text="searchDepartment"
                                     md-items="item in searchTextChange(searchDepartment,'Department')"
                                     md-item-text="item.USER_DEPT_NAME"
                                     md-min-length="0"
                                     md-floating-label="Search Department">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
                        </md-item-template>
						<div ng-messages="indentRequestForm.equipmentdept.$error" ng-if="indentRequestForm.equipmentdept.$touched">
							<div ng-message="required">required</div>
						</div>
                        <!--<md-not-found>
                            No Department Found
                        </md-not-found>-->
                    </md-autocomplete>
                    <span ng-value="indent_equipment.departments = searched.CODE.CODE"></span>
                    <div flex="10"  hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Quantity</label>
                        <input type="text"  ng-pattern="/^(\d)+$/" ng-maxlength="5"  required ng-model="indent_equipment.quantity" name="quantity" aria-label="quantity"/>
                        
						<!--<span ng-bind="EMessage1" ng-style="{color:EColor1}"></span>-->                  
	 				   <div ng-messages="indentRequestForm.quantity.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="indentRequestForm.quantity.$error.maxlength">Maxlength is Exceeds.</div>
							<div ng-show="indentRequestForm.quantity.$error.pattern">Please Type Numbers</div>
                        </div>
                    </md-input-container>
                </div>
                <h5 flex class="sub_heading-style-respond">Vendor/Company Details</h5>
                <div layout="row">
                    <!--<md-input-container class="md-block" flex-gt-sm flex="25">
                        <label>Company Name (OEM)</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="indent_equipment.company_name" name="company_name" aria-label="company_name">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Make" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="oems">
                                <md-option ng-repeat="oem in oems | filter:searchTerm" ng-value="oem.ID">{{oem.NAME}}</md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>-->
                    <md-autocomplete flex="20" class="md-block" flex-gt-sm
									 required 
									 md-input-name="equipmentcompany"
                                     md-no-cache="false"
                                     ng-value="indent_equipment.company_name=searched.ID2"
                                     md-selected-item="searched.ID2"
                                     md-search-text="searchCompanyName"
                                     md-items="item in searchTextChange(searchCompanyName,'Companyname')"
                                     md-item-text="item.NAME"
                                     md-min-length="0"
                                     md-floating-label="Search Company Name">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.NAME}}</span>
                        </md-item-template>
						<div ng-messages="indentRequestForm.equipmentcompany.$error" ng-if="indentRequestForm.equipmentcompany.$touched">
							<div ng-message="required">Required</div>
						</div>
                        <!--<md-not-found>
                            No Company Found
                        </md-not-found>--->
                    </md-autocomplete>
                    <span ng-value="indent_equipment.company_name = searched.ID2.ID2" ></span>
                    <div flex="5" hide-xs hide-sm></div>
                   <!-- <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Contract Vendor *</label>
                        <md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="indent_equipment.vendor_id" name="vendor" aria-label="vendor">
                            <md-select-header class="demo-select-header">
                                <input ng-model="searchTerm" type="text" placeholder="Search Vendor" class="demo-header-searchbox md-text">
                            </md-select-header>
                            <md-optgroup label="{{data.category}}" ng-repeat="data in sprt_vendrs">
                                <md-option ng-repeat="sprt_vendr in data.list | filter:searchTerm" ng-value="sprt_vendr.ID">                                    {{sprt_vendr.NAME}}                                </md-option>
                            </md-optgroup>
                        </md-select>
                    </md-input-container>-->
                    <md-autocomplete class="md-block" flex-gt-sm flex="25"
                                     ng-value="indent_equipment.vendor_id==searched.ORG_ID"
									 required 
									 md-input-name="equipmentorg"
                                     md-no-cache="false"
                                     md-selected-item="searched.ORG_ID"
                                     md-search-text="searchORG_NAME"
                                     md-items="item in searchTextChange(searchORG_NAME)"
                                     md-item-text="item.ORG_NAME"
									 md-selected-item-change="getContractVendorDetails(indent_equipment.vendor_id)"
                                     md-min-length="0"
                                     md-floating-label="Search Contract Vendor"
									 required>
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
                        </md-item-template>
						<div ng-messages="indentRequestForm.equipmentorg.$error" ng-if="indentRequestForm.equipmentorg.$touched">
							<div ng-message="required">Required</div>
						</div>
                        <!--<md-not-found>
                            NO Vendor Found
                        </md-not-found>-->
						 <div ng-messages="indentRequestForm.vendor_id.$error">
						<div ng-message="required">Required.</div>
						</div>
                    </md-autocomplete>
                    <span ng-value="indent_equipment.vendor_id = searched.ORG_ID.ORG_ID" ></span>
                    <div flex="5" hide-xs hide-sm></div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Contact Number</label>
                        <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="indent_equipment.vendor_contact_no" name="vendor_contact_no" aria-label="vcontact_no"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container class="md-block" flex-gt-sm flex="20">
                        <label>Email ID</label>
                        <input type="email" ng-disabled="true" ng-model="indent_equipment.vemail_id" name="vemail_id" aria-label="vemail_id"/>
                    </md-input-container>
                </div>
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Contact Person</label>
                        <input type="text" ng-disabled="true" ng-model="indent_equipment.vcontact_person" name="vcontact_person" aria-label="vcontact_person"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Contact Person Number</label>
                        <input type="text" ng-disabled="true" only-digits="only-digits" ng-model="indent_equipment.vcontact_person_no" name="vcontact_person_no" aria-label="vcontact_person_no"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Contact Person Email ID</label>
                        <input type="eamil" ng-disabled="true" ng-model="indent_equipment.vcontact_person_email_id" name="vcontact_person_email_id" aria-label="vcontact_person_email_id"/>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block"  flex-gt-sm flex="30">
                        <label>Vendor Address</label>
                        <textarea rows="5" ng-disabled="true" ng-model="indent_equipment.vendor_address" name="vendor_address" aria-label="vendor_address" md-select-on-focus></textarea>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Estimated Cost</label>
                        <input type="text" required ng-model="indent_equipment.estimated_cost"  
ng-pattern="/^(\d)+$/" ng-maxlength="8" ng-minlength="3"  name="estimated_cost" required  aria-label="equp_name"/>                  
	 				   <div ng-messages="indentRequestForm.estimated_cost.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="indentRequestForm.estimated_cost.$error.maxlength">Maximum length is Exceeds</div>
							<div ng-show="indentRequestForm.estimated_cost.$error.minlength">Minimum length is required 3. </div>
							<div ng-show="indentRequestForm.estimated_cost.$error.pattern">Please Type Numbers only.</div>
                        </div>
                        <!--<div ng-messages="indentRequestForm.estimated_cost.$error"><div ng-message="required">Required.</div></div>-->
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Approx Revenue Generation</label>
                        <input type="text" ng-model="indent_equipment.app_revenu_gen" name="app_revenu_gen" ng-pattern="/^(\d)+$/" />
                        <div ng-messages="indentRequestForm.app_revenu_gen.$error">
						<div ng-show="indentRequestForm.app_revenu_gen.$error.pattern">Please Type Numbers only.</div> 
                        </div>
					</md-input-container>
                    <div flex="5" hide-xs hide-sm></div>
                    <mdp-date-picker  ng-show="user_role_code==HMADMIN" mdp-placeholder="Budget Approved By*" flex-gt-sm flex="48" mdp-max-date="minDate" mdp-format="DD-MM-YYYY" ng-model="indent_equipment.budget_approved_by"></mdp-date-picker>
                    <div flex="5" ng-show="user_role_code==HMADMIN" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <mdp-date-picker mdp-placeholder="Bio-Medical Receipt Date*" flex-gt-sm flex="47" mdp-max-date="minDate" mdp-format="DD-MM-YYYY" ng-model="indent_equipment.biomedical_receipt_date" ></mdp-date-picker>
                </div>
                <h5 flex ng-show="user_role_code==HMADMIN" class="sub_heading-style-respond">Budget Details</h5>
                <div layout="row" ng-show="user_role_code==HMADMIN">
                    <md-input-container  class="md-block" flex-gt-sm>
                        <label>Budget Refrence</label>
                        <textarea ng-model="indent_equipment.budget_refrence" name="budget_refrence" rows="5" md-select-on-focus></textarea>
                        <!--<div ng-messages="indentRequestForm.budget_refrence.$error"><div ng-message="required">Required.</div></div> -->
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm></div>
                    <md-input-container  class="md-block" flex-gt-sm>
                        <label>Quotes called for(2 Weeks)</label>
                        <textarea ng-model="indent_equipment.quotes_called" name="quotes_called" rows="5" md-select-on-focus></textarea>
                        <!--<div ng-messages="indentRequestForm.quotes_called.$error"><div ng-message="required">Required.</div></div>-->
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <md-input-container  class="md-block" flex-gt-sm>
                        <label>Evalution Period(4 Weeks)</label>
                        <textarea ng-model="indent_equipment.evalution_period" name="evalution_period" rows="5" md-select-on-focus></textarea>
                        <!--<div ng-messages="indentRequestForm.evalution_period.$error"><div ng-message="required">Required.</div></div>-->
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <mdp-date-picker  mdp-placeholder="Po Release Date*" class="md-block" flex mdp-format="DD-MM-YYYY" ng-model="indent_equipment.po_date"></mdp-date-picker>
                </div>
                <h5 flex class="sub_heading-style-respond">Features/Description</h5>
                <div layout="row">
                    <div>
                        <label> Brief Description</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.desc" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <div>
                        <label>Basic / Essential Features</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.essential_feature" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Optimal /Desirous Features</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.desirous_features" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <div>
                        <label>Optimal /Luxurious Features</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.luxrious_features" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Standard Accessories</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.stard_access" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <div>
                        <label>Optional Accessories</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.optional_access" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Benefits with Desirous Features</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.benfits_desirous_features" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <div>
                        <label>Benefits with Luxurious Features</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.benfit_luxurious_feature" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div>
                        <label>Reasons</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.reasons" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                    <div flex="5" hide-xs hide-sm>
                        <!-- Space -->
                    </div>
                    <div>
                        <label>Remarks</label>
                        <md-input-container class="md-block">
                            <textarea ck-editor ng-model="indent_equipment.remarks" md-select-on-focus=""></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div flex layout="row" layout-align="center center">
                    
                        <md-button class="md-raised md-accent" ng-click="addIndentEquipment(indent_equipment,aindent_request)" ng-disabled="indentRequestForm.$invalid" aria-label="submit">Submit</md-button>
                        <md-button class="md-raised md-default" aria-label="submit" ui-sref="home.indent_equipment">Cancel</md-button>
                </div>
            </form>
        </div>
    </div>
</md-content>