<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="60" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Equipment Condition Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content" ng-repeat="equpcond in equpconditionlabel">
            <form method="POST" name="EditEqupcondForm" flex="100" autocomplete="off">
                <div flex layout="row">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{equpcond.CONDITION_NAME}}</label>
                        <input  type="text" ng-model="eeqcond_data.equp_condition" name="equp_condition" required>
                        <div ng-messages="EditEqupcondForm.equp_condition.$error">
                             <div ng-message="required">Required.</div>                           <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                    <div flex="10" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{equpcond.CODE}}</label>
                        <input  type="text" ng-model="eeqcond_data.equp_code" name="equp_code" ng-change="eeqcond_data.equp_code = (eeqcond_data.equp_code | uppercase)" md-maxlength="3" ng-pattern="/^[a-zA-Z0-9 -]*$/" required>
                        <div ng-messages="EditEqupcondForm.equp_code.$error">
                             <div ng-message="required">Required.</div>                               <div ng-message="md-maxlength">Max limit is reached.</div>                               <div ng-show="EditEqupcondForm.equp_code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                   <!-- <div flex="5" hide-xs hide-sm><!-- Space --></div>
                   <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{equpcond.STATUS}}*</label>
                        <md-select name="status" required ng-model="eeqcond_data.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditEqupcondForm.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>

                    <div flex="10" hide-xs hide-sm><!-- Space --></div>


                <div flex layout="row" layout-align="center center">

                    <md-button class="md-raised md-accent" ng-click="UpdateEqupCondition(eeqcond_data)" ng-disabled="EditEqupcondForm.$invalid " aria-label="submit" style="float:left">Submit</md-button>
                    <div flex="2" hide-xs hide-sm><!-- Space --></div>
                    <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>

                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>