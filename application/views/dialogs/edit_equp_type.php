<?php defined('BASEPATH') OR exit('Direct scripts Not allowed'); ?>
<md-dialog aria-label="dialog-box" flex="40" ng-clock>
    <md-toolbar>
        <div class="md-toolbar-tools">
            <h4>Equipment Type Details</h4>
            <span flex></span>
            <md-button class="md-icon-button" ng-click="cancel()">
                <md-icon md-font-set="material-icons">clear</md-icon>
            </md-button>
        </div>
    </md-toolbar>

    <md-dialog-content flex layout-align="center center">
        <div class="md-dialog-content">
            <form method="POST" name="EditEqupTypeForm" flex="100" autocomplete="off">
                <div flex layout="column">
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{equp_type_labels.TYPE}}</label>
                        <input  type="text" ng-model="eequp_type.type" md-maxlength="50" name="type" required>
                        <div ng-messages="EditEqupTypeForm.type.$error">
                            <div ng-message="required">Required.</div>							                            <div ng-message="md-maxlength">Max limit is reached.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm>
                        <label>{{equp_type_labels.CODE}}</label>
                        <input  type="text" ng-model="eequp_type.code" name="code"  md-maxlength="3" ng-change="eequp_type.code = (eequp_type.code | uppercase)"  ng-pattern="/^[a-zA-Z. ]*[a-zA-Z]$/" required>
                        <div ng-messages="EditEqupTypeForm.code.$error">
                            <div ng-message="required">Required.</div>                             <div ng-message="md-maxlength">Max limit is reached.</div>							 <div ng-show="EditEqupTypeForm.code.$error.pattern">Please Provide Text Only.</div>
                        </div>
                    </md-input-container>
                    <div flex="5" hide-xs hide-sm><!-- Space --></div>
                    <md-input-container class="md-block" flex-gt-sm flex="40">
                        <label>{{equp_type_labels.STATUS}}*</label>
                        <md-select name="status" required ng-model="eequp_type.status" aria-label="status">
                            <md-option  ng-value="status.ID" ng-repeat="status in user_statues">{{status.VALUE}}</md-option>
                        </md-select>
                        <div ng-messages="EditEqupTypeForm.status.$error">
                            <div ng-message="required">Required.</div>
                        </div>
                    </md-input-container>
                </div>

                <div flex layout="row" layout-align="center center">
                        <md-button class="md-raised md-accent" ng-click="updateEqupType(eequp_type)" ng-disabled="EditEqupTypeForm.$invalid" aria-label="submit" style="float:left" >Submit</md-button>
                        <div flex="2" hide-xs hide-sm><!-- Space --></div>
                        <md-button class="md-raised" style="float:left;color:#604ca3" ng-click="cancel()">Cancel</md-button>
                </div>
            </form>
        </div>
    </md-dialog-content>
</md-dialog>