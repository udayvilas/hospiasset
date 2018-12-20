<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="95" ng-clock>
	<md-toolbar>
		<div class="md-toolbar-tools">
			<h4>Viability Details</h4>
			<span flex></span>
			<md-button class="md-icon-button" ng-click="cancel()">
				<md-icon md-font-set="material-icons">clear</md-icon>
			</md-button>
		</div>
	</md-toolbar>
	<md-dialog-content flex layout-align="center center">
		<div class="md-dialog-content">
			<form method="POST" name="editViabilityForm" flex="100" class="md-whiteframe-1dp mylayout-padding"autocomplete="off">
				<div layout="row">
					<!---<md-input-container class="md-block" flex-gt-sm ><label>Equipment Id </label><input type="text"  ng-model="edit_viability.equp_id" name="equpid"  aria-label="equpid"/><div ng-messages="editViabilityForm.equpid.$error"><div ng-message="required">Required.</div></div></md-input-container><div flex="5" hide-xs hide-sm>
					<!-- Space --</div>-->
					<!--<md-input-container  class="md-block" flex-gt-sm flex="20"><label>Branch</label><md-select ng-model="edit_viability.branch_id" name="branchs"><md-option ng-repeat="branch in branchs"  ng-value="branch.BRANCH_ID" ng-if="branch.BRANCH_ID !='All'">                               {{branch.BRANCH_NAME}}                            </md-option></md-select></md-input-container><div flex="5" hide-xs hide-sm>
					<!-- Space -->
				
				<!--<md-input-container class="md-block" flex-gt-sm flex="20"><label>Department</label><md-select ng-change="getDepartmentDevices(edit_viability.dept_id,edit_viability.branch_id)" ng-model="edit_viability.dept_id" name="dept_id"><md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option></md-select></md-input-container>--->
				<md-autocomplete flex="20" class="md-block" flex-gt-sm
						 ng-init="searched.CODE = (edit_viability.dept_id != null) ? {'CODE': edit_viability.dept_id,'USER_DEPT_NAME':edit_viability.DEPT_NAME} : null"
						 md-no-cache="false"
						 md-input-name="department"
						 required
                         md-selected-item="searched.CODE"
                         md-search-text="edit_viability.searchDepartment"
                         md-items="item in searchTextChange(edit_viability.searchDepartment,'Department')"
                         md-item-text="item.USER_DEPT_NAME"
                         md-search-text-change="edit_viability.dept_id = ''"
                         md-selected-item-change="edit_viability.dept_id = item.CODE"
                         md-min-length="0"
                         md-floating-label="Search Department">
					<md-item-template>
						<span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>
					</md-item-template>
					<div ng-messages="ViabilityRequestForm.department.$error">
						<div ng-message="required">Required.</div>
					</div>
					<md-not-found>
                No Department Found
            </md-not-found>
				</md-autocomplete>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<!--<md-input-container class="md-block" flex-gt-sm flex="20"><label>Equipment ID *</label><md-select required ng-disabled="edit_viability.dept_id==null" ng-model="edit_viability.equp_id" name="equp_id" ng-change="getDeviceDetailsByEID(edit_viability.dept_id,edit_viability.equp_id);getEIDByPriority(edit_viability.equp_id)"><md-option ng-repeat="device in devices"  ng-value="device.E_ID" ng-if="devices.length>0">
                                {{device.E_ID}}
                            </md-option><md-option ng-if="devices.length == 0">                               No Equipment Found                            </md-option></md-select></md-input-container>--->
				<md-autocomplete flex="20" class="md-block" flex-gt-sm
						 ng-init="searched.E_ID = (edit_viability.equp_id != null) ? {'E_ID': edit_viability.equp_id} : null"
						 md-no-cache="false"
						 md-input-name="Eq.ID"
                         md-selected-item="searched.E_ID"
                         md-search-text="edit_viability.searchEid"
                         md-items="item in searchTextChange(edit_viability.searchEid,edit_viability.branch_id,edit_viability.dept_id)"
                         md-item-text="item.E_ID"
                         md-search-text-change="edit_viability.equp_id = ''"
                         md-selected-item-change="edit_viability.equp_id = item.E_ID"
						 md-selected-item-change="getDeviceDetailByEID(item)"
                         md-min-length="0"
                         md-floating-label="search Eq.id">
					<md-item-template>
						<span md-highlight-text="searchEid" md-highlight-flags="^i">{{item.E_ID}}</span>
					</md-item-template>
					<div ng-messages="ViabilityRequestForm.Eq.ID.$error">
						<div ng-message="required">Required.</div>
					</div>
					<md-not-found>
                No Equipment Found
            </md-not-found>
				</md-autocomplete>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Cost of Consumables</label>
					<input type="text" ng-pattern="/^(\d)+$/"  ng-maxlength="10" ng-model="edit_viability.cost_consumables" name="cost_consumables" aria-label="cost_consumables"/>
					<div ng-messages="ViabilityRequestForm.cost_consumables.$error">
						<div ng-show="ViabilityRequestForm.cost_consumables.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.cost_consumables.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Disposable Cost</label>
					<input type="text" ng-pattern="/^(\d)+$/"  ng-maxlength="10" ng-model="edit_viability.disposal_cost" name="disposal_cost" aria-label="disposal_cost"/>
					<div ng-messages="ViabilityRequestForm.disposal_cost.$error">
						<div ng-show="ViabilityRequestForm.disposal_cost.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.disposal_cost.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
			</div>
			<div layout="row">
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>No Cases Done Daily</label>
					<input ng-pattern="/^(\d)+$/" type="text" ng-maxlength="5" ng-model="edit_viability.no_of_cases_daily" name="no_of_cases_daily" aria-label="no_of_cases_daily"/>
					<div ng-messages="ViabilityRequestForm.no_of_cases_daily.$error">
						<div ng-show="ViabilityRequestForm.no_of_cases_daily.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.no_of_cases_daily.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Charges per operation/procedure</label>
					<input type="text" ng-model="edit_viability.charge_operation"  ng-maxlength="10" name="charge_operation" aria-label="charge_operation"/>
					<div ng-messages="ViabilityRequestForm.charge_operation.$error">
						<div ng-show="ViabilityRequestForm.charge_operation.$error.maxlength">Max length is Exceeds.</div>
					</div>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Number of operations per year</label>
					<input ng-pattern="/^(\d)+$/" type="text"  ng-maxlength="10" ng-model="edit_viability.no_of_oper_per_year" name="no_of_oper_per_year" aria-label="no_of_oper_per_year"/>
					<div ng-messages="ViabilityRequestForm.no_of_oper_per_year.$error">
						<div ng-show="ViabilityRequestForm.no_of_oper_per_year.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.no_of_oper_per_year.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Revenue per year</label>
					<input ng-pattern="/^(\d)+$/" type="text" ng-maxlength="10" ng-model="edit_viability.revenu_year" name="revenu_year" aria-label="revenu_year"/>
					<div ng-messages="ViabilityRequestForm.revenu_year.$error">
						<div ng-show="ViabilityRequestForm.revenu_year.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.revenu_year.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
			</div>
			<div layout="row" flex>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Profit over one year </label>
					<input ng-pattern="/^(\d)+$/" type="text" ng-maxlength="10" ng-model="edit_viability.Profit_over_one_year" name="Profit_over_one_year" aria-label="Profit_over_one_year"/>
					<div ng-messages="ViabilityRequestForm.Profit_over_one_year.$error">
						<div ng-show="ViabilityRequestForm.Profit_over_one_year.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.Profit_over_one_year.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Profit over three year</label>
					<input ng-pattern="/^(\d)+$/" type="text" ng-maxlength="10" ng-model="edit_viability.Profit_over_three_year" name="Profit_over_three_year" aria-label="Profit_over_three_year"/>
					<div ng-messages="ViabilityRequestForm.Profit_over_three_year.$error">
						<div ng-show="ViabilityRequestForm.Profit_over_three_year.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.Profit_over_three_year.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<md-input-container class="md-block" flex-gt-sm flex="20">
					<label>Code of operation</label>
					<input ng-pattern="/^(\d)+$/" type="text" ng-maxlength="10" ng-model="edit_viability.Code_of_operation" name="Code_of_operation" aria-label="Code_of_operation"/>
					<div ng-messages="ViabilityRequestForm.Code_of_operation.$error">
						<div ng-show="ViabilityRequestForm.Code_of_operation.$error.maxlength">Max length is Exceeds.</div>
						<div ng-show="ViabilityRequestForm.Code_of_operation.$error.pattern">Please type numbers only</div>
					</div>
				</md-input-container>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
			</div>
			<div layout="row">
				<div>
					<label> Justification</label>
					<md-input-container class="md-block">
						<textarea ck-editor ng-model="edit_viability.justification
" md-select-on-focus=""></textarea>
					</md-input-container>
				</div>
				<div flex="5" hide-xs hide-sm>
					<!-- Space -->
				</div>
				<div>
					<label>Advantages</label>
					<md-input-container class="md-block">
						<textarea ck-editor ng-model="edit_viability.advantages" md-select-on-focus=""></textarea>
					</md-input-container>
				</div>
			</div>
			<div layout="row">
				<div>
					<label> Technical specifications of the eq. being purchased</label>
					<md-input-container class="md-block">
						<textarea ck-editor ng-model="edit_viability.tsebp" md-select-on-focus=""></textarea>
					</md-input-container>
				</div>
			</div>
			<div flex layout="row" layout-align="center center">
				<md-button class="md-raised md-accent" ng-click="UpdateViability(edit_viability)" ng-disabled="editViabilityForm.$invalid" aria-label="submit">Submit</md-button>
				<md-button class="md-raised" aria-label="submit" ui-sref="home.viability">Cancel</md-button>
			</div>
		</form>
	</div>
</md-dialog-content></md-dialog>