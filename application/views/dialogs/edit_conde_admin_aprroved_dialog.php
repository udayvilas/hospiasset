<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Condemnation Approved Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="approvedCondmnationform"  autocomplete="off">
                <div layout-gt-sm="row" layout-xs="column" layout-gt-xs="column" layout="row" layout-wrap style="margin-top:15px;">
                    <md-input-container class="md-block" flex-gt-sm flex="30">
                        <label>Serial Number</label>
                        <input type="text" ng-model="approved_condmnation.serial_no" ng-disabled="true" aria-label="SERIAL NO"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="30" >
                        <label>Contract Type</label>
                        <input type="text" ng-model="approved_condmnation.contract_type" ng-disabled="true" aria-label="Contract Type"/>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container flex="30">
                        <label>Manufacturer</label>
                        <input type="text" ng-model="approved_condmnation.company_name" ng-disabled="true" aria-label="C_NAME"/>
                    </md-input-container>
                </div>
                <div layout="row">
                    <!---<md-input-container  class="md-block" flex-gt-sm flex="40">
                        <label>Department</label>
                        <md-select ng-model="approved_condmnation.departments" name="depts">
                            <md-option ng-repeat="dept in depts"  ng-value="dept.CODE">
                                {{dept.USER_DEPT_NAME}} ({{dept.CODE}})
                            </md-option>
                        </md-select>
                    </md-input-container>--->		
					<md-autocomplete flex="20" class="md-block" flex-gt-sm						 ng-init="searched.CODE = (approved_condmnation.departments != null) ? {'CODE': approved_condmnation.departments,'USER_DEPT_NAME':approved_condmnation.department} : null"						 
					md-no-cache="false"                         md-selected-item="searched.CODE"                         md-search-text="approved_condmnation.searchDepartment"                         md-items="item in searchTextChange(approved_condmnation.searchDepartment,'Department')"              md-item-text="item.USER_DEPT_NAME"                         md-search-text-change="approved_condmnation.departments = ''"                         md-selected-item-change="approved_condmnation.departments = item.CODE"                         
					md-min-length="0"                         
					md-floating-label="Department">            
					<md-item-template>                
					<span md-highlight-text="searchDepartment" md-highlight-flags="^i">{{item.USER_DEPT_NAME}}</span>            
					</md-item-template>            
					<md-not-found>                
					No Department Found            
					</md-not-found> 
					</md-autocomplete>              
					<span ng-value="approved_condmnation.departments = searched.CODE.CODE" ng-model="approved_condmnation.departments = searched.CODE.CODE" >
					</span>					
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment ID</label>
                        <input type="equp_id" ng-disabled="approved_condmnation.departments==null" required ng-model="approved_condmnation.equp_id" ng-change="getDeviceDetailsByEID(condmnation_req.departments,approved_condmnation.equp_id)" name="equp_id" aria-label="equp_id"/>
                        <div ng-messages="approvedCondmnationform.equp_id.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>Equipment Name</label>
                        <input type="text"  ng-model="approved_condmnation.equp_name" name="equp_name" aria-label="equp_name" ng-disabled="true"/>
                        <div ng-messages="CondemnationReqForm.equp_name.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm  flex="40">
                        <label>Resold Value</label>
                        <input type="text" only-digits="only-degits" ng-model="approved_condmnation.resold_value" name="resold_value" aria-label="resold_value"/>
                        <div ng-messages="CondemnationReqForm.resold_value.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Reasons*</label>
                        <textarea ng-model="approved_condmnation.reasons" name="reasons" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="CondemnationReqForm.reasons.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                        </div>
                    </md-input-container>
                </form>
                <div layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Feedback</label>
                        <textarea ng-model="approved_condmnation.feedback" name="feedback" md-maxlength="350" rows="5" md-select-on-focus> </textarea>
                        <div ng-messages="CondemnationReqForm.feedback.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="UpdateApprovedbmeCondemnation(approved_condmnation)" ng-disabled="CondemnationReqForm.$invalid" aria-label="submit">Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>