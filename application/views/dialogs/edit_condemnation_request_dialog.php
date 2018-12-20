<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Condimnation Edit Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditCondemnationReqForm" autocomplete="off">
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap style="margin-top:15px;">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Serial Number</label>
                        <input type="text" ng-model="edit_condmnation_req.serial_no" ng-disabled="true" aria-label="SERIAL NO"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30" >
                        <label>Contract Type</label>
                        <input type="text" ng-model="edit_condmnation_req.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container flex="30">
                        <label>Manufacturer</label>
                        <input type="text" ng-model="edit_condmnation_req
                        .company_name" ng-disabled="true" aria-label="C_NAME"/>
                    </md-input-container>
                </div>
                <div layout="row">
                    <!---<md-input-container  class="md-block" flex-gt-sm flex="40">
                        <label>Department</label>
                        <md-select  ng-model="edit_condmnation_req.departments" name="depts">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>-->										<md-autocomplete flex="20" class="md-block" flex-gt-sm						 ng-init="searched.CODE = (edit_condmnation_req.departments != null) ? {'CODE': edit_condmnation_req.departments,'USER_DEPT_NAME':edit_condmnation_req.department} : null"						 md-no-cache="false"                         md-selected-item="searched.CODE"                         md-search-text="edit_condmnation_req.searchDepartment"                         md-items="item in searchTextChange(edit_condmnation_req.searchDepartment,'Department')"                         md-item-text="item.USER_DEPT_NAME"                         md-search-text-change="edit_condmnation_req.departments = ''"                         md-min-length="0"                         md-floating-label="Department">            <md-item-template>                <span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>            </md-item-template>            <md-not-found>                No Department Found            </md-not-found>        </md-autocomplete>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment ID</label>
                        <input type="equp_id" ng-disabled="edit_condmnation_req.departments==null" required ng-model="edit_condmnation_req.equp_id" ng-change="getDeviceDetailsByEID(edit_condmnation_req.departments,edit_condmnation_req.equp_id)" name="equp_id" aria-label="equp_id"/>
                        <div ng-messages="EditCondemnationReqForm.equp_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="edit_condmnation_req.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        <!--<div ng-messages="EditCondemnationReqForm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>-->
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Model</label>
                        <input type="text"  ng-model="edit_condmnation_req.model_no" name="equp_model" aria-label="response" ng-disabled="true"/>
                        <!---<div ng-messages="EditCondemnationReqForm.equp_model.$error">
                            <div ng-message="required">Required.</div>
                        </div>--->
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Serial No</label>
                        <input type="text"  ng-model="edit_condmnation_req.serial_no" name="eserial_no" aria-label="eserial_no" ng-disabled="true"/>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment PO Date</label>
                        <input type="text"  ng-model="edit_condmnation_req.po_date" name="po_date" aria-label="po_date" ng-disabled="true"/>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm  flex="40">
                        <label>Equipment Cost</label>
                <input type="text"  ng-pattern="/^(\d)+$/" ng-model="edit_condmnation_req.equp_cost" ng-maxlength="5" name="equp_cost" aria-label="equp_cost" ng-disabled="true"/>
                        <div ng-messages="EditCondemnationReqForm.equp_cost.$error">
                            <div ng-message="required">Required.</div>
							<div ng-show="EditCondemnationReqForm.equp_cost.$error.maxlength">Maxlength is Exceeds</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm  flex="40">
                        <label>Reasons*</label>
                        <md-select ng-model="edit_condmnation_req.reasons" name="reasons" multiple>
                            <md-option ng-repeat="conreason in conreasons"  ng-value="conreason.CODE">
                                {{conreason.REQUEST_NAME}} ({{conreason.CODE}})
                            </md-option>
                        </md-select>
                        <div ng-messages="EditCondemnationReqForm.reasons.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Feedback</label>

                        <textarea ng-model="edit_condmnation_req.feedback" name="feedback" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                        <!--<div ng-messages="EditCondemnationReqForm.feedback.$error">
                            <div ng-message="required">Required.</div>
                        </div>-->
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                    <center>
                        <md-button class="md-raised md-accent" ng-click="UpdateCondemnationRequest(edit_condmnation_req)" ng-disabled="EditCondemnationReqForm.$invalid" aria-label="submit">Submit</md-button>
                    </center>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>