<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Training Type Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EdittypeForm" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Training Type</label>
                        <input  type="text" ng-model="etrining_type.traing_type" name="traing_type" md-maxlength="50" required>
                        <div ng-messages="EdittypeForm.traing_type.$error">                             						<div ng-message="required">Required.</div>								<div ng-message="md-maxlength">Max limit is reached.</div>  						</div>
                         
                    </md-input-container>
                    <div flex="20" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>Code</label>
                        <input  type="text" ng-model="etrining_type.traing_type_code" md-maxlength="3" name="traing_type_code" ng-change="etrining_type.traing_type_code = (etrining_type.traing_type_code | uppercase)" ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" required>
                        <div ng-messages="EdittypeForm.traing_type_code.$error">	
						<div ng-message="required">Required.</div>		
						<div ng-message="md-maxlength">Max limit is reached.</div>   
						<div ng-show="EdittypeForm.traing_type_code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                </div>
                <div flex="5" hide-xs hide-sm><!-- Space --></div>
                <md-input-container class="md-block" flex-gt-sm flex="40">
                    <label>Status*</label>
                    <md-select name="status" required ng-model="etrining_type.status" aria-label="status">
                        <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                    </md-select>
                    <div ng-messages="EdittypeForm.status.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>
                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="UpdateTrainingType(etrining_type)" ng-disabled="EdittypeForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3"  ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>