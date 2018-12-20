<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
	<div layout="column">
		<h3 class="heading-stylerespond">Add Roles</h3>
		<span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
		<div flex layout="row" layout-align="center center" >
			<form method="POST" name="addOrgroleForm" flex="100" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
				<div layout="row">
					<!--<md-input-container flex="20">
						<label>{{role_labels.ROLE_TYPE}}Roles Types *</label>
						<md-select ng-change="getOrgRoleFeatures(add_orgrole.role_code)" required  ng-model="add_orgrole.role_code" ng-change="getRoleFeatures(add_orgrole.role_code)" name="role_code" aria-label="role_code">
							<md-option ng-repeat="org_role_main_type in org_role_main_types | orderBy:'value'"  ng-if="org_role_main_type.code !=user_role_code" ng-value="org_role_main_type.code">                                {{org_role_main_type.value}}                            </md-option>
						</md-select>
						<div ng-messages="addOrgroleForm.role_code.$error">
							<div ng-message="required">Required.</div>
						</div>
					</md-input-container>--->
					 <md-input-container flex="20">
						<label>Roles Types *</label>
						<md-select  required  ng-model="add_orgrole.role_code"  name="role_code" aria-label="role_code">
							<md-option ng-repeat="role_type in roletypes" ng-if="role_type.ROLE_TYPE!=user_role_code"  ng-value="role_type.ROLE_TYPE">                           
                                
                                {{role_type.ROLE_TYPE_NAME}}
                            </md-option>
						</md-select>
						<div ng-messages="addOrgroleForm.role_code.$error">
							<div ng-message="required">Required.</div>
						</div>
					</md-input-container>
					
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
						<label>{{role_labels.ROLE_CODE}}</label>
						<input type="text" required ng-model="add_orgrole.erole_code"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/"  md-maxlength="3" name="erole_code" aria-label="erole_code"/>
						<div ng-messages="addOrgroleForm.erole_code.$error">
							<div ng-message="required">Required.</div>
							<div ng-message="md-maxlength">Max limit is reached.</div>
							<div ng-show="addOrgroleForm.erole_code.$error.pattern">Please Provide Text Only.</div>
						</div>
					</md-input-container>
					<div flex="5" hide-xs hide-sm></div>
					<md-input-container class="md-block" flex-gt-sm flex="40">
						<label>{{role_labels.ROLE_NAME}}</label>
						<input type="text" required ng-model="add_orgrole.role_name" ng-pattern="/^[a-zA-Z _\\\/.’'-]+$/" name="role_name" md-maxlength="50" aria-label="role_name"/>
						<div ng-messages="addOrgroleForm.role_name.$error">
							<div ng-message="required">Required.</div>
							<div ng-message="md-maxlength">Max limit is reached..</div>
							<!--<div ng-show="addOrgroleForm.role_name.$error.pattern">Please Provide Text Only.</div>-->
						</div>
					</md-input-container>
					<div flex="5" hide-xs hide-sm></div>
					<md-input-container class="md-block" flex-gt-sm flex="20">
                            <label>{{role.LEVEL}}Escalation Level</label>
                            <md-select name="level_name" required ng-model="add_orgrole.level_name" aria-label="level_name">
                                <md-option ng-repeat="level in levels" ng-value="level.LEVEL_CODE">
                                    {{level.LEVEL_NAME}}
                                </md-option>
                            </md-select>
							<div ng-messages="addOrgroleForm.level_name.$error">
							<div ng-message="required">Required.</div>
						</div>
                        </md-input-container>
				</div>
				<div layout="row">
					<md-checkbox aria-label="Select All" ng-true-value= "'y'" ng-false-value= "'n'"  ng-click="toggleAll4()" 	  ng-model="isAllSelected">
					<span ng-if="isChecked()">Un-</span>Select All
					</md-checkbox>
				</div>
				<div layout="row" layout-align="space-around" flex="100">
					<div ng-repeat="feature in orgfeatures" ng-model="features" flex="25">
						<label>
						<input type="checkbox" ng-model="feature.selected"  ng-change="clicker(feature);" aria-label="Select All">
						{{feature.name}}
						</label>
						<div  style="padding-left: 20px;width: 200px;height: 200px;overflow-y: auto;" layout="column">
							<div ng-repeat="subfeature in feature.subfeatures" ng-model="feature.subfeatures">
								<label>
								<input type="checkbox" ng-model="subfeature.selected" ng-change="clicker1(subfeature);"  aria-label="Select All">
								{{subfeature.name}}
								</label>
								<div  style="padding-left: 20px;" layout="column">
									<div ng-repeat="subsubfeature in subfeature.subsubfeatures" aria-label="Select All" ng-model="subfeature.subsubfeatures" >
										<label>
										<input type="checkbox" ng-model="subsubfeature.selected">
										{{subsubfeature.name}} 
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div flex="5" hide-xs hide-sm></div>
					 
				</div>
				<!-- <div layout="row"><md-input-container flex="20"><label>Indent</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.indent_req"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Request                        </md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.indent_approve"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Approve</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>CEAR</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.cear_req"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Add</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.cear_approve"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Approve</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Purchase</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.pur_req"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Add</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.pur_approve"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Approve</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Visible Purchase</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.pur_status_update"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Status Update</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.pur_stock_into_stock"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Stock Into Stock</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Install</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.add_device"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Add Equipment</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.edit_device"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Edit Equipment</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Gate Pass</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.gate_pass_edit"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Edit</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Transfer</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.with_in_unit"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">With in Unit</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.other_unit"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Other Unit</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Condemnation</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.condem_req"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Request</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.condem_approve"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Approve</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.condem_close"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Closing">Close</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Print Labels</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.qr_label"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">QR Label</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.pms_cal_label"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">PMS/CAL</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Contracts</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.add_contract"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Add">Add</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.renew_contract"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Renewal</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.close_contract"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Closing">Close</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Incident</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.add_incident"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Add">Add</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.approve_incident"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Approve</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.close_incident"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Closing">Close</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Viability</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.viability_generate"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Generate</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.viability_approve"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Approve</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Non Scheduled</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.ns_show"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Show</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>PMS</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.pms_show"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Show</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Calibration</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.calibration_show"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Show</md-checkbox></md-input-container></div><div layout="row"><md-input-container flex="20"><label>Trainings</label></md-input-container><md-input-container flex="80" layout="row"><md-checkbox                            ng-model="add_orgrole.training_create"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Request">Create</md-checkbox><div flex="5" hide-xs hide-sm></div><md-checkbox                            ng-model="add_orgrole.training_approve"                            ng-true-value="'{{yesstate}}'"                            ng-false-value="'{{nostate}}'"                            aria-label="Approve">Approve</md-checkbox></md-input-container></div>-->
				<!--<div layout="row" layout-align="space-around" flex="100"><div ng-repeat="role_all_feature in role_all_features" flex="25"><md-checkbox                            ng-model="role_all_feature.MMENU_ID$index" ng-click="menuToogle(role_all_feature,features_selected)" aria-label="Select All">                            {{role_all_feature.MMENU_TITLE}}                        </md-checkbox><div ng-show="role_all_feature.MMENU_ID$index" style="padding-left: 20px;" layout="column"><div ng-repeat="sub_feature in role_all_feature.sub_features"><md-checkbox ng-click="submenuToogle(sub_feature,sub_features_selected)" ng-value="sub_feature.SMENU_AID" aria-label="$index">{{sub_feature.SMENU_TITLE}}</md-checkbox></div></div></div></div>-->
				<div flex layout="row" layout-align="center center">
					
						<md-button class="md-raised md-accent" ng-click="addOrgRoles(add_orgrole)" ng-disabled="addOrgroleForm.$invalid" aria-label="submit">Submit</md-button>
					     <md-button class="md-raised md-accent" ng-click="switchState('home.org_roles')" aria-label="cancel">Cancel</md-button>
				</div>
			</form>
		</div>
	</div>
</md-content>