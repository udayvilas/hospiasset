<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
    <md-content class="mylayout-padding" md-theme="hospiclr">
        <div layout="column">
            <h3 class="heading-stylerespond">Edit Roles</h3>
            <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
            <div flex layout="row" layout-align="center center">
			<form method="POST" name="editOrgroleForm" flex="100" autocomplete="off">
				<div layout="row" flex>
					<md-input-container flex="20">
						<label>{{role_labels.ROLE_CODE}}Roles Types *</label>
						<md-select  required ng-model="edit_orgrole.role_code" ng-change="getRoleFeatures(edit_orgrole.role_code)" name="role_code" aria-label="role_code">
							<md-option ng-repeat="org_role_main_type in org_role_main_types | orderBy:'value'"  ng-if="org_role_main_type.code!=user_role_code" ng-value="org_role_main_type.code">                                {{org_role_main_type.value}}                            </md-option>
						</md-select>
						<div ng-messages="editOrgroleForm.role_code.$error">
							<div ng-message="required">Required.</div>
							
						</div>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block" flex-gt-sm flex="40">
						<label>{{role_labels.ROLE_CODE}}</label>
						<input type="text" required ng-model="edit_orgrole.erole_code" name="erole_code" md-maxlength="3" ng-change="edit_orgrole.erole_code = (edit_orgrole.erole_code | uppercase)" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" aria-label="erole_code"/>
						<div ng-messages="editOrgroleForm.erole_code.$error">
							<div ng-message="required">Required.</div>
							<div ng-message="md-maxlength">Max limit is reached.</div>
						</div>
					</md-input-container>
					<div flex="5" hide-xs hide-sm>
						<!-- Space -->
					</div>
					<md-input-container class="md-block" flex-gt-sm flex="40">
						<label>{{role_labels.ROLE_NAME}}</label>
						<input type="text" required ng-model="edit_orgrole.role_name"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" name="role_name" aria-label="role_name"/>
						<div ng-messages="editOrgroleForm.role_name.$error">
							<div ng-message="required">Required.</div>
							<div ng-show="editOrgroleForm.role_name.$error.pattern">Please Provide Text Only.</div>
						</div>
					</md-input-container>
				</div>
				<div class="row">
					<md-checkbox aria-label="Select All" ng-true-value= "'y'" ng-false-value= "'n'" ng-model="isAllSelected" ng-click="toggleAll1()">
					Select All
					</md-checkbox>
				</div>
				<div layout="row" layout-align="space-around" flex="100">
					
					<div ng-repeat="feature in list1" ng-model="features" flex="25">
						<label>
						<input type="checkbox" ng-model="feature.selected"  ng-change="editroleclicker(feature);" >
						{{feature.name}}
						</label>
						<div  style="padding-left: 20px;width: 200px;height: 400px;overflow-y: auto;" layout="column">
							<div ng-repeat="subfeature in feature.subfeatures"  ng-model="feature.subfeatures">
								<label>
								<input type="checkbox"  ng-model="subfeature.selected" ng-change="editroleclicker1(subfeature);"  aria-label="Select All">
                                    {{subfeature.name}}
								</label>
								<div  style="padding-left: 20px;" layout="column">
									<div ng-repeat="subsubfeature in subfeature.subsubfeatures" ng-model="subfeature.subsubfeatures" aria-label="Select All">
										<label>
										<input type="checkbox" ng-model="subsubfeature.selected" >
                                            {{subsubfeature.name}}
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--<div ng-repeat="role_all_feature in role_all_features" flex="25"><md-checkbox ng-model="role_all_feature.MMENU_ID$index" ng-value="role_all_feature.MMENU_ID" ng-click="menuToogle(role_all_feature,features_selected)" aria-label="Select All">                            {{role_all_feature.MMENU_TITLE}}                        </md-checkbox><div ng-show="role_all_feature.MMENU_ID$index" style="padding-left: 20px;" layout="column"><div ng-repeat="sub_feature in role_all_feature.sub_features"><md-checkbox ng-click="submenuToogle(sub_feature,sub_features_selected)"   ng-value="sub_feature.SMENU_AID" aria-label="$index">                                    {{sub_feature.SMENU_TITLE}}                                </md-checkbox></div></div></div>-->
				</div>
				<div flex layout="row" layout-align="center center">
					
						<md-button class="md-raised md-accent" ng-click="updateOrgRoles(edit_orgrole)"  aria-label="submit">Submit</md-button>
					    <md-button class="md-raised md-accent" ui-sref="home.org_roles" aria-label="cancel">Cancel</md-button>
				</div>
			</form>
            </div>
        </div>
    </md-content>