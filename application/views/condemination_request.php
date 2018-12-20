<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<md-content class="mylayout-padding" md-theme="hospiclr" ng-cloak>
    <div layout="column">
        <h3 class="heading-stylerespond">Condemnation Request</h3>
        <span flex class="mandatory-fileds">Mandatory Fields are Marked with an asterisk(*)</span>
        <div flex layout="row" layout-align="center center">
            <form method="POST" name="CondemnationReqForm" flex="60" class="md-whiteframe-1dp mylayout-padding" autocomplete="off">

                <div layout="row">
                    <md-input-container  class="md-block" flex-gt-sm flex="40">
                        <label>Department</label>
                        <md-select ng-change="getDepartmentDevices(condmnation_req.dept_id)" ng-model="condmnation_req.dept_id" name="dept_id">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="45">
                        <label>Equipment ID *</label>
                        <md-select  ng-disabled="condmnation_req.dept_id==null" ng-model="condmnation_req.equp_id" name="equp_id" ng-change="getDeviceDetailsByEID(condmnation_req.dept_id,condmnation_req.equp_id)">
                            <md-option ng-repeat="device in devices"  ng-value="device.E_ID">
                                {{device.E_ID}}
                            </md-option>
                        </md-select>
                    </md-input-container>

                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="condmnation_req.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        <div ng-messages="CondemnationReqForm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Model</label>
                        <input type="text"  ng-model="condmnation_req.equp_model" name="equp_model" aria-label="response" ng-disabled="true"/>
                        <div ng-messages="CondemnationReqForm.equp_model.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Serial No</label>
                        <input type="text"  ng-model="condmnation_req.srial_no" name="eserial_no" aria-label="eserial_no" ng-disabled="true"/>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment PO Date</label>
                        <input type="text"  ng-model="condmnation_req.po_date" name="po_date" aria-label="po_date" ng-disabled="true"/>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm  flex="40">
                        <label>Equipment Cost</label>
                        <input type="text"  ng-model="condmnation_req.equp_cost" name="equp_cost" aria-label="equp_cost" ng-disabled="true"/>
                        <div ng-messages="CondemnationReqForm.equp_cost.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm  flex="40">
                        <label>Reasons*</label>
                        <md-select ng-model="condmnation_req.reasons" name="reasons" multiple>
                            <md-option ng-repeat="conreason in conreasons"  ng-value="conreason.CODE">
                                {{conreason.REQUEST_NAME}} ({{conreason.CODE}})
                            </md-option>
                        </md-select>
                        <div ng-messages="CondemnationReqForm.reasons.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Feedback</label>

                        <textarea ng-model="condmnation_req.feedback" name="feedback" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="with_in_unitForm.feedback.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="addCondmenationRequest(condmnation_req)" ng-disabled="CondemnationReqForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </div>
</md-content>