<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="100" ng-clock>
	<md-toolbar>
		<div class="md-toolbar-tools">
			<h4>Indent</h4>
			<span flex></span>
			<md-button class="md-icon-button" ng-click="cancel()">
				<md-icon md-font-set="material-icons">clear</md-icon>
			</md-button>
		</div>
	</md-toolbar>
	<md-dialog-content flex layout-align="center center">
		<div class="md-dialog-content">
			<form method="POST" name="editIndentRequestForm" flex="100" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
				<div flex layout="row" layout-align="center center">
					<md-input-container  class="md-block" flex-gt-sm flex="20">
						<label>Select Branch * </label>
						<md-select ng-model="edit_indent_equipment.branch_id" ng-disabled="true" name="branch_id" ng-required="edit_indent_equipment.branch_id != ''">
							<md-option ng-value="branch.BRANCH_ID" ng-repeat="branch in branchs"  ng-if="branch.BRANCH_ID !='All'">                                
							{{branch.BRANCH_NAME}}                  
							</md-option>
						</md-select>
			            <div ng-messages="editIndentRequestForm.branch_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
					</md-input-container>
					<div flex="10" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
						<label>Indent Request For</label>
						<md-select ng-disabled="true" ng-model="aindent_request" name="indent_request">
							<md-option ng-repeat="indent_request in indent_requests"  ng-value="indent_request">                                {{indent_request}}                            </md-option>
						</md-select>
					</md-input-container>
				</div>
				<h5 flex class="sub_heading-style-respond">{{aindent_request}} Basic Details</h5>
				<div layout="row">
					<div ng-if="indent_requests[0]==aindent_request" flex="25">
						<md-input-container class="md-block" flex-gt-sm>
							<label>Equipment Name </label>
							<input type="text"  required ng-model="edit_indent_equipment.equp_name" name="equp_name" aria-label="equp_name"/>
							<div ng-messages="editIndentRequestForm.equp_name.$error">
								<div ng-message="required">Required.</div>
							</div>
						</md-input-container>
					</div>
					<div ng-show="indent_requests[1]==aindent_request"  flex="20">
						<md-input-container  class="md-block" flex-gt-sm>
							<label>Spares</label>
							<md-select ng-model="edit_indent_equipment.critical_spare" name="critical_spares">
								<md-option ng-repeat="m_critical_spare in m_critical_spares"  ng-value="m_critical_spare.CODE">                                    {{m_critical_spare.NAME}}                                </md-option>
							</md-select>
						</md-input-container>
					</div>
					<div ng-show="indent_requests[2]==aindent_request" flex="20">
						<md-input-container  class="md-block" flex-gt-sm>
							<label>Acessories</label>
							<md-select ng-model="edit_indent_equipment.accessories" name="accessorie">
								<md-option ng-repeat="m_accessorie in m_accessories"  ng-value="m_accessorie.CODE">                                    {{m_accessorie.NAME}}                                </md-option>
							</md-select>
						</md-input-container>
					</div>
					<div flex="10" hide-xs hide-sm>
						<!-- Space -->
					</div>
					
					
					<div flex="10" ng-if="indent_requests[0]==aindent_request" hide-xs hide-sm></div>
					
					<md-autocomplete flex="20" class="md-block" flex-gt-sm
					     required
						 md-input-name="equipmentdept"
						 ng-init="searched.CODE = (edit_indent_equipment.departments != null) ? {'CODE': edit_indent_equipment.departments,'USER_DEPT_NAME':edit_indent_equipment.DEPT_NAME} : null"
						 md-no-cache="false"
                         md-selected-item="searched.CODE"
                         md-search-text="edit_indent_equipment.searchDepartment"
                         md-items="item in searchTextChange(edit_indent_equipment.searchDepartment,'Department')"
                         md-item-text="item.USER_DEPT_NAME"
                         md-search-text-change="edit_indent_equipment.departments = ''"
                         md-selected-item-change="edit_indent_equipment.departments = item.CODE"
                         md-min-length="0"
                         md-floating-label="Search Department">
						<md-item-template>
							<span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
						</md-item-template>
						<div ng-messages="editIndentRequestForm.equipmentdept.$error" ng-if="editIndentRequestForm.equipmentdept.$touched">
							<div ng-message="required">Required</div>
						</div>
                    </md-autocomplete>
              <span ng-value="edit_indent_equipment.departments = searched.CODE.CODE" ng-model="edit_indent_equipment.departments = searched.CODE.CODE" ></span>
					<div flex="10" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block" flex-gt-sm flex="45">
						<label>Quantity</label>
						<input type="text"  ng-model="edit_indent_equipment.quantity" ng-maxlength="5"  ng-pattern="/^(\d)+$/" required name="quantity" aria-label="quantity"/>
						<div ng-messages="editIndentRequestForm.quantity.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="editIndentRequestForm.quantity.$error.maxlength">Maximum length is Exceeds</div>
							<!--<div ng-show="editIndentRequestForm.quantity.$error.minlength">Minimum length is required  </div>-->
                            <div ng-show="editIndentRequestForm.quantity.$error.pattern">Please Type Numbers only.</div>
						</div>
					</md-input-container>
				</div>
				<h5 flex class="sub_heading-style-respond">Vendor/Company Details</h5>
				<div layout="row">
					<!--<md-input-container class="md-block" flex-gt-sm flex="25">
						<label>Company Name (OEM)</label>
						<md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" required ng-model="edit_indent_equipment.company_name" name="company_name" aria-label="company_name">
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
                         ng-value="edit_indent_equipment.company_name=searched.ID2"
                         ng-init="searched.ID2 = {'ID2': edit_indent_equipment.company_name,'NAME':edit_indent_equipment.CMP_NAME}"
                         md-selected-item="searched.ID2"
                         md-search-text="searchCompanyName"
                         md-items="item in searchTextChange(searchCompanyName,'Companyname')"
                         md-item-text="item.NAME"
                         md-min-length="0"
                         md-floating-label="Search Company Name">
                        <md-item-template>
                            <span md-highlight-text="searchCompanyName" md-highlight-flags="^i">{{item.NAME}}</span>
                        </md-item-template>
						<div ng-messages="editIndentRequestForm.equipmentcompany.$error" ng-if="editIndentRequestForm.equipmentcompany.$touched">
							<div ng-message="required">Required</div>
						</div>
                        <!--<md-not-found>
                            No Company Found
                        </md-not-found>--->
                </md-autocomplete>
                <span ng-value="edit_indent_equipment.company_name = searched.ID2.ID2"
                     ng-model="edit_indent_equipment.company_name = searched.ID2.ID2" ></span>
						
						<!--<md-input-container class="md-block" flex-gt-sm flex="40"><label>Contract Vendor *</label><md-select ng-model="edit_indent_equipment.vendor" ng-change="getContractVendorDetails(edit_indent_equipment.vendor)" name="vendor" required aria-label="vendor"><md-option ng-repeat="sprt_vendr in sprt_vendrs" ng-value="sprt_vendr.ID">                                {{sprt_vendr.NAME}}                            </md-option></md-select></md-input-container>-->
						<!--<md-input-container class="md-block" flex-gt-sm flex="20">
							<label>Contract Vendor *</label>
							<md-select md-on-close="clearSearchTerm()" data-md-container-class="selectdemoSelectHeader" ng-model="edit_indent_equipment.vendor_id" name="vendor" aria-label="vendor">
								<md-select-header class="demo-select-header">
									<input ng-model="searchTerm" type="text" placeholder="Search Vendor" class="demo-header-searchbox md-text">
									</md-select-header>
									<md-optgroup label="{{data.category}}" ng-repeat="data in sprt_vendrs">
										<md-option ng-repeat="sprt_vendr in data.list | filter:searchTerm" ng-value="sprt_vendr.ID">                                    {{sprt_vendr.NAME}}                                </md-option>
									</md-optgroup>
								</md-select>
							</md-input-container>-->
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-autocomplete class="md-block" flex-gt-sm flex="25"
									 required 
									 md-input-name="equipmentorg"
                                     ng-value="edit_indent_equipment.vendor==searched.ORG_ID"'
									 ng-init="searched.ORG_ID = {'ORG_ID': edit_indent_equipment.vendor,'ORG_NAME':edit_indent_equipment.VENDOR_NAME}"
                                     md-no-cache="false"
                                     md-selected-item="searched.ORG_ID"
                                     md-search-text="searchORG_NAME"
                                     md-items="item in searchTextChange(searchORG_NAME)"
                                     md-item-text="item.ORG_NAME"
                                     md-min-length="0"
                                     md-floating-label="Search Contract Vendor">
                        <md-item-template>
                            <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.ORG_NAME}}</span>
                        </md-item-template>
						<div ng-messages="editIndentRequestForm.equipmentorg.$error" ng-if="editIndentRequestForm.equipmentorg.$touched">
							<div ng-message="required">Required</div>
						</div>
                        <!--<md-not-found>
                            NO Vendor Found
                        </md-not-found>--->
                    </md-autocomplete>
							<span ng-value="edit_indent_equipment.vendor = searched.ORG_ID.ORG_ID" ng-model="edit_indent_equipment.vendor = searched.ORG_NAME.ORG_NAME" ></span>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container class="md-block" flex-gt-sm flex="30">
								<label>Contact Number</label>
								<input type="text" ng-disabled="true" only-digits="only-digits" ng-model="edit_indent_equipment.vendor_contact_no" name="vendor_contact_no" aria-label="vcontact_no"/>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container class="md-block"  flex-gt-sm flex="30">
								<label>Email ID</label>
								<input type="email" ng-disabled="true" ng-model="edit_indent_equipment.vemail_id" name="vemail_id" aria-label="vemail_id"/>
							</md-input-container>
						</div>
						<div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row">
							<md-input-container class="md-block"  flex-gt-sm flex="30">
								<label>Contact Person</label>
								<input type="text" ng-disabled="true" ng-model="edit_indent_equipment.vcontact_person" name="vcontact_person" aria-label="vcontact_person"/>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container class="md-block"  flex-gt-sm flex="30">
								<label>Contact Person Number</label>
								<input type="text" ng-disabled="true" only-digits="only-digits" ng-model="edit_indent_equipment.vcontact_person_no" name="vcontact_person_no" aria-label="vcontact_person_no"/>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container class="md-block"  flex-gt-sm flex="30">
								<label>Contact Person Email ID</label>
								<input type="eamil" ng-disabled="true" ng-model="edit_indent_equipment.vcontact_person_email_id" name="vcontact_person_email_id" aria-label="vcontact_person_email_id"/>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container class="md-block"  flex-gt-sm flex="30">
								<label>Vendor Address</label>
								<textarea rows="5" ng-disabled="true" ng-model="edit_indent_equipment.vendor_address" name="vendor_address" aria-label="vendor_address" md-select-on-focus></textarea>
							</md-input-container>
						</div>
						<div layout="row">
							<md-input-container class="md-block" flex-gt-sm>
								<label>Estimated Cost</label>
								<input type="text"  required ng-model="edit_indent_equipment.estimated_cost" ng-pattern="/^(\d)+$/" ng-maxlength="8" ng-minlength="3" name="estimated_cost"  aria-label="equp_name"/>
								<div ng-messages="editIndentRequestForm.estimated_cost.$error">
									<div ng-message="required">Required.</div>
									<div ng-show="editIndentRequestForm.estimated_cost.$error.maxlength">Maxlength is Exceeds.</div>
									<div ng-show="editIndentRequestForm.estimated_cost.$error.minlength">Minlength is Required 3. </div>
								</div>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container class="md-block" flex-gt-sm>
								<label>Approx revenu generation</label>
								<input type="text" ng-model="edit_indent_equipment.app_revenu_gen" name="app_revenu_gen" ng-maxlength="150" ng-pattern="/^(\d)+$/"  md-select-on-focus>
								<div ng-messages="editIndentRequestForm.app_revenu_gen.$error">
									<div ng-message="required">Required.</div>
									<div ng-show="editIndentRequestForm.app_revenu_gen.$error.pattern">Please Type Numbers only.</div>
									<div ng-show="editIndentRequestForm.app_revenu_gen.$error.maxlength">Maxlength is Exceeds.</div>
								</div>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<mdp-date-picker  ng-show="user_role_code==HMADMIN"  mdp-placeholder="Budget Approved By*" flex-gt-sm flex="48" mdp-max-date="minDate" mdp-format="DD-MM-YYYY" ng-model="edit_indent_equipment.budget_approved_by"></mdp-date-picker>
							<div flex="5" ng-show="user_role_code==HMADMIN"   hide-xs hide-sm>
								<!-- Space -->
							</div>
							<mdp-date-picker mdp-placeholder="Bio-Medical Receipt Date*" flex-gt-sm flex="47" mdp-max-date="maxDate" mdp-format="DD-MM-YYYY" ng-model="edit_indent_equipment.biomedical_receipt_date" ></mdp-date-picker>
						</div>
						<h5 flex ng-show="user_role_code==HMADMIN" class="sub_heading-style-respond">Budget Details</h5>
						<div layout="row">
							<md-input-container  ng-show="user_role_code==HMADMIN"  class="md-block" flex-gt-sm >
								<label>Budget Refrence</label>
								<textarea ng-model="edit_indent_equipment.budget_refrence" name="budget_refrence" md-maxlength="350" rows="5" md-select-on-focus></textarea>
								<div ng-messages="editIndentRequestForm.budget_refrence.$error">
									<div ng-message="required">Required.</div>
								</div>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container  ng-show="user_role_code==HMADMIN"  class="md-block" flex-gt-sm>
								<label>Quotes called for(2 Weeks)</label>
								<textarea ng-model="edit_indent_equipment.quotes_called" name="quotes_called" md-maxlength="350" rows="5" md-select-on-focus></textarea>
								<div ng-messages="editIndentRequestForm.quotes_called.$error">
									<div ng-message="required">Required.</div>
								</div>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<md-input-container  ng-show="user_role_code==HMADMIN"  class="md-block" flex-gt-sm>
								<label>Evalution Period(4 Weeks)</label>
								<textarea ng-model="edit_indent_equipment.evalution_period" name="evalution_period" md-maxlength="350" rows="5" md-select-on-focus></textarea>
								<div ng-messages="editIndentRequestForm.evalution_period.$error">
									<div ng-message="required">Required.</div>
								</div>
							</md-input-container>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<mdp-date-picker  ng-show="user_role_code==HMADMIN"  mdp-placeholder="Po Release Date*" class="md-block" flex-gt-sm flex mdp-format="DD-MM-YYYY" ng-model="edit_indent_equipment.po_date" ></mdp-date-picker>
						</div>
						<h5 flex class="sub_heading-style-respond">Features/Description</h5>
						<div layout="row">
							<div>
								<label> Brief Description</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.desc" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<div>
								<label>Basic / Essential Features</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.essential_feature" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
						</div>
						<div layout="row">
							<div>
								<label>Optimal /Desirous Features</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.desirous_features" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<div>
								<label>Optimal /Luxurious Features</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.luxrious_features" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
						</div>
						<div layout="row">
							<div>
								<label>Standard Accessories</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.stard_access" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<div>
								<label>Optional Accessories</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.optional_access" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
						</div>
						<div layout="row">
							<div >
								<label>Benfits with Desirous Features</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.benfits_desirous_features" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<div>
								<label>Benfits with Luxurious Features</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.benfit_luxurious_feature" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
						</div>
						<div layout="row">
							<div>
								<label>Reasons</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.reasons" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
							<div flex="5" hide-xs hide-sm>
								<!-- Space -->
							</div>
							<div>
								<label>Remarks</label>
								<md-input-container class="md-block">
									<textarea ck-editor ng-model="edit_indent_equipment.remarks" md-select-on-focus=""></textarea>
								</md-input-container>
							</div>
						</div>
						<div flex layout="row" layout-align="center center">
							<center>
								<md-button class="md-raised md-accent" ng-click="updateIndentEquipment(edit_indent_equipment,aindent_request)" ng-disabled="editIndentRequestForm.$invalid" aria-label="submit">Submit</md-button>
							</center>
						</div>
					</form>
				</div>
			</md-dialog-content>
		</md-dialog>