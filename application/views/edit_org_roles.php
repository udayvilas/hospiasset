<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Add Org Roles</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="editOrgroleForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">
                <div layout="row">
                    <md-input-container flex="20">
                        <label>Roles Types *</label>
                        <md-select ng-change="getOrgRoleFeatures(edit_orgrole.role_code)" required  ng-model="edit_orgrole.role_code" ng-change="getRoleFeatures(edit_orgrole.role_code)" name="role_code" aria-label="role_code">
                            <md-option ng-repeat="org_role_main_type in org_role_main_types" ng-value="org_role_main_type.code">
                                {{org_role_main_type.value}}
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Role Code</label>
                        <input type="text" required ng-model="edit_orgrole.erole_code" name="erole_code" aria-label="erole_code"/>
                        <div ng-messages="editOrgroleForm.erole_code.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Role Name</label>
                        <input type="text" required ng-model="edit_orgrole.role_name" name="role_name" aria-label="role_name"/>
                        <div ng-messages="editOrgroleForm.role_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Indent</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.indent_req"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Request
                        </md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.indent_approve"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Approve</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>CEAR</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.cear_req"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Add</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.cear_approve"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Approve</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Purchase</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.pur_req"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Add</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.pur_approve"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Approve</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Visible Purchase</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.pur_status_update"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Status Update</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.pur_stock_into_stock"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Stock Into Stock</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Install</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.add_device"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Add Equipment</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.edit_device"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Edit Equipment</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Gate Pass</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.gate_pass_edit"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Edit</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Transfer</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.with_in_unit"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">With in Unit</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.other_unit"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Other Unit</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Condemnation</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.condem_req"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Request</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.condem_approve"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Approve</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.condem_close"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Closing">Close</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Print Labels</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.qr_label"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">QR Label</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.pms_cal_label"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">PMS/CAL</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Contracts</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.add_contract"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Add">Add</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.renew_contract"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Renewal</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.close_contract"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Closing">Close</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Incident</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.add_incident"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Add">Add</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.approve_incident"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Approve</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.close_incident"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Closing">Close</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Viability</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.viability_generate"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Generate</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.viability_approve"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Approve</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Non Scheduled</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.ns_show"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Show</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>PMS</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.pms_show"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Show</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Calibration</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.calibration_show"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Show</md-checkbox>
                    </md-input-container>
                </div>

                <div layout="row">
                    <md-input-container flex="20">
                        <label>Trainings</label>
                    </md-input-container>
                    <md-input-container flex="80" layout="row">
                        <md-checkbox
                            ng-model="edit_orgrole.training_create"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Request">Create</md-checkbox>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-checkbox
                            ng-model="edit_orgrole.training_approve"
                            ng-true-value="'{{yesstate}}'"
                            ng-false-value="'{{nostate}}'"
                            aria-label="Approve">Approve</md-checkbox>
                    </md-input-container>
                </div>

                    <div layout="row" layout-align="space-around" flex="100">
                        <div ng-repeat="role_all_feature in role_all_features" flex="25">
                            <md-checkbox ng-model="role_all_feature.MMENU_ID$index" ng-value="role_all_feature.MMENU_ID" ng-click="menuToogle(role_all_feature,features_selected)" aria-label="Select All">
                                {{role_all_feature.MMENU_TITLE}}
                            </md-checkbox>
                            <div ng-show="role_all_feature.MMENU_ID$index" style="padding-left: 20px;" layout="column">
                                <div ng-repeat="sub_feature in role_all_feature.sub_features">
                                <md-checkbox ng-click="submenuToogle(sub_feature,sub_features_selected)" ng-value="sub_feature.SMENU_AID" aria-label="$index">
                                        {{sub_feature.SMENU_TITLE}}
                                    </md-checkbox>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="updateOrgRoles(edit_orgrole)" ng-disabled="editOrgroleForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>