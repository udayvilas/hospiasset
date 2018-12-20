<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="50" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Condemnation Approval</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">

            <div flex layout="row" layout-align="center center">
                <md-input-container  class="md-block" flex-gt-sm flex="30">
                    <label>Condemnation Status</label>
                    <md-select ng-model="acondemnation_status" name="transfer_status" ng-change="getDeviceDetailsByEID(edit_cond_approval.departments,edit_cond_approval.equp_id)">
                        <md-option ng-repeat="condemnation_status in condemnation_statuss"  ng-value="condemnation_status">
                            {{condemnation_status}}
                        </md-option>
                    </md-select>
                </md-input-container>
            </div>
            <div ng-if="acondemnation_status==condemnation_statuss[0]" flex="100" layout="row" layout-align="center center">
                <form method="POST" name="EditCondemnationadminForm" flex="100" autocomplete="off">
                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap style="margin-top:15px;">
                            <md-input-container class="md-block" flex-gt-sm flex="30">
                                <label>Serial Number</label>
                                <input type="text" ng-model="edit_cond_approval.serial_no" ng-disabled="true" aria-label="SERIAL NO"/>
                            </md-input-container>
                            <div flex="5" hide-xs hide-sm><!-- Space --></div>
                            <md-input-container class="md-block" flex-gt-sm flex="30">
                                <label>Contract Type</label>
                                <input type="text" ng-model="edit_cond_approval.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                            </md-input-container>
                            <div flex="5" hide-xs hide-sm><!-- Space --></div>
                            <md-input-container flex="30">
                                <label>Manufacturer</label>
                                <input type="text" ng-model="edit_cond_approval.company_name" ng-disabled="true" aria-label="C_NAME"/>
                            </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container  class="md-block" flex-gt-sm flex>
                            <label>Department</label>
                            <md-select ng-model="edit_cond_approval.departments" name="depts">
                                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment ID</label>
                            <input type="equp_id" ng-disabled="edit_cond_approval.departments==null" required ng-model="edit_cond_approval.equp_id" ng-change="getDeviceDetailsByEID(edit_cond_approval.departments,edit_cond_approval.equp_id)" name="equp_id" aria-label="equp_id"/>
                            <div ng-messages="EditCondemnationadminForm.equp_id.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment Name</label>
                            <input type="text"  ng-model="edit_cond_approval.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                            <div ng-messages="EditCondemnationadminForm.equp_name.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Equipment Model</label>
                            <input type="text"  ng-model="edit_cond_approval.equp_model" name="equp_model" aria-label="response" ng-disabled="true"/>
                            <div ng-messages="EditCondemnationadminForm.equp_model.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment Serial No</label>
                            <input type="text"  ng-model="edit_cond_approval.srial_no" name="eserial_no" aria-label="eserial_no" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment PO Date</label>
                            <input type="text"  ng-model="edit_cond_approval.po_date" name="po_date" aria-label="po_date" ng-disabled="true"/>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm  flex>
                            <label>Equipment Cost</label>
                            <input type="text"  ng-model="edit_cond_approval.equp_cost" name="equp_cost" aria-label="equp_cost" ng-disabled="true"/>
                            <div ng-messages="EditCondemnationadminForm.equp_cost.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm  flex>
                            <label>Reasons*</label>
                            <md-select ng-model="edit_cond_approval.reasons" name="reasons" multiple>
                                <md-option ng-repeat="conreason in conreasons"  ng-value="conreason.CODE">
                                    {{conreason.REQUEST_NAME}} ({{conreason.CODE}})
                                </md-option>
                            </md-select>
                            <div ng-messages="EditCondemnationadminForm.reasons.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Feedback</label>

                            <textarea ng-model="edit_cond_approval.feedback" name="feedback"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="with_in_unitForm.feedback.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                   <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex>
                        <label>Reusable Parts</label>
                        <md-select ng-model="edit_cond_approval.reusable_part" name="reusable_part" multiple>
                            <md-option ng-repeat="reusable_part in reusable_parts"  ng-value="reusable_part.CODE">
                                {{reusable_part.REUSABLE_PARTS}} ({{reusable_part.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm  flex>
                        <label>Expected Cost</label>
                        <input type="text"  ng-model="edit_cond_approval.expected_cost" name="expected_cost" aria-label="expected_cost"/>
                        <div ng-messages="EditCondemnationadminForm.expected_cost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Admin Feedback</label>

                                    <textarea ng-model="edit_cond_approval.admin_feedback" name="admin_feedback"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="with_in_unitForm.admin_feedback.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="UpdateAdminApprovals(edit_cond_approval,acondemnation_status)" ng-disabled="EditCondemnationadminForm.$invalid" aria-label="submit">Submit</md-button>
                        </center>
                    </div>
                </form>
            </div>

            <div ng-if="acondemnation_status==condemnation_statuss[1]" flex="100" layout="row" layout-align="center center">
                <form method="POST" name="EditcondDisapprovalForm"  autocomplete="off" flex="100">
                    <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap style="margin-top:15px;">
                        <md-input-container class="md-block" flex-gt-sm flex="30">
                            <label>Serial Number</label>
                            <input type="text" ng-model="edit_cond_disapproval.serial_no" ng-disabled="true" aria-label="SERIAL NO"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex="30" >
                            <label>Contract Type</label>
                            <input type="text" ng-model="edit_cond_disapproval.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container flex="30">
                            <label>Manufacturer</label>
                            <input type="text" ng-model="edit_cond_disapproval.company_name" ng-disabled="true" aria-label="C_NAME"/>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container  class="md-block" flex-gt-sm flex>
                            <label>Department</label>
                            <md-select ng-model="edit_cond_disapproval.departments" name="depts">
                                <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                    {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                                </md-option>
                            </md-select>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment ID</label>
                            <input type="equp_id" ng-disabled="edit_cond_disapproval.departments==null" required ng-model="edit_cond_disapproval.equp_id" ng-change="getDeviceDetailsByEID(edit_cond_approval.departments,edit_cond_disapproval.equp_id)" name="equp_id" aria-label="equp_id"/>
                            <div ng-messages="EditcondDisapprovalForm.equp_id.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment Name</label>
                            <input type="text"  ng-model="edit_cond_disapproval.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                            <div ng-messages="EditcondDisapprovalForm.equp_name.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment Model</label>
                            <input type="text"  ng-model="edit_cond_disapproval.equp_model" name="equp_model" aria-label="response" ng-disabled="true"/>
                            <div ng-messages="EditcondDisapprovalForm.equp_model.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment Serial No</label>
                            <input type="text"  ng-model="edit_cond_disapproval.srial_no" name="eserial_no" aria-label="eserial_no" ng-disabled="true"/>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm flex>
                            <label>Equipment PO Date</label>
                            <input type="text"  ng-model="edit_cond_disapproval.po_date" name="po_date" aria-label="po_date" ng-disabled="true"/>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm  flex>
                            <label>Equipment Cost</label>
                            <input type="text"  ng-model="edit_cond_disapproval.equp_cost" name="equp_cost" aria-label="equp_cost" ng-disabled="true"/>
                            <div ng-messages="EditcondDisapprovalForm.equp_cost.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                        <div flex="5" hide-xs hide-sm><!-- Space --></div>
                        <md-input-container class="md-block" flex-gt-sm  flex>
                            <label>Reasons*</label>
                            <md-select ng-model="edit_cond_disapproval.reasons" name="reasons" multiple>
                                <md-option ng-repeat="conreason in conreasons" ng-value="conreason.CODE">
                                    {{conreason.REQUEST_NAME}} ({{conreason.CODE}})
                                </md-option>
                            </md-select>
                            <div ng-messages="EditcondDisapprovalForm.reasons.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Feedback</label>
                            <textarea ng-model="edit_cond_disapproval.feedback" name="feedback"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="EditcondDisapprovalForm.feedback.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>
                    <div layout="row">
                        <md-input-container class="md-block" flex-gt-sm>
                            <label>Admin Reasons</label>
                            <textarea ng-model="edit_cond_disapproval.admin_reasons" name="admin_feedback"  rows="5" md-select-on-focus> </textarea>
                            <div ng-messages="EditcondDisapprovalForm.admin_reasons.$error">
                                <div ng-message="required">Required.</div>
                            </div>
                        </md-input-container>
                    </div>

                    <div flex layout="row" layout-align="center center">
                        <center>
                            <md-button class="md-raised md-accent" ng-click="UpdateAdminDisapprovals(edit_cond_disapproval,acondemnation_status)" ng-disabled="EditcondDisapprovalForm.$invalid" aria-label="submit">Submit</md-button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </md-dialog-content>
</md-dialog>